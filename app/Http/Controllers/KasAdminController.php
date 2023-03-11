<?php

namespace App\Http\Controllers;

use App\Models\KasAdmin;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

class KasAdminController extends Controller
{
    protected $judul = 'Keuangan Admin';
    protected $menu = 'keuangan';
    protected $sub_menu = 'keuangan_admin';
    protected $directory = 'admin.keuangan.admin';
    protected $directoryTambah = 'admin.keuangan.admin.tambah';
    protected $directoryKurang = 'admin.keuangan.admin.kurang';

    public function index()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kas_admin'] = KasAdmin::with([

            'penyewa' => function ($query) {

                $query->with([
                    'users'
                ]);
            },
        ])
            ->orderBy('id_kas_admin', 'DESC')
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

            $kas_admin_sebelumnya = KasAdmin::orderBy('id_kas_admin', 'DESC')->first();

            // Memasukkan request ke dalam variabel
            $validatedDataTabelKasAdmin = $request->validate([
                'kas_admin_masuk' => 'required',
                'tanggal' => 'required|date',
            ]);

            // penyewa_id, jenis, kas_admin_keluar
            $validatedDataTabelKasAdmin['penyewa_id'] = $kas_admin_sebelumnya->penyewa_id;
            $validatedDataTabelKasAdmin['jenis'] = "Pemasukan";
            $validatedDataTabelKasAdmin['kas_admin_keluar'] = 0;

            // total_kas_admin_sekarang
            $validatedDataTabelKasAdmin['total_kas_admin_satu'] = ($kas_admin_sebelumnya->total_kas_admin_semua) + ($request->kas_admin_masuk);
            $validatedDataTabelKasAdmin['total_kas_admin_semua'] = ($kas_admin_sebelumnya->total_kas_admin_semua) + ($request->kas_admin_masuk);

            // waktu
            $waktu = Carbon::now()->format('Y-m-d H:i:s');
            $validatedDataTabelKasAdmin['waktu_kas_masuk'] = $waktu;
            $validatedDataTabelKasAdmin['waktu_total_kas_admin_satu'] = $waktu;
            $validatedDataTabelKasAdmin['waktu_total_kas_admin_semua'] = $waktu;


            if (empty($request->keterangan)) {

                $validatedDataTabelKasAdmin['keterangan'] = 'Pemasukan Keuangan Asuransi pada Admin';
            } else {

                $request->validate([
                    'keterangan' => 'required|string',
                ]);

                $validatedDataTabelKasAdmin['keterangan'] = $request->keterangan;
            }

            // dd($validatedDataTabelKasAdmin);

            $kas_admin = KasAdmin::create($validatedDataTabelKasAdmin);

            if ($kas_admin) {

                return redirect()->route('keuanganAdmin')->with('status', 'success')->with('message', 'Berhasil Menambah Saldo Keuangan Admin');
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

        $data['kas_admin'] = KasAdmin::with([

            'penyewa' => function ($query) {

                $query->with([
                    'users'
                ]);
            },
        ])
            ->where('id_kas_admin', $id)
            ->first();

        $data['users'] = Users::where('level_user', 'Pengguna')->get();

        // dd($data);

        return view($this->directory . ".show", $data);
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

            $kas_admin_sebelumnya = KasAdmin::orderBy('id_kas_admin', 'DESC')->first();

            // Memasukkan request ke dalam variabel
            $validatedDataTabelKasAdmin = $request->validate([
                'kas_admin_keluar' => 'required',
                'tanggal' => 'required|date',
            ]);

            // kas_admin_masuk, penyewa_id, jenis
            $validatedDataTabelKasAdmin['kas_admin_masuk'] = 0;
            $validatedDataTabelKasAdmin['penyewa_id'] = $kas_admin_sebelumnya->penyewa_id;
            $validatedDataTabelKasAdmin['jenis'] = "Pengeluaran";

            // total_kas_admin_sekarang
            $validatedDataTabelKasAdmin['total_kas_admin_satu'] = ($kas_admin_sebelumnya->total_kas_admin_semua) - ($request->kas_admin_keluar);
            $validatedDataTabelKasAdmin['total_kas_admin_semua'] = ($kas_admin_sebelumnya->total_kas_admin_semua) - ($request->kas_admin_keluar);

            // waktu
            $waktu = Carbon::now()->format('Y-m-d H:i:s');
            $validatedDataTabelKasAdmin['waktu_kas_keluar'] = $waktu;
            $validatedDataTabelKasAdmin['waktu_total_kas_admin_satu'] = $waktu;
            $validatedDataTabelKasAdmin['waktu_total_kas_admin_semua'] = $waktu;


            if (empty($request->keterangan)) {

                $validatedDataTabelKasAdmin['keterangan'] = 'Pengeluaran Keuangan Asuransi pada Admin';
            } else {

                $request->validate([
                    'keterangan' => 'required|string',
                ]);

                $validatedDataTabelKasAdmin['keterangan'] = $request->keterangan;
            }

            // dd($validatedDataTabelKasAdmin);

            $kas_admin = KasAdmin::create($validatedDataTabelKasAdmin);

            if ($kas_admin) {

                return redirect()->route('keuanganAdmin')->with('status', 'success')->with('message', 'Berhasil Mengurangi Saldo Keuangan Admin');
            }
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }
}
