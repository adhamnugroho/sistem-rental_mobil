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

    <style>
        @media print {

            /* styles for print */
            @page {
                size: letter;
                margin: 1cm;
            }
        }
    </style>

</head>

<body id="container-absolut">
    <div id="app">
        <div class="card">
            <div class="card-body">
                <div class="container mb-5 mt-3">
                    {{-- <div class="row d-flex align-items-baseline">
                        <div class="col-xl-9">
                            <p style="color: #7e8d9f;font-size: 20px;">Invoice >> <strong>ID: #123-123</strong></p>
                        </div>
                        <div class="col-xl-3 float-end">
                            <a class="btn btn-light text-capitalize border-0" data-mdb-ripple-color="dark"><i
                                    class="fas fa-print text-primary"></i> Print</a>
                            <a class="btn btn-light text-capitalize" data-mdb-ripple-color="dark"><i
                                    class="far fa-file-pdf text-danger"></i> Export</a>
                        </div>
                        <hr>
                    </div> --}}

                    <div class="container">
                        <div class="col-md-12">
                            <div class="text-center">
                                <img src="{{ asset('template-admin/assets/images/logo/logo_website_rental_mobil1.svg') }}"
                                    alt="Logo TransportIn" srcset="" class="w-50 h-100 p-2" />
                            </div>

                        </div>


                        <div class="row mt-5">
                            <div class="col-xl-12">
                                <ul class="list-unstyled">
                                    <li class="text-muted"></i> <span>Kode Invoice:</span>
                                        {{ $penyewa->kode_invoice }}
                                    </li>
                                    <li class="text-muted">Nama Penyewa: <span
                                            style="color:#5d9fc5 ;">{{ $penyewa->users->nama_lengkap }}</span>
                                    </li>
                                    <li class="text-muted">Tempat Penyewaan: <span
                                            style="color:#5d9fc5 ;">{{ $penyewa->penyewa_detail[0]->kabupaten->nama_kabupaten }}</span>
                                    </li>
                                    {{-- <li class="text-muted">State, Country</li>
                                    <li class="text-muted"><i class="fas fa-phone"></i> 123-456-789</li> --}}
                                </ul>
                            </div>
                            {{-- <div class="col-xl-4">
                                <ul class="list-unstyled">
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                            class="fw-bold">Kode Invoice:</span> {{ $penyewa->kode_invoice }}</li>
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                            class="fw-bold">Waktu Pembayaran: </span>{{ $tanggal_pembayaran_penyewa }}
                                    </li>
                                    <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i>
                                        <span class="me-1 fw-bold">Status Pembayaran Penyewaan:</span><span
                                            class="badge bg-primary text-white fw-bold">
                                            {{ $status_pembayaran }}</span>
                                    </li>
                                </ul>
                            </div> --}}
                        </div>

                        <div class="row mt-2">
                            <div class="col-xl-12">
                                <ul class="list-unstyled">
                                    <li class="text-muted"></i> <span>Waktu Pembayaran:
                                        </span>{{ $tanggal_pembayaran_penyewa }}
                                    </li>
                                    <li class="text-muted"></i>
                                        <span class="me-1">Status Pembayaran Penyewaan:</span><span
                                            class="text-black fw-bold">{{ $status_pembayaran }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="row my-2 mx-1 justify-content-center">
                            <table class="table table-striped">
                                <thead class="table-active">
                                    <tr class="text-dark fw-bold">
                                        <th class="text-center" scope="col">Nama Perental</th>
                                        <th class="text-center" scope="col">Nama Mobil</th>
                                        <th class="text-center" scope="col">Plat Mobil</th>
                                        <th class="text-center" scope="col">Harga (Mobil)</th>
                                        <th class="text-center" scope="col">Tanggal Penyewaan</th>
                                        <th class="text-center" scope="col">Tanggal Pengembalian</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            {{ $penyewa->penyewa_detail[0]->mobil->perental->users->nama_lengkap }}
                                        </td>
                                        <td>{{ $penyewa->penyewa_detail[0]->mobil->jenis_mobil }}</td>
                                        <td>{{ $penyewa->penyewa_detail[0]->mobil->plat_nomor }}</td>
                                        <td>{{ $penyewa->penyewa_detail[0]->mobil->harga }}</td>
                                        <td>{{ $penyewa->penyewa_detail[0]->tanggal_penyewaan }}</td>
                                        <td>{{ $penyewa->penyewa_detail[0]->tanggal_pengembalian }}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <div class="row">
                            <div class="col-xl-12 mt-2">
                                <ul class="list-unstyled">
                                    <li class="text-muted ms-3">
                                        <span class="text-black me-4">Total Harga
                                            Penyewaan:</span>Rp. {{ $penyewa->penyewa_detail[0]->total_harga }}
                                    </li>
                                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Kas
                                            Asuransi(2%): </span>Rp.
                                        {{ $penyewa->kas_asuransi[0]->kas_asuransi_masuk }}
                                    </li>
                                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Kas
                                            Admin(1%): </span>Rp. {{ $penyewa->kas_admin[0]->kas_admin_masuk }}
                                    </li>
                                    <li class="text-black ms-n2 mt-2">
                                        ---------------------------------------------------
                                    </li>
                                </ul>

                                <ul class="list-unstyled">
                                    <li class="text-muted ms-3">
                                        <span class="text-black me-4">Nominal Pembayaran: </span>Rp.
                                        {{ $penyewa->penyewa_detail[0]->nominal_pembayaran }}
                                    </li>
                                    <li class="text-muted ms-3 mt-2"><span class="text-black me-4">Kembalian:
                                        </span>Rp. {{ $penyewa->penyewa_detail[0]->kembalian }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="row mt-5">
                            <div class="col-xl-12">
                                <p class="text-center">Penyewaan yang sudah dibayar tidak bisa dibatalkan! Dan uang
                                    tidak bisa dikembalikan kecuali dengan persetujuan!</p>
                            </div>
                            <div class="col-xl-2">
                                {{-- <button type="button" class="btn btn-primary text-capitalize"
                                    style="background-color:#60bdf3 ;">Pay Now</button> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12">
                                <p class="text-center">Terima Kasih Sudah Melakukan Penyewaan Menggunakan <span
                                        class="fw-bold">TransportIn</span> </p>
                            </div>
                        </div>

                        {{-- <div class="row justify-content-center">
                            <div class="col-xl-2">
                                <p class="text-center">&copy; Copyright {{ $tahun_print_penyewa }}</p>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
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
        window.print();
        window.onfocus = function() {
            window.close();
        }
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
