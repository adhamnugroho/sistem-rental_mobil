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
                    {{-- <a href="{{ route('usersCreate') }}" class="btn btn-primary btn-sm ml-2">
                        Tambah Data {{ $judul }}
                    </a> --}}
                </div>

                <table class="table" id="tabel-data-user">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Username</th>
                            {{-- <th class="text-center">Email</th> --}}
                            <th class="text-center">Status Akun</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $us)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="ps-4">{{ $us->nama_lengkap }}</td>
                                <td class="ps-4">{{ $us->username }}</td>
                                {{-- <td class="ps-4">{{ $us->email }}</td> --}}
                                <td class="justify-content-center">
                                    @if ($us->status_akun == 'Penyewa')
                                        <span class="badge text-bg-primary ms-2">{{ $us->status_akun }}</span>
                                    @else
                                        <span class="badge text-bg-secondary ms-2">{{ $us->status_akun }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('usersShow', $us->id) }}" class="btn btn-warning btn-sm" required
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Tombol Show Data {{ $judul }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('usersEdit', $us->id) }}" class="btn btn-primary btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Tombol Edit Data {{ $judul }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm" id="button-delete" onclick="confirmDeleteUser()"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Tombol Hapus Data {{ $judul }}">
                                        <i class="fa fa-trash"></i>

                                    </button>
                                </td>
                                <td style="display:none;">
                                    {{ $us->id }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Username</th>
                            {{-- <th class="text-center">Email</th> --}}
                            <th class="text-center">Status Akun</th>
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
        var tabelDataUser = $("#tabel-data-user").DataTable({

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
                    "name": "username",
                    "targets": 2,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "status_akun",
                    "targets": 3,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "id_user",
                    "targets": 5,
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
        // $('#button-delete').on('click', confirmDeleteUser());


        // Konfirmasi Delete Data User
        function confirmDeleteUser() {

            $('#tabel-data-user tbody').on('click', 'td', function() {

                var id_user = tabelDataUser.cell(this, 'id_user:name', {
                    order: 'original'
                }).data();


                swal.fire({

                    icon: 'warning',
                    title: 'Apakah Anda Ingin Menghapus Data User Ini?',
                    text: 'Data yang sudah dihapus tidak dapat dikembalikan lagi!',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Iya!',
                }).then((result) => {

                    // alert(result);

                    if (result.isConfirmed) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('usersDelete', id_user);


                        // console.log(hasil_route);

                        window.open(hasil_route, '_self');

                    }
                });

                console.log(id_user);
            });

            console.log('berhasil');




        }
    </script>
@endsection
