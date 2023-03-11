<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\KasAdmin;
use App\Models\KasAsuransi;
use App\Models\Mobil;
use App\Models\Penyewa;
use App\Models\PenyewaDetail;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

class PenyewaController extends Controller
{
    protected $judul = 'Penyewa';
    protected $menu = 'penyewa';
    protected $sub_menu = '';
    protected $directory = 'admin.penyewa';


    public function index()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['penyewa'] = Penyewa::with([

            'penyewa_detail' => function ($query) {

                $query->with([
                    'kabupaten',
                    'mobil',
                ]);
            },
            'users',
        ])->get();



        return view($this->directory . ".main", $data);
    }


    public function create()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['users'] = Users::where('level_user', 'Pengguna')
            ->where('status_pengguna', 'Aktif')
            ->where('status_akun', 'Penyewa')
            ->whereNotIn('nama_lengkap', ['Pengguna'])
            ->get();

        $data['mobil'] = Mobil::where('status_penggunaan_mobil', 'Aktif')
            ->whereHas('perental', function ($query) {

                $query->where('status_perental', 'Aktif');
            })
            ->get();



        return view($this->directory . ".add", $data);
    }


    public function store(Request $request)
    {

        // return $request->all();

        try {

            // Memasukkan request ke dalam variabel

            $validatedDataTabelPenyewa = $request->validate([
                'users_id' => 'required',
            ]);


            // status tabel penyewa
            $validatedDataTabelPenyewa['status_penyewaan'] = 'Berjalan';
            $validatedDataTabelPenyewa['status_pembayaran'] = 'Belum-Selesai';


            $penyewa = Penyewa::create($validatedDataTabelPenyewa);

            // dd($penyewa);

            if ($penyewa) {

                $validatedDataTabelPenyewaDetail = $request->validate([
                    'mobil_id' => 'required',
                    'tanggal_penyewaan' => 'required|date',
                    'tanggal_pengembalian' => 'required|date',
                ]);


                // id_penyewa
                $penyewa = Penyewa::orderBy('id_penyewa', 'DESC')->first();
                $penyewa_id = $penyewa->id_penyewa;

                $validatedDataTabelPenyewaDetail['penyewa_id'] = $penyewa_id;


                // kabupaten_id
                $kabupaten = Kabupaten::whereHas('tempat_lahir', function ($query) use ($request) {

                    $query->with([

                        'perental' => function ($pr) use ($request) {

                            $pr->with([

                                'mobil' => function ($mb) use ($request) {

                                    $mb->where('id_mobil', $request->mobiL_id);
                                }
                            ]);
                        }
                    ]);
                })
                    ->first();

                // dd($kabupaten);

                $validatedDataTabelPenyewaDetail['kabupaten_id'] = $kabupaten->id_kabupaten;


                // total_harga
                $tanggal_awal = new Carbon($request->tanggal_penyewaan);
                $tanggal_akhir = new Carbon($request->tanggal_pengembalian);

                $jarak_hari = $tanggal_awal->diffInDays($tanggal_akhir) + 1;
                $harga_penyewaan_hari = $jarak_hari * 500000;

                $mobil = Mobil::where('id_mobil', $request->mobil_id)->first();
                $harga_mobil = $mobil->harga;

                $harga_penyewaan_total = $harga_penyewaan_hari + $harga_mobil;

                $validatedDataTabelPenyewaDetail['total_harga'] = $harga_penyewaan_total;

                // dd($validatedDataTabelPenyewaDetail['total_harga']);


                // nominal_pembayaran, total_uang_bersih_perental, kembalian
                $validatedDataTabelPenyewaDetail['nominal_pembayaran'] = 0;
                $validatedDataTabelPenyewaDetail['kembalian'] = 0;
                $validatedDataTabelPenyewaDetail['total_uang_bersih_perental'] = 0;


                // keterangan & rating
                $validatedDataTabelPenyewaDetail['keterangan'] = '-';
                $validatedDataTabelPenyewaDetail['rating'] = 0;

                $penyewa_detail = PenyewaDetail::create($validatedDataTabelPenyewaDetail);

                // dd($penyewa_detail);

                if ($penyewa_detail) {

                    $mobil = Mobil::where('id_mobil', $request->mobil_id)->first();

                    $validatedDataTabelMobil['status_penyewaan'] = "Sudah_Disewa";

                    $mobil->update($validatedDataTabelMobil);

                    if ($mobil) {

                        return redirect()->route('penyewa')->with('status', 'success')->with('message', 'Berhasil Menambah Data Penyewa');
                    }
                }
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

        $data['users'] = Users::where('level_user', 'Pengguna')
            ->where('status_pengguna', 'Aktif')
            ->where('status_akun', 'Penyewa')
            ->whereNotIn('nama_lengkap', ['Pengguna'])
            ->get();

        $data['mobil'] = Mobil::where('status_penggunaan_mobil', 'Aktif')
            ->whereHas('perental', function ($query) {

                $query->where('status_perental', 'Aktif');
            })
            ->get();

        $data['penyewa'] = Penyewa::with([

            'penyewa_detail',
        ])
            ->where('id_penyewa', $id)
            ->first();

        $data['kabupaten'] = Kabupaten::where('id_provinsi', '35')->get();

        $data['kembalian'] = 0;


        return view($this->directory . ".show", $data);
    }


    public function preBayar($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['users'] = Users::where('level_user', 'Pengguna')
            ->where('status_pengguna', 'Aktif')
            ->where('status_akun', 'Penyewa')
            ->whereNotIn('nama_lengkap', ['Pengguna'])
            ->get();

        $data['mobil'] = Mobil::where('status_penggunaan_mobil', 'Aktif')
            ->whereHas('perental', function ($query) {

                $query->where('status_perental', 'Aktif');
            })
            ->get();

        $data['penyewa'] = Penyewa::with([

            'penyewa_detail',
        ])
            ->where('id_penyewa', $id)
            ->first();

        $data['kabupaten'] = Kabupaten::where('id_provinsi', '35')->get();


        return view($this->directory . ".bayar", $data);
    }


    public function postBayar($id, Request $request)
    {

        // return $request->all();

        try {

            $penyewa_detail = PenyewaDetail::whereHas('penyewa', function ($query) use ($id) {

                $query->where('id_penyewa', $id);
            })->first();


            // Memasukkan request ke dalam variabel
            $validatedDataTabelPenyewaDetail = $request->validate([
                'nominal_pembayaran' => 'required',
                'rating' => 'required',
            ]);

            // Pembayaran perentalan
            $total_harga_penyewaan = $penyewa_detail->total_harga;
            $nominal_sekarang = $request->nominal_pembayaran;

            if ($nominal_sekarang > $total_harga_penyewaan) {

                $kembalian = $nominal_sekarang - $total_harga_penyewaan;

                $validatedDataTabelPenyewaDetail['kembalian'] = $kembalian;

                // uang bersih perental
                $uang_bersih_perental = intval(($nominal_sekarang - $kembalian) - ($total_harga_penyewaan * 0.02) - ($total_harga_penyewaan * 0.01));

                $validatedDataTabelPenyewaDetail['total_uang_bersih_perental'] = $uang_bersih_perental;
            } else {

                $validatedDataTabelPenyewaDetail['kembalian'] = 0;

                // uang bersih perental
                $uang_bersih_perental = intval($nominal_sekarang - ($nominal_sekarang * 0.02) - ($nominal_sekarang * 0.01));

                $validatedDataTabelPenyewaDetail['total_uang_bersih_perental'] = $uang_bersih_perental;
            }

            // keterangan
            if (empty($request->keterangan)) {

                $validatedDataTabelPenyewaDetail['keterangan'] = '-';
            } else {

                $request->validate([
                    'keterangan' => 'required|string',
                ]);

                $validatedDataTabelPenyewaDetail['keterangan'] = $request->keterangan;
            }


            $penyewa_detail->update($validatedDataTabelPenyewaDetail);



            if ($penyewa_detail) {

                $penyewa = Penyewa::where('id_penyewa', $id)->first();

                // status penyewaan dan status pembayaran
                $validatedDataTabelPenyewa['status_penyewaan'] = 'Selesai';
                $validatedDataTabelPenyewa['status_pembayaran'] = 'Selesai';

                $penyewa->update($validatedDataTabelPenyewa);


                if ($penyewa) {

                    $mobil = Mobil::whereHas('penyewa_detail', function ($query) use ($id) {

                        $query->where('penyewa_id', $id);
                    })->first();

                    $validatedDataTabelMobil['status_penyewaan'] = 'Belum_Disewa';

                    $mobil->update($validatedDataTabelMobil);


                    if ($mobil) {

                        $validatedDataTabelKasAsuransi['penyewa_id'] = $id;
                        $validatedDataTabelKasAsuransi['jenis'] = 'Pemasukan';
                        $validatedDataTabelKasAsuransi['kas_asuransi_keluar'] = 0;
                        $validatedDataTabelKasAsuransi['keterangan'] = '-';

                        // Perhitungan Pemasukan

                        $uang_pemasukan_asuransi = intval($total_harga_penyewaan * 0.02);
                        $validatedDataTabelKasAsuransi['kas_asuransi_masuk'] = $uang_pemasukan_asuransi;

                        $kas_asuransi_sebelumnya = KasAsuransi::orderBy('id_kas_asuransi', 'DESC')->first();
                        $total_kas_asuransi_sebelumnya = $kas_asuransi_sebelumnya->total_keuangan_asuransi;
                        $perhitungan_asuransi_sekarang = $total_kas_asuransi_sebelumnya + $uang_pemasukan_asuransi;
                        $validatedDataTabelKasAsuransi['total_keuangan_asuransi'] = $perhitungan_asuransi_sekarang;

                        // tanggal
                        $tanggal_pemasukan = Carbon::now()->format('Y-m-d');
                        $validatedDataTabelKasAsuransi['tanggal'] = $tanggal_pemasukan;


                        $kas_asuransi = KasAsuransi::create($validatedDataTabelKasAsuransi);


                        if ($kas_asuransi) {

                            $validatedDataTabelKasAdmin['penyewa_id'] = $id;
                            $validatedDataTabelKasAdmin['jenis'] = 'Pemasukan';
                            $validatedDataTabelKasAdmin['kas_admin_keluar'] = 0;
                            $validatedDataTabelKasAdmin['keterangan'] = '-';

                            // Perhitungan Pemasukan
                            $uang_pemasukan_admin = intval($total_harga_penyewaan * 0.01);
                            $validatedDataTabelKasAdmin['kas_admin_masuk'] = $uang_pemasukan_admin;

                            $kas_admin_sebelumnya = KasAdmin::orderBy('id_kas_admin', 'DESC')->first();
                            $total_kas_admin_sebelumnya = $kas_admin_sebelumnya->total_kas_admin;
                            $perhitungan_admin_sekarang = $total_kas_admin_sebelumnya + $uang_pemasukan_admin;
                            $validatedDataTabelKasAdmin['total_kas_admin'] = $perhitungan_admin_sekarang;

                            // tanggal
                            $tanggal_pemasukan = Carbon::now()->format('Y-m-d');
                            $validatedDataTabelKasAdmin['tanggal'] = $tanggal_pemasukan;

                            // dd($validatedDataTabelKasAdmin);

                            $kas_admin = KasAdmin::create($validatedDataTabelKasAdmin);

                            if ($kas_admin) {

                                return redirect()->route('penyewaShow', $id)->with('status', 'success')->with('message', 'Berhasil Melakukan Pembayaran Penyewaan');
                            }
                        }
                    }
                }
            }
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function batal($id)
    {

        try {

            $penyewa = Penyewa::where('id_penyewa', $id)->first();

            // status tabel penyewa
            $validatedDataTabelPenyewa['status_penyewaan'] = 'Dibatalkan';


            $penyewa->update($validatedDataTabelPenyewa);

            if ($penyewa) {

                $mobil = Mobil::whereHas('penyewa_detail', function ($query) use ($id) {

                    $query->where('penyewa_id', $id);
                })->first();

                $validatedDataTabelMobil['status_penyewaan'] = 'Belum_Disewa';

                $mobil->update($validatedDataTabelMobil);

                if ($mobil) {

                    return redirect()->route('penyewa')->with('status', 'success')->with('message', 'Berhasil Membatalkan Penyewaan');
                }
            }
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }
}
