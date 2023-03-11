<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\KasAdmin;
use App\Models\KasAsuransi;
use App\Models\Mobil;
use App\Models\Penyewa;
use App\Models\PenyewaDetail;
use App\Models\Perental;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Throwable;

class TransaksiPerentalController extends Controller
{
    protected $judul = 'Transaksi Perental';
    protected $menu = 'transaksi';
    protected $sub_menu = 'transaksi_perental';
    protected $directory = 'admin.transaksi.transaksi_perental';


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
        ])
            ->orderBy('id_penyewa', 'DESC')
            ->get();



        return view($this->directory . ".main", $data);
    }


    public function show($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['users'] = Users::where('level_user', 'Pengguna')
        ->where('status_pengguna', 'Aktif')
        ->where('status_akun', 'Perental')
        ->whereNotIn('nama_lengkap', ['Pengguna'])
        ->get();


        $data['perental'] = Perental::with([

            'users'
        ])
            ->whereHas('mobil.penyewa_detail.penyewa', function ($pny) use ($id) {

                $pny->where('id_penyewa', $id);
            })
            ->first();

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


        // Pencarian data beberapa penyewaan yang status_pembayaran_perentalnya 'Belum_Selesai'
        $perental_terkait = Perental::whereHas('mobil.penyewa_detail.penyewa', function ($pny) use ($id) {

            $pny->where('id_penyewa', $id);
        })->first();
        $penyewa = Penyewa::whereHas('penyewa_detail.mobil.perental', function ($pny) use ($perental_terkait) {

            $pny->where('id_perental', $perental_terkait->id_perental);
        })
            ->where('status_penyewaan', '!=', 'Dibatalkan')
            ->where('status_pembayaran_perental', 'Belum-Selesai')
            ->get();

        // Jika ditemukan beberapa data penyewaan yang belum selesai, maka jumlah_pembayaran_belum_selesai-nya Lebih dari 1
        if (count($penyewa) > 1) {

            $data['jumlah_penyewaan_belum_selesai'] = 'Lebih dari 1';
        } else if (count($penyewa) == 1) {

            $data['jumlah_penyewaan_belum_selesai'] = 'Cuma 1';
        } else {

            $data['jumlah_penyewaan_belum_selesai'] = 'Tidak Ada';
        }


        // Pencarian data beberapa penyewaan yang waktu_pembayaran_perental dan waktu_mobil_dibawa_perental sama
        $penyewa_waktu_pembayaran = Penyewa::whereHas('penyewa_detail.mobil.perental', function ($pny) use ($perental_terkait) {

            $pny->where('id_perental', $perental_terkait->id_perental);
        })
            ->where('status_penyewaan', '!=', 'Dibatalkan')
            ->get();

        // Data penyewa sekarang 
        $penyewaan_terkait = Penyewa::with([

            'penyewa_detail' => function ($pnydt) {

                $pnydt->with('kabupaten');
            },
        ])
            ->where('id_penyewa', $id)
            ->first();
        $waktu_pembayaran_perental_terkait_penyewa = $penyewaan_terkait->waktu_pembayaran_perental;
        $waktu_mobil_dibawa_perental_terkait_penyewa = $penyewaan_terkait->waktu_mobil_dibawa_perental;


        // pencarian data penyewaan yang sama
        $id_penyewaan_array = [];
        foreach ($penyewa_waktu_pembayaran as $key => $pnytrp) {

            $id_penyewaan_untuk_array = $pnytrp->id_penyewa;

            $waktu_mobil_dibawa_perental_terkait_perental = $pnytrp->waktu_mobil_dibawa_perental;
            $waktu_pembayaran_perental_terkait_perental = $pnytrp->waktu_pembayaran_perental;

            if ($waktu_mobil_dibawa_perental_terkait_perental == $waktu_mobil_dibawa_perental_terkait_penyewa && $waktu_pembayaran_perental_terkait_perental == $waktu_pembayaran_perental_terkait_penyewa) {

                $id_penyewaan_array[] = $id_penyewaan_untuk_array;
            }
        }

        // pengkondisian
        if (count($id_penyewaan_array) > 1) {

            $data['jumlah_penyewaan_yang_waktunya_sama'] = 'Lebih dari 1';
        } else if (count($id_penyewaan_array) == 1) {

            $data['jumlah_penyewaan_yang_waktunya_sama'] = 'Cuma 1';
        } else {

            $data['jumlah_penyewaan_yang_waktunya_sama'] = 'Tidak ada';
        }

        // dd($data);


        return view($this->directory . ".show", $data);
    }


    public function mobilSudahDatang($id)
    {

        try {

            $penyewa = Penyewa::where('id_penyewa', $id)->first();

            // dd($penyewa);

            // status tabel penyewa
            $validatedDataTabelPenyewa['status_penyewaan'] = 'Mobil_Sudah_Datang';

            // waktu
            $waktu_mobil_datang = Carbon::now()->format('Y-m-d H:i:s');
            $validatedDataTabelPenyewa['waktu_mobil_datang'] = $waktu_mobil_datang;


            $penyewa->update($validatedDataTabelPenyewa);

            // dd($penyewa);

            if ($penyewa) {

                return redirect()->route('transaksiPerental')->with('status', 'success')->with('message', 'Berhasil Mengganti Status Penyewaan');
            }
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function selesaiSemua($id)
    {

        try {

            // Pencarian data beberapa penyewaan yang status_pembayaran_perentalnya 'Belum_Selesai'
            $penyewa = Penyewa::whereHas('penyewa_detail.mobil.perental', function ($pny) use ($id) {

                $pny->where('id_perental', $id);
            })
                ->where('status_penyewaan', '!=', 'Dibatalkan')
                ->where('status_pembayaran_perental', 'Belum-Selesai')
                ->get();

            $jumlah = count($penyewa);
            $jumlahLoop = 0;

            // dd($penyewa);

            foreach ($penyewa as $key => $pny) {
                // status tabel penyewa
                $validatedDataTabelPenyewa['status_penyewaan'] = 'Selesai';
                $validatedDataTabelPenyewa['status_pembayaran_perental'] = 'Selesai';

                // waktu
                $waktu = Carbon::now()->format('Y-m-d H:i:s');
                $validatedDataTabelPenyewa['waktu_pembayaran_perental'] = $waktu;
                $validatedDataTabelPenyewa['waktu_mobil_dibawa_perental'] = $waktu;

                $pny->update($validatedDataTabelPenyewa);

                $jumlahLoop++;

                if ($penyewa && $jumlahLoop == $jumlah) {

                    return redirect()->route('transaksiPerental')->with('status', 'success')->with('message', 'Berhasil Menyelesaikan Beberapa Penyewaan');
                }
            }
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function selesaiSatu($id)
    {

        try {

            $penyewa = Penyewa::where('id_penyewa', $id)->first();

            // status tabel penyewa
            $validatedDataTabelPenyewa['status_penyewaan'] = 'Selesai';
            $validatedDataTabelPenyewa['status_pembayaran_perental'] = 'Selesai';

            // waktu
            $waktu = Carbon::now()->format('Y-m-d H:i:s');
            $validatedDataTabelPenyewa['waktu_pembayaran_perental'] = $waktu;
            $validatedDataTabelPenyewa['waktu_mobil_dibawa_perental'] = $waktu;


            $penyewa->update($validatedDataTabelPenyewa);

            if ($penyewa) {

                return redirect()->route('transaksiPerental')->with('status', 'success')->with('message', 'Berhasil Menyelesaikan Penyewaan');
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

                    return redirect()->route('transaksiPerental')->with('status', 'success')->with('message', 'Berhasil Membatalkan Penyewaan');
                }
            }
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function printBanyak($id, Request $request)
    {

        // return $request->all();

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        // Data Perental
        $perental_terkait = Perental::with([
            'users'
        ])
            ->where('id_perental', $id)
            ->first();
        $penyewa_terkait_perental = Penyewa::whereHas("penyewa_detail.mobil.perental", function ($prnt) use ($perental_terkait) {

            $prnt->where("id_perental", $perental_terkait->id_perental);
        })
            ->get();

        // Data penyewa sekarang 
        $penyewaan_terkait = Penyewa::with([

            'penyewa_detail' => function ($pnydt) {

                $pnydt->with('kabupaten');
            },
        ])
            ->where('id_penyewa', $request->id_penyewa)
            ->first();
        $waktu_pembayaran_perental_terkait_penyewa = $penyewaan_terkait->waktu_pembayaran_perental;
        $waktu_mobil_dibawa_perental_terkait_penyewa = $penyewaan_terkait->waktu_mobil_dibawa_perental;


        // pencarian data penyewaan yang sama
        $id_penyewaan_array = [];
        foreach ($penyewa_terkait_perental as $key => $pnytrp) {

            $id_penyewaan_untuk_array = $pnytrp->id_penyewa;

            $waktu_mobil_dibawa_perental_terkait_perental = $pnytrp->waktu_mobil_dibawa_perental;
            $waktu_pembayaran_perental_terkait_perental = $pnytrp->waktu_pembayaran_perental;

            if ($waktu_mobil_dibawa_perental_terkait_perental == $waktu_mobil_dibawa_perental_terkait_penyewa && $waktu_pembayaran_perental_terkait_perental == $waktu_pembayaran_perental_terkait_penyewa) {

                $id_penyewaan_array[] = $id_penyewaan_untuk_array;
            }
        }



        $data['kode_invoice'] = $penyewaan_terkait->kode_invoice;
        $data['nama_perental'] = $perental_terkait->users->nama_lengkap;
        $data['tempat_penyewaan'] = $penyewaan_terkait->penyewa_detail[0]->kabupaten->nama_kabupaten;

        // Data penyewaan untuk foreach tabel invoice
        $data['penyewa'] = Penyewa::with([

            'penyewa_detail' => function ($pd) {

                $pd->with([

                    'mobil',
                ]);
            },
            'users' => function ($us) {

                $us->with([
                    'tempat_lahir',
                    'domisili_sekarang',
                ]);
            },
        ])
            ->whereIn('id_penyewa', $id_penyewaan_array)
            ->get();



        $penyewa_detail_penyewaan_ini = PenyewaDetail::with([

            'penyewa' => function ($pny) {

                $pny->with([
                    'kas_admin',
                    'kas_asuransi',
                ]);
            }
        ])
            ->whereHas('penyewa', function ($pny) use ($id_penyewaan_array) {

                $pny->whereIn('id_penyewa', $id_penyewaan_array);
            })
            ->get();

        $kas_asuransi_penyewaan_ini = KasAsuransi::whereHas('penyewa', function ($pny) use ($id_penyewaan_array) {

            $pny->whereIn('id_penyewa', $id_penyewaan_array);
        })
            ->get();

        $kas_admin_penyewaan_ini = KasAdmin::whereHas('penyewa', function ($pny) use ($id_penyewaan_array) {

            $pny->whereIn('id_penyewa', $id_penyewaan_array);
        })
            ->get();


        // perhitungan total harga penyewaan
        $total_harga_penyewaan_ini = $penyewa_detail_penyewaan_ini->sum('total_harga');
        $data['total_harga'] = $total_harga_penyewaan_ini;

        // Perhitungan total uang bersih perental
        $total_uang_bersih_penyewaan_ini = $penyewa_detail_penyewaan_ini->sum('total_uang_bersih_perental');
        $data['total_uang_bersih_perental'] = $total_uang_bersih_penyewaan_ini;

        // Perhitungan total kas_asuransi_masuk
        $total_kas_asuransi_masuk_penyewaan_ini = $kas_asuransi_penyewaan_ini->sum('kas_asuransi_masuk');
        $data['total_kas_asuransi_masuk'] = $total_kas_asuransi_masuk_penyewaan_ini;

        // Perhitungan total kas_admin_masuk
        $total_kas_admin_masuk_penyewaan_ini = $kas_admin_penyewaan_ini->sum('kas_admin_masuk');
        $data['total_kas_admin_masuk'] = $total_kas_admin_masuk_penyewaan_ini;

        // Tanggal dan tahun pembayaran penyewaan untuk perental 
        $tanggal_pembayaran_penyewaan = Carbon::createFromFormat('Y-m-d H:i:s', $penyewaan_terkait->waktu_pembayaran_perental)->format('d-m-Y');
        $data['tanggal_pembayaran_penyewa'] = $tanggal_pembayaran_penyewaan;

        $tahun_print_penyewaan = Carbon::now()->format('Y');
        $data['tahun_print_penyewa'] = $tahun_print_penyewaan;

        // Status_pembayaran
        if ($penyewaan_terkait->status_pembayaran_perental == 'Selesai') {

            $data['status_pembayaran'] = 'Lunas';
        } else {

            $data['status_pembayaran'] = 'Belum-Lunas';
        }


        return view($this->directory . ".printBanyak", $data);
    }


    public function printSatu($id, Request $request)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        // Data Perental
        $perental_terkait = Perental::with([
            'users'
        ])
            ->where('id_perental', $id)
            ->first();

        // Data penyewa sekarang 
        $penyewaan_terkait = Penyewa::with([

            'penyewa_detail' => function ($pnydt) {

                $pnydt->with('kabupaten');
            },
        ])
            ->where('id_penyewa', $request->id_penyewa)
            ->first();




        // Data perental untuk foreach tabel invoice
        $data['penyewa'] = Penyewa::with([

            'penyewa_detail' => function ($pd) {

                $pd->with([

                    'mobil',
                ]);
            },
            'users' => function ($us) {

                $us->with([
                    'tempat_lahir',
                    'domisili_sekarang',
                ]);
            },
        ])
            ->where('id_penyewa', $penyewaan_terkait->id_penyewa)
            ->first();


        $data['kode_invoice'] = $penyewaan_terkait->kode_invoice;
        $data['nama_perental'] = $perental_terkait->users->nama_lengkap;
        $data['tempat_penyewaan'] = $penyewaan_terkait->penyewa_detail[0]->kabupaten->nama_kabupaten;

        // Data penyewaan untuk foreach tabel invoice
        $data['penyewa'] = Penyewa::with([

            'penyewa_detail' => function ($pd) {

                $pd->with([

                    'mobil',
                ]);
            },
            'users' => function ($us) {

                $us->with([
                    'tempat_lahir',
                    'domisili_sekarang',
                ]);
            },
        ])
            ->where('id_penyewa', $penyewaan_terkait->id_penyewa)
            ->first();



        $penyewa_detail_penyewaan_ini = PenyewaDetail::with([

            'penyewa' => function ($pny) {

                $pny->with([
                    'kas_admin',
                    'kas_asuransi',
                ]);
            }
        ])
            ->whereHas('penyewa', function ($pny) use ($penyewaan_terkait) {

                $pny->where('id_penyewa', $penyewaan_terkait->id_penyewa);
            })
            ->first();

        $kas_asuransi_penyewaan_ini = KasAsuransi::whereHas('penyewa', function ($pny) use ($penyewaan_terkait) {

            $pny->where('id_penyewa', $penyewaan_terkait->id_penyewa);
        })
            ->first();

        $kas_admin_penyewaan_ini = KasAdmin::whereHas('penyewa', function ($pny) use ($penyewaan_terkait) {

            $pny->where('id_penyewa', $penyewaan_terkait->id_penyewa);
        })
            ->first();


        // perhitungan total harga penyewaan
        $total_harga_penyewaan_ini = $penyewa_detail_penyewaan_ini->total_harga;
        $data['total_harga'] = $total_harga_penyewaan_ini;

        // Perhitungan total uang bersih perental
        $total_uang_bersih_penyewaan_ini = $penyewa_detail_penyewaan_ini->total_uang_bersih_perental;
        $data['total_uang_bersih_perental'] = $total_uang_bersih_penyewaan_ini;

        // Perhitungan total kas_asuransi_masuk
        $total_kas_asuransi_masuk_penyewaan_ini = $kas_asuransi_penyewaan_ini->kas_asuransi_masuk;
        $data['total_kas_asuransi_masuk'] = $total_kas_asuransi_masuk_penyewaan_ini;

        // Perhitungan total kas_admin_masuk
        $total_kas_admin_masuk_penyewaan_ini = $kas_admin_penyewaan_ini->kas_admin_masuk;
        $data['total_kas_admin_masuk'] = $total_kas_admin_masuk_penyewaan_ini;

        // Tanggal dan tahun pembayaran penyewaan untuk perental 
        $tanggal_pembayaran_penyewaan = Carbon::createFromFormat('Y-m-d H:i:s', $penyewaan_terkait->waktu_pembayaran_penyewa)->format('d-m-Y');
        $data['tanggal_pembayaran_penyewa'] = $tanggal_pembayaran_penyewaan;

        $tahun_print_penyewaan = Carbon::now()->format('Y');
        $data['tahun_print_penyewa'] = $tahun_print_penyewaan;

        // Status_pembayaran
        if ($penyewaan_terkait->status_pembayaran_perental == 'Selesai') {

            $data['status_pembayaran'] = 'Lunas';
        } else {

            $data['status_pembayaran'] = 'Belum-Lunas';
        }


        return view($this->directory . ".printSatu", $data);
    }
}
