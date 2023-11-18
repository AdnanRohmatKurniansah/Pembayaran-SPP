<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }
    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'nis' => 'required|max:10',
            'password' => 'required|max:32'
        ]);

        $siswa = Siswa::where('nis', $data['nis'])->first();
        $petugas = Petugas::where('username', $data['nis'])->first();

        if ($siswa) {
            $guard = 'siswa';
            $credentials = [
                'nis' => $siswa->nis,
                'password' => $data['password'],
            ];
            $redirectPath = '/dashboard/pembayaranmu';
        } elseif ($petugas) {
            $guard = 'petugas';
            $credentials = [
                'username' => $petugas->username,
                'password' => $data['password'],
            ];
            $redirectPath = '/dashboard';
        } else {
            return back()->with('error', 'NISN atau Username atau Password salah');
        }

        if (Auth::guard($guard)->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect($redirectPath)->with('success', 'Berhasil login');
        }

        return back()->with('error', 'NISN atau Username atau Password salah');
    }

    public function logout() {
        if (Auth::guard('siswa')->check() || Auth::guard('petugas')->check()) {
            Auth::logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();
        }
    
        return redirect('/')->with('info', 'Berhasil logout');
    }
    
    public function ubahPassword(Request $request) {
        $data = $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
        ]);

        if(Auth::guard('siswa')->check()) {
            if(!Hash::check($data['password_lama'], Auth::guard('siswa')->user()->password)){
                return back()->with('error', 'Password lama salah!');
            } else {
                Siswa::whereId(Auth::guard('siswa')->user()->id)->update([
                    'password' => Hash::make($data['password_baru'])
                ]);
    
                return back()->with('info', 'Password berhasil diubah!');
            }
        } else {
            if(!Hash::check($data['password_lama'], Auth::guard('petugas')->user()->password)){
                return back()->with('error', 'Password lama salah!');
            } else {
                Petugas::whereId(Auth::guard('petugas')->user()->id)->update([
                    'password' => Hash::make($data['password_baru'])
                ]);
    
                return back()->with('info', 'Password berhasil diubah!');
            }
        }
    }
}
