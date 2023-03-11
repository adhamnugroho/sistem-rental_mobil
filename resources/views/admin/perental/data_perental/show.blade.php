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



                                <form class="form form-vertical" action="">

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
                                                                {{ $us->id == $perental->users_id ? 'selected' : '' }}>
                                                                {{ $us->id }} -
                                                                {{ $us->nama_lengkap }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label for="keterangan" class="mb-2">
                                                    <span>Keterangan</span>
                                                </label>
                                                <div class="form-floating">
                                                    <textarea class="form-control mt-2" placeholder="Masukkan Keterangan Disini" id="keterangan" name="keterangan"
                                                        readonly="readonly">{{ $perental->keterangan }}</textarea>
                                                    <label for="keterangan">Masukkan Keterangan Disini</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="status_perental" class="mb-2">Status Perental</label>
                                                    <select class="choices form-select" id="status_perental"
                                                        name="status_perental" required disabled>
                                                        <option value="">-- Pilih Status Perental --</option>
                                                        <option
                                                            value="{{ old('status_perental') ? old('status_perental') : 'Aktif' }}"
                                                            {{ $perental->status_perental == 'Aktif' ? 'selected' : '' }}>
                                                            Aktif</option>
                                                        <option
                                                            value="{{ old('status_perental') ? old('status_perental') : 'Non-Aktif' }}"
                                                            {{ $perental->status_perental == 'Non-Aktif' ? 'selected' : '' }}>
                                                            Non-Aktif</option>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('perental') }}"
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
