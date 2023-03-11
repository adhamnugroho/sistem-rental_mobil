<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenyewaDetail extends Model
{
    use HasFactory;

    protected $table = 'penyewa_detail';
    protected $primaryKey = 'id_penyewa_detail';


    protected $fillable = [
        'penyewa_id',
        'kabupaten_id',
        'mobil_id',
        'tanggal_penyewaan',
        'tanggal_pengembalian',
        'total_harga',
        'nominal_pembayaran',
        'kembalian',
        'total_uang_bersih_perental',
        'keterangan',
        'rating',
    ];


    // relationship with mobil table
    public function mobil()
    {

        return $this->belongsTo(Mobil::class, 'mobil_id');
    }

    // relationship with penyewa table
    public function penyewa()
    {

        return $this->belongsTo(Penyewa::class, 'penyewa_id');
    }

    // relationship with kabupaten table
    public function kabupaten()
    {

        return $this->belongsTo(Kabupaten::class, 'kabupaten_id');
    }
}
