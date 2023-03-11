@extends('user.layout.app')

@section('content')
    <section class="hero-wrap hero-wrap-2 js-fullheight"
        style="background-image: url('{{ asset('template-user/images/bg_1.jpg') }}');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs">
                        <span class="mr-2"><a href="{{ route('userDashboard') }}">Beranda <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>{{ $judul }} <i
                                class="ion-ios-arrow-forward"></i>
                        </span>
                    </p>
                    <h1 class="mb-3 bread">{{ $judul }}</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-no-pt bg-light">
        <div class="container">

    </section>

    <section class="ftco-section ftco-intro" style="background-image: url({{ asset('template-user/images/bg_2.jpg') }});"
        id="container-form-penyewaan">
        <div class="overlay bg-primary"></div>
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-12	featured-top mt-1">
                    <div class="row no-gutters">
                        <div class="col-md-4 d-flex align-items-center justify-content-end">
                            <form action="{{ route('userStorePenyewaan') }}" class="request-form ftco-animate bg-primary"
                                id="form-penyewaan" method="POST">

                                @csrf

                                <h2 class="">Make your trip</h2>
                                <div class="form-group">
                                    <label for="" class="label">Tanggal Penyewaan</label>
                                    <input type="date" class="form-control" id="tanggal_penyewaan"
                                        name="tanggal_penyewaan" placeholder="Tanggal Penyewaan"
                                        onchange="hitungHargaPenyewaan();minTanggalPengembalian();" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Kolom Tanggal Penyewaan">
                                </div>
                                <div class="form-group">
                                    <label for="" class="label">Tanggal Pengembalian</label>
                                    <input type="date" class="form-control" id="tanggal_pengembalian"
                                        name="tanggal_pengembalian" placeholder="Tanggal Pengembalian"
                                        onchange="hitungHargaPenyewaan();maxTanggalPenyewaan();" data-bs-toggle="tooltip"
                                        data-bs-placement="left" title="Kolom Tanggal Pengembalian">
                                </div>
                                <input type="hidden" name="mobil_id" id="mobil_id" value="{{ $mobil->id_mobil }}">
                                {{-- <div class="form-group">
                                    <label for="" class="label">Pick-up time</label>
                                    <input type="text" class="form-control" id="time_pick" placeholder="Time">
                                </div> --}}
                                <div class="form-group">
                                    <input type="submit" value="Sewa Sekarang" class="btn btn-secondary py-3 px-4">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8 d-flex align-items-center">
                            <div class="services-wrap rounded-right w-100">
                                <h3 class="heading-section mb-4">List Harga Yang Harus Dibayarkan</h3>
                                <div class="row">
                                    <div class="col-5 text-dark">Harga Mobil: </div>
                                    <div class="col-3 text-dark">Rp. {{ number_format($mobil->harga, 0, ',', '.') }}</div>
                                    <input type="hidden" name="harga_mobil" id="harga_mobil" value="{{ $mobil->harga }}">
                                </div>
                                <div class="row">
                                    <div class="col-5 text-dark">Harga Penyewaan Per Hari: </div>
                                    <div class="col-3 text-dark">Rp. {{ number_format(500000, 0, ',', '.') }}</div>
                                </div>
                                <br>
                                <hr
                                    style="border-top: 5px solid ;
                                           box-shadow: 0 3px 9px 0px rgba(0, 0, 0, 0.2);">
                                <div class="row">
                                    <div class="col-5 text-dark">Total Harga Penyewaan: </div>
                                    <div class="col-3 text-dark" id="harga_total_penyewaan_display"></div>
                                    <input type="hidden" name="harga_total_penyewaan" id="harga_total_penyewaan"
                                        value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- <section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-md-7 text-center heading-section ftco-animate">
                    <span class="subheading">Testimonial</span>
                    <h2 class="mb-3">Happy Clients</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel ftco-owl">
                        <div class="item">
                            <div class="testimony-wrap rounded text-center py-4 pb-5">
                                <div class="user-img mb-2"
                                    style="background-image: url({{ asset('template-user/images/person_1.jpg') }})">
                                </div>
                                <div class="text pt-4">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">Marketing Manager</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap rounded text-center py-4 pb-5">
                                <div class="user-img mb-2"
                                    style="background-image: url({{ asset('template-user/images/person_2.jpg') }})">
                                </div>
                                <div class="text pt-4">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">Interface Designer</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap rounded text-center py-4 pb-5">
                                <div class="user-img mb-2"
                                    style="background-image: url({{ asset('template-user/images/person_3.jpg') }})">
                                </div>
                                <div class="text pt-4">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">UI Designer</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap rounded text-center py-4 pb-5">
                                <div class="user-img mb-2"
                                    style="background-image: url({{ asset('template-user/images/person_1.jpg') }})">
                                </div>
                                <div class="text pt-4">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">Web Developer</span>
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="testimony-wrap rounded text-center py-4 pb-5">
                                <div class="user-img mb-2"
                                    style="background-image: url({{ asset('template-user/images/person_1.jpg') }})">
                                </div>
                                <div class="text pt-4">
                                    <p class="mb-4">Far far away, behind the word mountains, far from the countries
                                        Vokalia and Consonantia, there live the blind texts.</p>
                                    <p class="name">Roger Scott</p>
                                    <span class="position">System Analyst</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <section class="ftco-counter ftco-section img" id="section-counter">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="{{ $lama_berdiri }}">0</strong>
                            <span>Tahun <br>Telah Berdiri</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="{{ $jumlah_mobil }}">0</strong>
                            <span>Total <br>Mobil</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text text-border d-flex align-items-center">
                            <strong class="number" data-number="{{ $jumlah_users }}">0</strong>
                            <span>Pelanggan <br>Yang Puas</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 justify-content-center counter-wrap ftco-animate">
                    <div class="block-18">
                        <div class="text d-flex align-items-center">
                            <strong class="number" data-number="{{ $jumlah_cabang }}">0</strong>
                            <span>Total <br>Cabang</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@section('script')
    <script>
        $(document).ready(function() {

            hitungHargaPenyewaan()
        });
    </script>

    <script>
        // Fitur dinamic day in min attribute input:date id"tanggal_penyewaan" dan id"tanggal_pengembalian"
        let inputDatesTanggalPenyewaan = document.getElementById('tanggal_penyewaan');
        let inputDatesTanggalPengembalian = document.getElementById('tanggal_pengembalian');

        // Mendapatkan tanggal hari ini
        var tanggalSekarang = new Date();

        // Menambahkan 1 hari pada tanggal hari ini
        tanggalSekarang.setDate(tanggalSekarang.getDate() + 2);

        // Mengambil bagian tanggal, bulan, dan tahun dari tanggal hari ini
        var tanggal = tanggalSekarang.getDate();
        var bulan = tanggalSekarang.getMonth() + 1;
        var tahun = tanggalSekarang.getFullYear();

        // Menambahkan 0 di depan tanggal dan bulan jika kurang dari 10
        if (tanggal < 10) {
            tanggal = "0" + tanggal;
        }
        if (bulan < 10) {
            bulan = "0" + bulan;
        }

        // Menyusun tanggal hari ini + 1 dalam format yyyy-mm-dd
        var tanggalHariIni = tahun + "-" + bulan + "-" + tanggal;


        // Menetapkan nilai attribute min pada elemen input dengan tanggal hari ini
        inputDatesTanggalPenyewaan.min = tanggalHariIni;
        inputDatesTanggalPengembalian.min = tanggalHariIni;
    </script>


    <script>
        function hitungHargaPenyewaan() {

            let tanggalPenyewaan = document.getElementById('tanggal_penyewaan').value;
            let tanggalPengembalian = document.getElementById('tanggal_pengembalian').value;


            if (tanggalPenyewaan !== '' && tanggalPengembalian !== '') {

                let mobil_id = document.getElementById('mobil_id').value;

                let hasil_routeHitungPenyewaanAjax = route('userHitungPenyewaanAjax');

                $.ajax({
                    type: "POST",
                    url: hasil_routeHitungPenyewaanAjax,
                    data: {
                        tanggal_penyewaan: tanggalPenyewaan,
                        tanggal_pengembalian: tanggalPengembalian,
                        mobil_id: mobil_id,
                    },
                    dataType: "json",
                    success: function(response) {

                        if (response.status == 'ditemukan') {

                            $("#harga_total_penyewaan_display").html("Rp. " + response.harga_total_penyewaan
                                .toLocaleString())
                            $("#harga_total_penyewaan").val(response.harga_total_penyewaan)
                        }
                    },
                    error: function(response) {

                        console.log(response.responseText);
                    }
                });
            } else {

                let harga_mobil = Number(document.getElementById("harga_mobil").value);
                let harga_total_penyewaan = document.getElementById("harga_total_penyewaan");
                let harga_total_penyewaan_display = document.getElementById("harga_total_penyewaan_display");

                let hitung_hargaMobil = harga_mobil + 500000;

                harga_total_penyewaan.value = hitung_hargaMobil;
                harga_total_penyewaan_display.innerHTML = "Rp. " + hitung_hargaMobil.toLocaleString();
            }
        }


        function minTanggalPengembalian() {
            let inputDatesTanggalPenyewaan = document.getElementById('tanggal_penyewaan').value;
            let inputDatesTanggalPengembalian = document.getElementById('tanggal_pengembalian');

            // set tanggal minimal pengambalian
            inputDatesTanggalPengembalian.min = inputDatesTanggalPenyewaan;
        }


        function maxTanggalPenyewaan() {
            let inputDatesTanggalPenyewaan = document.getElementById('tanggal_penyewaan');
            let inputDatesTanggalPengembalian = document.getElementById('tanggal_pengembalian').value;

            // set tanggal minimal pengambalian
            inputDatesTanggalPenyewaan.max = inputDatesTanggalPengembalian;
        }
    </script>
@endsection
