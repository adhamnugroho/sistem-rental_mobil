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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('username');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_telp', 15)->nullable();
            $table->unsignedBigInteger('tempat_lahir')->nullable();
            $table->foreign('tempat_lahir')->references('id_kabupaten')->on('kabupaten');
            $table->date('tanggal_lahir')->nullable();
            $table->integer('umur')->nullable();
            $table->unsignedBigInteger('domisili_sekarang')->nullable(); // Kota untuk alamat
            $table->foreign('domisili_sekarang')->references('id_kabupaten')->on('kabupaten');
            $table->text('alamat_lengkap')->nullable();
            $table->enum('status_akun', ['Perental', 'Penyewa'])->nullable();
            $table->enum('status_pengguna', ['Aktif', 'Non-Aktif'])->nullable();
            $table->enum('level_user', ['Admin', 'Pengguna'])->nullable();
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
        Schema::dropIfExists('users');
    }
};
