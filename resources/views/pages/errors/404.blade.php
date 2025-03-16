@extends('layouts.layout-admin')

@section('title', '404')

@section('content')
<div class="d-flex align-items-center justify-content-center" style="height: calc(100vh - 170.8px)">
    <div class="text-center">
        <div class="h2 mb-3 text-dark">404</div>
        <div class="h4 mb-5 text-dark">Halaman Tidak Ditemukan</div>
        <div class="h6 text-dark">Silakan kembali ke <a href="{{ route('overview') }}">halaman utama</a>.</div>

    </div>
</div>
@endsection