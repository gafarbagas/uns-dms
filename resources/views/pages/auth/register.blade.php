@extends('layouts.layout-auth')

@section('title', 'Register')

@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Buat Akun</h1>
    </div>
    <form class="user" action="{{ route('register') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" placeholder="Nama Lengkap">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{ old('nim') }}" id="nim" placeholder="NIM">
            @error('nim')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <select name="study_program" class="form-control @error('study_program') is-invalid @enderror">
                <option value="">Program Studi</option>
                <option value="Pendidikan Jasmani, Kesehatan, dan Rekreasi" {{ old('study_program') == 'Pendidikan Jasmani, Kesehatan, dan Rekreasi' ? 'selected' : '' }}>Pendidikan Jasmani, Kesehatan, dan Rekreasi</option>
                <option value="Pendidikan Kepelatihan Olahraga" {{ old('study_program') == 'Pendidikan Kepelatihan Olahraga' ? 'selected' : '' }}>Pendidikan Kepelatihan Olahraga</option>
            </select>
            @error('nim')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="exampleInputPassword" placeholder="Password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="exampleInputPassword" placeholder="Konfirmasi Password">
            @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block">
            Login
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a class="small" href="{{ route('login') }}">Sudah punya akun? Login</a>
    </div>
@endsection