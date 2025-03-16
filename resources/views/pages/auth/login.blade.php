@extends('layouts.layout-auth')

@section('title', 'Login')

@push('styles')
    <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="text-center">
        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
    </div>
    <form class="user" action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group">
            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Email" value="{{ old('email') }}">
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
        <button type="submit" class="btn btn-primary btn-block">
            Login
        </button>
    </form>
    <hr>
    <div class="text-center">
        <a href="#" data-toggle="modal" data-target="#forgotPasswordModal">Lupa Password?</a>
    </div>
    <div class="text-center">
        <a href="{{ route('register') }}">Buat Akun</a>
    </div>

    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Jika Anda lupa password, silakan hubungi admin untuk reset password.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
        
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif
    @if (session('error'))
        <script>
            toastr.error("{{ session('error') }}");
        </script>
    @endif
@endpush