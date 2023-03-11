<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    use HasFactory;

    protected $table = 'penyewa';
    protected $primaryKey = 'id_penyewa';


    protected $fillable = [
        'kode_invoice',
        'users_id',
        'status_penyewaan',
        'status_pembayaran_penyewa',
        'status_pembayaran_perental',
        'waktu_mobil_datang',
        'waktu_penyewaan_berjalan',
        'waktu_penyewa_mengembalikan_mobil',
        'waktu_pembayaran_penyewa',
        'waktu_pembayaran_perental',
        'waktu_mobil_dibawa_perental',
    ];


    // relationship with perental table
    public function users()
    {

        return $this->belongsTo(Users::class, 'users_id');
    }

    // relationship with penyewa_detail table
    public function penyewa_detail()
    {

        return $this->hasMany(PenyewaDetail::class, 'penyewa_id');
    }

    // relationship with kas_asuransi table
    public function kas_asuransi()
    {

        return $this->hasMany(KasAsuransi::class, 'penyewa_id');
    }

    // relationship with kas_admin table
    public function kas_admin()
    {

        return $this->hasMany(KasAdmin::class, 'penyewa_id');
    }
}
