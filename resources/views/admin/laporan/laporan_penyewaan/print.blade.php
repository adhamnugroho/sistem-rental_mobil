<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- meta CSRF - Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>TransportIn | {{ $judul }}</title>

    {{-- Main Css --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/css/main/app.css') }}" />


    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('template-admin/assets/images/favicon/favicon_package_v0.16/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('template-admin/assets/images/favicon/favicon_package_v0.16/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('template-admin/assets/images/favicon/favicon_package_v0.16/favicon-16x16.png') }}">
    <link rel="manifest"
        href="{{ asset('template-admin/assets/images/favicon/favicon_package_v0.16/site.webmanifest') }}">
    <link rel="mask-icon"
        href="{{ asset('template-admin/assets/images/favicon/favicon_package_v0.16/safari-pinned-tab.svg') }}"
        color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    {{-- Iconly.css --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/css/shared/iconly.css') }}" />

    {{-- FontAwesome CSS --}}
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/@fortawesome/fontawesome-free/css/fontawesome.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/@fortawesome/fontawesome-free/css/all.min.css') }}" />

    {{-- Datatables css --}}
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('template-admin/assets/css/pages/datatables.css') }}" />

    {{-- DripIcons --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/extensions/@icon/dripicons/dripicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('template-admin/assets/css/pages/dripicons.css') }}" />

    {{-- Sweetalert2 - 11.4.8  --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/plugins/sweetalert2/dist/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('template-admin/assets/plugins/sweetalert2/dist/dark.css') }}">

    {{-- Choices --}}
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/choices.js/public/assets/styles/choices.css') }}" />

    {{-- FilePond --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/extensions/filepond/filepond.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}" />

    {{-- Toastify --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/extensions/toastify-js/src/toastify.css') }}" />

    {{-- Rater.js plugin --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/extensions/rater-js/lib/style.css') }}" />


    {{-- Ziggy – Laravel routes in JavaScript --}}
    @routes

</head>

<body id="container-absolut">
    <div id="app">
        <input type="hidden" name="" id="tanggal_awal" value="{{ $tanggal_awal }}">
        <input type="hidden" name="" id="tanggal_akhir" value="{{ $tanggal_akhir }}">
        <table class="table table-bordered" id="tabel-data-kas-asuransi-print">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Kode Invoice</th>
                    <th class="text-center">Nama Penyewa</th>
                    <th class="text-center">Kota / Kabupaten Perentalan</th>
                    <th class="text-center">Status Penyewaan</th>
                    <th class="text-center">Nama Mobil</th>
                    <th class="text-center">Plat Nomor</th>
                    <th class="text-center">Harga Penyewaan (Mobil)</th>
                    <th class="text-center">Nama Perental</th>
                    <th class="text-center">Tanggal Penyewaan</th>
                    <th class="text-center">Tanggal Pengembalian</th>
                    <th class="text-center">Total Harga Penyewaan</th>
                    <th class="text-center">Nominal Pembayaran Penyewa</th>
                    <th class="text-center">Nominal Kembalian</th>
                    <th class="text-center">Total Uang Bersih Perental</th>
                    <th class="text-center">Review Penyewaan</th>
                    <th class="text-center">Rating Penyewaan</th>
                    <th class="text-center">Status Pembayaran Penyewa</th>
                    <th class="text-center">Status Pembayaran Perental</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($laporan_penyewaan as $key => $lp)
                    <tr>
                        <td class="text-center" id="no">{{ $key + 1 }}</td>
                        <td class="ps-4" id="nama_penyewa">{{ $lp->penyewa->kode_invoice }}</td>
                        <td class="ps-4" id="jenis">{{ $lp->penyewa->users->nama_lengkap }}</td>
                        <td class="ps-4" id="kas_asuransi_masuk">{{ $lp->kabupaten->nama_kabupaten }}</td>
                        <td class="ps-4" id="kas_asuransi_keluar">{{ $lp->penyewa->status_penyewaan }}</td>
                        <td class="ps-4" id="total_keuangan_asuransi">{{ $lp->mobil->jenis_mobil }}</td>
                        <td class="ps-4" id="total_keuangan_asuransi">{{ $lp->mobil->plat_nomor }}</td>
                        <td class="ps-4" id="total_keuangan_asuransi">{{ $lp->mobil->harga }}</td>
                        <td class="ps-4" id="total_keuangan_asuransi">
                            {{ $lp->mobil->perental->users->nama_lengkap }}</td>
                        <td class="ps-4" id="total_keuangan_asuransi" data-t="n" data-v="41246"
                            data-z="yyyy-mm-dd">{{ $lp->tanggal_penyewaan }}</td>
                        <td class="ps-4" id="total_keuangan_asuransi" data-t="n" data-v="41246"
                            data-z="yyyy-mm-dd">{{ $lp->tanggal_pengembalian }}</td>
                        <td class="ps-4" id="total_keuangan_asuransi">{{ $lp->total_harga }}</td>
                        <td class="ps-4" id="total_keuangan_asuransi">{{ $lp->nominal_pembayaran }}</td>
                        <td class="ps-4" id="total_keuangan_asuransi">{{ $lp->kembalian }}</td>
                        <td class="ps-4" id="total_keuangan_asuransi">{{ $lp->total_uang_bersih_perental }}</td>
                        <td class="ps-4" id="keterangan">{{ $lp->keterangan }}</td>
                        <td class="ps-4" id="keterangan">{{ $lp->rating }}</td>
                        <td class="ps-4" id="keterangan">{{ $lp->penyewa->status_pembayaran_penyewa }}</td>
                        <td class="ps-4" id="keterangan">{{ $lp->penyewa->status_pembayaran_perental }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <script src="{{ asset('template-admin/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('template-admin/assets/js/app.js') }}"></script>
    <script src="{{ asset('template-admin/assets/extensions/jquery/jquery.min.js') }}"></script>

    <!-- Need: Apexcharts -->
    {{-- <script src="{{ asset('template-admin/assets/extensions/apexcharts/apexcharts.min.js') }}"></script> --}}

    {{-- Datatable JS --}}

    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('template-admin/assets/js/pages/datatables.js') }}"></script>

    {{-- Dashboard JS --}}
    <script src="{{ asset('template-admin/assets/js/pages/dashboard.js') }}"></script>

    {{-- Sweetalert2 - 11.4.8 --}}
    <script src="{{ asset('template-admin/assets/plugins/sweetalert2/dist/sweetalert2.all.js') }}"></script>

    {{-- Fontawesome --}}
    <script src="{{ asset('template-admin/assets/extensions/@fortawesome/fontawesome-free/js/all.min.js') }}"></script>

    {{-- Select --}}
    <script src="{{ asset('template-admin/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('template-admin/assets/js/pages/form-element-select.js') }}"></script>

    {{-- FilePond --}}
    <script src="{{ asset('template-admin/assets/extensions/filepond/filepond.js') }}"></script>
    <script src="{{ asset('template-admin/assets/js/pages/filepond.js') }}"></script>
    <script
        src="{{ asset('template-admin/assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.js') }}">
    </script>
    <script
        src="{{ asset('template-admin/assets/extensions/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.js') }}">
    </script>
    <script
        src="{{ asset('template-admin/assets/extensions/filepond-plugin-file-validate-type/filepond-plugin-file-validate-type.js') }}">
    </script>
    <script
        src="{{ asset('template-admin/assets/extensions/filepond-plugin-image-validate-size/filepond-plugin-image-validate-size.js') }}">
    </script>
    <script
        src="{{ asset('template-admin/assets/extensions/filepond-plugin-image-resize/filepond-plugin-image-resize.js') }}">
    </script>

    {{-- Toastify --}}
    <script src="{{ asset('template-admin/assets/extensions/toastify-js/src/toastify.js') }}"></script>

    {{-- Rater.js Plugin --}}
    <script src="{{ asset('template-admin/assets/extensions/rater-js/index.js?v=2') }}"></script>
    {{-- <script src="{{ asset('template-admin/assets/js/pages/rater-js.js?v=2') }}"></script> --}}

    {{-- JsPDF --}}
    <script src="{{ asset('template-admin/assets/plugins/jspdf/dist/jspdf.umd.min.js') }}"></script>

    {{-- JsPDF --}}
    <script src="{{ asset('template-admin/assets/plugins/xlsx/dist/xlsx.full.min.js') }}"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    {{-- <script>
        // Tooltips Boostrap 5

        // If you want to use tooltips in your project, we suggest initializing them globally
        // instead of a "per-page" level.
        document.addEventListener(
            "DOMContentLoaded",
            function() {
                var tooltipTriggerList = [].slice.call(
                    document.querySelectorAll('[data-bs-toggle="tooltip"]')
                );
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            },
            false
        );
    </script> --}}

    <script>
        var tanggal_awal = document.getElementById("tanggal_awal").
        value;
        var tanggal_akhir = document.getElementById("tanggal_akhir").
        value;

        // format tanggal awal
        const tanggalAwalArray = tanggal_awal.split("-").reverse();
        const tanggalAwal_format = tanggalAwalArray.join("-");

        const tanggalAkhirArray = tanggal_akhir.split("-").reverse();
        const tanggalAkhir_format = tanggalAkhirArray.join("-");


        // console.log("LaporanKeuanganAsuransi-dari-" + tanggalAwal_format + "-sampai-" + tanggalAkhir_format);

        var workbook = XLSX.utils.book_new();

        // Acquire Data (reference to the HTML table)
        var table_elt = document.getElementById("tabel-data-kas-asuransi-print");


        // const raw_data = await(await fetch(table_elt)).json();

        /* flatten objects */
        // const rows = table_elt.map(row => ({
        //     No: row.no,
        //     Nama_Penyewa: row.nama_penyewa,
        //     Jenis: row.jenis,
        //     Total_Keuangan_asuransi: row.total_keuangan_asuransi,
        //     Tanggal: row.tanggal,
        // }));


        // Extract Data (create a worksheet object from the table)
        var worksheet = XLSX.utils.table_to_sheet(table_elt, {
            type: "binary",
            cellDates: true
        });

        // Process Data (add a new row)
        XLSX.utils.book_append_sheet(workbook, worksheet, "LaporanKeuanganAsuransi");

        /* fix headers */
        XLSX.utils.sheet_add_aoa(worksheet, [
            [
                "No", "Kode Invoice", "Nama Penyewa", "Kota / Kabupaten Penyewaan", "Status Penyewaan",
                "Nama Mobil",
                "Plat Nomor", "Harga Penyewaan (Mobil)", "Nama Perental", "Tanggal Penyewaan",
                "Tanggal Pengembalian", "Total Harga Penyewaan", "Nominal Pembayaran Penyewa",
                "Nominal Kembalian Penyewa", "Total_Uang_Bersih_Perental", "Review Penyewaan", "Rating Penyewaan",
                "Status Pembayaran Penyewa", "Status Pembayaran Perental"
            ]
        ], {
            origin: "A1"
        });


        // /* calculate column width */
        worksheet["!cols"] = [{
                wch: 10
            }, // set column No width 
            {
                wch: 40
            }, // set column Kode Invoice width 
            {
                wch: 60
            }, // set column Nama Penyewa width 
            {
                wch: 35
            }, // set column Kota / Kabupaten Penyewa width 
            {
                wch: 45
            }, // set column Status Penyewaan width 
            {
                wch: 60
            }, // set column Nama Mobil width 
            {
                wch: 20
            }, // set column Plat Nomor width 
            {
                wch: 25
            }, // set column Harga Penyewaan Mobil width 
            {
                wch: 60
            }, // set column Nama Perental width 
            {
                wch: 25
            }, // set column Tanggal Penyewaan width 
            {
                wch: 25
            }, // set column Tanggal Pengembalian width 
            {
                wch: 30
            }, // set column Total Harga Penyewaan width 
            {
                wch: 35
            }, // set column Nominal Pembayaran Penyewa width 
            {
                wch: 35
            }, // set column Nominal Kembalian Penyewa width 
            {
                wch: 35
            }, // set column Total Uang Bersih Perental width 
            {
                wch: 65
            }, // set column Review Penyewaan width 
            {
                wch: 20
            }, // set column Rating Penyewaan width 
            {
                wch: 45
            }, // set column Status Pembayaran Penyewa width 
            {
                wch: 45
            }, // set column Status Pembayaran Perental width 
        ];

        var range = XLSX.utils.decode_range(worksheet['!ref']);
        var ncols = range.e.c - range.s.c + 1,
            nrows = range.e.r - range.s.r + 1;

        // Package and Release Data (`writeFile` tries to write and save an XLSB file)
        XLSX.writeFile(workbook, "LaporanPenyewaan-dari-" + tanggalAwal_format + "-sampai-" + tanggalAkhir_format +
            ".xlsx", {
                type: "binary",
                cellDates: true,
            });

        $(document).ready(function() {
            window.close();
        })
    </script>

    {{-- <script>
        const {
            jsPDF
        } = window.jspdf;

        const doc = new jsPDF();
        doc.text("Hello world!", 10, 10);
        
        doc.autoPrint({variant: 'non-conform'});
        // doc.print('autoprint.pdf');
    </script> --}}

</body>

</html>
