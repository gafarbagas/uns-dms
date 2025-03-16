@extends('layouts.layout-admin')

@section('title', 'Pengaturan')

@push('styles')
    <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark">Pengaturan</h1>
</div>

<div class="card text-dark shadow mb-4">
    <div class="card-body">
        <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist">
            @if (Auth::user()->role == 'student')
                <li class="nav-item">
                    <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profil</a>
                </li>
            @endif
            <li class="nav-item">
                <a class="nav-link {{ Auth::user()->role == 'student' ? '' : 'active' }}" id="pills-password-tab" data-toggle="pill" href="#pills-password" role="tab" aria-controls="pills-password" aria-selected="false">Password</a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            @if (Auth::user()->role == 'student')
                <div class="tab-pane fade active show" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
            
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', Auth::user()->name) }}" placeholder="Nama Lengkap">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
            
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" value="{{ Auth::user()->student->nim }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label for="study_program" class="form-label">Program Studi</label>
                            <input type="text" class="form-control" id="study_program" value="{{ Auth::user()->student->study_program }}" readonly>
                        </div>
            
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </form>
                </div>
            @endif

            <div class="tab-pane fade {{ Auth::user()->role == 'student' ? '' : 'active show' }}" id="pills-password" role="tabpanel" aria-labelledby="pills-password-tab">
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
        
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Lama</label>
                        <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password">
                        @error('current_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
        
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Kofirmasi Password Baru</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
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

@push('scripts')
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
        
    @if (session('success'))
        <script>
            toastr.success("{{ session('success') }}");
        </script>
    @endif

    @if ($errors->any())
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let oldInput = @json(session('_old_input'));
                if (oldInput.hasOwnProperty('current_password') || 
                    oldInput.hasOwnProperty('password') || 
                    oldInput.hasOwnProperty('password_confirmation')) {
                    $('#pills-password-tab').tab('show'); 
                } else if (oldInput.hasOwnProperty('name')) {
                    $('#pills-profile-tab').tab('show'); 
                }
            });
        </script>
    @endif
@endpush