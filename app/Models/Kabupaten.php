<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    use HasFactory;

    protected $table = 'kabupaten';
    protected $primaryKey = 'id_kabupaten';


    // relationship with users table
    public function users_tempat_lahir()
    {

        return $this->hasMany(Users::class, 'tempat_lahir');
    }

    public function users_domisili_sekarang()
    {

        return $this->hasMany(Users::class, 'domisili_sekarang');
    }


    // relationship with penyewa_detail table
    public function penyewa_detail()
    {

        return $this->hasMany(PenyewaDetail::class, 'kabupaten_id');
    }
}
