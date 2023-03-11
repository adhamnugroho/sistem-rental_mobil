<?php

namespace App\Http\Controllers;

use App\Models\KasAsuransi;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

class KasAsuransiController extends Controller
{
    protected $judul = 'Keuangan Asuransi';
    protected $menu = 'keuangan';
    protected $sub_menu = 'keuangan_asuransi';
    protected $directory = 'admin.keuangan.asuransi';
    protected $directoryTambah = 'admin.keuangan.asuransi.tambah';
    protected $directoryKurang = 'admin.keuangan.asuransi.kurang';


    public function index()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kas_asuransi'] = KasAsuransi::with([

            'penyewa' => function ($query) {

                $query->with([
                    'users'
                ]);
            },
        ])
            ->orderBy('id_kas_asuransi', 'DESC')
            ->get();

        // dd($data);

        return view($this->directory . ".main", $data);
    }


    public function tambahCreate()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;


        return view($this->directoryTambah . ".add", $data);
    }


    public function tambahStore(Request $request)
    {

        // return $request->all();

        try {

            $kas_asuransi_sebelumnya = KasAsuransi::orderBy('id_kas_asuransi', 'DESC')->first();

            // Memasukkan request ke dalam variabel
            $validatedDataTabelKasAsuransi = $request->validate([
                'kas_asuransi_masuk' => 'required',
                'tanggal' => 'required|date',
            ]);

            // penyewa_id, jenis, kas_asuransi_keluar
            $validatedDataTabelKasAsuransi['penyewa_id'] = $kas_asuransi_sebelumnya->penyewa_id;
            $validatedDataTabelKasAsuransi['jenis'] = "Pemasukan";
            $validatedDataTabelKasAsuransi['kas_asuransi_keluar'] = 0;

            // total_kas_asuransi_sekarang
            $validatedDataTabelKasAsuransi['total_keuangan_asuransi_satu'] = ($kas_asuransi_sebelumnya->total_keuangan_asuransi_semua) + ($request->kas_asuransi_masuk);
            $validatedDataTabelKasAsuransi['total_keuangan_asuransi_semua'] = ($kas_asuransi_sebelumnya->total_keuangan_asuransi_semua) + ($request->kas_asuransi_masuk);

            // waktu
            $waktu = Carbon::now()->format('Y-m-d H:i:s');
            $validatedDataTabelKasAsuransi['waktu_kas_masuk'] = $waktu;
            $validatedDataTabelKasAsuransi['waktu_total_kas_asuransi_satu'] = $waktu;
            $validatedDataTabelKasAsuransi['waktu_total_kas_asuransi_semua'] = $waktu;


            if (empty($request->keterangan)) {

                $validatedDataTabelKasAsuransi['keterangan'] = 'Pemasukan Keuangan Asuransi pada Admin';
            } else {

                $request->validate([
                    'keterangan' => 'required|string',
                ]);

                $validatedDataTabelKasAsuransi['keterangan'] = $request->keterangan;
            }

            // dd($validatedDataTabelKasAsuransi);

            $kas_asuransi = KasAsuransi::create($validatedDataTabelKasAsuransi);

            if ($kas_asuransi) {

                return redirect()->route('keuanganAsuransi')->with('status', 'success')->with('message', 'Berhasil Menambah Saldo Keuangan Asuransi');
            }
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function show($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kas_asuransi'] = KasAsuransi::with([

            'penyewa' => function ($query) {

                $query->with([
                    'users'
                ]);
            },
        ])
            ->where('id_kas_asuransi', $id)
            ->first();

        $data['users'] = Users::where('level_user', 'Pengguna')->get();

        // dd($data);

        return view($this->directory . ".show", $data);
    }


    public function tambahEdit($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kas_asuransi'] = KasAsuransi::with([

            'penyewa' => function ($query) {

                $query->with([
                    'users'
                ]);
            },
        ])
            ->where('id_kas_asuransi', $id)
            ->first();

        // dd($data);

        return view($this->directoryTambah . ".edit", $data);
    }


    public function tambahUpdate($id, Request $request)
    {

        // return $request->all();

        try {

            $kas_asuransi_sebelumnya = KasAsuransi::where('id_kas_asuransi', $id)->first();

            // Memasukkan request ke dalam variabel
            $validatedDataTabelKasAsuransi = $request->validate([
                'kas_asuransi_masuk' => 'required',
                'tanggal' => 'required|date',
            ]);



            // total_kas_asuransi_sekarang
            $kas_asuransi_sebelumnya_total = KasAsuransi::orderBy('id_kas_asuransi', 'DESC')->first();
            $total_kas_sebelumnya = $kas_asuransi_sebelumnya_total->total_keuangan_asuransi;
            $total_kas_masuk_sebelumnya = $kas_asuransi_sebelumnya->kas_asuransi_masuk;


            if ($request->kas_asuransi_masuk > $total_kas_masuk_sebelumnya) {

                $perhitungan_total_kas_masuk_sekarang = ($request->kas_asuransi_masuk) - $total_kas_masuk_sebelumnya;

                $validatedDataTabelKasAsuransi['total_keuangan_asuransi'] = $total_kas_sebelumnya + $perhitungan_total_kas_masuk_sekarang;
            } else if ($request->kas_asuransi_masuk < $total_kas_masuk_sebelumnya) {

                $perhitungan_total_kas_masuk_sekarang = $total_kas_masuk_sebelumnya - ($request->kas_asuransi_masuk);

                $validatedDataTabelKasAsuransi['total_keuangan_asuransi'] = $total_kas_sebelumnya - $perhitungan_total_kas_masuk_sekarang;
            }

            // keterangan
            if (empty($request->keterangan)) {

                $validatedDataTabelKasAsuransi['keterangan'] = 'Pemasukan Keuangan Asuransi pada Admin';
            } else {

                $request->validate([
                    'keterangan' => 'required|string',
                ]);

                $validatedDataTabelKasAsuransi['keterangan'] = $request->keterangan;
            }

            // dd($validatedDataTabelKasAsuransi);

            $kas_asuransi_sebelumnya->update($validatedDataTabelKasAsuransi);

            if ($kas_asuransi_sebelumnya) {

                return redirect()->route('keuanganAsuransi')->with('status', 'success')->with('message', 'Berhasil Mengupdate Keuangan Asransi');
            }
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function kurangCreate()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;


        return view($this->directoryKurang . ".add", $data);
    }


    public function kurangStore(Request $request)
    {

        // return $request->all();

        try {

            $kas_asuransi_sebelumnya = KasAsuransi::orderBy('id_kas_asuransi', 'DESC')->first();

            // Memasukkan request ke dalam variabel
            $validatedDataTabelKasAsuransi = $request->validate([
                'kas_asuransi_keluar' => 'required',
                'tanggal' => 'required|date',
            ]);

            // kas_asuransi_masuk, penyewa_id, jenis
            $validatedDataTabelKasAsuransi['kas_asuransi_masuk'] = 0;
            $validatedDataTabelKasAsuransi['penyewa_id'] = $kas_asuransi_sebelumnya->penyewa_id;
            $validatedDataTabelKasAsuransi['jenis'] = "Pengeluaran";

            // total_kas_asuransi_sekarang
            $validatedDataTabelKasAsuransi['total_keuangan_asuransi_satu'] = ($kas_asuransi_sebelumnya->total_keuangan_asuransi_semua) - ($request->kas_asuransi_keluar);
            $validatedDataTabelKasAsuransi['total_keuangan_asuransi_semua'] = ($kas_asuransi_sebelumnya->total_keuangan_asuransi_semua) - ($request->kas_asuransi_keluar);

            // waktu
            $waktu = Carbon::now()->format('Y-m-d H:i:s');
            $validatedDataTabelKasAsuransi['waktu_kas_keluar'] = $waktu;
            $validatedDataTabelKasAsuransi['waktu_total_kas_asuransi_satu'] = $waktu;
            $validatedDataTabelKasAsuransi['waktu_total_kas_asuransi_semua'] = $waktu;


            if (empty($request->keterangan)) {

                $validatedDataTabelKasAsuransi['keterangan'] = 'Pengeluaran Keuangan Asuransi pada Admin';
            } else {

                $request->validate([
                    'keterangan' => 'required|string',
                ]);

                $validatedDataTabelKasAsuransi['keterangan'] = $request->keterangan;
            }

            // dd($validatedDataTabelKasAsuransi);

            $kas_asuransi = KasAsuransi::create($validatedDataTabelKasAsuransi);

            if ($kas_asuransi) {

                return redirect()->route('keuanganAsuransi')->with('status', 'success')->with('message', 'Berhasil Mengurangi Saldo Keuangan Asuransi');
            }
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function kurangEdit($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kas_asuransi'] = KasAsuransi::with([

            'penyewa' => function ($query) {

                $query->with([
                    'users'
                ]);
            },
        ])
            ->where('id_kas_asuransi', $id)
            ->first();

        // dd($data);

        return view($this->directoryKurang . ".edit", $data);
    }


    public function kurangUpdate($id, Request $request)
    {

        // return $request->all();

        try {

            $kas_asuransi_sebelumnya = KasAsuransi::where('id_kas_asuransi', $id)->first();

            // Memasukkan request ke dalam variabel
            $validatedDataTabelKasAsuransi = $request->validate([
                'kas_asuransi_keluar' => 'required',
                'tanggal' => 'required|date',
            ]);



            // total_kas_asuransi_sekarang
            $kas_asuransi_sebelumnya_total = KasAsuransi::orderBy('id_kas_asuransi', 'DESC')->first();
            $total_kas_sebelumnya = $kas_asuransi_sebelumnya_total->total_keuangan_asuransi;
            $total_kas_keluar_sebelumnya = $kas_asuransi_sebelumnya->kas_asuransi_keluar;


            if ($request->kas_asuransi_keluar > $total_kas_keluar_sebelumnya) {

                $perhitungan_total_kas_keluar_sekarang = ($request->kas_asuransi_keluar) - $total_kas_keluar_sebelumnya;

                $validatedDataTabelKasAsuransi['total_keuangan_asuransi'] = $total_kas_sebelumnya - $perhitungan_total_kas_keluar_sekarang;
            } else if ($request->kas_asuransi_keluar < $total_kas_keluar_sebelumnya) {

                $perhitungan_total_kas_keluar_sekarang = $total_kas_keluar_sebelumnya - ($request->kas_asuransi_keluar);

                $validatedDataTabelKasAsuransi['total_keuangan_asuransi'] = $total_kas_sebelumnya + $perhitungan_total_kas_keluar_sekarang;
            }

            // keterangan
            if (empty($request->keterangan)) {

                $validatedDataTabelKasAsuransi['keterangan'] = 'Pemasukan Keuangan Asuransi pada Admin';
            } else {

                $request->validate([
                    'keterangan' => 'required|string',
                ]);

                $validatedDataTabelKasAsuransi['keterangan'] = $request->keterangan;
            }

            // dd($validatedDataTabelKasAsuransi);

            $kas_asuransi_sebelumnya->update($validatedDataTabelKasAsuransi);

            if ($kas_asuransi_sebelumnya) {

                return redirect()->route('keuanganAsuransi')->with('status', 'success')->with('message', 'Berhasil Mengupdate Keuangan Asransi');
            }
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }
}
