<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perental extends Model
{
    use HasFactory;

    protected $table = 'perental';
    protected $primaryKey = 'id_perental';


    protected $fillable = [
        'users_id',
        'keterangan',
        'status_perental',
    ];


    // relationship with users table
    public function users()
    {

        return $this->belongsTo(Users::class, 'users_id');
    }

    // relationship with mobil table
    public function mobil()
    {

        return $this->hasMany(Mobil::class, 'perental_id');
    }
}
