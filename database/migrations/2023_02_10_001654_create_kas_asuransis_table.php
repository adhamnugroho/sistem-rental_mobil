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
        Schema::create('kas_asuransi', function (Blueprint $table) {
            $table->id('id_kas_asuransi');
            $table->unsignedBigInteger('penyewa_id')->nullable();
            $table->foreign('penyewa_id')->references('id_penyewa')->on('penyewa');
            $table->enum('jenis', ['Pemasukan', 'Pengeluaran'])->nullable();
            $table->integer('kas_asuransi_masuk')->nullable();
            $table->integer('kas_asuransi_keluar')->nullable();
            $table->integer('total_keuangan_asuransi_satu')->nullable();
            $table->integer('total_keuangan_asuransi_semua')->nullable();
            $table->date('tanggal')->nullable();
            $table->dateTime('waktu_kas_masuk')->nullable();
            $table->dateTime('waktu_kas_keluar')->nullable();
            $table->dateTime('waktu_total_kas_asuransi_satu')->nullable();
            $table->dateTime('waktu_total_kas_asuransi_semua')->nullable();
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('kas_asuransi');
    }
};
