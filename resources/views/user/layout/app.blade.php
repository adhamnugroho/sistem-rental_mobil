<!DOCTYPE html>
<html lang="en">

<head>
    <title>TransportIn - {{ $judul }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- meta csrf --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap"
        rel="stylesheet">

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

    <link rel="stylesheet" href="{{ asset('template-user/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template-user/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('template-user/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template-user/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('template-user/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('template-user/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('template-user/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('template-user/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('template-user/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('template-user/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('template-user/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('template-user/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('template-user/css/button-custom.css') }}">

    {{-- FontAwesome --}}
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/fontawesome-free-6.2.1-web/css/fontawesome.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/fontawesome-free-6.2.1-web/css/all.min.css') }}" />

    {{-- Sweetalert2 - 11.4.8  --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/plugins/sweetalert2/dist/sweetalert2.css') }}">
    <link rel="stylesheet" href="{{ asset('template-admin/assets/plugins/sweetalert2/dist/dark.css') }}">

    {{-- template user  - 404 not found --}}
    <!-- Template specific stylesheets-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
    {{-- <link href="{{ asset('template-404-notfound/assets/lib/hamburgers/dist/hamburgers.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('template-404-notfound/assets/lib/iconsmind/iconsmind.css') }}" rel="stylesheet" />
    <link href="{{ asset('template-404-notfound/assets/lib/flexslider/flexslider.css') }}" rel="stylesheet" />
    <link href="{{ asset('template-404-notfound/assets/lib/loaders.css/loaders.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('template-404-notfound/assets/lib/remodal/dist/remodal.css') }}" rel="stylesheet" />
    <link href="{{ asset('template-404-notfound/assets/lib/remodal/dist/remodal-default-theme.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('template-404-notfound/assets/lib/semantic-ui-dropdown/dropdown.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('template-404-notfound/assets/lib/semantic-ui-accordion/accordion.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('template-404-notfound/assets/lib/semantic-ui-transition/transition.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('template-404-notfound/assets/lib/owl.carousel/dist/assets/owl.carousel.min.css') }}"
        rel="stylesheet" />
    <link href="{{ asset('template-404-notfound/assets/lib/owl.carousel/dist/assets/owl.theme.default.min.css') }}"
        rel="stylesheet" /> --}}
    <link href="{{ asset('template-404-notfound/assets/lib/lightbox2/dist/css/lightbox.css') }}" rel="stylesheet" />
    <!-- Main stylesheet and color file-->
    <link href="{{ asset('template-404-notfound/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('template-404-notfound/assets/css/custom.css') }}" rel="stylesheet" />

    {{-- Ziggy – Laravel routes in JavaScript --}}
    @routes

</head>

<body>

    @include('user.layout.header')
    <!-- END nav -->

    @yield('content')

    @include('user.layout.counter')

    @include('user.layout.footer')


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg>
    </div>


    <script src="{{ asset('template-user/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template-user/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('template-user/js/popper.min.js') }}"></script>
    <script src="{{ asset('template-user/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template-user/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('template-user/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('template-user/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('template-user/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template-user/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('template-user/js/aos.js') }}"></script>
    <script src="{{ asset('template-user/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('template-user/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('template-user/js/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('template-user/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('template-user/js/google-map.js') }}"></script>
    <script src="{{ asset('template-user/js/main.js') }}"></script>

    {{-- Sweetalert2 - 11.4.8 --}}
    <script src="{{ asset('template-admin/assets/plugins/sweetalert2/dist/sweetalert2.all.js') }}"></script>

    {{-- javascript - 404 Not Found --}}
    {{-- <script src="{{ asset('template-404-notfound/cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js') }}">
    <script src="{{ asset('template-404-notfound/assets/js/imagesloaded.pkgd.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/%40fontawesome/js/all.min.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/TweenMax.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/CustomEase.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/ScrollToPlugin.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/Utils.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/detector.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/inertia.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/sticky-kit/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/stickyfilljs/dist/stickyfill.min.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/stickykit.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/stickyfill.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/zanimation.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/border-animation.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/remodal/dist/remodal.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/semantic-ui-dropdown/dropdown.min.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/semantic-ui-accordion/accordion.min.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/semantic-ui-transition/transition.min.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/lightbox2/dist/js/lightbox.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/tableCollation.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/countup.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/googlemap.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/rellax/rellax.min.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/isotope-layout/dist/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/isotope-packery/packery-mode.pkgd.min.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/typed.js/lib/typed.min.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/lib/jquery.mb.ytplayer/dist/jquery.mb.YTPlayer.min.js') }}">
    </script>
    <script src="{{ asset('template-404-notfound/assets/lib/flexslider/jquery.flexslider-min.js') }}"></script>
    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-55162400-5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());
        gtag("config", "UA-55162400-5");
    </script>
    <!-- Hotjar Tracking Code for https://prium.github.io/slick/-->
    <script>
        (function(h, o, t, j, a, r) {
            h.hj =
                h.hj ||
                function() {
                    (h.hj.q = h.hj.q || []).push(arguments);
                };
            h._hjSettings = {
                hjid: 1029753,
                hjsv: 6
            };
            a = o.getElementsByTagName("head")[0];
            r = o.createElement("script");
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(
            window,
            document,
            "https://static.hotjar.com/c/hotjar-",
            ".js?sv="
        );
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARdVcREeBK44lIWnv5-iPijKqvlSAVwbw&amp;callback=initMap"
        async></script> --}}
    <script src="{{ asset('template-404-notfound/assets/js/core.js') }}"></script>
    <script src="{{ asset('template-404-notfound/assets/js/main.js') }}"></script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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

    <script>
        // Template Toast dengan Sweet Alert
        // Template harus didefinisikan terlebih dahulu, sebelum menggunakan template
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3700,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });



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

    @yield('script')

</body>

</html>
