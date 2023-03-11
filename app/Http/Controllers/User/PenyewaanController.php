<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use App\Models\Mobil;
use App\Models\Penyewa;
use App\Models\PenyewaDetail;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class PenyewaanController extends Controller
{
    protected $judul = 'Penyewaan';
    protected $menu = 'penyewaan';
    protected $sub_menu = 'peyewaan';
    protected $directory = 'user.penyewaan';


    public function index($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['mobil'] = Mobil::with([

            'perental' => function ($pr) {

                $pr->with(['users']);
            }
        ])
            ->where('id_mobil', $id)
            ->first();

        $mobil = Mobil::whereHas('perental.users', function ($us) {
            $us->whereNotIn('nama_lengkap', ['Pengguna', 'Guest', 'Guest_Perental']);
        })->get();

        $data['jumlah_mobil'] = count($mobil);

        $data['lama_berdiri'] = (Carbon::now()->format('Y')) - 2022;
        $data['jumlah_penyewaan'] = count(PenyewaDetail::all());

        $users = Users::whereNotIn('nama_lengkap', ['Pengguna', 'Guest', 'Guest_Perental'])
            ->get();
        $data['jumlah_users'] = count($users);

        $data['jumlah_cabang'] = count(Kabupaten::where('id_provinsi', 35)->get());

        // dd($data['mobil']);


        return view($this->directory . ".main", $data);
    }

    public function hitungPenyewaanAjax(Request $request)
    {

        // total_harga
        $tanggal_awal = new Carbon($request->tanggal_penyewaan);
        $tanggal_akhir = new Carbon($request->tanggal_pengembalian);

        $jarak_hari = $tanggal_awal->diffInDays($tanggal_akhir) + 1;
        $harga_penyewaan_hari = $jarak_hari * 500000;

        $mobil = Mobil::where('id_mobil', $request->mobil_id)->first();
        $harga_mobil = $mobil->harga;

        $harga_penyewaan_total = $harga_penyewaan_hari + $harga_mobil;

        return response()->json(['status' => 'ditemukan', 'harga_total_penyewaan' => $harga_penyewaan_total]);
    }


    public function storePenyewaan(Request $request)
    {

        // return $request->all();

        try {

            // user_yang_menyewa
            $validatedDataTabelPenyewa['users_id'] = Auth::id();


            // status tabel penyewa
            $validatedDataTabelPenyewa['status_pembayaran_penyewa'] = 'Belum-Selesai';
            $validatedDataTabelPenyewa['status_pembayaran_perental'] = 'Belum-Selesai';

            // Pengecekan mobil untuk status penyewaan
            $id_mobil = $request->validate([
                'mobil_id' => 'required',
            ]);

            $riwayat_penyewaan = Penyewa::whereHas('penyewa_detail', function ($pd) use ($id_mobil) {

                $pd->where('mobil_id', $id_mobil);
            })
                ->get();


            if ($riwayat_penyewaan != null && count($riwayat_penyewaan) != 0) {

                foreach ($riwayat_penyewaan as $rp) {

                    $riwayat_penyewaan_status = $rp->status_penyewaan;

                    if ($riwayat_penyewaan_status != 'Selesai' && $riwayat_penyewaan_status != 'Berjalan' && $riwayat_penyewaan_status != 'Dibatalkan' && $riwayat_penyewaan_status != 'Mobil_Sudah_Datang' && $riwayat_penyewaan_status != 'Mobil_Belum_Datang') {

                        $validatedDataTabelPenyewa['status_penyewaan'] = 'Mobil_Sudah_Datang';

                        $waktu_mobil_datang = Carbon::now()->format('Y-m-d H:i:s');
                        $validatedDataTabelPenyewa['waktu_mobil_datang'] = $waktu_mobil_datang;
                    } else {

                        $validatedDataTabelPenyewa['status_penyewaan'] = 'Mobil_Belum_Datang';
                    }
                }
            } else {

                $validatedDataTabelPenyewa['status_penyewaan'] = 'Mobil_Belum_Datang';
            }

            // dd($validatedDataTabelPenyewa);


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
                $kabupaten = Kabupaten::whereHas('users_tempat_lahir', function ($query) use ($request) {

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

                    $validatedDataTabelMobil['status_penyewaan'] = 'Sudah_Disewa';

                    $mobil->update($validatedDataTabelMobil);

                    if ($mobil) {

                        $penyewa = Penyewa::with([

                            'penyewa_detail' => function ($pd) {

                                $pd->with(['kabupaten']);
                            }
                        ])
                            ->orderBy('id_penyewa', 'DESC')
                            ->first();

                        // Kode Invoice
                        $waktu_pembuatan_transaksi = Carbon::createFromFormat('Y-m-d H:i:s', $penyewa->created_at)->toDateString();
                        $waktu_pembuatan_transaksi = str_replace("-", "", $waktu_pembuatan_transaksi);

                        $kabupaten = $penyewa->penyewa_detail[0]->kabupaten->id_kabupaten;
                        $provinsi = $penyewa->penyewa_detail[0]->kabupaten->id_provinsi;
                        $id_penyewa = $penyewa->id_penyewa;

                        $validatedDataTabelPenyewa1['kode_invoice'] = 'INV-' . $waktu_pembuatan_transaksi . "-" . $kabupaten . "-" . $provinsi . "-" . $id_penyewa;

                        // dd($validatedDataTabelPenyewa1);

                        $penyewa->update($validatedDataTabelPenyewa1);

                        // dd($penyewa);

                        if ($penyewa) {

                            $penyewa = Penyewa::orderBy('id_penyewa', 'DESC')->first();

                            return redirect()->route('userPenyewaanBerhasil', ['id' => $penyewa->id_penyewa]);
                        }
                    }
                }
            }
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function penyewaanBerhasil(Request $request)
    {

        // return $request->all();

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['penyewa'] = Penyewa::with([

            'penyewa_detail' => function ($query) {

                $query->with([
                    'kabupaten',
                    'mobil' => function ($mb) {

                        $mb->with([

                            'perental' => function ($pr) {

                                $pr->with([

                                    'users' => function ($us) {

                                        $us->with([

                                            'tempat_lahir',
                                            'domisili_sekarang'
                                        ]);
                                    }
                                ]);
                            }
                        ]);
                    }
                ]);
            },
            'users',
        ])
            ->where('id_penyewa', $request->id)
            ->first();

        $penyewa =
            Penyewa::with([

                'penyewa_detail' => function ($query) {

                    $query->with([
                        'kabupaten',
                        'mobil' => function ($mb) {

                            $mb->with([

                                'perental' => function ($pr) {

                                    $pr->with([

                                        'users' => function ($us) {

                                            $us->with([

                                                'tempat_lahir',
                                                'domisili_sekarang'
                                            ]);
                                        }
                                    ]);
                                }
                            ]);
                        }
                    ]);
                },
                'users',
            ])
            ->where('id_penyewa', $request->id)
            ->first();

        $data['tanggal_penyewaan'] = Carbon::parse($penyewa->penyewa_detail[0]->tanggal_penyewaan)->format('d-m-Y');


        return view($this->directory . ".tempatAdmin", $data);
    }
}
