<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Mobil;
use App\Models\PenyewaDetail;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $judul = 'Dashboard';
    protected $menu = 'dashboard';
    protected $sub_menu = '';
    protected $direktori = 'user.dashboard';


    public function main(Request $request)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $mobil = Mobil::whereHas('perental.users', function ($us) {
            $us->whereNotIn('nama_lengkap', ['Pengguna', 'Guest', 'Guest_Perental']);
        })->get();

        $mobil1 = Mobil::whereHas('perental.users', function ($us) {
            $us->whereNotIn('nama_lengkap', ['Pengguna', 'Guest', 'Guest_Perental']);
        })
            ->where('status_penyewaan', 'Belum_Disewa')
            ->get();

        $data['jumlah_mobil'] = count($mobil);
        $data['mobil'] = $mobil1;

        $data['lama_berdiri'] = (Carbon::now()->format('Y')) - 2022;
        $data['jumlah_penyewaan'] = count(PenyewaDetail::all());

        $users = Users::whereNotIn('nama_lengkap', ['Pengguna', 'Guest', 'Guest_Perental'])
            ->get();
        $data['jumlah_users'] = count($users);

        $data['jumlah_cabang'] = count(Kabupaten::where('id_provinsi', 35)->get());

        // dd($data);


        return view($this->direktori . '.main', $data);
    }
}
