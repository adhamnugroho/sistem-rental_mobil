@extends('admin.layout.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data {{ $judul }}</h3>
                    <p class="text-subtitle text-muted">
                        Harap memasukkan data {{ $judul }} dengan benar.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('perental') }}">Halaman Utama {{ $judul }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Data {{ $judul }}
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
                            <h4 class="card-title">Form Edit Data {{ $judul }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">



                                <form class="form form-vertical" action="{{ route('mobilUpdate', $mobil->id_mobil) }}"
                                    method="POST" enctype="multipart/form-data">

                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="perental_id" class="mb-2">Nama Perental <sup
                                                            class="text-danger">*</sup></label>
                                                    <select class="choices form-select" id="perental_id" name="perental_id"
                                                        required>
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
                                                    <label for="jenis_mobil">Jenis Mobil <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="text" id="jenis_mobil" class="form-control mt-2"
                                                        name="jenis_mobil" placeholder="Masukkan Jenis Mobil" required
                                                        value="{{ old('jenis_mobil') ? old('jenis_mobil') : $mobil->jenis_mobil }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Pengisian maksimal hanya 25 karakter" maxlength="25"/>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="plat_nomor">Plat Nomor <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="text" id="plat_nomor"
                                                        class="form-control mt-2 text-uppercase" name="plat_nomor"
                                                        placeholder="Masukkan Plat Nomor" required data-bs-toggle="tooltip"
                                                        data-bs-placement="top"
                                                        title="Harap menggunakan format pengisian UpperCase"
                                                        value="{{ old('plat_nomor') ? old('plat_nomor') : $mobil->plat_nomor }}" />
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="warna">Warna <sup class="text-danger">*</sup></label>
                                                    <input type="text" id="warna" class="form-control mt-2"
                                                        name="warna" placeholder="Masukkan Warna" required
                                                        value="{{ old('warna') ? old('warna') : $mobil->warna }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="tanggal_didaftarkan">Tanggal Pendaftaran <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="date" id="tanggal_didaftarkan" class="form-control mt-2"
                                                        name="tanggal_didaftarkan" required min="2019-01-01"
                                                        max="2300-01-01"
                                                        value="{{ old('tanggal_didaftarkan') ? old('tanggal_didaftarkan') : $mobil->tanggal_didaftarkan }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="harga">Harga Penyewaan Mobil <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="number" id="harga" class="form-control mt-2"
                                                        name="harga" placeholder="Masukkan Harga Penyewaan Mobil" required
                                                        min="100000" max="" inputmode="numeric"
                                                        autocomplete="transaction-currency"
                                                        value="{{ old('harga') ? old('harga') : $mobil->harga }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label for="deskripsi_mobil" class="mb-2">
                                                    <span>Deskripsi Mobil</span> <span class="text-info">(Opsional)</span>
                                                </label>
                                                <div class="form-floating">
                                                    <textarea class="form-control mt-2" placeholder="Masukkan Deskripsi Mobil Disini" id="deskripsi_mobil"
                                                        name="deskripsi_mobil">{{ old('deskripsi_mobil') ? old('deskripsi_mobil') : $mobil->deskripsi_mobil }}</textarea>
                                                    <label for="deskripsi_mobil">Masukkan Deskripsi Mobil Disini</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="status_penggunaan_mobil" class="mb-2">Status Penggunaan
                                                        Mobil <sup class="text-danger">*</sup></label>
                                                    <select class="choices form-select" id="status_penggunaan_mobil"
                                                        name="status_penggunaan_mobil" required>
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
                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="foto_mobil">
                                                        <span>Foto Mobil</span> <span class="text-info">(Opsional)</span>
                                                    </label>
                                                    <input type="file" id="foto_mobil"
                                                        class="form-control mt-2 image-preview-filepond" name="foto_mobil"
                                                        value="{{ old('foto_mobil') }}" accept="image/*" />
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('mobil') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
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
