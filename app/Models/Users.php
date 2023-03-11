<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';
    protected $primaryKey = 'id';


    protected $fillable = [
        'nama_lengkap',
        'username',
        'email',
        'password',
        'no_telp',
        'tempat_lahir',
        'tanggal_lahir',
        'umur',
        'domisili_sekarang',
        'alamat_lengkap',
        'status_akun',
        'status_pengguna',
        'level_user',
    ];


    // relationship with kabupaten table
    public function tempat_lahir()
    {

        return $this->belongsTo(Kabupaten::class, 'tempat_lahir');
    }

    public function domisili_sekarang()
    {

        return $this->belongsTo(Kabupaten::class, 'domisili_sekarang');
    }


    // relationship with perental table
    public function perental()
    {

        return $this->hasMany(Perental::class, 'users_id');
    }


    // relationship with penyewa table
    public function penyewa()
    {
        return $this->hasMany(Perental::class, 'users_id');
    }
}
