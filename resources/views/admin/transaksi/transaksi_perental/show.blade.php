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
                                <a href="{{ route('transaksiPerental') }}">Halaman Utama {{ $judul }}</a>
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
                                            <input type="hidden" id="id_perental" value="{{ $perental->id_perental }}">
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
                                                    <label for="users_id" class="mb-2">Nama Perental </label>
                                                    <select class="choices form-select" id="users_id" name="users_id"
                                                        disabled>
                                                        <option value="">-- Pilih Nama Perental -- </option>

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
                                                        <label for="total_uang_bersih_perental">Total Uang Bersih Perental
                                                        </label>
                                                        <input type="number" id="total_uang_bersih_perental"
                                                            class="form-control mt-2" name="total_uang_bersih_perental"
                                                            placeholder="Masukkan Total Uang Bersih Perental" required
                                                            min="100000" max="" inputmode="numeric"
                                                            autocomplete="transaction-currency"
                                                            value="{{ old('total_uang_bersih_perental') ? old('total_uang_bersih_perental') : $penyewa->penyewa_detail[0]->total_uang_bersih_perental }}"
                                                            readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-2">
                                                    <label for="keterangan" class="mb-2">
                                                        <span>Keterangan</span>
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
                                                    <label for="status_pembayaran_perental" class="mb-2">Status
                                                        Pembayaran Perental</label>
                                                    <select class="choices form-select" id="status_pembayaran_perental"
                                                        name="status_pembayaran_perental" disabled>
                                                        <option value="">-- Pilih Status Pembayaran Perental --
                                                        </option>
                                                        <option
                                                            value="{{ old('status_pembayaran_perental') ? old('status_pembayaran_perental') : 'Selesai' }}"
                                                            {{ $penyewa->status_pembayaran_perental == 'Selesai' ? 'selected' : '' }}>
                                                            Selesai</option>
                                                        <option
                                                            value="{{ old('status_pembayaran_perental') ? old('status_pembayaran_perental') : 'Belum-Selesai' }}"
                                                            {{ $penyewa->status_pembayaran_perental == 'Belum-Selesai' ? 'selected' : '' }}>
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
                                        @if ($penyewa->status_penyewaan == 'Mobil_Belum_Datang')
                                            <div class="col-6 d-flex justify-content-start mt-5">
                                                <button class="btn btn-danger mb-1" onclick="batal()">Batalkan
                                                    Penyewaan!</button>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end mt-5">
                                                <button class="btn btn-success me-4 mb-1"
                                                    onclick="mobilSudahDatang()">Mobil Sudah Datang</button>
                                                <a href="{{ route('transaksiPerental') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                            </div>
                                        @elseif(
                                            $penyewa->status_penyewaan == 'Mobil_Sudah_Dikembalikan_Ke_Admin' &&
                                                $penyewa->status_pembayaran_perental == 'Belum-Selesai' &&
                                                $penyewa->status_pembayaran_penyewa == 'Selesai')
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <button class="btn btn-success me-4 mb-1" onclick="selesai()">Penyewaan
                                                    Selesai</button>

                                                <input type="hidden" name="" id="jumlah_penyewaan_belum_selesai"
                                                    value="{{ $jumlah_penyewaan_belum_selesai }}">

                                                <a href="{{ route('transaksiPerental') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                            </div>
                                        @elseif($penyewa->status_pembayaran_perental == 'Selesai')
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <button class="btn btn-success me-4 mb-1" onclick="print()">
                                                    Print Invoice
                                                </button>

                                                <input type="hidden" name=""
                                                    id="jumlah_penyewaan_yang_waktunya_sama"
                                                    value="{{ $jumlah_penyewaan_yang_waktunya_sama }}">

                                                <a href="{{ route('transaksiPerental') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                            </div>
                                        @elseif($penyewa->status_penyewaan == 'Dibatalkan')
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('transaksiPerental') }}"
                                                    class="btn btn-light-secondary me-1 mb-1">Kembali</a>
                                            </div>
                                        @else
                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                <a href="{{ route('transaksiPerental') }}"
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

                    const hasil_route = route('transaksiPerentalBatal', id_penyewa);

                    // console.log(hasil_route);

                    window.open(hasil_route, '_self');

                }
            });

            // console.log(id_penyewa);
        }

        function mobilSudahDatang() {

            id_penyewa = document.getElementById("id_penyewa").value;

            swal.fire({

                icon: 'warning',
                title: 'Apakah Benar Mobil Perental Sudah Datang?',
                text: 'Dimohon untuk mengecek lagi data perental pada penyewaan!',
                showCancelButton: true,
                cancelButtonText: 'Batal',
                confirmButtonText: 'Iya, Benar!',
            }).then((result) => {

                // alert(result);

                if (result.isConfirmed) {

                    // console.log('berhasil lagi')

                    const hasil_route = route('transaksiPerentalMobilSudahDatang', id_penyewa);

                    // console.log(hasil_route);

                    window.open(hasil_route, '_self');

                }
            });

            // console.log(id_penyewa);
        }

        function selesai() {

            let id_penyewa = document.getElementById("id_penyewa").value;
            let id_perental = document.getElementById("id_perental").value;
            let jumlah_penyewaan_belum_selesai = document.getElementById("jumlah_penyewaan_belum_selesai").value;

            // console.log(jumlah_penyewaan_belum_selesai);

            if (jumlah_penyewaan_belum_selesai == "Lebih dari 1") {

                swal.fire({

                    icon: 'warning',
                    title: 'Apakah Anda Yakin Ingin Menyelesaikan Semua Penyewaan?',
                    text: 'Jika tidak, maka anda akan menyelesaikan penyewaan ini saja.',
                    showCancelButton: true,
                    showDenyButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Iya, Semua!',
                    denyButtonText: 'Tidak, Penyewaan Ini saja',
                    returnInputValueOnDeny: true,
                }).then((result) => {

                    // alert(result);

                    if (result.isConfirmed) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('transaksiPerentalSelesaiSemua', id_perental);

                        // console.log(hasil_route);

                        window.open(hasil_route, '_self');

                    } else if (result.isDenied) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('transaksiPerentalSelesaiSatu', id_penyewa);

                        // console.log(hasil_route);

                        window.open(hasil_route, '_self');
                    }
                });

            } else if (jumlah_penyewaan_belum_selesai == "Cuma 1") {

                swal.fire({

                    icon: 'warning',
                    title: 'Apakah Anda Yakin Ingin Menyelesaikan Penyewaan Ini?',
                    text: 'Penyewaan yang sudah diselesaikan tidak dapat dirubah lagi!',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Iya, Yakin!',
                }).then((result) => {

                    // alert(result);

                    if (result.isConfirmed) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('transaksiPerentalSelesaiSatu', id_penyewa);

                        // console.log(hasil_route);

                        window.open(hasil_route, '_self');

                    }
                });
            }

            // console.log(id_penyewa);
        }


        function print() {

            let id_penyewa = Number(document.getElementById("id_penyewa").value);
            let id_perental = Number(document.getElementById("id_perental").value);
            let jumlah_penyewaan_yang_waktunya_sama = document.getElementById("jumlah_penyewaan_yang_waktunya_sama").value;


            if (jumlah_penyewaan_yang_waktunya_sama == "Lebih dari 1") {

                swal.fire({

                    icon: 'warning',
                    title: 'Apakah Anda Yakin, Ingin Mengeprint Invoice Semua Penyewaan Yang Terkait Dengan Penyewaan Ini?',
                    text: 'Jika tidak, hanya penyewaan ini saja yang diprint invoicenya',
                    showCancelButton: true,
                    showDenyButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Iya, Semua Penyewaan!',
                    denyButtonText: 'Tidak, Penyewaan Ini saja',
                }).then((result) => {

                    // alert(result);

                    if (result.isConfirmed) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('transaksiPerentalPrintBanyak', {
                            id: id_perental,
                            id_penyewa: id_penyewa
                        });

                        // console.log(hasil_route);

                        window.open(hasil_route, '_blank');

                    } else if (result.isDenied) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('transaksiPerentalPrintSatu', {
                            id: id_perental,
                            id_penyewa: id_penyewa
                        });

                        // console.log(hasil_route);

                        window.open(hasil_route, '_blank');
                    }
                });

            } else if (jumlah_penyewaan_yang_waktunya_sama == "Cuma 1") {

                swal.fire({

                    icon: 'warning',
                    title: 'Apakah Anda Yakin Ingin Menyelesaikan Penyewaan Ini?',
                    text: 'Penyewaan yang sudah diselesaikan tidak dapat dirubah lagi!',
                    showCancelButton: true,
                    cancelButtonText: 'Batal',
                    confirmButtonText: 'Iya, Yakin!',
                }).then((result) => {

                    // alert(result);

                    if (result.isConfirmed) {

                        // console.log('berhasil lagi')

                        const hasil_route = route('transaksiPerentalPrintSatu', {
                            id: id_perental,
                            id_penyewa: id_penyewa
                        });

                        // console.log(hasil_route);

                        window.open(hasil_route, '_blank');

                    }
                });
            }

            // console.log(id_penyewa);
        }
    </script>
@endsection
