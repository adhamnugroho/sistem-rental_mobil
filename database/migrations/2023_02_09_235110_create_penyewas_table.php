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
        Schema::create('penyewa', function (Blueprint $table) {
            $table->id('id_penyewa');
            $table->string('kode_invoice')->nullable();
            $table->unsignedBigInteger('users_id')->nullable();
            $table->foreign('users_id')->references('id')->on('users');
            $table->enum('status_penyewaan', ['Berjalan', 'Selesai', 'Dibatalkan', 'Mobil_Sudah_Datang', 'Mobil_Sudah_Dikembalikan_Ke_Admin', 'Mobil_Belum_Datang']);
            $table->enum('status_pembayaran_penyewa', ['Belum-Selesai', 'Selesai']);
            $table->enum('status_pembayaran_perental', ['Belum-Selesai', 'Selesai']);
            $table->dateTime('waktu_mobil_datang')->nullable();
            $table->dateTime('waktu_penyewaan_berjalan')->nullable();
            $table->dateTime('waktu_penyewa_mengembalikan_mobil')->nullable();
            $table->dateTime('waktu_pembayaran_penyewa')->nullable();
            $table->dateTime('waktu_pembayaran_perental')->nullable();
            $table->dateTime('waktu_mobil_dibawa_perental')->nullable();
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
        Schema::dropIfExists('penyewa');
    }
};
