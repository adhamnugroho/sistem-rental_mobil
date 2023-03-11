@extends('admin.layout.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data {{ $judul }}</h3>
                    <p class="text-subtitle text-muted">
                        List Detail Data {{ $judul }}.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('transaksiPenyewa') }}">Halaman Utama {{ $judul }}</a>
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
                            <h4 class="card-title">List Detail Data {{ $judul }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form class="form form-vertical">

                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <input type="hidden" id="id_penyewa" value="{{ $penyewa->id_penyewa }}">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="kode_invoice">Kode Invoice</label>
                                                    <input type="text" id="kode_invoice" class="form-control mt-2"
                                                        name="kode_invoice" placeholder="Masukkan Kode Invoice" required
                                                        value="{{ old('kode_invoice') ? old('kode_invoice') : $penyewa->kode_invoice }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="users_id" class="mb-2">Nama Penyewa </label>
                                                    <select class="choices form-select" id="users_id" name="users_id"
                                                        disabled>
                                                        <option value="">-- Pilih Nama Penyewa -- </option>

                                                        @foreach ($users as $key => $us)
                                                            <option
                                                                value="{{ old('users_id') ? old('users_id') : $us->id }}"
                                                                {{ $us->id == $penyewa->users_id ? 'selected' : '' }}>
                                                                {{ $us->id }} -
                                                                {{ $us->nama_lengkap }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="jenis_mobil">Jenis Mobil </label>
                                                    <select class="choices form-select" id="mobil_id" name="mobil_id"
                                                        disabled>
                                                        <option value="">-- Pilih Jenis Mobil -- </option>

                                                        @foreach ($mobil as $key => $mb)
                                                            <option
                                                                value="{{ old('mobil_id') ? old('mobil_id') : $mb->id_mobil }}"
                                                                {{ $mb->id_mobil == $penyewa->penyewa_detail[0]->mobil_id ? 'selected' : '' }}>
                                                                {{ $mb->id_mobil }} -
                                                                {{ $mb->jenis_mobil }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="kabupaten_id" class="mb-2">Kota / Kabupaten
                                                        Perentalan</label>
                                                    <select class="choices form-select" id="kabupaten_id"
                                                        name="kabupaten_id" required disabled>
                                                        <option value="">-- Pilih Kota /Kabupaten
                                                            Perentalan --</option>

                                                        @foreach ($kabupaten as $key => $kb)
                                                            <option
                                                                value="{{ old('kabupaten_id') ? old('kabupaten_id') : $kb->id_kabupaten }}"
                                                                {{ $penyewa->penyewa_detail[0]->kabupaten_id == $kb->id_kabupaten ? 'selected' : '' }}>
                                                                {{ $kb->id_kabupaten }} -
                                                                {{ $kb->nama_kabupaten }}</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="tanggal_penyewaan">Tanggal Penyewaan </label>
                                                    <input type="date" id="tanggal_penyewaan" class="form-control mt-2"
                                                        name="tanggal_penyewaan" min="2019-01-01" max="2300-01-01"
                                                        value="{{ old('tanggal_penyewaan') ? old('tanggal_penyewaan') : $penyewa->penyewa_detail[0]->tanggal_penyewaan }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="tanggal_pengembalian">Tanggal Pengembalian </label>
                                                    <input type="date" id="tanggal_pengembalian"
                                                        class="form-control mt-2" name="tanggal_pengembalian"
                                                        min="2019-01-01" max="2300-01-01"
                                                        value="{{ old('tanggal_pengembalian') ? old('tanggal_pengembalian') : $penyewa->penyewa_detail[0]->tanggal_pengembalian }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="total_harga">Total Harga Penyewaan </label>
                                                    <input type="number" id="total_harga" class="form-control mt-2"
                                                        name="total_harga" placeholder="Masukkan Harga Penyewaan Mobil"
                                                        required min="100000" max="" inputmode="numeric"
                                                        autocomplete="transaction-currency"
                                                        value="{{ old('total_harga') ? old('total_harga') : $penyewa->penyewa_detail[0]->total_harga }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>

                                            @if (
                                                $penyewa->status_penyewaan != 'Mobil_Belum_Datang' &&
                                                    $penyewa->status_penyewaan != 'Mobil_Sudah_Datang' &&
                                                    $penyewa->status_penyewaan != 'Berjalan' &&
                                                    $penyewa->status_penyewaan != 'Dibatalkan')
                                                <div class="col-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="nominal_pembayaran">Nominal Pembayaran Penyewaan
                                                        </label>
                                                        <input type="number" id="nominal_pembayaran"
                                                            class="form-control mt-2" name="nominal_pembayaran"
                                                            placeholder="Masukkan Nominal Pembayaran Penyewaan" required
                                                            min="100000" max="" inputmode="numeric"
                                                            autocomplete="transaction-currency"
                                                            value="{{ old('nominal_pembayaran') ? old('nominal_pembayaran') : $penyewa->penyewa_detail[0]->nominal_pembayaran }}"
                                                            readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <div class="form-group">
                                                        <label for="kembalian">Kembalian Pembayaran Penyewa
                                                        </label>
                                                        <input type="number" id="kembalian" class="form-control mt-2"
                                                            name="kembalian"
                                                            placeholder="Masukkan Total Uang Bersih Perental" required
                                                            min="100000" max="" inputmode="numeric"
                                                            autocomplete="transaction-currency"
                                                            value="{{ old('kembalian') ? old('kembalian') : $penyewa->penyewa_detail[0]->kembalian }}"
                                                            readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <label for="keterangan" class="mb-2">
                                                        <span>Review</span>
                                                    </label>
                                                    <div class="form-floating">
                                                        <textarea class="form-control mt-2" placeholder="Masukkan Keterangan Disini" id="keterangan" name="keterangan"
                                                            readonly="readonly" data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Kolom Keterangan ini bisa dipanjangkan ukuran wadahnya, apabila dirasa tampilan default kurang memadai untuk membaca isinya">{{ old('keterangan') ? old('keterangan') : $penyewa->penyewa_detail[0]->keterangan }}</textarea>
                                                        <label for="keterangan">Masukkan Keterangan Disini</label>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="status_penyewaan" class="mb-2">Status Penyewaan </label>
                                                    <select class="choices form-select" id="status_penyewaan"
                                                        name="status_penyewaan" disabled>
                                                        <option value="">-- Pilih Penyewaan --</option>
                                                        <option
                                                            value="{{ old('status_penyewaan') ? old('status_penyewaan') : 'Berjalan' }}"
                                                            {{ $penyewa->status_penyewaan == 'Berjalan' ? 'selected' : '' }}>
                                                            Berjalan</option>
                                                        <option
                                                            value="{{ old('status_penyewaan') ? old('status_penyewaan') : 'Selesai' }}"
                                                            {{ $penyewa->status_penyewaan == 'Selesai' ? 'selected' : '' }}>
                                                            Selesai</option>
                                                        <option
                                                            value="{{ old('status_penyewaan') ? old('status_penyewaan') : 'Dibatalkan' }}"
                                                            {{ $penyewa->status_penyewaan == 'Dibatalkan' ? 'selected' : '' }}>
                                                            Dibatalkan</option>
                                                        <option
                                                            value="{{ old('status_penyewaan') ? old('status_penyewaan') : 'Mobil_Sudah_Datang' }}"
                                                            {{ $penyewa->status_penyewaan == 'Mobil_Sudah_Datang' ? 'selected' : '' }}>
                                                            Mobil Sudah Datang</option>
                                                        <option
                                                            value="{{ old('status_penyewaan') ? old('status_penyewaan') : 'Mobil_Sudah_Dikembalikan_Ke_Admin' }}"
                                                            {{ $penyewa->status_penyewaan == 'Mobil_Sudah_Dikembalikan_Ke_Admin' ? 'selected' : '' }}>
                                                            Mobil Sudah Dikembalikan Ke Admin</option>
                                                        <option
                                                            value="{{ old('status_penyewaan') ? old('status_penyewaan') : 'Mobil_Belum_Datang' }}"
                                                            {{ $penyewa->status_penyewaan == 'Mobil_Belum_Datang' ? 'selected' : '' }}>
                                                            Mobil Belum Datang</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-3">
                                                <div class="form-group">
                                                    <label for="status_penggunaan_mobil" class="mb-2">Status
                                                        Pembayaran Penyewa</label>
                                                    <select class="choices form-select" id="status_penggunaan_mobil"
                                                        name="status_pembayaran_penyewa" disabled>
                                                        <option value="">-- Pilih Status Pembayaran Penyewa --
                                                        </option>
                                                        <option
                                                            value="{{ old('status_pembayaran_penyewa') ? old('status_pembayaran_penyewa') : 'Selesai' }}"
                                                            {{ $penyewa->status_pembayaran_penyewa == 'Selesai' ? 'selected' : '' }}>
                                                            Selesai</option>
                                                        <option
                                                            value="{{ old('status_pembayaran_penyewa') ? old('status_pembayaran_penyewa') : 'Belum-Selesai' }}"
                                                            {{ $penyewa->status_pembayaran_penyewa == 'Belum-Selesai' ? 'selected' : '' }}>
                                                            Belum Selesai</option>

                                                    </select>
                                                </div>
                                            </div>

                                            @if (
                                                $penyewa->status_penyewaan != 'Mobil_Belum_Datang' &&
                                                    $penyewa->status_penyewaan != 'Mobil_Sudah_Datang' &&
                                                    $penyewa->status_penyewaan != 'Berjalan' &&
                                                    $penyewa->status_penyewaan != 'Dibatalkan')
                                                <div class="col-12 mt-4">
                                                    <div class="form-group">
                                                        <div class="card">
                                                            <label for="rating">Rating</label>
                                                            <div class="card-body ">

                                                                <div id="rater"></div>
                                                            </div>
                                                            <input type="hidden" id="rating_database"
                                                                value="{{ $penyewa->penyewa_detail[0]->rating }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </form>
                                <div class="form-body">
                                    <div class="row">
                                        @if ($penyewa->status_penyewaan == 'Mobil_Sudah_Datang' && $penyewa->status_pembayaran_penyewa == 'Belum-Selesai')
                                            <div class="col-6 d-flex justify-content-start mt-5">
                                                <button class="btn btn-danger mb-1" onclick="batal()">Batalkan
                                                    Penyewaan!</button>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end mt-5">
                                                <button class="btn btn-success me-4 mb-1"
                                                    onclick="penyewaanBerjalan()">Jalankan Penyewaan</button>
                                                <a href="{{ route('transaksiPenyewa') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                            </div>
                                        @elseif($penyewa->status_penyewaan == 'Berjalan' && $penyewa->status_pembayaran_penyewa == 'Belum-Selesai')
                                            <div class="col-6 d-flex justify-content-start mt-5">
                                                <button class="btn btn-danger mb-1" onclick="batal()">Batalkan
                                                    Penyewaan!</button>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end mt-5">
                                                <button class="btn btn-success me-4 mb-1" onclick="bayar()">Bayar</button>
                                                <a href="{{ route('transaksiPenyewa') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                            </div>
                                        @elseif(
                                            $penyewa->status_penyewaan == 'Mobil_Sudah_Dikembalikan_Ke_Admin' &&
                                                $penyewa->status_pembayaran_penyewa == 'Belum-Selesai')
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <button class="btn btn-success me-4 mb-1" onclick="bayar()">Bayar</button>
                                                <a href="{{ route('transaksiPenyewa') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                            </div>
                                        @elseif($penyewa->status_pembayaran_penyewa == 'Selesai')
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('transaksiPenyewaPrint', $penyewa->id_penyewa) }}"
                                                    class="btn btn-success me-4 mb-1" target="_blank">
                                                    Print Invoice
                                                </a>
                                                <a href="{{ route('transaksiPenyewa') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                            </div>
                                        @elseif($penyewa->status_penyewaan == 'Dibatalkan')
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('transaksiPenyewa') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                            </div>
                                        @else
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('transaksiPenyewa') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
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
        $(document).ready(function() {

            settingRating()
        })

        function settingRating() {

            let ratingPadaDatabase = document.getElementById("rating_database").value;
            let ratingPadaDatabaseNumber = Number(ratingPadaDatabase);

            const options = {

                element: document.getElementById("rater"),
                starSize: 32,
                step: 0.5,
                readOnly: true,
                rating: ratingPadaDatabaseNumber,
                showToolTip: true,
                ratingText: "Rating saat ini:  {rating} / {maxRating}",
                disableText: "Rating saat ini:  {rating} / {maxRating}",
                rateCallback: function rateCallback(rating, done) {
                    this.setRating(rating)
                    // console.log('jalan');
                    done()
                },

            };

            const rating = raterJs(options);

            // console.log(rating)
        }

        function bayar() {

            id_penyewa = document.getElementById("id_penyewa").value;

            swal.fire({

                icon: 'question',
                title: 'Apakah Anda Ingin Membayar Penyewaan Ini?',
                text: '',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Iya!',
            }).then((result) => {

                // alert(result);

                if (result.isConfirmed) {

                    // console.log('berhasil lagi')

                    const hasil_route = route('transaksiPenyewaPreBayar', id_penyewa);

                    // console.log(hasil_route);

                    window.open(hasil_route, '_self');

                }
            });

            // console.log(id_penyewa);
        }

        function batal() {

            id_penyewa = document.getElementById("id_penyewa").value;

            swal.fire({

                icon: 'warning',
                title: 'Apakah Anda Yakin Membatalkan Penyewaan Ini?',
                text: 'Penyewaan yang sudah dibatalkan, tidak dapat dirubah lagi!',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Iya, Yakin!',
            }).then((result) => {

                // alert(result);

                if (result.isConfirmed) {

                    // console.log('berhasil lagi')

                    const hasil_route = route('transaksiPenyewaBatal', id_penyewa);

                    // console.log(hasil_route);

                    window.open(hasil_route, '_self');

                }
            });

            // console.log(id_penyewa);
        }

        function penyewaanBerjalan() {

            id_penyewa = document.getElementById("id_penyewa").value;

            swal.fire({

                icon: 'warning',
                title: 'Apakah Penyewaan Ini Akan Berjalan?',
                text: 'Penyewaan yang sudah berjalan, tidak dapat dirubah lagi!',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Iya, Benar!',
            }).then((result) => {

                // alert(result);

                if (result.isConfirmed) {

                    // console.log('berhasil lagi')

                    const hasil_route = route('transaksiPenyewaBerjalan', id_penyewa);

                    // console.log(hasil_route);

                    window.open(hasil_route, '_self');

                }
            });

            // console.log(id_penyewa);
        }
    </script>
@endsection
