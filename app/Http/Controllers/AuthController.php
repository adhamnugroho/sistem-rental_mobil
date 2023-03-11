<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;

class AuthController extends Controller
{
    protected $judul = 'Autentikasi';
    protected $direktori = 'auth';


    public function main(Request $request)
    {

        $data['judul'] = $this->judul;

        return view($this->direktori . ".login", $data);
    }


    public function postLogin(Request $request)
    {

        // return $request->all();

        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $username = $credentials['username'];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            if (Auth::user()->level_user == 'Admin') {
                return redirect()->route('dashboard')
                ->with('status', 'success')
                ->with('message', 'Selamat Datang ' . $username . '!');
            } else {
                return redirect()->route('userDashboard')
                ->with('status', 'success')
                ->with('message', 'Selamat Datang ' . $username . '!');
            }
        } else {

            return redirect()->route('login')
            ->with('status', 'error')
            ->with('message', 'Username atau Password Salah!');
        }
    }


    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')
        ->with('status', 'success')
        ->with('message', 'Berhasil Logout');
    }


    public function register()
    {

        $data['judul'] = $this->judul;

        $data['kabupaten'] = Kabupaten::where('id_provinsi', '35')->get();

        $tahun_ini = Carbon::now()->format('Y');
        $data['tahun_ini'] = $tahun_ini;

        return view($this->direktori . ".register", $data);
    }

    public function registerStore(Request $request)
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

            return redirect()->route('login')->with('status', 'success')->with('message', 'Berhasil Registrasi Data User');
        } catch (Throwable $th) {

            return back()->withInput()->with('status', 'error')->with('message', $th->getMessage());
        }
    }
}
