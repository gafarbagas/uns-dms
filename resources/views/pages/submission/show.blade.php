@extends('layouts.layout-admin')

@section('title', $title)

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark">{{ $title }}</h1>
    @if (Auth::user()->role == 'admin')
        <div class="d-flex">
            <button type="button" class="btn btn-sm btn-success btn-icon-split mr-3" data-toggle="modal" data-target="#addForm">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Setujui</span>
            </button>
            <button type="button" class="btn btn-sm btn-danger btn-icon-split" data-toggle="modal" data-target="#rejectForm">
                <span class="icon text-white-50">
                    <i class="fas fa-times"></i>
                </span>
                <span class="text">Tolak</span>
            </button>
        </div>
    @endif
</div>

<div class="card text-dark shadow mb-4">
    <div class="card-body">
        @foreach ($data as $item)
            @if ($slug == 'surat-dispensasi' && $item['label'] == 'Students')
                <div class="font-weight-bold">Data Mahasiswa</div>
                <table width="100%" class="table table-bordered table-sm text-dark">
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Program Studi</th>
                    </tr>
                    @foreach ($item['value'] as $student)
                        <tr>
                            <td>{{ $student['student_name'] }}</td>
                            <td>{{ $student['nim'] }}</td>
                            <td>{{ $student['study_program'] }}</td>
                        </tr>
                    @endforeach
                </table>
            @else
                <div class="row mb-2">
                    <div class="col-sm-4 font-weight-bold">
                        {{ $item['label'] }}
                    </div>
                    <div class="col-sm-8">
                        {{ $item['value'] }}
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

@if (Auth::user()->role == 'admin')
    <div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="addFormLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFormLabel">Setujui Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pengajuan.approval', ["slug" => $slug, "id" => Crypt::encrypt($id), "status" => "disetujui"]) }}" method="POST" id="approvalForm">
                    @csrf
                    @method("PUT")
                    @if ($slug == 'surat-dispensasi')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="doc_number_1">Nomor Surat Dispensasi</label>
                                <input type="text" class="form-control @error('doc_number_1') is-invalid @enderror" id="doc_number_1" name="doc_number_1" placeholder="Nomor Surat Dispensasi" value="{{ old('doc_number_1') }}">
                                @error('doc_number_1')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="doc_number_2">Nomor Surat Tugas Mahasiswa</label>
                                <input type="text" class="form-control @error('doc_number_2') is-invalid @enderror" id="doc_number_2" name="doc_number_2" placeholder="Nomor Surat Tugas Mahasiswa" value="{{ old('doc_number_2') }}">
                                @error('doc_number_2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="doc_number_3">Nomor Surat Tugas Dosen</label>
                                <input type="text" class="form-control @error('doc_number_3') is-invalid @enderror" id="doc_number_3" name="doc_number_3" placeholder="Nomor Surat Tugas Dosen" value="{{ old('doc_number_3') }}">
                                @error('doc_number_3')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @else
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="doc_number">Nomor Surat</label>
                                <input type="text" class="form-control @error('doc_number') is-invalid @enderror" id="doc_number" name="doc_number" placeholder="Nomor Surat" value="{{ old('doc_number') }}">
                                @error('doc_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="submitApproval">
                            Setujui
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectForm" tabindex="-1" role="dialog" aria-labelledby="rejectFormLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectFormLabel">Setujui Pengajuan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pengajuan.approval', ["slug" => $slug, "id" => Crypt::encrypt($id), "status" => "ditolak"]) }}" method="POST" id="rejectForm">
                    @csrf
                    @method("PUT")
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="notes">Alasan Penolakan</label>
                            <textarea type="text" class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" placeholder="Alasan Penolakan" value="{{ old('notes') }}"></textarea>
                            @error('notes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger" id="submitRejection">
                            Tolak
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
@endsection

@if (Auth::user()->role == 'admin')
@push('scripts')
    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let oldInput = @json(session('_old_input'));
                if (oldInput.hasOwnProperty('doc_number_1') || 
                    oldInput.hasOwnProperty('doc_number_2') || 
                    oldInput.hasOwnProperty('doc_number_3') || 
                    oldInput.hasOwnProperty('doc_number')) {
                    $('#addForm').modal('show'); 
                } else if (oldInput.hasOwnProperty('notes')) {
                    $('#rejectForm').modal('show'); 
                }
            });
        </script>
    @endif

    <script>
        const approvalForm = document.getElementById('approvalForm');
        const rejectForm = document.getElementById('rejectForm');
        const submitApproval = document.getElementById('submitApproval');
        const submitRejection = document.getElementById('submitRejection');

        approvalForm.addEventListener('submit', function () {
            submitApproval.disabled = true;
            submitApproval.textContent = 'Menunggu...';
        });

        rejectForm.addEventListener('submit', function () {
            submitRejection.disabled = true;
            submitRejection.textContent = 'Menunggu...';
        });
    </script>
@endpush
@endif
