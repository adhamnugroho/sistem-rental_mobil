<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasAdmin extends Model
{
    use HasFactory;

    protected $table = 'kas_admin';
    protected $primaryKey = 'id_kas_admin';


    protected $fillable = [
        'penyewa_id',
        'jenis',
        'kas_admin_masuk',
        'kas_admin_keluar',
        'total_kas_admin_satu',
        'total_kas_admin_semua',
        'tanggal',
        'waktu_kas_masuk',
        'waktu_kas_keluar',
        'waktu_total_kas_admin_satu',
        'waktu_total_kas_admin_semua',
        'keterangan',
    ];


    // relationship with penyewa table
    public function penyewa()
    {

        return $this->belongsTo(Penyewa::class, 'penyewa_id');
    }
}
