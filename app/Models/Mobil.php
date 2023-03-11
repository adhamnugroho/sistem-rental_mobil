<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    protected $table = 'mobil';
    protected $primaryKey = 'id_mobil';


    protected $fillable = [
        'perental_id',
        'jenis_mobil',
        'slug_jenis_mobil',
        'plat_nomor',
        'warna',
        'tanggal_didaftarkan',
        'tanggal_terakhir_direntalkan',
        'harga',
        'deskripsi_mobil',
        'foto_mobil',
        'status_penyewaan',
        'status_penggunaan_mobil',
    ];


    // relationship with perental table
    public function perental()
    {

        return $this->belongsTo(Perental::class, 'perental_id');
    }

    // relationship with penyewa_detail table
    public function penyewa_detail()
    {

        return $this->hasMany(PenyewaDetail::class, 'mobil_id');
    }
}
