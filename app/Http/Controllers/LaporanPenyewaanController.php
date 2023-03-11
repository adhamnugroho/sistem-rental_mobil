<?php

namespace App\Http\Controllers;

use App\Models\PenyewaDetail;
use Illuminate\Http\Request;

class LaporanPenyewaanController extends Controller
{
    protected $judul = 'Laporan Penyewaan';
    protected $menu = 'laporan_rekapitulasi';
    protected $sub_menu = 'laporan_penyewaan';
    protected $direktori = 'admin.laporan.laporan_penyewaan';


    public function index(Request $request)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;


        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {

            $data['laporan_penyewaan'] = PenyewaDetail::with([

                'penyewa' => function ($query) {

                    $query->with([
                        'users'
                    ]);
                },
                'mobil' => function ($mb) {

                    $mb->with([

                        'perental' => function ($pr) {

                            $pr->with([

                                'users'
                            ]);
                        }
                    ]);
                },
                'kabupaten',
            ])
                ->whereBetween('tanggal_penyewaan', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();
        } else {

            $data['laporan_penyewaan'] = PenyewaDetail::with([

                'penyewa' => function ($query) {

                    $query->with([
                        'users'
                    ]);
                },
                'mobil' => function ($mb) {

                    $mb->with([

                        'perental' => function ($pr) {

                            $pr->with([

                                'users'
                            ]);
                        }
                    ]);
                },
                'kabupaten',
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

        $data['laporan_penyewaan'] = PenyewaDetail::with([

            'penyewa' => function ($query) {

                $query->with([
                    'users'
                ]);
            },
        ])
            ->whereBetween('tanggal_penyewaan', [$request->tanggal_awal, $request->tanggal_akhir])
            ->get();


        if (count($data['laporan_penyewaan']) > 0) {

            return response()->json(['status' => 'ditemukan', 'url' => route('laporanPenyewaan')]);
        } else {

            return response()->json(['status' => 'tidak_ditemukan', 'url' => route('laporanPenyewaan')]);
        }
    }


    public function print(Request $request)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;


        if (isset($request->tanggal_awal) && isset($request->tanggal_akhir) && !empty($request->tanggal_awal) && !empty($request->tanggal_akhir)) {

            $data['laporan_penyewaan'] = PenyewaDetail::with([

                'penyewa' => function ($query) {

                    $query->with([
                        'users'
                    ]);
                },
                'mobil' => function ($mb) {

                    $mb->with([

                        'perental' => function ($pr) {

                            $pr->with([

                                'users'
                            ]);
                        }
                    ]);
                },
                'kabupaten',
            ])
                ->whereBetween('tanggal_penyewaan', [$request->tanggal_awal, $request->tanggal_akhir])
                ->get();

            if (count($data['laporan_penyewaan']) == 0) {

                return redirect()->route('laporanPenyewaan')
                ->with('status', 'error')
                ->with('message', 'Tidak Ada data yang ditemukan untuk di print');
            }
        } else {

            $data['laporan_penyewaan'] = PenyewaDetail::with([

                'penyewa' => function ($query) {

                    $query->with([
                        'users'
                    ]);
                },
                'mobil' => function ($mb) {

                    $mb->with([

                        'perental' => function ($pr) {

                            $pr->with([

                                'users'
                            ]);
                        }
                    ]);
                },
                'kabupaten',
            ])
                ->orderBy('created_at', 'DESC')
                ->get();
        }


        $data['tanggal_awal'] = $request->tanggal_awal;
        $data['tanggal_akhir'] = $request->tanggal_akhir;

        return view($this->direktori . ".print", $data);
    }
}
