<?php

namespace App\Http\Controllers;

use App\Models\ExemptionLetterStudent;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubmissionController extends Controller
{
    public function index(Request $request)
    {
        $data = Submission::where(function ($query) use ($request) {
            if ($request->input('dokumen')) {
                $query->where('doc_type', $request->input('dokumen'));
            }
            if ($request->input('date_from') && $request->input('date_to')) {
                $dateFrom = Carbon::createFromFormat('Y-m-d', $request->input('date_from'), 'Asia/Bangkok')
                    ->startOfDay() // Set to 00:00:00
                    ->setTimezone('UTC'); // Convert to UTC
            
                $dateTo = Carbon::createFromFormat('Y-m-d', $request->input('date_to'), 'Asia/Bangkok')
                    ->endOfDay() // Set to 23:59:59
                    ->setTimezone('UTC'); // Convert to UTC
            
                $query->whereBetween('created_at', [$dateFrom, $dateTo]);
            }
            if ($request->input('status')) {
                $query->where('status', $request->input('status'));
            }
        })
        ->when(auth()->user()->role !== 'admin', function ($query) {
            $query->where('user_id', auth()->id());
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        $docTypes = [
            'surat-dispensasi' => 'Surat Dispensasi',
            'surat-izin-penelitian' => 'Surat Izin Penelitian',
            'surat-keterangan-aktif' => 'Surat Keterangan Aktif',
            'surat-keterangan-aktif-tunjangan' => 'Surat Keterangan Aktif Tunjangan',
        ];
        return view('pages.submission.index', compact('data', 'docTypes'));
    }

    public function create($slug)
    {
        if (!$this->isValidSlug($slug)) {
            return view('pages.errors.404');
        }

        $title = Str::title(str_replace('-', ' ', $slug));

        return view("pages.submission.form", compact('slug', 'title'));
    }

    public function store(Request $request, $slug)
    {
        if (!$this->isValidSlug($slug)) {
            return view('pages.errors.404');
        }

        $rules = $this->getValidationRules($slug);
        $messages = $this->getValidationMessages();
        $attributes = $this->getValidationAttributes();

        $validatedData = $request->validate($rules, $messages, $attributes);

        DB::beginTransaction();

        try {
            $submission = Submission::create([
                "user_id" => Auth::user()->id,
                "doc_type" => $slug,
                "status" => "menunggu",
            ]);

            if ($slug == 'surat-dispensasi' && $request->hasFile('attachment')) {
                $file = $request->file('attachment');
                $filePath = $file->store('uploads/attachments');
                $validatedData['attachment'] = json_encode($filePath);
            }

            $model = $this->getDocTypeModels($slug);
            $model = $model::create(array_merge($validatedData, [
                "submission_id" => $submission->id,
            ]));

            if ($slug == 'surat-dispensasi') {
                foreach ($validatedData['student_name'] as $index => $studentName) {
                    ExemptionLetterStudent::create([
                        "exemption_letter_id" => $model->id,
                        "student_name" => $studentName,
                        "nim" => $validatedData['nim'][$index],
                        "study_program" => $validatedData['study_program'][$index],
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('pengajuan')->with('success', 'Pengajuan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error creating submission: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function show($slug, $id)
    {
        if (!$this->isValidSlug($slug)) {
            return view('pages.errors.404');
        }

        $id = Crypt::decrypt($id);
        $title = Str::title(str_replace('-', ' ', $slug));
        $submission = Submission::find($id);

        if (!$submission) {
            return view('pages.errors.404');
        }

        $model = $this->getDocTypeModels($slug);

        if ($slug === 'surat-dispensasi') {
            $record = $model::with('students')->where('submission_id', $submission->id)->first();
        } else {
            $record = $model::where('submission_id', $submission->id)->first();
        }

        if (!$record) {
            return view('pages.errors.404');
        }

        if (Auth::user()->role !== 'admin' && $submission->user_id !== Auth::user()->id) {
            return view('pages.errors.404');
        }

        $attributeLabels = $this->getValidationAttributes();

        $excludedFields = ['id', 'submission_id', 'doc_number', 'created_at', 'updated_at'];

        $data = [];
        foreach ($record->toArray() as $key => $value) {
            if (!in_array($key, $excludedFields) && !is_null($value)) {
                if ($key === 'bod') {
                    $value = \Carbon\Carbon::parse($value)->locale('id')->translatedFormat('d F Y');
                }
                $data[] = [
                    'label' => $attributeLabels[$key] ?? ucfirst(str_replace('_', ' ', $key)),
                    'value' => $value
                ];
            }
        }

        return view('pages.submission.show', compact('data', 'title', 'slug', 'id'));
    }

    public function approval(Request $request, $slug, $id, $status)
    {
        if (!$this->isValidSlug($slug) || !in_array($status, ['disetujui', 'ditolak'])) {
            return view('pages.errors.404');
        }

        $id = Crypt::decrypt($id);
        $submission = Submission::find($id);
        if (!$submission) {
            return view('pages.errors.404');
        }

        $model = $this->getDocTypeModels($slug);
        if (!$model) {
            return view('pages.errors.404');
        }
        
        $rules = $this->getValidationApprovalRules($slug, $status);
        $messages = $this->getValidationMessages();
        $attribute = $this->getValidationAttributes();

        try {
            $validatedData = $request->validate($rules, $messages, $attribute);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $updateData = ["status" => $status];

            if ($status === 'ditolak') {
                $updateData['keterangan'] = $validatedData['keterangan'];
            } else {
                $model::where('submission_id', $id)->update($validatedData);
            }

            $submission->update($updateData);

            DB::commit();

            return redirect()->route('pengajuan')->with('success', 'Pengajuan ' . $status);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error updating submission: " . $e->getMessage());

            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    public function download($slug, $id)
    {
        if (!$this->isValidSlug($slug)) {
            return view('pages.errors.404');
        }

        $id = Crypt::decrypt($id);
        $title = Str::title(str_replace('-', ' ', $slug));
        $submission = Submission::find($id);

        if (!$submission || $submission->status !== 'disetujui') {
            return view('pages.errors.404');
        }

        $model = $this->getDocTypeModels($slug);

        $query = $model::query();
        if ($slug === 'surat-dispensasi') {
            $query->with('students');
        }

        $data = $query->where('submission_id', $submission->id)->first();
        if (!$data) {
            return view('pages.errors.404');
        }

        $dateFields = ['bod', 'research_date', 'cover_letter_date', 'exemption_date_start', 'exemption_date_end'];
        foreach ($dateFields as $field) {
            if (!empty($data->$field)) {
                $data->$field = Carbon::parse($data->$field)->locale('id')->translatedFormat('d F Y');
            }
        }

        if ($slug === 'surat-dispensasi') {
            if (!empty($data->exemption_date_start) && !empty($data->exemption_date_end)) {
                if ($data->exemption_date_start === $data->exemption_date_end) {
                    $data->exemption_date = $data->exemption_date_start;
                } else {
                    $data->exemption_date = "{$data->exemption_date_start} - {$data->exemption_date_end}";
                }
            } else {
                $data->exemption_date = $data->exemption_date_start ?? $data->exemption_date_end ?? '';
            }

            $dataArray['exemption_date'] = $data->exemption_date;
        }

        $dataArray = $data->toArray();

        foreach ($dataArray as $key => $value) {
            if (is_array($value)) {
                $dataArray[$key] = implode(', ', array_map(fn($item) => is_array($item) ? json_encode($item) : (string)$item, $value));
            } else {
                $dataArray[$key] = (string) $value;
            }
        }

        $dataArray['date'] = Carbon::now()->locale('id')->translatedFormat('d F Y');
        $phpWord = new \PhpOffice\PhpWord\TemplateProcessor("file/{$slug}.docx");
        $phpWord->setValues($dataArray);

        if ($slug === 'surat-dispensasi' && isset($data->students)) {
            $students = $data->students;
            $phpWord->cloneRow('students.name', count($students));

            $studyPrograms = $students->pluck('study_program')->unique();

            $tembusanMap = [
                'Pendidikan Jasmani, Kesehatan, dan Rekreasi' => 'Kaprodi S1-Pendidikan Jasmani, Kesehatan, dan Rekreasi',
                'Pendidikan Kepelatihan Olahraga' => 'Kaprodi S1-Pendidikan Kepelatihan Olahraga',
            ];

            $tembusanList = [];
            foreach ($studyPrograms as $program) {
                if (isset($tembusanMap[$program])) {
                    $tembusanList[] = count($tembusanList) + 1 . '. ' . $tembusanMap[$program];
                }
            }

            $tembusanText = implode("\n", $tembusanList);
            $phpWord->setValue('tembusan', $tembusanText);

            foreach ($students as $index => $student) {
                $row = $index + 1;
                $phpWord->setValue("students.no#{$row}", $index + 1);
                $phpWord->setValue("students.name#{$row}", $student->student_name);
                $phpWord->setValue("students.nim#{$row}", $student->nim);
                $phpWord->setValue("students.study_program#{$row}", $student->study_program);
            }
            
            // Clone second table using different placeholders
            $phpWord->cloneRow('students_2.name', count($students));
            foreach ($students as $index => $student) {
                $row = $index + 1;
                $phpWord->setValue("students_2.no#{$row}", $index + 1);
                $phpWord->setValue("students_2.name#{$row}", $student->student_name);
                $phpWord->setValue("students_2.nim#{$row}", $student->nim);
                $phpWord->setValue("students_2.study_program#{$row}", $student->study_program);
            }
        }

        $tempFile = tempnam(sys_get_temp_dir(), 'word');
        $phpWord->saveAs($tempFile);

        return response()->download($tempFile, "$title.docx")->deleteFileAfterSend(true);
    }

    public function delete($id)
    {
        $id = Crypt::decrypt($id);
        $submission = Submission::find($id);

        if (!$submission) {
            return view('pages.errors.404');
        }

        if (Auth::user()->role !== 'admin' && $submission->user_id !== Auth::user()->id) {
            return view('pages.errors.404');
        }

        DB::beginTransaction();

        try {
            $submission->delete();
            DB::commit();
            return redirect()->route('pengajuan')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error deleting submission: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan, silakan coba lagi.');
        }
    }

    private function isValidSlug($slug)
    {
        $validSlugs = [
            'surat-dispensasi', 
            'surat-izin-penelitian', 
            'surat-keterangan-aktif', 
            'surat-keterangan-aktif-tunjangan'
        ];
        
        return in_array($slug, $validSlugs);
    }

    private function getDocTypeModels($docTypeSlug)
    {
        $models = [
            'surat-dispensasi' => \App\Models\ExemptionLetter::class,
            'surat-izin-penelitian' => \App\Models\PermissionLetter::class,
            'surat-keterangan-aktif' => \App\Models\ActiveStatusLetter::class,
            'surat-keterangan-aktif-tunjangan' => \App\Models\ActiveStatusBenefitLetter::class,
        ];
        return $models[$docTypeSlug] ?? abort(404);
    }

    private function getValidationRules($slug)
    {
        $rules = [
            'surat-dispensasi' => [
                'student_name.*' => 'required|string|max:255',
                'nim.*' => 'required|string|max:20',
                'study_program.*' => 'required|string|max:255',
                'attachment' => 'required|file|mimetypes:application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/pdf,image/jpeg,image/png|max:5120',
                'cover_letter_number' => 'required|string|max:255',
                'cover_letter_date' => 'required|date',
                'event_organizer' => 'required|string|max:255',
                'event_name' => 'required|string|max:255',
                'event_place' => 'required|string|max:255',
                'event_level' => 'required|string|max:255',
                'exemption_date_start' => 'required|date',
                'exemption_date_end' => 'required|date',
                'exemption_reason' => 'required|string|max:255',
                'lecture_name' => 'required|string|max:255',
                'lecture_nidn' => 'required|string|max:255',
                'lecture_unit' => 'required|string|max:255',
                'lecture_duty' => 'required|string|max:255',
                'participation_status' => 'required|string|max:255',
                'sport_name' => 'required|string|max:255',
            ],
            'surat-izin-penelitian' => [
                'service_type' => 'required|string|max:255',
                'student_name' => 'required|string|max:255',
                'nim' => 'required|string|max:255',
                'study_program' => 'required|string|max:255',
                'pob' => 'required|string|max:255',
                'bod' => 'required|date',
                'address' => 'required|string|max:255',
                'thesis_title' => 'required|string|max:255',
                'institution_name' => 'required|string|max:255',
                'institution_city' => 'required|string|max:255',
                'head_of_institution' => 'required|string|max:255',
                'research_address' => 'required|string|max:1000',
                'research_date' => 'required|date',
                'research_object' => 'required|string|max:255',
            ],
            'surat-keterangan-aktif' => [
                'student_name' => 'required|string|max:255',
                'pob' => 'required|string|max:255',
                'bod' => 'required|date',
                'address' => 'required|string|max:1000',
                'nim' => 'required|string|max:255',
                'study_program' => 'required|string|max:255',
                'year' => 'required|integer',
                'semester' => 'required|integer',
                'institution_name' => 'required|string|max:255',
            ],
            'surat-keterangan-aktif-tunjangan' => [
                'student_name' => 'required|string|max:255',
                'nim' => 'required|string|max:255',
                'study_program' => 'required|string|max:255',
                'tingkat' => 'required|integer',
                'semester' => 'required|integer',
                'parent_name' => 'required|string|max:255',
                'nip' => 'required|string|max:255',
                'rank' => 'required|string|max:255',
                'group' => 'required|string|max:255',
                'room' => 'required|string|max:255',
                'institution_name' => 'required|string|max:255',
                'marital_status' => 'required|string|max:255',
                'retirement_payment_book_number' => 'required|string|max:255',
            ],
        ];

        return $rules[$slug] ?? [];
    }

    private function getValidationApprovalRules($slug, $status)
    {
        if ($status === 'disetujui') {
            if ($slug === 'surat-dispensasi') {
                return [
                    'doc_number_1' => 'required|string|max:255',
                    'doc_number_2' => 'required|string|max:255',
                    'doc_number_3' => 'required|string|max:255',
                ];
            } else {
                return [
                    'doc_number' => 'required|string|max:255',
                ];
            }
        } elseif ($status === 'ditolak') {
            return [
                'notes' => 'required|string|max:1000',
            ];
        }

        return [];
    }

    private function getValidationMessages()
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string' => ':attribute harus berupa teks.',
            'max' => ':attribute tidak boleh lebih dari :max karakter.',
            'date' => ':attribute harus berupa tanggal yang valid.',
            'integer' => ':attribute harus berupa angka.',
            'file' => ':attribute harus berupa file.',
            'mimes' => ':attribute harus memiliki format: :values.',
            'attachment.max' => 'Ukuran file :attribute tidak boleh lebih dari 5MB.',
        ];
    }

    private function getValidationAttributes()
    {
        return [
            'reason' => 'Alasan',
            'date' => 'Tanggal',
            'service_type' => 'Tipe Layanan',
            'student_name' => 'Nama Mahasiswa',
            'nim' => 'NIM',
            'study_program' => 'Program Studi',
            'student_name.*' => 'Nama Mahasiswa',
            'nim.*' => 'NIM',
            'study_program.*' => 'Program Studi',
            'pob' => 'Tempat Lahir',
            'bod' => 'Tanggal Lahir',
            'address' => 'Alamat',
            'thesis_title' => 'Judul Tesis',
            'institution_name' => 'Nama Institusi',
            'institution_city' => 'Kota Institusi',
            'head_of_institution' => 'Nama Kepala Institusi',
            'research_address' => 'Alamat Penelitian',
            'research_date' => 'Tanggal Penelitian',
            'research_object' => 'Tujuan Penelitian',
            'year' => 'Tahun',
            'semester' => 'Semester',
            'tingkat' => 'Tingkat',
            'parent_name' => 'Nama Orang Tua',
            'nip' => 'NIP / NRP',
            'rank' => 'Jabatan',
            'group' => 'Golongan',
            'room' => 'Ruang',
            'marital_status' => 'Status Perkawinan',
            'retirement_payment_book_number' => 'Nomor Buku Pembayaran Pensiun',
            'cover_letter_date' => 'Tanggal Surat Pengantar',
            'exemption_date_start' => 'Tanggal Dispensasi Awal',
            'exemption_date_end' => 'Tanggal Dispensasi Akhir',
            'cover_letter_number' => 'Nomor Surat Pengantar',
            'event_level' => 'Tingkat Kegiatan',
            'event_name' => 'Nama Kegiatan',            
            'event_organizer' => 'Penyelenggara Kegiatan',
            'event_place' => 'Tempat Kegiatan',
            'exemption_reason' => 'Alasan Dispensasi',
            'lecture_name' => 'Nama Dosen',
            'lecture_nidn' => 'NIDN Dosen',
            'lecture_unit' => 'Unit Dosen',
            'lecture_duty' => 'Tugas Dosen',
            'participation_status' => 'Status Kegiatan',
            'sport_name' => 'Cabang Olahraga',
            'doc_number' => 'Nomor Surat',
            'doc_number_1' => 'Nomor Surat Dispensasi',
            'doc_number_2' => 'Nomor Surat Tugas Mahasiswa',
            'doc_number_3' => 'Nomor Surat Tugas Dosen',
            'notes' => 'Alasan Penolakan',
            'attachment' => 'Dokumen Pendukung',
        ];
    }
}
