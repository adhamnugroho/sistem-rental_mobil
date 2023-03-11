<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        {{-- <a class="navbar-brand" href="index.html">Car<span>Book</span></a> --}}
        <a class="navbar-brand" href="{{ route('userDashboard') }}">
            <img src="{{ asset('template-admin/assets/images/logo/logo_website_rental_mobil1.svg') }}" alt="Logo"
                srcset="" class="w-50 h-100 pb-2 pe-sm-2" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
            aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            {{-- <ul class="navbar-nav ml-auto">
                <li class="nav-item {{ $judul == 'Dashboard' ? 'active' : '' }}"><a href="{{ route('userDashboard') }}"
                        class="nav-link">Home</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
            </ul> --}}
            @if (Auth::check())
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-3 text-center align-items-center" id="text-nama-user-login">
                        {{ Auth::user()->nama_lengkap }}
                    </li>
                    <li class=" mb-1 nav-item">
                        <a href="{{ route('logout') }}" class="button-custom">Logout <i
                                class="fa-solid fa-right-from-bracket"></i></a>
                    </li>
                </ul>
            @else
                <ul class="navbar-nav ml-auto">
                    <li class="">
                        <a href="{{ route('login') }}" class="button-custom">Login <i
                                class="fa-solid fa-right-to-bracket"></i></a>
                    </li>
                </ul>
            @endif
        </div>
    </div>
</nav>
