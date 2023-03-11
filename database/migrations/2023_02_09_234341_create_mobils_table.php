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
        Schema::create('mobil', function (Blueprint $table) {
            $table->id('id_mobil');
            $table->unsignedBigInteger('perental_id');
            $table->foreign('perental_id')->references('id_perental')->on('perental');
            $table->string('jenis_mobil');
            $table->longText('slug_jenis_mobil')->nullable();
            $table->string('plat_nomor');
            $table->string('warna');
            $table->date('tanggal_didaftarkan')->nullable();
            $table->date('tanggal_terakhir_dirental')->nullable();
            $table->bigInteger('harga')->nullable();
            $table->longText('deskripsi_mobil')->nullable();
            $table->longText('foto_mobil')->nullable();
            $table->enum('status_penyewaan', ['Belum_Disewa', 'Sudah_Disewa'])->nullable();
            $table->enum('status_penggunaan_mobil', ['Aktif', 'Non-Aktif'])->nullable();
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
        Schema::dropIfExists('mobil');
    }
};
