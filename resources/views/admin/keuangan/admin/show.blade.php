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
                                <a href="{{ route('perental') }}">Halaman Utama {{ $judul }}</a>
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
                                <form class="form form-vertical" action="" method="">

                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="users_id" class="mb-2">Nama User </label>
                                                    <select class="choices form-select" id="users_id" name="users_id"
                                                        disabled>
                                                        <option value="">-- Pilih Nama User -- </option>

                                                        @foreach ($users as $key => $us)
                                                            <option
                                                                value="{{ old('users_id') ? old('users_id') : $us->id }}"
                                                                {{ $us->id == $kas_admin->penyewa->users_id ? 'selected' : '' }}>
                                                                {{ $us->id }} -
                                                                {{ $us->nama_lengkap }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="jenis" class="mb-2">Jenis</label>
                                                    <select class="choices form-select" id="jenis" name="jenis"
                                                        disabled>
                                                        <option value="">-- Pilih Jenis --</option>
                                                        <option value="{{ old('jenis') ? old('jenis') : 'Pemasukan' }}"
                                                            {{ $kas_admin->jenis == 'Pemasukan' ? 'selected' : '' }}>
                                                            Pemasukan</option>
                                                        <option value="{{ old('jenis') ? old('jenis') : 'Pengeluaran' }}"
                                                            {{ $kas_admin->jenis == 'Pengeluaran' ? 'selected' : '' }}>
                                                            Pengeluaran</option>
                                                    </select>
                                                </div>
                                            </div>
                                            @if ($kas_admin->jenis == 'Pemasukan')
                                                <div class="col-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="kas_admin_masuk" class="mb-2">Nominal Keuangan
                                                            Admin
                                                            Masuk </label>
                                                        <input type="number" id="kas_admin_masuk" class="form-control mt-2"
                                                            name="kas_admin_masuk" min="100"
                                                            placeholder="Masukkan Nominal Keuangan Asuransi Masuk" required
                                                            inputmode="numeric" autocomplete="transaction-currency"
                                                            value="{{ old('kas_admin_masuk') ? old('kas_admin_masuk') : $kas_admin->kas_admin_masuk }}"
                                                            readonly="readonly" />
                                                    </div>
                                                </div>
                                            @elseif($kas_admin->jenis == 'Pengeluaran')
                                                <div class="col-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="kas_admin_keluar" class="mb-2">Nominal Keuangan
                                                            Admin
                                                            Keluar </label>
                                                        <input type="number" id="kas_admin_keluar"
                                                            class="form-control mt-2" name="kas_admin_keluar" min="100"
                                                            placeholder="Masukkan Nominal Keuangan Admin Keluar" required
                                                            inputmode="numeric" autocomplete="transaction-currency"
                                                            value="{{ old('kas_admin_keluar') ? old('kas_admin_keluar') : $kas_admin->kas_admin_keluar }}"
                                                            readonly="readonly" />
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($kas_admin->jenis == 'Pemasukan')
                                                <div class="col-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="total_kas_admin" class="mb-2">Nominal Total
                                                            Keuangan
                                                            Asuransi Pada Pemasukan Ini</label>
                                                        <input type="number" id="total_kas_admin" class="form-control mt-2"
                                                            name="total_kas_admin"
                                                            placeholder="Masukkan Nominal Total Keuangan Asuransi" required
                                                            inputmode="numeric" autocomplete="transaction-currency"
                                                            value="{{ old('total_kas_admin') ? old('total_kas_admin') : $kas_admin->total_kas_admin_satu }}"
                                                            readonly="readonly" />
                                                    </div>
                                                </div>
                                            @elseif($kas_admin->jenis == 'Pengeluaran')
                                                <div class="col-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="total_kas_admin" class="mb-2">Nominal Total
                                                            Keuangan
                                                            Asuransi Pada Pengeluaran Ini</label>
                                                        <input type="number" id="total_kas_admin" class="form-control mt-2"
                                                            name="total_kas_admin"
                                                            placeholder="Masukkan Nominal Total Keuangan Asuransi" required
                                                            inputmode="numeric" autocomplete="transaction-currency"
                                                            value="{{ old('total_kas_admin') ? old('total_kas_admin') : $kas_admin->total_kas_admin_satu }}"
                                                            readonly="readonly" />
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="total_kas_admin" class="mb-2">Nominal Total
                                                        Keuangan
                                                        Admin</label>
                                                    <input type="number" id="total_kas_admin" class="form-control mt-2"
                                                        name="total_kas_admin"
                                                        placeholder="Masukkan Nominal Total Keuangan Admin" required
                                                        inputmode="numeric" autocomplete="transaction-currency"
                                                        value="{{ old('total_kas_admin') ? old('total_kas_admin') : $kas_admin->total_kas_admin_semua }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="tanggal">
                                                        Tanggal Pemasukan
                                                    </label>
                                                    <input type="date" id="tanggal" class="form-control mt-2"
                                                        name="tanggal" required max="2300-01-01"
                                                        value="{{ old('tanggal') ? old('tanggal') : $kas_admin->tanggal }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label for="keterangan" class="mb-2">
                                                    <span>Keterangan</span>
                                                </label>
                                                <div class="form-floating">
                                                    <textarea class="form-control mt-2" placeholder="Masukkan Keterangan Disini" id="keterangan" name="keterangan"
                                                        readonly="readonly">{{ old('keterangan') ? old('keterangan') : $kas_admin->keterangan }}</textarea>
                                                    <label for="keterangan">Masukkan Keterangan Disini</label>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('keuanganAdmin') }}"
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
