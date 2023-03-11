<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasAsuransi extends Model
{
    use HasFactory;

    protected $table = 'kas_asuransi';
    protected $primaryKey = 'id_kas_asuransi';


    protected $fillable = [
        'penyewa_id',
        'jenis',
        'kas_asuransi_masuk',
        'kas_asuransi_keluar',
        'total_keuangan_asuransi_satu',
        'total_keuangan_asuransi_semua',
        'tanggal',
        'waktu_kas_masuk',
        'waktu_kas_keluar',
        'waktu_total_kas_asuransi_satu',
        'waktu_total_kas_asuransi_semua',
        'keterangan',
    ];


    // relationship with penyewa table
    public function penyewa()
    {

        return $this->belongsTo(Penyewa::class, 'penyewa_id');
    }
}
