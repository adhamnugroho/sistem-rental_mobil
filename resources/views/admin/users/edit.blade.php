@extends('admin.layout.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data {{ $judul }}</h3>
                    <p class="text-subtitle text-muted">
                        Harap memasukkan data user dengan benar.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('users') }}">Halaman Utama User</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Data User
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
                                <form class="form form-vertical" action="{{ route('usersUpdate', $users->id) }}"
                                    method="POST">

                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="nama_lengkap">Nama Lengkap <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="text" id="nama_lengkap" class="form-control mt-2"
                                                        name="nama_lengkap" placeholder="Masukkan Nama Lengkap" required
                                                        value="{{ old('nama_lengkap') ? old('nama_lengkap') : $users->nama_lengkap }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="username">Username <sup class="text-danger">*</sup></label>
                                                    <input type="text" id="username" class="form-control mt-2"
                                                        name="username" placeholder="Masukkan Username" maxlength="50"
                                                        required data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Harap untuk memasukkan username tidak lebih dari 50 karakter"
                                                        autocomplete="username"
                                                        value="{{ old('username') ? old('username') : $users->username }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="email">Email <sup class="text-danger">*</sup></label>
                                                    <input type="email" id="email" class="form-control mt-2"
                                                        name="email" placeholder="Masukkan Email" required
                                                        autocomplete="email" inputmode="email"
                                                        value="{{ old('email') ? old('email') : $users->email }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="password">
                                                        <span>Password</span> <span class="text-info">(Opsional)</span>
                                                    </label>
                                                    <input type="password" id="password" class="form-control mt-2"
                                                        name="password" placeholder="Masukkan Password"
                                                        autocomplete="current-password" minlength="8"
                                                        data-bs-toggle="tooltip" data-bs-placement="right"
                                                        title="Harap memasukkan password minimal 8 karakter"
                                                        value="{{ old('password') }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="no_telp">Nomor Telepon <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="tel" id="no_telp" class="form-control mt-2"
                                                        name="no_telp" placeholder="Masukkan Nomor Telepon" required
                                                        inputmode="tel" data-bs-toggle="tooltip" data-bs-placement="right"
                                                        title="Harap memasukkan nomor telepon tidak lebih dari 15 digit"
                                                        autocomplete="tel"
                                                        value="{{ old('no_telp') ? old('no_telp') : $users->no_telp }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="tempat_lahir" class="mb-2">Tempat Lahir <sup
                                                            class="text-danger">*</sup></label>
                                                    <select class="choices form-select" id="tempat_lahir"
                                                        name="tempat_lahir" required>
                                                        <option value="">-- Pilih Tempat Lahir --</option>

                                                        @foreach ($kabupaten as $key => $tl)
                                                            <option
                                                                value="{{ old('tempat_lahir') ? old('tempat_lahir') : $tl->id_kabupaten }}"
                                                                {{ $users->tempat_lahir == $tl->id_kabupaten ? 'selected' : '' }}>
                                                                {{ $tl->id_kabupaten }} -
                                                                {{ $tl->nama_kabupaten }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="tanggal_lahir">Tanggal Lahir <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="date" id="tanggal_lahir" class="form-control mt-2"
                                                        name="tanggal_lahir" required min="1800-01-01" max="2300-01-01"
                                                        value="{{ old('tanggal_lahir') ? old('tanggal_lahir') : $users->tanggal_lahir }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="umur">Umur <sup class="text-danger">*</sup></label>
                                                    <input type="number" id="umur" class="form-control mt-2"
                                                        name="umur" placeholder="Masukkan Umur Saat Ini" required
                                                        min="5" max="200" inputmode="numeric"
                                                        value="{{ old('umur') ? old('umur') : $users->umur }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="domisili_sekarang" class="mb-2">Domisili Sekarang <sup
                                                            class="text-danger">*</sup></label>
                                                    <select class="choices form-select" id="domisili_sekarang"
                                                        name="domisili_sekarang" required>
                                                        <option value="">-- Pilih Domisili -- </option>

                                                        @foreach ($kabupaten as $key => $ds)
                                                            <option
                                                                value="{{ old('domisili_sekarang') ? old('domisili_sekarang') : $ds->id_kabupaten }}"
                                                                {{ $users->domisili_sekarang == $ds->id_kabupaten ? 'selected' : '' }}>
                                                                {{ $ds->id_kabupaten }} -
                                                                {{ $ds->nama_kabupaten }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label for="alamat_lengkap" class="mb-2">Alamat Lengkap <sup
                                                        class="text-danger">*</sup></label>
                                                <div class="form-floating">
                                                    <textarea class="form-control mt-2" placeholder="Masukkan Alamat Lengkap Anda Disini" id="alamat_lengkap"
                                                        name="alamat_lengkap" required autocomplete="address-level1">{{ old('alamat_lengkap') ? old('nama_lengkap') : $users->alamat_lengkap }}</textarea>
                                                    <label for="alamat_lengkap">Masukkan Alamat Lengkap Anda Disini</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="status_akun" class="mb-2">Status Akun <sup
                                                            class="text-danger">*</sup></label>
                                                    <select class="choices form-select" id="status_akun"
                                                        name="status_akun" required>
                                                        <option value="">-- Pilih Status Akun --</option>
                                                        <option
                                                            value="{{ old('status_akun') ? old('status_akun') : 'Penyewa' }}"
                                                            {{ $users->status_akun == 'Penyewa' ? 'selected' : '' }}>
                                                            Penyewa</option>
                                                        <option
                                                            value="{{ old('status_akun') ? old('status_akun') : 'Perental' }}"
                                                            {{ $users->status_akun == 'Perental' ? 'selected' : '' }}>
                                                            Perental</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="status_pengguna" class="mb-2">Status Pengguna <sup
                                                            class="text-danger">*</sup></label>
                                                    <select class="choices form-select" id="status_pengguna"
                                                        name="status_pengguna" required>
                                                        <option value="">-- Pilih Status Pengguna --</option>
                                                        <option
                                                            value="{{ old('status_pengguna') ? old('status_pengguna') : 'Aktif' }}"
                                                            {{ $users->status_pengguna == 'Aktif' ? 'selected' : '' }}>
                                                            Aktif</option>
                                                        <option
                                                            value="{{ old('status_pengguna') ? old('status_pengguna') : 'Non-Aktif' }}"
                                                            {{ $users->status_pengguna == 'Non-Aktif' ? 'selected' : '' }}>
                                                            Non-Aktif</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('users') }}"
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
