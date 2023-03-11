<?php

namespace App\Http\Controllers;

use App\Models\KasAdmin;
use App\Models\KasAsuransi;
use App\Models\Mobil;
use App\Models\PenyewaDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $judul = 'Dashboard';
    protected $menu = 'dashboard';
    protected $sub_menu = '';
    protected $direktori = 'admin.dashboard';


    public function main(Request $request)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $kas_asuransi = KasAsuransi::orderBy('id_kas_asuransi', 'DESC')->first();
        $data['total_kas_asuransi'] = $kas_asuransi->total_keuangan_asuransi_semua;

        $kas_admin = KasAdmin::orderBy('id_kas_admin', 'DESC')->first();
        $data['total_kas_admin'] = $kas_admin->total_kas_admin_semua;

        $mobil = Mobil::all();
        $data['jumlah_mobil'] = count($mobil);

        $tanggal_awal_bulan_ini = Carbon::now()->startOfMonth()->format('Y-m-d');
        $tanggal_akhir_bulan_ini = Carbon::now()->endOfMonth()->format('Y-m-d');
        $penyewaan_satu_bulan_ini = PenyewaDetail::whereBetween('tanggal_penyewaan', [$tanggal_awal_bulan_ini, $tanggal_akhir_bulan_ini])->get();
        $data['jumlah_penyewaan_bulan_ini'] = count($penyewaan_satu_bulan_ini);

        // dd(Auth::user());


        return view($this->direktori . '.main', $data);
    }
}
