<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\Perental;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Throwable;

class MobilController extends Controller
{
    protected $judul = 'Mobil';
    protected $menu = 'perental';
    protected $sub_menu = 'mobil';
    protected $directory = 'admin.perental.mobil';


    public function index()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['mobil'] = Mobil::with([

            'perental' => function ($pr) {

                $pr->with(['users']);
            }
        ])
            ->orderBy('created_at', 'ASC')
            ->get();

        // dd($data['mobil']);


        return view($this->directory . ".main", $data);
    }


    public function create()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['perental'] = Perental::with([

            'users' => function ($query) {

                $query->where('status_pengguna', 'Aktif');
            }
        ])
            ->where('status_perental', 'Aktif')
            ->get();


        if ($data['perental']->isEmpty()) {

            return back()->withInput()->with('status', 'error')->with('message', 'Tidak ada data user yang status_perental / status_penggunanya aktif');
        } else {

            return view($this->directory . ".add", $data);
        }
    }


    public function store(Request $request)
    {

        // return $request->all();

        try {

            // Memasukkan request ke dalam variabel

            $validatedData = $request->validate([
                'perental_id' => 'required',
                'jenis_mobil' => 'required',
                'plat_nomor' => 'required|uppercase',
                'warna' => 'required',
                'tanggal_didaftarkan' => 'required|date',
                'harga' => 'required|min:6',
            ]);

            // dd($validatedData);


            // Slug
            $usersSlug = Users::whereHas('perental', function ($query) use ($request) {
                $query->where('id_perental', "$request->perental_id");
            })->first();

            $dataRawSlug = $validatedData['jenis_mobil'] . ' ' . $usersSlug->nama_lengkap . ' ' .  $validatedData['plat_nomor'];

            $validatedData['slug_jenis_mobil'] = Str::slug($dataRawSlug);
            // dd($validatedData['slug']);


            // Tanggal terakhir direntalkan
            $validatedData['tanggal_terakhir_dirental'] = '0000-00-00';


            // deskripsi_mobil
            if (empty($request->deskripsi_mobil)) {

                $validatedData['deskripsi_mobil'] = '-';
            } else {

                $request->validate([
                    'deskripsi_mobil' => 'required',
                ]);

                $validatedData['deskripsi_mobil'] = $request->deskripsi_mobil;
            }


            // Foto Mobil
            if ($request->file('foto_mobil')) {

                $request->validate([
                    'foto_mobil' => 'required|mimetypes:image/png,image/jpeg,image/webp,image/svg+xml',
                ]);


                $validatedData['foto_mobil'] = Storage::disk('public')->put('foto_produk', $request->file('foto_mobil'));
            }


            // Status
            $validatedData['status_penyewaan'] = 'Belum_Disewa';
            $validatedData['status_penggunaan_mobil'] = 'Aktif';


            $mobil = Mobil::create($validatedData);


            return redirect()->route('mobil')->with('status', 'success')->with('message', 'Berhasil Menambah Data Mobil');
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function show($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['perental'] = Perental::with([

            'users',
        ])->get();

        $data['mobil'] = Mobil::where('id_mobil', $id)->first();


        if ($data['perental']->isEmpty()) {

            return back()->withInput()->with('status', 'error')->with('message', 'Tidak ada data Perental');
        } else if ($data['mobil']->count() == 0) {

            return back()->withInput()->with('status', 'error')->with('message', 'Tidak ada data Mobil');
        } else {

            return view($this->directory . ".show", $data);
        }
    }


    public function edit($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['perental'] = Perental::with([

            'users' => function ($query) {

                $query->where('status_pengguna', 'Aktif');
            }
        ])
            ->where('status_perental', 'Aktif')
            ->get();

        $data['mobil'] = Mobil::where('id_mobil', $id)->first();


        if ($data['perental']->isEmpty()) {

            return back()->withInput()->with('status', 'error')->with('message', 'Tidak ada data Perental');
        } else if ($data['mobil']->count() == 0) {

            return back()->withInput()->with('status', 'error')->with('message', 'Tidak ada data Mobil');
        } else {

            return view($this->directory . ".edit", $data);
        }
    }


    public function update($id, Request $request)
    {

        // return $request->all();

        try {

            $mobil = Mobil::where('id_mobil', $id)->first();

            // Memasukkan request ke dalam variabel

            $validatedData = $request->validate([
                'perental_id' => 'required',
                'jenis_mobil' => 'required',
                'plat_nomor' => 'required|uppercase',
                'warna' => 'required',
                'tanggal_didaftarkan' => 'required|date',
                'harga' => 'required|min:6',
                'status_penggunaan_mobil' => 'required',
            ]);


            // Slug
            $usersSlug = Users::whereHas('perental', function ($query) use ($request) {
                $query->where('id_perental', "$request->perental_id");
            })->first();

            $dataRawSlug = $validatedData['jenis_mobil'] . ' ' . $usersSlug->nama_lengkap . ' ' .  $validatedData['plat_nomor'];

            $validatedData['slug_jenis_mobil'] = Str::slug($dataRawSlug);


            // deskripsi_mobil
            if (empty($request->deskripsi_mobil)) {

                $validatedData['deskripsi_mobil'] = '-';
            } else {

                $request->validate([
                    'deskripsi_mobil' => 'required',
                ]);

                $validatedData['deskripsi_mobil'] = $request->deskripsi_mobil;
            }


            // Foto Mobil
            if ($request->file('foto_mobil')) {

                $foto_mobil_lama = $mobil->foto_mobil;

                if (!is_null($foto_mobil_lama) && !empty($foto_mobil_lama)) {

                    Storage::disk('public')->delete($foto_mobil_lama);
                }

                $request->validate([
                    'foto_mobil' => 'required|mimetypes:image/png,image/jpeg,image/webp,image/svg+xml',
                ]);


                $validatedData['foto_mobil'] = Storage::disk('public')->put('foto_produk', $request->file('foto_mobil'));
            }


            // dd($validatedData);

            $mobil->update($validatedData);


            return redirect()->route('mobil')->with('status', 'success')->with('message', 'Berhasil Mengupdate Data Mobil');
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function destroy($id)
    {
        try {

            $mobil = Mobil::where('id_mobil', $id)->first();

            // Foto Mobil

            $foto_mobil = $mobil->foto_mobil;

            if (!is_null($foto_mobil) && !empty($foto_mobil)) {

                Storage::disk('public')->delete($foto_mobil);
            }

            $mobil->delete();


            return redirect()->route('mobil')->with('status', 'success')->with('message', 'Berhasil Menghapus Data Mobil');
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }
}
