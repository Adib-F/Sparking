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
            'email' => 'required|unique:pengguna,email|email',
            'nama' => 'required',
            'password' => 'required|confirmed',
        ], [
            'nama.required' => 'Nama Lengkap harus diisi',
            'email.required' => 'Email harus diisi',
            'email.unique' => 'Email sudah terdaftar',
            'email.email' => 'Email harus diisi dengan format email',
            'password.required' => 'Password wajib diisi',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        $store = [
            'email' => $validated['email'],
            'nama' => $validated['nama'],
            'password' => Hash::make($validated['password']),
        ];

        $user = User::create($store);

        if ($user) {
            return redirect()
                ->route('landing_page')
                ->with('success', 'Pendaftaran berhasil')
                ->with('showLogin', true)
                ->withErrors([])
                ->withInput([]);
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
