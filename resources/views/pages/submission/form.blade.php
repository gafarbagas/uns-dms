@extends('layouts.layout-admin')

@section('title', $title)

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark">{{ $title }}</h1>
</div>

<div class="card text-dark shadow mb-4">
    <form action="{{ route('pengajuan.store', ["slug" => $slug]) }}" id="submissionForm" method="POST" @if ($slug == 'surat-dispensasi') enctype="multipart/form-data" @endif>
        @csrf
        <div class="card-body">
            @if ($slug == 'surat-dispensasi')
                @include('pages.submission.form.surat-dispensasi')
            @elseif ($slug == 'surat-izin-penelitian')
                @include('pages.submission.form.surat-izin-penelitian')
            @elseif ($slug == 'surat-keterangan-aktif')
                @include('pages.submission.form.surat-keterangan-aktif')
            @elseif ($slug == 'surat-keterangan-aktif-tunjangan')
                @include('pages.submission.form.surat-keterangan-aktif-tunjangan')
            @endif

            <div class="d-flex justify-content-between">
                <a href="{{ route('pengajuan') }}" class="btn btn-sm btn-secondary btn-icon-split" id="cancelButton">
                    <span class="icon text-white-50">
                        <i class="fas fa-chevron-left"></i>
                    </span>
                    <span class="text">Kembali</span>
                </a>
                <button type="submit" class="btn btn-sm btn-primary btn-icon-split" id="submitButton">
                    <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                    </span>
                    <span class="text">Simpan</span>
                </button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
    <script>
        const form = document.getElementById('submissionForm');
        const submitButton = document.getElementById('submitButton');
        const cancelButton = document.getElementById('cancelButton');
        const submitText = submitButton.querySelector('.text');

        form.addEventListener('submit', function () {
            submitButton.disabled = true;
            cancelButton.disabled = true;
            submitText.textContent = 'Menunggu...';
        });
    </script>
@endpush