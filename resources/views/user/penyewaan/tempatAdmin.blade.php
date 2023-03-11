@extends('user.layout.app')

@section('content')
    <main>
        <section id="id-features-8">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 text-center">
                        <h2>Pembuatan Penyewaan Berhasil</h2>
                        <p class="lead mt-3 mb-4">
                            Anda harus mengambil mobil {{ $penyewa->penyewa_detail[0]->mobil->jenis_mobil }} ini di kantor
                            admin di Jalan Sukarno Hatta pada
                            {{ $penyewa->penyewa_detail[0]->kabupaten->nama_kabupaten }},
                            pada tanggal {{ $tanggal_penyewaan }}
                        </p>
                        <a class="btn btn-sm btn-outline-primary mt-3 hvr-sweep-left"
                            href="{{ route('userDashboard') }}">Kembali Ke Halaman User</a><img class="mt-6"
                            src="https://prium.github.io/slick/assets/images/hang_out.svg" alt="featured-image"
                            id="featured-image-features-8" />
                    </div>
                </div>
                <!--/.row-->
            </div>
            <!--/.container-->
        </section>
    </main>
@endsection
