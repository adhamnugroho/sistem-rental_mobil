<!DOCTYPE html>
<html class="has-sidemenu" lang="en" dir="ltr">

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- meta CSRF - Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>TransportIn | {{ $judul }}</title>

    {{-- favicon --}}
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


    <!--    Stylesheets-->
    <link href="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/vendors/loaders.css/loaders.min.css') }}"
        rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link href="https://fonts.googleapis.com/css?family=PT+Mono%7cPT+Serif:400,400i%7cLato:100,300,400,700,800,900"
        rel="stylesheet">
    <link href="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/assets/css/theme.min.css') }}"
        rel="stylesheet" />
    <link
        href="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/assets/css/user.min.css"') }}
        rel="stylesheet" />

    {{-- Choices --}}
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/choices.js/public/assets/styles/choices.css') }}" />

    {{-- FontAwesome --}}
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/fontawesome-free-6.2.1-web/css/fontawesome.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/fontawesome-free-6.2.1-web/css/all.min.css') }}" />
</head>

<body class="overflow-hidden-x">

    <!--    Main Content-->

    <main class="main min-vh-100" id="top">
        <!-- Preloader ==================================-->
        <div class="preloader" id="preloader">
            <div class="loader">
                <div class="line-scale-pulse-out-rapid">
                    <div> </div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div> </div>
                </div>
            </div>
        </div>
        <!-- End of Preloader ===========================-->


        <!-- <section> begin ============================-->
        <section class="py-0">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 px-0">
                        <div class="sticky-top vh-lg-100 py-9">
                            <div class="bg-holder"
                                style="background-image:url({{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/assets/img/car-3.jpg') }});background-position:center;"
                                data-zanim-trigger="scroll"
                                data-zanim-lg='{"animation":"zoom-out-slide-right","delay":0.4}'>
                            </div>
                            <!--/.bg-holder-->
                        </div>
                    </div>
                    <div class="col-lg-7 py-6">
                        <div class="row h-100 align-items-center justify-content-center">
                            <div class="col-sm-8 col-md-6 col-lg-10 col-xl-8"
                                data-zanim-xs='{"delay":0.5,"animation":"slide-right"}' data-zanim-trigger="scroll">
                                <h3 class="display-4 fs-2 text-primary">Registrasi Akun</h3>
                                <h6 class="text-dark mt-3">Isi Semua Kolom Dengan Data Yang Sesuai.
                                </h6>
                                <form class="mt-5" action="{{ route('registerStore') }}" method="POST">

                                    @csrf

                                    <div class="row gy-4 align-items-center mb-4">
                                        <div class="col-12">
                                            <label for="nama_lengkap">Nama Lengkap <sup
                                                    class="text-danger">*</sup></label>
                                            <input class="form-control bg-light" type="text"
                                                placeholder="Masukkan Nama Lengkap Anda" id="nama_lengkap"
                                                name="nama_lengkap" required value="{{ old('nama_lengkap') }}" />
                                        </div>
                                        <div class="col-12">
                                            <label for="username">Username <sup class="text-danger">*</sup></label>
                                            <input class="form-control bg-light" type="text"
                                                placeholder="Masukkan Username" name="username" id="username"
                                                maxlength="50" required data-bs-toggle="tooltip"
                                                data-bs-placement="left"
                                                title="Harap untuk memasukkan username tidak lebih dari 50 karakter"
                                                autocomplete="username" value="{{ old('username') }}" />
                                        </div>
                                        <div class="col-12">
                                            <label for="email">Email <sup class="text-danger">*</sup></label>
                                            <input class="form-control bg-light" type="email"
                                                placeholder="Masukkan Email" name="email" id="email" required
                                                autocomplete="email" inputmode="email"
                                                value="{{ old('email') }}" />
                                        </div>
                                        <div class="col-12">
                                            <label for="password">Password <sup class="text-danger">*</sup></label>
                                            <div class="input-group">
                                                <input class="form-control bg-light" type="password"
                                                    placeholder="Masukkan Password" name="password" id="password"
                                                    required autocomplete="current-password" minlength="8"
                                                    data-bs-toggle="tooltip" data-bs-placement="right"
                                                    title="Harap memasukkan password minimal 8 karakter"
                                                    value="{{ old('password') }}" />
                                                <i class="fa-regular fa-eye-slash" onclick="togglePassword()"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Tombol hide / unhide password" id="toggle-hide"
                                                    style="cursor: pointer;"></i>

                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="no_telp">Nomor Telepon <sup
                                                    class="text-danger">*</sup></label>
                                            <input class="form-control bg-light" type="no_telp"
                                                placeholder="Masukkan Nomor Telepon" name="no_telp" id="no_telp"
                                                required inputmode="tel" data-bs-toggle="tooltip"
                                                data-bs-placement="left"
                                                title="Harap memasukkan nomor telepon tidak lebih dari 15 digit"
                                                maxlength="15" autocomplete="tel" value="{{ old('no_telp') }}" />
                                        </div>
                                        <div class="col-12">
                                            <label for="tempat_lahir">Tempat Lahir <sup
                                                    class="text-danger">*</sup></label>
                                            <select class="choices form-select bg-light" id="tempat_lahir"
                                                name="tempat_lahir" required>
                                                <option value="">-- Pilih Kota / Kabupaten --</option>

                                                @foreach ($kabupaten as $key => $tl)
                                                    <option
                                                        value="{{ old('tempat_lahir') ? old('tempat_lahir') : $tl->id_kabupaten }}"
                                                        {{ old('tempat_lahir') ? 'selected' : '' }}>
                                                        {{ $tl->id_kabupaten }} -
                                                        {{ $tl->nama_kabupaten }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="tanggal_lahir">Tanggal Lahir <sup
                                                    class="text-danger">*</sup></label>
                                            <input class="form-control bg-light" type="date"
                                                placeholder="Masukkan Tanggal Lahir" name="tanggal_lahir"
                                                id="tanggal_lahir" required min="1800-01-01" max="2300-01-01"
                                                value="{{ old('tanggal_lahir') }}" data-bs-toggle="tooltip"
                                                data-bs-placement="left"
                                                title="Jika kesulitan memilih tanggal, bisa menggunakan bantuan pemilihan tanggal dipojok kanan kolom" />
                                        </div>
                                        <div class="col-12">
                                            <label for="umur">Umur <sup class="text-danger">*</sup></label>
                                            <input class="form-control bg-light" type="number"
                                                placeholder="Masukkan Umur Anda" name="umur" id="umur"
                                                required min="5" max="200" inputmode="numeric"
                                                value="{{ old('umur') }}" data-bs-toggle="tooltip"
                                                data-bs-placement="left"
                                                title="Minimal umur yang dibolehkan untuk registrasi yaitu 5 tahun" />
                                        </div>
                                        <div class="col-12">
                                            <label for="domisili_sekarang">Domisili Sekarang <sup
                                                    class="text-danger">*</sup></label>
                                            <select class="choices form-select bg-light" id="domisili_sekarang"
                                                name="domisili_sekarang" required>
                                                <option value="">-- Pilih Kota / Kabupaten --</option>

                                                @foreach ($kabupaten as $key => $tl)
                                                    <option
                                                        value="{{ old('domisili_sekarang') ? old('domisili_sekarang') : $tl->id_kabupaten }}"
                                                        {{ old('domisili_sekarang') ? 'selected' : '' }}>
                                                        {{ $tl->id_kabupaten }} -
                                                        {{ $tl->nama_kabupaten }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="alamat_lengkap">Alamat Lengkap <sup
                                                    class="text-danger">*</sup></label>
                                            <textarea class="form-control bg-light" placeholder="Masukkan Alamat Lengkap Anda Disini" id="alamat_lengkap"
                                                name="alamat_lengkap" required autocomplete="address-level1">{{ old('alamat_lengkap') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-4 align-items-center">
                                        <div class="col-auto d-grid">
                                            <input class="btn btn-primary" type="submit" name="submit"
                                                value="Buat Akun" />
                                        </div>
                                        <div class="col-sm">
                                            <p class="fs--1 text-700 mb-0 font-sans-serif mt-2 mt-lg-0">Sudah Memiliki
                                                Akun, Kembali Ke <a class="text-black"
                                                    href="{{ route('login') }}">Halaman
                                                    Login</a></p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end of .container-->
        </section><!-- <section> close ============================-->


    </main <!-- End of Main Content-->




    <!--===============================================-->
    <!--    Footer-->
    <!--===============================================-->
    <footer class="footer text-600 py-4 font-sans-serif text-center overflow-hidden" data-zanim-timeline="{}"
        data-zanim-trigger="scroll" style="background-color: #435ebe;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 order-lg-2 position-relative"><a class="indicator indicator-up"
                        href="#top"><span class="indicator-arrow indicator-arrow-one"
                            data-zanim-xs='{"from":{"opacity":0,"y":15},"to":{"opacity":1,"y":-5,"scale":1},"ease":"Back.easeOut","duration":0.4,"delay":0.9}'></span><span
                            class="indicator-arrow indicator-arrow-two"
                            data-zanim-xs='{"from":{"opacity":0,"y":15},"to":{"opacity":1,"y":-5,"scale":1},"ease":"Back.easeOut","duration":0.4,"delay":1.05}'></span></a>
                </div>
                <div class="col-lg-4 text-lg-start mt-4 mt-lg-0">
                    <p class="fs--1 ls fw-bold mb-0 text-white">Copyright &copy; {{ $tahun_ini }} <span
                            class="">TransportIn</span></p>
                </div>
                {{-- <div class="col-lg-4 text-lg-end order-lg-2 mt-2 mt-lg-0 text-white">
                    <p class="fs--1 text-uppercase ls fw-bold mb-0 text-white">Made with<span
                            class="text-danger fas fa-heart mx-1"></span>by <a class="text-white"
                            href="https://themewagon.com/">Themewagon</a></p>
                </div> --}}
            </div>
        </div>
    </footer>
    </div>


    <!--    JavaScripts-->
    <script src="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/vendors/popper/popper.min.js') }}">
    </script>
    <script src="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/vendors/bootstrap/bootstrap.min.js') }}">
    </script>
    <script src="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/vendors/anchorjs/anchor.min.js') }}">
    </script>
    <script src="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/vendors/is/is.min.js') }}"></script>
    <script src="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/vendors/fontawesome/all.min.js') }}">
    </script>
    <script src="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/vendors/lodash/lodash.min.js') }}">
    </script>
    <script src="{{ asset('template-sign-up/polyfill.io/v3/polyfill.min58be.js?features=window.scroll') }}"></script>
    <script
        src="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/vendors/imagesloaded/imagesloaded.pkgd.js') }}">
    </script>
    <script src="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/vendors/gsap/gsap.js') }}"></script>
    <script src="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/vendors/gsap/customEase.js') }}"></script>
    <script src="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/vendors/gsap/drawSVGPlugin.js') }}">
    </script><!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-122907869-1"></script>
    <script src="{{ asset('template-admin/assets/extensions/jquery/jquery.min.js') }}"></script>
    {{-- Select --}}
    <script src="{{ asset('template-admin/assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('template-admin/assets/js/pages/form-element-select.js') }}"></script>
    <script src="{{ asset('template-sign-up/prium.github.io/twbs-sparrow/v2.1.1/assets/js/theme.js') }}"></script>


    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-122907869-1');
    </script>


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
        function togglePassword() {

            let passwordInput = document.getElementById("password");
            let toggleHide = $("#toggle-hide");


            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';

                toggleHide.removeClass('fa-regular fa-eye-slash')
                toggleHide.addClass('fa-regular fa-eye')
            } else {
                passwordInput.type = 'password';

                toggleHide.removeClass('fa-regular fa-eye')
                toggleHide.addClass('fa-regular fa-eye-slash')
            }
        }
    </script>

</body>

</html>
