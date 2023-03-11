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
                    <a href="{{ route('mobilCreate') }}" class="btn btn-primary btn-sm ml-2">
                        Tambah Data {{ $judul }}
                    </a>
                </div>

                <table class="table" id="tabel-data-mobil">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Perental</th>
                            <th class="text-center">Jenis Mobil</th>
                            <th class="text-center">Plat Nomor</th>
                            <th class="text-center">Status Penyewaan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($mobil as $key => $mbl)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="ps-4 text-center">{{ $mbl->perental->users->nama_lengkap }}</td>
                                <td class="ps-4">{{ $mbl->jenis_mobil }}</td>
                                <td class="ps-4">{{ $mbl->plat_nomor }}</td>
                                <td class="text-center">
                                    @if ($mbl->status_penyewaan == 'Belum_Disewa')
                                        <span class="badge text-bg-primary ms-2">{{ $mbl->status_penyewaan }}</span>
                                    @else
                                        <span class="badge text-bg-secondary ms-2">{{ $mbl->status_penyewaan }}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('mobilShow', $mbl->id_mobil) }}" class="btn btn-warning btn-sm me-1"
                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Tombol Show Data {{ $judul }}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="{{ route('mobilEdit', $mbl->id_mobil) }}" class="btn btn-primary btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Tombol Edit Data {{ $judul }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm mt-2" id="button-delete"
                                        onclick="confirmDeleteMobil()" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Tombol Hapus Data {{ $judul }}">
                                        <i class="fa fa-trash"></i>

                                    </button>
                                </td>
                                <td style="display:none;">
                                    {{ $mbl->id_mobil }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Perental</th>
                            <th class="text-center">Jenis Mobil</th>
                            <th class="text-center">Plat Nomor</th>
                            <th class="text-center">Status Penyewaan</th>
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
        var tabelDataPerental = $("#tabel-data-mobil").DataTable({

            "columnDefs": [{
                    "name": "no",
                    "targets": 0,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "nama_perental",
                    "targets": 1,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "jenis_mobil",
                    "targets": 2,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "plat_nomor",
                    "targets": 3,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "status_akun",
                    "targets": 4,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "id_mobil",
                    "targets": 6,
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
        // $('#button-delete').on('click', confirmDeleteMobil());


        // Konfirmasi Delete Data User
        function confirmDeleteMobil() {

            $('#tabel-data-mobil tbody').on('click', 'td', function() {

                var id_mobil = tabelDataPerental.cell(this, 'id_mobil:name', {
                    order: 'original'
                }).data();


                swal.fire({

                    icon: 'warning',
                    title: 'Apakah Anda Ingin Menghapus Data Mobil Ini?',
                    text: 'Data yang sudah dihapus tidak dapat dikembalikan lagi!',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Iya!',
                }).then((result) => {

                    // alert(result);

                    if (result.isConfirmed) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('mobilDelete', id_mobil);


                        // console.log(hasil_route);

                        window.open(hasil_route, '_self');

                    }
                });

                console.log(id_mobil);
            });

            console.log('berhasil');




        }
    </script>
@endsection
