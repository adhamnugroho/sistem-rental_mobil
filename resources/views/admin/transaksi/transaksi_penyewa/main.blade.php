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

                {{-- <div class="col-lg-7 p-1 mb-n2">
                    <a href="{{ route('transaksiPenyewaCreate') }}" class="btn btn-primary btn-sm ml-2">
                        Tambah Data Penyewa
                    </a>
                </div> --}}

                <table class="table" id="tabel-data-penyewa">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Penyewa</th>
                            <th class="text-center">Jenis Mobil</th>
                            <th class="text-center">Kota / Kabupaten</th>
                            <th class="text-center">Status Penyewaan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penyewa as $key => $pny)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="ps-4 text-center">{{ $pny->users->nama_lengkap }}</td>
                                <td class="ps-4">{{ $pny->penyewa_detail[0]->mobil->jenis_mobil }}</td>
                                <td class="ps-4">{{ $pny->penyewa_detail[0]->kabupaten->nama_kabupaten }}</td>
                                <td class="text-center">
                                    @if ($pny->status_penyewaan == 'Berjalan')
                                        <span class="badge text-bg-primary ms-2">
                                            {{ $pny->status_penyewaan }}
                                        </span>
                                    @elseif ($pny->status_penyewaan == 'Dibatalkan')
                                        <span class="badge text-bg-danger ms-2">
                                            {{ $pny->status_penyewaan }}
                                        </span>
                                    @else
                                        <span class="badge text-bg-secondary ms-2">
                                            {{ $pny->status_penyewaan }}
                                        </span>
                                    @endif
                                </td>
                                <td class="">
                                    <a href="{{ route('transaksiPenyewaShow', $pny->id_penyewa) }}"
                                        class="btn btn-warning btn-sm m-1" required data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Tombol Detail Data {{ $judul }}an">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    {{-- <a href="{{ route('penyewaEdit', $pny->id_penyewa) }}" class="btn btn-primary btn-sm"
                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Tombol Edit Data">
                                        <i class="fa fa-edit"></i>
                                    </a> --}}
                                    {{-- <button class="btn btn-danger btn-sm m-1" id="button-delete"
                                        onclick="confirmDeletePenyewa()" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Tombol Hapus Data {{ $judul }}an">
                                        <i class="fa fa-trash"></i>

                                    </button> --}}
                                </td>
                                <td style="display:none;">
                                    {{ $pny->id_penyewa }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Penyewa</th>
                            <th class="text-center">Jenis Mobil</th>
                            <th class="text-center">Kota / Kabupaten</th>
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
        var tabelDataPerental = $("#tabel-data-penyewa").DataTable({

            "columnDefs": [{
                    "name": "no",
                    "targets": 0,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "nama_penyewa",
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
                    "name": "kota_atau_kabupaten",
                    "targets": 3,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "status_penyewaan",
                    "targets": 4,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "id_penyewa",
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
        // $('#button-delete').on('click', confirmDeletePenyewa());


        // Konfirmasi Delete Data User
        function confirmDeletePenyewa() {

            $('#tabel-data-penyewa tbody').on('click', 'td', function() {

                var id_penyewa = tabelDataPerental.cell(this, 'id_penyewa:name', {
                    order: 'original'
                }).data();


                swal.fire({

                    icon: 'warning',
                    title: 'Apakah Anda Ingin Menghapus Data Penyewa Ini?',
                    text: 'Data yang sudah dihapus tidak dapat dikembalikan lagi!',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Iya!',
                }).then((result) => {

                    // alert(result);

                    if (result.isConfirmed) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('penyewaDelete', id_penyewa);


                        console.log(hasil_route);

                        // window.open(hasil_route, '_self');

                    }
                });

                console.log(id_penyewa);
            });

            console.log('berhasil');




        }
    </script>
@endsection
