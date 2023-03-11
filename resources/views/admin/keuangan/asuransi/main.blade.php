@extends('admin.layout.app')

@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data {{ str_replace('_', ' ', $judul) }}</h3>
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
                            Data {{ str_replace('_', ' ', $judul) }}
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
                    Tabel {{ str_replace('_', ' ', $judul) }}
                </h5>
            </div>
            <div class="card-body">
                <div class="row mb-n2">
                    <div class="col-lg-2 p-1 ">
                        <a href="{{ route('keuanganAsuransiTambahCreate') }}" class="btn btn-primary btn-sm ms-3">
                            Tambah Saldo
                        </a>
                    </div>
                    <div class="col-lg-2 p-1 ms-n1">
                        <a href="{{ route('keuanganAsuransiKurangCreate') }}" class="btn btn-warning btn-sm ml-2">
                            Kurang Saldo
                        </a>
                    </div>
                </div>

                <table class="table" id="tabel-data-kas-asuransi">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Penyewa</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Total Keuangan Asuransi</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kas_asuransi as $key => $ka)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="ps-4">{{ $ka->penyewa->users->nama_lengkap }}</td>
                                <td class="ps-4">{{ $ka->jenis }}</td>
                                <td class="ps-4">{{ $ka->total_keuangan_asuransi_semua }}</td>
                                <td class="text-center">
                                    {{ $ka->tanggal }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('keuanganAsuransiShow', $ka->id_kas_asuransi) }}"
                                        class="btn btn-warning btn-sm me-1" required data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Tombol Show Data {{ $judul }}">
                                        <i class="fa fa-eye"></i>
                                    </a>

                                    {{-- @if ($ka->jenis == 'Pengeluaran')
                                        <a href="{{ route('keuanganAsuransiKurangEdit', $ka->id_kas_asuransi) }}"
                                            class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Tombol Edit Data {{ $judul }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @elseif($ka->jenis == 'Pemasukan')
                                        <a href="{{ route('keuanganAsuransiTambahEdit', $ka->id_kas_asuransi) }}"
                                            class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="Tombol Edit Data {{ $judul }}">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    @endif --}}
                                    {{-- <button class="btn btn-danger btn-sm" id="button-delete"
                                        onclick="confirmDeleteKeuanganAsuransi()" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="Tombol Hapus Data {{ $judul }}">
                                        <i class="fa fa-trash"></i>

                                    </button> --}}
                                </td>
                                <td style="display:none;">
                                    {{ $ka->id_kas_asuransi }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Penyewa</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Total Keuangan Asuransi</th>
                            <th class="text-center">Tanggal</th>
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
        var tabelDataKeuanganAsuransi = $("#tabel-data-kas-asuransi").DataTable({

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
                    "name": "jenis",
                    "targets": 2,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "total_keuangan_asuransi",
                    "targets": 3,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "tanggal",
                    "targets": 4,
                    "searchable": true,
                    "type": "html"
                },
                {
                    "name": "id_kas_asuransi",
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
        // $('#button-delete').on('click', confirmDeleteKeuanganAsuransi());


        // Konfirmasi Delete Data User
        function confirmDeleteKeuanganAsuransi() {

            $('#tabel-data-kas-asuransi tbody').on('click', 'td', function() {

                var id_kas_asuransi = tabelDataKeuanganAsuransi.cell(this, 'id_kas_asuransi:name', {
                    order: 'original'
                }).data();


                swal.fire({

                    icon: 'warning',
                    title: 'Apakah Anda Ingin Menghapus Data Kas Asuransi Ini?',
                    text: 'Data yang sudah dihapus tidak dapat dikembalikan lagi!',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Iya!',
                }).then((result) => {

                    // alert(result);

                    if (result.isConfirmed) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('keuanganAsuransiDelete', id_kas_asuransi);


                        console.log(hasil_route);

                        // window.open(hasil_route, '_self');

                    }
                });

                console.log(id_kas_asuransi);
            });

            console.log('berhasil');




        }
    </script>
@endsection
