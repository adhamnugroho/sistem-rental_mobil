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
                                <form class="form form-vertical"
                                    action="{{ route('keuanganAsuransiTambahUpdate', $kas_asuransi->id_kas_asuransi) }}"
                                    method="POST">

                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="kas_asuransi_masuk" class="mb-2">Nominal Keuangan
                                                        Asuransi
                                                        Masuk <sup class="text-danger">*</sup></label>
                                                    <input type="number" id="kas_asuransi_masuk" class="form-control mt-2"
                                                        name="kas_asuransi_masuk" min="100"
                                                        placeholder="Masukkan Nominal Keuangan Asuransi Masuk" required
                                                        inputmode="numeric" autocomplete="transaction-currency"
                                                        value="{{ old('kas_asuransi_masuk') ? old('kas_asuransi_masuk') : $kas_asuransi->kas_asuransi_masuk }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="tanggal">
                                                        Tanggal Pemasukan <sup class="text-danger">*</sup>
                                                    </label>
                                                    <input type="date" id="tanggal" class="form-control mt-2"
                                                        name="tanggal" required max="2300-01-01"
                                                        value="{{ old('tanggal') ? old('tanggal') : $kas_asuransi->tanggal }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label for="keterangan" class="mb-2">
                                                    <span>Keterangan</span> <span class="text-info">(Opsional)</span>
                                                </label>
                                                <div class="form-floating">
                                                    <textarea class="form-control mt-2" placeholder="Masukkan Keterangan Disini" id="keterangan" name="keterangan">{{ old('keterangan') ? old('keterangan') : $kas_asuransi->keterangan }}</textarea>
                                                    <label for="keterangan">Masukkan Keterangan Disini</label>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('keuanganAsuransi') }}"
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
