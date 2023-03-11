<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UsersController extends Controller
{
    protected $judul = 'Users';
    protected $menu = 'users';
    protected $sub_menu = '';
    protected $directory = 'admin.users';


    public function index()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;
        $data['users'] = Users::where('level_user', 'Pengguna')->get();


        return view($this->directory . ".main", $data);
    }


    public function create()
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kabupaten'] = Kabupaten::where('id_provinsi', '35')->get();

        return view($this->directory . ".add", $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        // return $request->all();

        try {

            // Memasukkan request ke dalam variabel

            $validatedData = $request->validate([
                'nama_lengkap' => 'required',
                'username' => 'required|unique:users|max:50',
                'email' => 'required|unique:users|email:rfc',
                'password' => 'required|min:8',
                'no_telp' => 'required|max:15',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'umur' => 'required|numeric',
                'domisili_sekarang' => 'required',
                'alamat_lengkap' => 'required',
            ]);

            // password
            $validatedData['password'] = Hash::make($request->password);

            // level and status
            $validatedData['status_akun'] = 'Penyewa';
            $validatedData['status_pengguna'] = 'Aktif';
            $validatedData['level_user'] = 'Pengguna';


            $users = Users::create($validatedData);

            // dd($users);

            if (Auth::check()) {
                return redirect()->route('users')->with('status', 'success')->with('message', 'Berhasil Menambah User');
            } else {
                return redirect()->route('login')->with('status', 'success')->with('message', 'Berhasil Registrasi Data User');
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

        $data['kabupaten'] = Kabupaten::where('id_provinsi', '35')->get();
        $data['users'] = Users::where('id', $id)->first();


        return view($this->directory . ".show", $data);
    }


    public function edit($id)
    {

        $data['judul'] = $this->judul;
        $data['menu'] = $this->menu;
        $data['sub_menu'] = $this->sub_menu;

        $data['kabupaten'] = Kabupaten::where('id_provinsi', '35')->get();
        $data['users'] = Users::where('id', $id)->first();


        return view($this->directory . ".edit", $data);
    }


    public function update($id, Request $request)
    {

        // return $request->all();


        try {

            $users = Users::where('id', $id)->first();


            // Memasukkan request ke dalam variabel

            $validatedData = $request->validate([
                'nama_lengkap' => 'required',
                'username' => 'required|max:50',
                'email' => 'required',
                'no_telp' => 'required|max:15',
                'tempat_lahir' => 'required',
                'tanggal_lahir' => 'required|date',
                'umur' => 'required|numeric',
                'domisili_sekarang' => 'required',
                'alamat_lengkap' => 'required',
                'status_akun' => 'required',
                'status_pengguna' => 'required',
            ]);


            // dd($request->username != $users->username);

            // username dan email (unique validation)
            if ($request->username != $users->username) {

                $request->validate([
                    'username' => 'required|unique:users|max:50',
                ]);
            }

            if ($request->email != $users->email) {

                $request->validate([
                    'email' => 'required|unique:users|email:rfc',
                ]);
            }


            // password (opsional)
            if (empty($request->password)) {

                $validatedData['password'] = $users->password;
            } else {

                $validatedData['password'] = Hash::make($request->password);
            }

            // level and status
            $validatedData['level_user'] = 'Pengguna';

            $users->update($validatedData);

            return redirect()->route('users')->with('status', 'success')->with('message', 'Berhasil Mengedit Data User');
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function destroy($id)
    {
        // dd($users);

        try {

            $users = Users::where('id', $id)->first();

            // dd($users);

            $users->delete();

            return redirect()->route('users')->with('status', 'success')->with('message', 'Berhasil Menghapus Data');
        } catch (\Throwable $th) {
            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }


    public function getKabupaten(Request $request)
    {

        // return $request->id_provinsi;

        $kabupaten = Kabupaten::where('id_provinsi', $request->id_provinsi)->get();


        if ($kabupaten->count() > 0) {

            return ['status' => 'success', 'code' => 200, "message" => 'Berhasil Mengambil Data', 'data' => $kabupaten];
        } else {

            return ['status' => 'error', 'code' => 500, "message" => 'Gagal Mengambil Data', 'data' => $kabupaten];
        }
    }
}
