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
                <div class="row mb-n2 justify-content-end">
                    {{-- <div class="col-lg-2 p-1 ">
                        <a href="{{ route('keuanganAdminTambahCreate') }}" class="btn btn-primary btn-sm ms-3">
                            Tambah Saldo
                        </a>
                    </div>
                    <div class="col-lg-2 p-1 ms-n1">
                        <a href="{{ route('keuanganAdminKurangCreate') }}" class="btn btn-warning btn-sm ml-2">
                            Kurang Saldo
                        </a>
                    </div> --}}

                    <div class="col-sm-2 text-center pt-sm-1">
                        Range Tanggal
                    </div>

                    <div class="col-md-3">

                        <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal"
                            value="{{ isset($_GET['tanggal_awal']) ? $_GET['tanggal_awal'] : date('Y-m-d') }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Kolom Tanggal Awal">
                    </div>

                    <div class="col-1 p-1 text-center">
                        -
                    </div>

                    <div class="col-md-3">

                        <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir"
                            value="{{ isset($_GET['tanggal_akhir']) ? $_GET['tanggal_akhir'] : date('Y-m-d') }}"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Kolom Tanggal Akhir">
                    </div>

                    <div class="col-2 d-flex ms-n2 justify-content-end">
                        <button type="submit" class="btn btn-primary ps-3 pe-3" onclick="cariDataKasAdmin()"
                            id="tombol_cari">

                            <i class="fa fa-search"></i>
                            Cari
                        </button>
                    </div>
                </div>

                <div class="row justify-content-end mt-lg-3 mb-3">
                    <div class="col-2 d-flex justify-content-end">
                        <button class="btn btn-warning " onclick="print(event)">
                            <i class="fa fa-print"></i>
                            Print
                        </button>
                    </div>
                </div>

                <table class="table table-bordered" id="tabel-data-kas-asuransi">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Penyewa</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Total Keuangan Admin</th>
                            <th class="text-center">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($laporan_kas_admin as $key => $lka)
                            <tr>
                                <td class="text-center">{{ $key + 1 }}</td>
                                <td class="ps-4">{{ $lka->penyewa->users->nama_lengkap }}</td>
                                <td class="ps-4">{{ $lka->jenis }}</td>
                                <td class="ps-4">{{ $lka->total_kas_admin_semua }}</td>
                                <td class="text-center">
                                    {{ $lka->tanggal }}
                                </td>
                                <td style="display:none;">
                                    {{ $lka->id_kas_admin }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Penyewa</th>
                            <th class="text-center">Jenis</th>
                            <th class="text-center">Total Keuangan Admin</th>
                            <th class="text-center">Tanggal</th>
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
        var tabelDataKeuanganAdmin = $("#tabel-data-kas-asuransi").DataTable({

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
                    "name": "total_keuangan_admin",
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
                    "name": "id_kas_admin",
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
            "searching": false,

        }); //buttons().container().appendTo('#tabel-data-user_wrapper .col-md-6:eq(0)');


        // console.log(tabelData1);
    </script>




    {{-- Search --}}
    <script>
        // // Jquery untuk mencari data user
        // $('#search').on('keyup', cariDataKasAdmin);

        // // Jquery saat event tombol x input:search diklik
        // $('#search').on('search.dt', cariDataKasAdmin);


        function cariDataKasAdmin() {

            let tanggal_awal = document.getElementById("tanggal_awal").value;
            let tanggal_akhir = document.getElementById("tanggal_akhir").value;

            // console.log(search.value);
            // console.log(optionSearch);


            const hasil_route = route('laporanKasAdmin', {
                tanggal_awal,
                tanggal_akhir
            });


            // console.log(hasil_route);

            window.open(hasil_route, '_self');
        }
    </script>


    {{-- Print --}}
    <script>
        function print(event) {
            event.preventDefault();

            let tanggal_awal = document.getElementById("tanggal_awal").value;
            let tanggal_akhir = document.getElementById("tanggal_akhir").value;

            const hasil_routeCariData = route('laporanKasAdminCariData');
            const hasil_routePrint = route('laporanKasAdminPrint', {
                tanggal_awal,
                tanggal_akhir
            });

            // console.log(hasil_routeCariData)


            $.ajax({
                type: "GET",
                url: hasil_routeCariData,
                data: {
                    tanggal_awal: tanggal_awal,
                    tanggal_akhir: tanggal_akhir,
                },
                dataType: "json",
                success: function(response) {

                    console.log(response.status);

                    if (response.status == 'ditemukan') {

                        window.open(hasil_routePrint, "_blank", "noopener, noreferrer");
                    } else {

                        window.location.href = hasil_routePrint;
                    }
                },
                error: function(response) {

                    console.log(response.responseText);
                }
            });
        }
    </script>


    
@endsection
