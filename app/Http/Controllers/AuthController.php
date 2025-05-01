<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view(
            'auth.login',
            [
                'title' => 'login'
            ]
        );
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $status = Auth::user()->status;

            switch ($status) {
                case 'nonAktif':
                    return redirect()
                        ->back()
                        ->with('error', 'Akun Anda belum diaktivasi. Silahkan tunggu admin mengaktivasi akun Anda.');

                case 'ditolak':
                    return redirect()
                        ->back()
                        ->with('error', 'Mohon maaf, pendaftaran Anda ditolak oleh admin.');

                case 'aktif':
                    if (Auth::user()->role === 'admin') {
                        return redirect()->route('admin-dashboard')->with('success', 'Login berhasil');
                    } else {
                        return redirect()->route('dashboard')->with('success', 'Login berhasil');
                    }

                default:
                    return redirect()
                        ->back()
                        ->with('error', 'Status akun tidak valid.');
            }

        } else {
            return redirect()
                ->back()
                ->with('error', 'Email atau password salah.');
        }
    }

    public function registrasi()
    {
        return view('auth.registrasi', [
            'title' => 'registrasi'
        ]);
    }

    public function registrasi_proses(Request $request)
    {
        $validated = $request->validate([
            'identitas' => 'required|unique:pengguna',
            'jenis_pengguna' => 'required',
            'email' => 'required|unique:pengguna|email',
            'nomor_telepon' => 'required|unique:pengguna',
            'nama' => 'required',
            'password' => 'required|confirmed',
            'jenis_kendaraan' => 'required',
            'no_plat' => 'required|unique:pengguna',
            'foto_kendaraan' => 'required|image|file|mimes:jpeg,png,jpg',
            'foto_pengguna' => 'required|image|file|mimes:jpeg,png,jpg',
        ], [
            'identitas.required' => 'Identitas wajib diisi',
            'jenis_pengguna.required' => 'Jenis pengguna wajib diisi',
            'nama.required' => 'Nama Lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'email.email' => 'Email harus diisi dengan format email',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi',
            'password.required' => 'Password wajib diisi',
            'jenis_kendaraan.required' => 'Jenis kendaraan harus diisi',
            'no_plat.required' => 'No Plat harus diisi',
            'foto_kendaraan.required' => 'Foto kendaraan harus diisi',
            'foto_kendaraan.mimes' => 'Foto kendaraan tidak sesuai format yang di tentukan',
            'foto_pengguna.required' => 'Foto pengguna harus diisi',
            'nama.required' => 'Nama Lengkap harus diisi',
            'identitas.unique' => 'Identitas sudah terdaftar',
            'no_plat.unique' => 'Nomor Plat sudah terdaftar',
            'nomor_telepon.unique' => 'no telepon sudah terdaftar',
            'foto_pengguna.mimes' => 'Foto pengguna tidak sesuai dengan format yang di tentukan'
        ]);

        $foto_kendaraan = $request->file('foto_kendaraan')->store('image/fotoKendaraan', 'public');
        $foto_pengguna = $request->file('foto_pengguna')->store('image/fotoPengguna', 'public');

        $store = [
            'identitas' => $validated['identitas'],
            'email' => $validated['email'],
            'nomor_telepon' => $validated['nomor_telepon'],
            'nama' => $validated['nama'],
            'jenis_pengguna' => $validated['jenis_pengguna'],
            'jenis_kendaraan' => $validated['jenis_kendaraan'],
            'no_plat' => $validated['no_plat'],
            'password' => Hash::make($validated['password']),
            'foto_pengguna' => $foto_pengguna,
            'foto_kendaraan' => $foto_kendaraan,
        ];

        $user = User::create($store);
        if ($user) {
            return redirect()->route('login')->with('success', 'Pendaftaran berhasil');
        } else {
            return back()->with('error', 'Pendaftaran gagal');
        }

    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('login')->with('succes', 'Logout Berhasil');
    }
}
