@extends('layouts.layout-admin')

@section('title', 'Data Mahasiswa')

@push('styles')
    <link href="{{ asset('vendor/datatables/datatables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/toastr/toastr.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-dark">Data Mahasiswa</h1>
</div>

<div class="card text-dark shadow mb-4">
    <div class="card-header d-flex justify-content-between py-3">
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
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Program Studi</th>
                        <th width="50px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr>
                            <td class="align-middle">{{ $data->firstItem() + $key }}.</td>
                            <td class="align-middle">{{ $item->student_name }}</td>
                            <td class="align-middle">{{ $item->nim }}</td>
                            <td class="align-middle">{{ $item->study_program }}</td>
                            <td class="d-flex justify-content-center align-middle">
                                <a href="{{ route('student.show', Crypt::encrypt($item->id)) }}" class="text-secondary mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
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
            <form action="{{ route('student') }}" method="GET">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ request()->input('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" name="nim" class="form-control" value="{{ request()->input('nim') }}">
                    </div>
                    <div class="form-group">
                        <label for="study_program">Program Studi</label>
                        <select name="study_program" class="form-control">
                            <option value="">Pilih</option>
                            <option value="Pendidikan Jasmani, Kesehatan, dan Rekreasi" {{ request()->input('study_program') == 'Pendidikan Jasmani, Kesehatan, dan Rekreasi' ? 'selected' : '' }}>Pendidikan Jasmani, Kesehatan, dan Rekreasi</option>
                            <option value="Pendidikan Kepelatihan Olahraga" {{ request()->input('study_program') == 'Pendidikan Kepelatihan Olahraga' ? 'selected' : '' }}>Pendidikan Kepelatihan Olahraga</option>
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
