<div class="font-weight-bold mb-3">Data Mahasiswa</div>
<div class="row mb-3">
    <div class="col-sm-12">
        <div id="student-form-container">
            @foreach (old('student_name', ['']) as $index => $oldValue)
                <div class="student-form row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control @error("student_name.$index") is-invalid @enderror" name="student_name[]" placeholder="Nama Mahasiswa" value="{{ old("student_name.$index") }}">
                            @error("student_name.$index")
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control @error("nim.$index") is-invalid @enderror" name="nim[]" placeholder="NIM" value="{{ old("nim.$index") }}">
                            @error("nim.$index")
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control @error("study_program.$index") is-invalid @enderror" name="study_program[]">
                                <option value="">Program Studi</option>
                                <option value="Pendidikan Jasmani, Kesehatan, dan Rekreasi" {{ old("study_program.$index") == 'Pendidikan Jasmani, Kesehatan, dan Rekreasi' ? 'selected' : '' }}>Pendidikan Jasmani, Kesehatan, dan Rekreasi</option>
                                <option value="Pendidikan Kepelatihan Olahraga" {{ old("study_program.$index") == 'Pendidikan Kepelatihan Olahraga' ? 'selected' : '' }}>Pendidikan Kepelatihan Olahraga</option>
                            </select>
                            @error("study_program.$index")
                                <span class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    @if ($index != 0 && ($errors->has("student_name.$index") || $errors->has("nim.$index") || $errors->has("study_program.$index")))
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-student">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                @endif
                </div>
            @endforeach
        </div>
        <button type="button" class="btn btn-primary btn-sm mt-2" id="add-student">Tambah Mahasiswa</button>
    </div>
</div>

<div class="font-weight-bold mb-3">Data Kegiatan</div>
<div class="row mb-3">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="cover_letter_number">Nomor Surat Undangan</label>
            <input type="text" class="form-control @error('cover_letter_number') is-invalid @enderror" id="cover_letter_number" name="cover_letter_number" placeholder="Nomor Surat Undangan" value="{{ old('cover_letter_number') }}">
            @error('cover_letter_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="cover_letter_date">Tanggal Surat Undangan</label>
            <input type="date" class="form-control @error('cover_letter_date') is-invalid @enderror" id="cover_letter_date" name="cover_letter_date" placeholder="Nomor Surat Undangan" value="{{ old('cover_letter_date') }}">
            @error('cover_letter_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="event_organizer">Penyelenggara</label>
            <input type="text" class="form-control @error('event_organizer') is-invalid @enderror" id="event_organizer" name="event_organizer" placeholder="Penyelenggara" value="{{ old('event_organizer') }}">
            @error('event_organizer')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="event_name">Nama Kegiatan</label>
            <input type="text" class="form-control @error('event_name') is-invalid @enderror" id="event_name" name="event_name" placeholder="Nama Kegiatan" value="{{ old('event_name') }}">
            @error('event_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="event_place">Tempat Kegiatan</label>
            <input type="text" class="form-control @error('event_place') is-invalid @enderror" id="event_place" name="event_place" placeholder="Tempat Kegiatan" value="{{ old('event_place') }}">
            @error('event_place')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="exemption_date_start">Tanggal Dispensasi Awal</label>
            <input type="date" class="form-control @error('exemption_date_start') is-invalid @enderror" id="exemption_date_start" name="exemption_date_start" placeholder="Tanggal Dispensasi Awal" value="{{ old('exemption_date_start') }}">
            @error('exemption_date_start')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="exemption_date_end">Tanggal Dispensasi Akhir</label>
            <input type="date" class="form-control @error('exemption_date_end') is-invalid @enderror" id="exemption_date_end" name="exemption_date_end" placeholder="Tanggal Dispensasi Akhir" value="{{ old('exemption_date_end') }}">
            @error('exemption_date_end')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="exemption_reason">Alasan Dispensasi</label>
            <input type="text" class="form-control @error('exemption_reason') is-invalid @enderror" id="exemption_reason" name="exemption_reason" placeholder="Alasan Dispensasi" value="{{ old('exemption_reason') }}">
            @error('exemption_reason')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="sport_name">Cabang Olahraga</label>
            <input type="text" class="form-control @error('sport_name') is-invalid @enderror" id="sport_name" name="sport_name" placeholder="Cabang Olahraga" value="{{ old('sport_name') }}">
            @error('sport_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="participation_status">Status Keikutsertaan</label>
            <input type="text" class="form-control @error('participation_status') is-invalid @enderror" id="participation_status" name="participation_status" placeholder="Status Keikutsertaan" value="{{ old('participation_status') }}">
            @error('participation_status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="event_level">Tingkat</label>
            <input type="text" class="form-control @error('event_level') is-invalid @enderror" id="event_level" name="event_level" placeholder="Tingkat" value="{{ old('event_level') }}">
            @error('event_level')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="lecture_name">Nama Dosen Penanggung Jawab</label>
            <input type="text" class="form-control @error('lecture_name') is-invalid @enderror" id="lecture_name" name="lecture_name" placeholder="Nama Dosen Penanggung Jawab" value="{{ old('lecture_name') }}">
            @error('lecture_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="lecture_nidn">NIDN Dosen</label>
            <input type="text" class="form-control @error('lecture_nidn') is-invalid @enderror" id="lecture_nidn" name="lecture_nidn" placeholder="NIDN Dosen" value="{{ old('lecture_nidn') }}">
            @error('lecture_nidn')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="lecture_unit">Unit Kerja Dosen</label>
            <input type="text" class="form-control @error('lecture_unit') is-invalid @enderror" id="lecture_unit" name="lecture_unit" placeholder="Unit Kerja Dosen" value="{{ old('lecture_unit') }}">
            @error('lecture_unit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="lecture_duty">Tugas Dosen</label>
            <input type="text" class="form-control @error('lecture_duty') is-invalid @enderror" id="lecture_duty" name="lecture_duty" placeholder="Tugas Dosen" value="{{ old('lecture_duty') }}">
            @error('lecture_duty')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="attachment">Dokumen Pendukung*</label>
            <input type="file" class="form-control-file mt-1 mb-2 @error('attachment') is-invalid @enderror" id="attachment" name="attachment" placeholder="Dokumen Pendukung" value="{{ old('attachment') }}">
            @error('attachment')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <p>*Undangan/Invitasi/Bukti Pendukung lainnya jadikan 1 dokumen.</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('add-student').addEventListener('click', function () {
        let container = document.getElementById('student-form-container');
        let newRow = document.createElement('div');
        newRow.classList.add('student-form', 'row');
        newRow.innerHTML = `
            <div class="col-md-4">
                <div class="form-group">
                    <input type="text" class="form-control" name="student_name[]" placeholder="Nama Mahasiswa">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control" name="nim[]" placeholder="NIM">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <select class="form-control" name="study_program[]">
                        <option value="">Program Studi</option>
                        <option value="Pendidikan Jasmani, Kesehatan, dan Rekreasi">Pendidikan Jasmani, Kesehatan, dan Rekreasi</option>
                        <option value="Pendidikan Kepelatihan Olahraga">Pendidikan Kepelatihan Olahraga</option>
                    </select>
                </div>
            </div>
            <div class="col-md-1">
                <button type="button" class="btn btn-danger remove-student"><i class="fas fa-trash"></i></button>
            </div>
        `;
        container.appendChild(newRow);
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('remove-student')) {
            e.target.closest('.student-form').remove();
        }
    });
</script>

@endpush