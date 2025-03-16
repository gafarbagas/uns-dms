@extends('layouts.layout-admin')

@section('title', 'Overview')

@push('styles')
    <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="row">
    <div class="col-sm-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Menunggu</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $waiting }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-spinner fa-2x text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Disetujui</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $approved }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-success"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Ditolak</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $rejected }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-times fa-2x text-danger"></i>
                    </div>
                </div>
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
@endpush