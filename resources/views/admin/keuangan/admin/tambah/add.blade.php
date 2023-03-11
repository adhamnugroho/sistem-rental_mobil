@extends('admin.layout.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data {{ str_replace('_', ' ', $judul) }}</h3>
                    <p class="text-subtitle text-muted">
                        Harap memasukkan data {{ str_replace('_', ' ', $judul) }} dengan benar.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('perental') }}">Halaman Utama {{ str_replace('_', ' ', $judul) }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tambah Data {{ str_replace('_', ' ', $judul) }}
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
                            <h4 class="card-title">Form Pemasukan {{ str_replace('_', ' ', $judul) }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" action="{{ route('keuanganAdminTambahStore') }}"
                                    method="POST">

                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="kas_admin_masuk" class="mb-2">Nominal Pemasukan <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="number" id="kas_admin_masuk" class="form-control mt-2"
                                                        name="kas_admin_masuk" min="100"
                                                        placeholder="Masukkan Nominal Pemasukan Kas Admin" required
                                                        inputmode="numeric" autocomplete="transaction-currency"
                                                        value="{{ old('kas_admin_masuk') }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="tanggal">
                                                        Tanggal Pemasukan <sup class="text-danger">*</sup>
                                                    </label>
                                                    <input type="date" id="tanggal" class="form-control mt-2"
                                                        name="tanggal" required max="2300-01-01"
                                                        value="{{ old('tanggal') }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label for="keterangan" class="mb-2">
                                                    <span>Keterangan</span> <span class="text-info">(Opsional)</span>
                                                </label>
                                                <div class="form-floating">
                                                    <textarea class="form-control mt-2" placeholder="Masukkan Keterangan Disini" id="keterangan" name="keterangan">{{ old('keterangan') }}</textarea>
                                                    <label for="keterangan">Masukkan Keterangan Disini</label>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('keuanganAdmin') }}"
                                                    class="btn btn-light-secondary me-3 mb-1">Kembali</a>
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
        // Fitur dinamic day in min attribute input:date 
        let inputDatesTanggal = document.getElementById('tanggal');


        // Mendapatkan tanggal hari ini
        var tanggalSekarang = new Date();

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
        inputDatesTanggal.min = tanggalHariIni;
    </script>
@endsection
