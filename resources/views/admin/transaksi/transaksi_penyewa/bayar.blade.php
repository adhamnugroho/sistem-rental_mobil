@extends('admin.layout.app')


@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Data Pembayaran Penyewaan</h3>
                    <p class="text-subtitle text-muted">
                        Harap memasukkan data pembayaran penyewaan dengan benar.
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('transaksiPenyewaShow', $penyewa->id_penyewa) }}">Detail Lengkap Data
                                    {{ $judul }}</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Pembayaran Penyewaan
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
                            <h4 class="card-title">Form Pembayaran {{ $judul }}an</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">

                                <form class="form form-vertical"
                                    action="{{ route('transaksiPenyewaPostBayar', $penyewa->id_penyewa) }}" method="POST">

                                    @csrf

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="total_harga">Total Harga Penyewaan </label>
                                                    <input type="number" id="total_harga" class="form-control mt-2"
                                                        placeholder="Masukkan Harga Penyewaan Mobil" required min="100000"
                                                        max="" inputmode="numeric"
                                                        autocomplete="transaction-currency"
                                                        value="{{ old('total_harga') ? old('total_harga') : $penyewa->penyewa_detail[0]->total_harga }}"
                                                        readonly="readonly" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <div class="form-group">
                                                    <label for="nominal_pembayaran">Nominal Pembayaran Penyewaan <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="number" id="nominal_pembayaran" class="form-control mt-2"
                                                        name="nominal_pembayaran"
                                                        placeholder="Masukkan Nominal Pembayaran Penyewaan" required
                                                        inputmode="numeric" autocomplete="transaction-currency"
                                                        value="{{ old('nominal_pembayaran') ? old('nominal_pembayaran') : $penyewa->penyewa_detail[0]->nominal_pembayaran }}" />
                                                </div>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <label for="keterangan" class="mb-2">
                                                    <span>Review Penyewaan</span> <span class="text-info">(Opsional)</span>
                                                </label>
                                                <div class="form-floating">
                                                    <textarea class="form-control mt-2" placeholder="Masukkan Review Penyewaan Disini" id="keterangan" name="keterangan"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Kolom Keterangan ini bisa dipanjangkan ukuran wadahnya, apabila dirasa tampilan default kurang memadai untuk membaca isinya">{{ old('keterangan') ? old('keterangan') : $penyewa->penyewa_detail[0]->keterangan }}</textarea>
                                                    <label for="keterangan">Masukkan Keterangan Disini</label>
                                                </div>
                                            </div>
                                            <div class="col-12 mt-4">
                                                <div class="form-group">
                                                    <div class="card">
                                                        <label for="rating">Rating <sup
                                                                class="text-danger">*</sup></label>
                                                        <div class="card-body ">

                                                            <div id="rater"></div>
                                                        </div>
                                                        <input type="hidden" id="rating_database"
                                                            value="{{ $penyewa->penyewa_detail[0]->rating }}">
                                                        <input type="hidden" name="rating" id="rating_untuk_database"
                                                            value="{{ $penyewa->penyewa_detail[0]->rating }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-flex justify-content-end mt-5">
                                                {{-- <a href="" class="btn btn-success me-4 mb-1">Bayar</a> --}}
                                                <a href="{{ route('transaksiPenyewaShow', $penyewa->id_penyewa) }}"
                                                    class="btn btn-light-secondary me-4 mb-1">Kembali</a>
                                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                                    Bayar
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
        $(document).ready(function() {

            settingRating();
            setMinNominalPembayaran();
        })


        function settingRating() {

            let ratingPadaDatabase = document.getElementById("rating_database").value;
            let ratingPadaDatabaseNumber = Number(ratingPadaDatabase);

            const options = {

                element: document.getElementById("rater"),
                starSize: 32,
                step: 0.5,
                readOnly: false,
                rating: ratingPadaDatabaseNumber,
                showToolTip: true,
                ratingText: "Rating saat ini:  {rating} / {maxRating}",
                disableText: "Rating saat ini:  {rating} / {maxRating}",
                rateCallback: function rateCallback(rating, done) {
                    this.setRating(rating)

                    document.getElementById("rating_untuk_database").value = rating;
                    // console.log(rating)

                    done()
                },

            };

            const rating = raterJs(options);

            // console.log(rating)
        }


        function setMinNominalPembayaran() {

            let total_harga = document.getElementById("total_harga").value;

            let nominal_pembayaran = document.getElementById("nominal_pembayaran");
            nominal_pembayaran.setAttribute("min", total_harga);

        }
    </script>
@endsection
