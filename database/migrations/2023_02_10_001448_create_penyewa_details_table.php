<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penyewa_detail', function (Blueprint $table) {
            $table->id('id_penyewa_detail');
            $table->unsignedBigInteger('penyewa_id')->nullable();
            $table->foreign('penyewa_id')->references('id_penyewa')->on('penyewa');
            $table->unsignedBigInteger('kabupaten_id')->nullable();
            $table->foreign('kabupaten_id')->references('id_kabupaten')->on('kabupaten');
            $table->unsignedBigInteger('mobil_id')->nullable();
            $table->foreign('mobil_id')->references('id_mobil')->on('mobil');
            $table->date('tanggal_penyewaan')->nullable();
            $table->date('tanggal_pengembalian')->nullable();
            $table->bigInteger('total_harga')->nullable();
            $table->bigInteger('nominal_pembayaran')->nullable();
            $table->bigInteger('kembalian')->nullable();
            $table->bigInteger('total_uang_bersih_perental')->nullable();
            $table->string('keterangan')->nullable();
            $table->double('rating', 10, 1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penyewa_detail');
    }
};
