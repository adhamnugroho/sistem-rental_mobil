<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    {{-- meta CSRF - Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>TransportIn - {{ $judul }}</title>

    <link rel="stylesheet" href="{{ asset('template-admin/assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('template-admin/assets/css/pages/auth.css') }}" />

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

    {{-- FontAwesome CSS --}}
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/fontawesome-free-6.2.1-web/css/fontawesome.css') }}" />
    <link rel="stylesheet"
        href="{{ asset('template-admin/assets/extensions/fontawesome-free-6.2.1-web/css/all.min.css') }}" />

    {{-- DripIcons --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/extensions/@icon/dripicons/dripicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('template-admin/assets/css/pages/dripicons.css') }}" />

    {{-- Sweetalert2 - 11.4.8  --}}
    <link rel="stylesheet" href="{{ asset('template-admin/assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}">

</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-6 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img
                                src="{{ asset('template-admin/assets/images/logo/logo_website_rental_mobil1.svg') }}"
                                alt="Logo" /></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">
                        Log in dengan data yang anda masukkan sewaktu melakukan registrasi akun.
                    </p>

                    <form action="{{ route('postLogin') }}" method="POST">
                        @csrf

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control" placeholder="Username" name="username" required
                                autocomplete="username" id="input-username" />
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control" placeholder="Password" name="password" required
                                autocomplete="current-password" id="input-password" />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>

                            </div>
                            <div class="form-control-icon-1">
                                <i class="bi bi-eye-slash" onclick="togglePassword()" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="Tombol hide / unhide password" id="toggle-hide"
                                    style="cursor: pointer;"></i>

                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2" id="button-login">
                            Log in
                        </button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-5">
                        <p class="text-gray-600">
                            Tidak mempunyai akun?
                            <a href="{{ route('register') }}" class="font-bold">Registrasi</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div id="auth-right"></div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template-admin/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('template-admin/assets/js/app.js') }}"></script>
    <script src="{{ asset('template-admin/assets/extensions/jquery/jquery.min.js') }}"></script>

    {{-- Sweetalert2 - 11.4.8 --}}
    <script src="{{ asset('template-admin/assets/plugins/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
    </script>


    <script>
        document.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {

                if (document.getElementById('input-username').value !== '' && document.getElementById(
                        'input-password').value !== '') {

                    document.getElementById('button-login').click();
                }
            }
        });
    </script>

    <script>
        function togglePassword() {

            let passwordInput = document.getElementById("input-password");
            let toggleHide = $("#toggle-hide");


            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';

                toggleHide.removeClass('bi bi-eye-slash')
                toggleHide.addClass('bi bi-eye')
            } else {
                passwordInput.type = 'password';

                toggleHide.removeClass('bi bi-eye')
                toggleHide.addClass('bi bi-eye-slash')
            }
        }
    </script>


</body>

</html>
