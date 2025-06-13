<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\VerifikasiEmail;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
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
                        ->with('error', 'Akun Anda belum terverifikasi. Silahkan cek email dan klik tombol/link untuk melakukan verifikasi.');

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

    public function registrasi_proses(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|unique:pengguna,email|email',
                'nama' => 'required',
                'password' => 'required|confirmed',
            ], [
                'nama.required' => 'Nama Lengkap harus diisi',
                'email.required' => 'Email harus diisi',
                'email.unique' => 'Email sudah terdaftar',
                'email.email' => 'Format email tidak valid',
                'password.required' => 'Password wajib diisi',
                'password.confirmed' => 'Konfirmasi password tidak cocok',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessage = collect($e->validator->errors()->all())->first();

            return back()
                ->withInput()
                ->with('error', $errorMessage)
                ->with('showModalError', true);
        }

        $store = [
            'email' => $validated['email'],
            'nama' => $validated['nama'],
            'password' => Hash::make($validated['password']),
            'onboarding_step' => 0,
            'onboarding_completed' => false,
        ];

        $user = User::create($store);

        if ($user) {
            $user->notify(new VerifikasiEmail());

            return redirect()
                ->route('login')
                ->with('success', 'Pendaftaran berhasil. Silakan periksa email Anda untuk verifikasi.')
                ->with('showVerificationModal', true);
        } else {
            return back()
                ->withInput()
                ->with('error', 'Pendaftaran gagal')
                ->with('showModalError', true);
        }
    }


    public function verifyEmail(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            abort(403, 'Invalid verification link');
        }

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
            $user->status = 'aktif';
            $user->save();

            event(new Verified($user));
        }

        return redirect()->route('login')->with('success', 'Akun anda sudah diverifikasi dan siap digunakan!');
    }


    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return redirect()->route('login')->with('succes', 'Logout Berhasil');
    }


}
