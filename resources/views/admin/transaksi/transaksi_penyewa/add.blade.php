@extends('admin.layout.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data {{ $judul }}</h3>
                    <p class="text-subtitle text-muted">
                        Harap memasukkan data {{ $menu }} dengan benar.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('transaksiPenyewa') }}">Halaman Utama {{ $judul }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tambah Data {{ $judul }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Basic Vertical form layout section start -->
        <section id="basic-vertical-layouts">
            <div class="row match-height justify-content-center">
                <div class="col-md-9 col-12 mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Tambah {{ $judul }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" action="{{ route('transaksiPenyewaStore') }}"
                                    method="POST" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="users_id" class="mb-2">Nama User <sup
                                                            class="text-danger">*</sup></label>
                                                    <select class="choices form-select" id="users_id" name="users_id"
                                                        required>
                                                        <option value="">-- Pilih Nama User -- </option>

                                                        @foreach ($users as $key => $us)
                                                            <option
                                                                value="{{ old('users_id') ? old('users_id') : $us->id }}"
                                                                {{ old('users_id') ? 'selected' : '' }}>
                                                                {{ $us->id }} -
                                                                {{ $us->nama_lengkap }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="mobil_id">Jenis Mobil <sup
                                                            class="text-danger">*</sup></label>
                                                    <select class="choices form-select" id="mobil_id" name="mobil_id"
                                                        required>
                                                        <option value="">-- Pilih Jenis Mobil -- </option>

                                                        @foreach ($mobil as $key => $mb)
                                                            <option
                                                                value="{{ old('mobil_id') ? old('mobil_id') : $mb->id_mobil }}"
                                                                {{ old('mobil_id') ? 'selected' : '' }}>
                                                                {{ $mb->id_mobil }} -
                                                                {{ $mb->jenis_mobil }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="tanggal_penyewaan">
                                                        Tanggal Penyewaan <sup class="text-danger">*</sup>
                                                    </label>
                                                    <input type="date" id="tanggal_penyewaan" class="form-control mt-2"
                                                        name="tanggal_penyewaan" required max="2300-01-01"
                                                        value="{{ old('tanggal_penyewaan') }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="tanggal_pengembalian">
                                                        Tanggal Pengembalian <sup class="text-danger">*</sup>
                                                    </label>
                                                    <input type="date" id="tanggal_pengembalian"
                                                        class="form-control mt-2" name="tanggal_pengembalian" required
                                                        max="2300-01-01" value="{{ old('tanggal_pengembalian') }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('transaksiPenyewa') }}"
                                                    class="btn btn-light-secondary me-4 mb-1">Kembali</a>
                                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- // Basic Vertical form layout section end -->
    </div>
@endsection


@section('script')
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
@endsection
