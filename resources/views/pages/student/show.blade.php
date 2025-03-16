@extends('layouts.layout-admin')

@section('title', 'Detail Mahasiswa')

@section('content')
<div class="d-sm-flex align-items-center mb-4">
    <a href="{{ route('student') }}" class="btn btn-sm btn-secondary btn-icon-split float-right">
        <span class="icon text-white-50">
            <i class="fas fa-arrow-left"></i>
        </span>
        <span class="text">Kembali</span>
    </a>
    <h1 class="ml-3 h3 mb-0 text-dark">Detail Mahasiswa</h1>
</div>

<div class="card text-dark shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <div class="row mb-3">
                    <div class="col-md-4 font-weight-bold">
                        Nama
                    </div>
                    <div class="col-md-8">
                        {{ $data->student_name }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 font-weight-bold">
                        NIM
                    </div>
                    <div class="col-md-8">
                        {{ $data->nim }}
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4 font-weight-bold">
                        Program Studi
                    </div>
                    <div class="col-md-8">
                        {{ $data->study_program }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <form action="{{ route('student.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection