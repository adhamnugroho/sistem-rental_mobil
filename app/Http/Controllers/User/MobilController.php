<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    protected $judul = 'Mobil';
    protected $menu = 'mobil';
    protected $sub_menu = 'mobil';
    protected $directory = 'user.mobil';

    public function detail($id)
    {
        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['mobil'] = Mobil::where('id_mobil', $id)->first();

        return view($this->directory . ".detail", $data);
    }
}
