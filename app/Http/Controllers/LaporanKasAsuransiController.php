<?php

namespace App\Http\Controllers;

use App\Models\KasAsuransi;
use Illuminate\Http\Request;

class LaporanKasAsuransiController extends Controller
{
    protected $judul = 'Laporan Keuangan Asuransi';
    protected $menu = 'laporan_rekapitulasi';
    protected $sub_menu = 'laporan_keuangan_asuransi';
    protected $direktori = 'admin.laporan.laporan_kas_asuransi';


    public function index(Request $request)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;


        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {

            $data['laporan_kas_asuransi'] = KasAsuransi::with([

                'penyewa' => function ($query) {

                    $query->with([
                        'users'
                    ]);
                },
            ])
                ->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();
        } else {

            $data['laporan_kas_asuransi'] = KasAsuransi::with([

                'penyewa' => function ($query) {

                    $query->with([
                        'users'
                    ]);
                },
            ])
                ->orderBy('created_at', 'DESC')
                ->get();
        }


        return view($this->direktori . ".main", $data);
    }


    public function cariData(Request $request)
    {
        $data['tanggal_awal'] = $request->tanggal_awal;
        $data['tanggal_akhir'] = $request->tanggal_akhir;

        $data['laporan_kas_asuransi'] = KasAsuransi::with([

            'penyewa' => function ($query) {

                $query->with([
                    'users'
                ]);
            },
        ])
            ->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();


        if (count($data['laporan_kas_asuransi']) > 0) {

            return response()->json(['status' => 'ditemukan', 'url' => route('laporanKasAsuransi')]);
        } else {

            return response()->json(['status' => 'tidak_ditemukan', 'url' => route('laporanKasAsuransi')]);
        }
    }


    public function print(Request $request)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;


        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {

            $data['laporan_kas_asuransi'] = KasAsuransi::with([

                'penyewa' => function ($query) {

                    $query->with([
                        'users'
                    ]);
                },
            ])
                ->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();

            if (count($data['laporan_kas_asuransi']) == 0) {

                return redirect()->route('laporanKasAsuransi')
                    ->with('status', 'error')
                    ->with('message', 'Tidak Ada data yang ditemukan untuk di print');
            }
        } else {

            $data['laporan_kas_asuransi'] = KasAsuransi::with([

                'penyewa' => function ($query) {

                    $query->with([
                        'users'
                    ]);
                },
            ])
                ->orderBy('created_at', 'DESC')
                ->get();
        }


        $data['tanggal_awal'] = $request->tanggal_awal;
        $data['tanggal_akhir'] = $request->tanggal_akhir;

        return view($this->direktori . ".print", $data);
    }
}
