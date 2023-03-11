@extends('admin.layout.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data {{ $judul }}</h3>
                    <p class="text-subtitle text-muted">
                        List Data Lengkap {{ $judul }}.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('mobil') }}">Halaman Utama {{ $judul }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Detail Lengkap Data {{ $judul }}
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
                            <h4 class="card-title">List Data Lengkap {{ $judul }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form class="form form-vertical" action="" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="perental_id" class="mb-2">Nama Perental </label>
                                                    <select class="choices form-select" id="perental_id" name="perental_id"
                                                        disabled>
                                                        <option value="">-- Pilih Nama Perental -- </option>

                                                        @foreach ($perental as $key => $pr)
                                                            <option
                                                                value="{{ old('perental_id') ? old('perental_id') : $pr->id_perental }}"
                                                                {{ $pr->id_perental == $mobil->perental_id ? 'selected' : '' }}>
                                                                {{ $pr->id_perental }} -
                                                                {{ $pr->users->nama_lengkap }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="jenis_mobil">Jenis Mobil </label>
                                                    <input type="text" id="jenis_mobil" class="form-control mt-2"
                                                        name="jenis_mobil" placeholder="Masukkan Jenis Mobil"
                                                        value="{{ old('jenis_mobil') ? old('jenis_mobil') : $mobil->jenis_mobil }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="plat_nomor">Plat Nomor </label>
                                                    <input type="text" id="plat_nomor"
                                                        class="form-control mt-2 text-uppercase" name="plat_nomor"
                                                        placeholder="Masukkan Plat Nomor"
                                                        value="{{ old('plat_nomor') ? old('plat_nomor') : $mobil->plat_nomor }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="warna">Warna</label>
                                                    <input type="text" id="warna" class="form-control mt-2"
                                                        name="warna" placeholder="Masukkan Warna"
                                                        value="{{ old('warna') ? old('warna') : $mobil->warna }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="tanggal_didaftarkan">Tanggal Pendaftaran </label>
                                                    <input type="date" id="tanggal_didaftarkan" class="form-control mt-2"
                                                        name="tanggal_didaftarkan" min="2019-01-01" max="2300-01-01"
                                                        value="{{ old('tanggal_didaftarkan') ? old('tanggal_didaftarkan') : $mobil->tanggal_didaftarkan }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="harga">Harga Penyewaan Mobil </label>
                                                    <input type="number" id="harga" class="form-control mt-2"
                                                        name="harga" placeholder="Masukkan Harga Penyewaan Mobil" required
                                                        min="100000" max="" inputmode="numeric"
                                                        autocomplete="transaction-currency"
                                                        value="{{ old('harga') ? old('harga') : $mobil->harga }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label for="deskripsi_mobil" class="mb-2">
                                                    <span>Deskripsi Mobil</span>
                                                </label>
                                                <div class="form-floating">
                                                    <textarea class="form-control mt-2" placeholder="Masukkan Deskripsi Mobil Disini" id="deskripsi_mobil"
                                                        name="deskripsi_mobil" readonly="readonly" data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Kolom Deskripsi ini bisa dipanjangkan ukuran wadahnya, apabila dirasa tampilan default kurang memadai untuk membaca isinya">{{ old('deskripsi_mobil') ? old('deskripsi_mobil') : $mobil->deskripsi_mobil }}</textarea>
                                                    <label for="deskripsi_mobil">Masukkan Deskripsi Mobil Disini</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="status_penyewaan" class="mb-2">Status Penyewaan </label>
                                                    <select class="choices form-select" id="status_penyewaan"
                                                        name="status_penyewaan" disabled>
                                                        <option value="">-- Pilih Penyewaan --</option>
                                                        <option
                                                            value="{{ old('status_penyewaan') ? old('status_penyewaan') : 'Sudah_Disewa' }}"
                                                            {{ $mobil->status_penyewaan == 'Sudah_Disewa' ? 'selected' : '' }}>
                                                            Sudah Disewa</option>
                                                        <option
                                                            value="{{ old('status_penyewaan') ? old('status_penyewaan') : 'Belum_Disewa' }}"
                                                            {{ $mobil->status_penyewaan == 'Belum_Disewa' ? 'selected' : '' }}>
                                                            Belum Disewa</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="status_penggunaan_mobil" class="mb-2">Status Penggunaan
                                                        Mobil </label>
                                                    <select class="choices form-select" id="status_penggunaan_mobil"
                                                        name="status_penggunaan_mobil" disabled>
                                                        <option value="">-- Pilih Status Penggunaan Mobil --</option>
                                                        <option
                                                            value="{{ old('status_penggunaan_mobil') ? old('status_penggunaan_mobil') : 'Aktif' }}"
                                                            {{ $mobil->status_penggunaan_mobil == 'Aktif' ? 'selected' : '' }}>
                                                            Aktif</option>
                                                        <option
                                                            value="{{ old('status_penggunaan_mobil') ? old('status_penggunaan_mobil') : 'Non-Aktif' }}"
                                                            {{ $mobil->status_penggunaan_mobil == 'Non-Aktif' ? 'selected' : '' }}>
                                                            Non Aktif</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <div class="form-group">
                                                    <div class="card">
                                                        <label for="foto_mobil">Foto Mobil</label>
                                                        <div class="card-body mx-auto">
                                                            <img src="{{ asset('/storage/' . $mobil->foto_mobil) }}"
                                                                alt="*Gambar Mobil {{ $mobil->jenis_mobil }}"
                                                                width="400">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('mobil') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                                {{-- <button type="submit" class="btn btn-primary me-1 mb-1">
                                                    Simpan
                                                </button> --}}
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
