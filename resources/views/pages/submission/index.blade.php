@extends('layouts.layout-admin')

@section('title', 'Pengajuan')

@push('styles')
    <link href="{{ asset('vendor/datatables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark">Pengajuan</h1>
</div>

<div class="card text-dark shadow mb-4">
    <div class="card-header d-flex justify-content-between py-3">
        @if (Auth::user()->role == 'student')
            <button type="button" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#addForm">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah</span>
            </button>
        @endif
        <button type="button" class="btn btn-sm btn-secondary btn-icon-split" data-toggle="modal" data-target="#filterForm">
            <span class="icon text-white-50">
                <i class="fas fa-search"></i>
            </span>
            <span class="text">Pencarian</span>
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm table-bordered table-hover text-dark nowrap" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th width="25px">No.</th>
                        <th>Dokumen</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        @if (Auth::user()->role == 'admin')
                            <th>Pengaju</th>
                        @endif
                        <th>Status</th>
                        <th width="50px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td class="align-middle">{{ $data->firstItem() + $key }}.</td>
                            <td class="align-middle">{{ Str::title(str_replace('-', ' ', $item->doc_type)) }}</td>
                            <td class="align-middle">
                                {{ \Carbon\Carbon::parse($item->created_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('d F Y') }}
                            </td>
                            <td class="align-middle">
                                {{ \Carbon\Carbon::parse($item->created_at)->setTimezone('Asia/Jakarta')->locale('id')->translatedFormat('H:i:s') }}
                            </td>
                            @if (Auth::user()->role == 'admin')
                                <td class="align-middle">{{ $item->user->name }}</td>
                            @endif
                            <td class="align-middle">
                                <div class="border border-{{ $item->status == 'menunggu' ? 'secondary' : ($item->status == 'disetujui' ? 'success' : 'danger') }} text-white px-2 rounded text-center text-{{ $item->status == 'menunggu' ? 'secondary' : ($item->status == 'disetujui' ? 'success' : 'danger') }}" style="cursor: default">{{ Str::title($item->status) }}</div>
                            </td>
                            <td class="d-flex justify-content-center align-middle">
                                @if (Auth::user()->role === 'admin' && $item->status === 'disetujui')
                                    <a href="{{ route('pengajuan.download', ['slug' => $item->doc_type, 'id' => Crypt::encrypt($item->id)]) }}" class="text-success mr-2">
                                        <i class="fas fa-download"></i>
                                    </a>
                                @endif
                                <a href="{{ route('pengajuan.show', ['slug' => $item->doc_type, 'id' => Crypt::encrypt($item->id)]) }}" class="text-secondary mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if (Auth::user()->role === 'admin' || ($item->status === 'menunggu' && Auth::user()->role === 'student'))
                                    <div type='button' class='text-danger btn-delete' data-id="{{ Crypt::encrypt($item->id) }}">
                                        <i class='fa fa-trash'></i>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-3">
                <div>
                    Menampilkan
                    @if ($data->total() != 0)
                        {!! $data->firstItem() !!} sampai  {!! $data->lastItem() !!} dari
                    @endif
                    {!! $data->total() !!} data
                </div>
                {{ $data->appends(request()->input() ?? '')->links() }}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="filterForm" tabindex="-1" aria-labelledby="filterFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="filterFormLabel">Pencarian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pengajuan') }}" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="dokumen">Dokumen</label>
                        <select name="dokumen" class="form-control">
                            <option value="">Pilih</option>
                            @foreach ($docTypes as $item => $value)
                                <option value="{{ $item }}" {{ request()->input('dokumen') == $item ? 'selected' : '' }}>{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-12">Tanggal Pengajuan</label>
                        <div class="col-sm-6">
                            <input type="date" name="date_from" class="form-control" placeholder="Enter date" value="{{ request()->input('date_from') ?? '' }}">
                        </div>
                        <div class="col-sm-6">
                            <input type="date" name="date_to" class="form-control" placeholder="Enter date" value="{{ request()->input('date_to') ?? '' }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control">
                            <option value="">Pilih</option>
                            <option value="menunggu" {{ request()->input('status') == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                            <option value="disetujui" {{ request()->input('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request()->input('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary reset">Reset</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addForm" tabindex="-1" role="dialog" aria-labelledby="addFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFormLabel">Pilih Pengajuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <a href="{{ route('pengajuan.form', ["slug" => "surat-dispensasi"]) }}" class="btn btn-block btn-primary py-3">
                            Surat Dispensasi
                        </a>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <a href="{{ route('pengajuan.form', ["slug" => "surat-izin-penelitian"]) }}" class="btn btn-block btn-primary py-3">
                            Surat Izin Penelitian
                        </a>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <a href="{{ route('pengajuan.form', ["slug" => "surat-keterangan-aktif"]) }}" class="btn btn-block btn-primary py-3">
                            Surat Keterangan Aktif
                        </a>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <a href="{{ route('pengajuan.form', ["slug" => "surat-keterangan-aktif-tunjangan"]) }}" class="btn btn-block btn-primary py-3">
                            Surat Keterangan Aktif Tunjangan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert2/sweetalert2.min.js') }}"></script>
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
    
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "paging":   false,
                "info":     false,
                "searching": false,
            });

            $(document).on('click', '.btn-delete', function() {
                var id = $(this).data('id');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Harap periksa kembali. Data yang sudah dihapus tidak dapat dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#888888',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/pengajuan/' + id,
                            type: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Berhasil!',
                                    'Data Anda telah dihapus.',
                                    'success'
                                );
                                location.reload();
                            },
                            error: function(response) {
                                Swal.fire(
                                    'Gagal!',
                                    'Terjadi kesalahan.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(".reset").click(function () {
                location.reload();
            });
        });
    </script>
@endpush
