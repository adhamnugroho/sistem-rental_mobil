<?php

namespace App\Http\Controllers;

use App\Models\Perental;
use App\Models\Users;
use Illuminate\Http\Request;
use Throwable;

class PerentalController extends Controller
{
    protected $judul = 'Perental';
    protected $menu = 'perental';
    protected $sub_menu = 'data_perental';
    protected $directory = 'admin.perental.data_perental';


    public function index()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['perental'] = Perental::with(['users'])
            ->orderBy('created_at', 'ASC')
            ->get();


        return view($this->directory . ".main", $data);
    }


    public function create()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['users'] = Users::where('level_user', 'Pengguna')
            ->where('status_pengguna', 'Aktif')
            ->get();


        if ($data['users']->isEmpty()) {

            return back()->withInput()->with('status', 'error')->with('message', 'Tidak ada user yang status_penggunanya Aktif');
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
                'users_id' => 'required|unique:perental',
            ]);


            if (empty($request->keterangan)) {

                $validatedData['keterangan'] = '-';

                $validatedData['status_perental'] = 'Aktif';
            } else {

                $request->validate([
                    'keterangan' => 'required|string',
                ]);

                $validatedData['keterangan'] = $request->keterangan;

                $validatedData['status_perental'] = 'Aktif';
            }



            // dd($validatedData);

            $perental = Perental::create($validatedData);

            // dd($perental == true);

            if ($perental) {

                $users = Users::where('id', $request->users_id)->first();

                $users->status_akun = 'Perental';

                $users->save();


                return redirect()->route('perental')->with('status', 'success')->with('message', 'Berhasil Menambah Perental');
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

        $data['users'] = Users::all();
        $data['perental'] = Perental::where('id_perental', $id)->first();


        return view($this->directory . ".show", $data);
    }


    public function edit($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['users'] = Users::all();
        $data['perental'] = Perental::where('id_perental', $id)->first();


        return view($this->directory . ".edit", $data);
    }


    public function update($id, Request $request)
    {

        // return $request->all();


        try {

            $perental = Perental::where('id_perental', $id)->first();

            // dd($perental);


            // Memasukkan request ke dalam variabel

            // $validatedData = $request->validate([
            //     'users_id' => 'required',
            // ]);


            if (empty($request->keterangan)) {

                $validatedData['keterangan'] = '-';
            } else {

                $request->validate([
                    'keterangan' => 'required|string',
                ]);

                $validatedData['keterangan'] = $request->keterangan;
            }

            $validatedData['status_perental'] = $request->status_perental;

            // dd($validatedData);

            $perental->update($validatedData);

            return redirect()->route('perental')->with('status', 'success')->with('message', 'Berhasil Mengedit Data Perental');
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function destroy($id)
    {

        try {

            $perental = Perental::where('id_perental', $id)->first();

            // dd($perental);

            $perental->delete();

            // dd($perental);

            if ($perental) {

                $users = Users::where('id', $perental->users_id)->first();

                $users->status_akun = 'Penyewa';

                $users->save();

                return redirect()->route('perental')->with('status', 'success')->with('message', 'Berhasil Menghapus Data');
            }
        } catch (\Throwable $th) {
            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }
}
