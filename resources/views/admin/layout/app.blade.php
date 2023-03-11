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
    {{-- Theme Dark --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/css/main/app-dark.css') }}" />
    {{-- Spinner --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/css/main/spinner.css') }}" />


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
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/css/shared/icon-system-rental-mobil-font/iconly.css') }}" />

    {{-- FontAwesome CSS --}}
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/fontawesome-free-6.2.1-web/css/fontawesome.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/fontawesome-free-6.2.1-web/css/all.min.css') }}" />

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
    <script src="{{ asset('template-admin/assets/js/initTheme.js') }}"></script>

    <div class="spinner-wrapper" id="spinner-wrapper">
        <div class="spinner" id="spinner">
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="circle"></div>
            <div class="shadow"></div>
            <div class="shadow"></div>
            <div class="shadow"></div>
        </div>
    </div>


    <div id="app">

        {{-- Sidebar --}}
        @include('admin.layout.sidebar')

        <div id="main">
            {{-- Header --}}
            @include('admin.layout.header')

            {{-- Content --}}
            @yield('content')

            {{-- Footer --}}
            @include('admin.layout.footer')
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


    <script>
        // Config Loader

        $(window).on("load", function() {
            $("#spinner-wrapper").fadeOut("slow");
        });
    </script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <script>
        // Pengkondisian Theme-light dan Theme-dark jika halaman sudah diload
        $(document).ready(function() {

            loadThemeToast()
        });


        // Pengkondisian Theme-light dan Theme-dark jika tombol #toggle-dark diklik
        $("#toggle-dark").on('click', loadThemeToast);


        function loadThemeToast() {

            let theme = document.getElementsByTagName("body")[0].className;

            if (theme == "theme-light") {

                // Template Toast dengan Sweet Alert
                // Template harus didefinisikan terlebih dahulu, sebelum menggunakan template
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 10000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });


                // console.log(theme)


                @if (Session::has('status'))

                    @if (Session::get('status') == 'success')

                        Toast.fire({

                            icon: '{{ Session::get('status') }}',
                            title: '{{ Session::get('message') }}',
                        })
                    @else

                        Toast.fire({

                            icon: '{{ Session::get('status') }}',
                            title: '{{ Session::get('message') }}',
                        })
                    @endif
                @endif


            } else if (theme == "theme-dark") {

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    background: '#435ebe',
                    color: '#ffffff',
                    showConfirmButton: false,
                    timer: 10000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });

                // console.log(theme)


                @if (Session::has('status'))

                    @if (Session::get('status') == 'success')

                        Toast.fire({

                            icon: '{{ Session::get('status') }}',
                            title: '{{ Session::get('message') }}',
                        })
                    @else

                        Toast.fire({

                            icon: '{{ Session::get('status') }}',
                            title: '{{ Session::get('message') }}',
                        })
                    @endif
                @endif
            }
        }


        // Logout
        function logout() {

            swal.fire({

                icon: 'warning',
                title: 'Apakah Anda Yakin Ingin Logout?',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Yakin!',
            }).then((result) => {

                if (result.value) {

                    window.location.replace("{{ route('logout') }}");
                }
            });
        }
    </script>


    <script>
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
    </script>


    @yield('script')

</body>

</html>
