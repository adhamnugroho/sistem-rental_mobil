@extends('admin.layout.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data {{ $judul }}</h3>
                <p class="text-subtitle text-muted">
                    {{-- Bisa diisi sub text --}}
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Data {{ $judul }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <!-- Basic Tables start -->
    <section class="section mt-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Tabel {{ $judul }}
                </h5>
            </div>
            <div class="card-body">

                <div class="col-lg-7 p-1 mb-n2">
                    <a href="{{ route('perentalCreate') }}" class="btn btn-primary btn-sm ml-2">
                        Tambah Data {{ $judul }}
                    </a>
                </div>

                <table class="table" id="tabel-data-perental">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Perental</th>
                            {{-- <th class="text-center">Username</th> --}}
                            {{-- <th class="text-center">Email</th> --}}
                            <th class="text-center">Status Perental</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($perental as $key => $pr)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="ps-4 text-center">{{ $pr->users->nama_lengkap }}</td>
                                {{-- <td class="ps-4">{{ $pr->username }}</td> --}}
                                {{-- <td class="ps-4">{{ $us->email }}</td> --}}
                                <td class="text-center">
                                    @if ($pr->status_perental == 'Aktif')
                                        <span class="badge text-bg-primary ms-2">{{ $pr->status_perental }}</span>
                                    @else
                                        <span class="badge text-bg-secondary ms-2">{{ $pr->status_perental }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('perentalShow', $pr->id_perental) }}" class="btn btn-warning btn-sm"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Tombol Show Data {{ $judul }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('perentalEdit', $pr->id_perental) }}" class="btn btn-primary btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Tombol Edit Data {{ $judul }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm" id="button-delete"
                                        onclick="confirmDeletePerental()" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Tombol Hapus Data {{ $judul }}">
                                        <i class="fa fa-trash"></i>

                                    </button>
                                </td>
                                <td style="display:none;">
                                    {{ $pr->id_perental }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Perental</th>
                            {{-- <th class="text-center">Username</th> --}}
                            {{-- <th class="text-center">Email</th> --}}
                            <th class="text-center">Status Perental</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
    <!-- Basic Tables end -->
@endsection


@section('script')
    {{-- Datatable --}}
    <script>
        var tabelDataPerental = $("#tabel-data-perental").DataTable({

            "columnDefs": [{
                    "name": "no",
                    "targets": 0,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "nama_lengkap",
                    "targets": 1,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "status_akun",
                    "targets": 2,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "id_perental",
                    "targets": 4,
                    "searchable": true,
                    "type": "html",
                    "visible": false
                }
            ],

            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": true,
            "searching": true,

        }); //buttons().container().appendTo('#tabel-data-user_wrapper .col-md-6:eq(0)');


        // console.log(tabelData1);
    </script>


    <script>
        // const Router = new Object();
        // $('#button-delete').on('click', confirmDeletePerental());


        // Konfirmasi Delete Data User
        function confirmDeletePerental() {

            $('#tabel-data-perental tbody').on('click', 'td', function() {

                var id_perental = tabelDataPerental.cell(this, 'id_perental:name', {
                    order: 'original'
                }).data();


                swal.fire({

                    icon: 'warning',
                    title: 'Apakah Anda Ingin Menghapus Data Perental Ini?',
                    text: 'Data yang sudah dihapus tidak dapat dikembalikan lagi!',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Iya!',
                }).then((result) => {

                    // alert(result);

                    if (result.isConfirmed) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('perentalDelete', id_perental);


                        // console.log(hasil_route);

                        window.open(hasil_route, '_self');

                    }
                });

                console.log(id_perental);
            });

            console.log('berhasil');




        }
    </script>
@endsection
