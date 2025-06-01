<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\UbahpasswordEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Password;

class SettingsController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('settings', [
            'title' => 'pengaturan',
            'user' => $user
        ]);
    }


    public function updateFotoKendaraan(Request $request)
    {
        $request->validate([
            'foto_kendaraan' => 'required|image|mimes:jpg,jpeg,png|max:5120', 
        ]);

        $user = auth()->user();

        if ($user->foto_kendaraan && Storage::exists('public/' . $user->foto_kendaraan)) {
            Storage::delete('public/' . $user->foto_kendaraan);
        }

        $path = $request->file('foto_kendaraan')->store('foto_kendaraan', 'public');
        $user->foto_kendaraan = $path;
        $user->save();

        return response()->json([
            'message' => 'Foto kendaraan berhasil diperbarui.',
            'path' => asset('storage/' . $path)
        ]);
    }

    public function changePassword(Request $request)
    {
        $request->validate(
            [
                'old_password' => 'required',
                'new_password' => 'required|min:8|different:old_password',
                'confirm_password' => 'required|same:new_password'
            ],
            [
                'old_password.required' => 'Password lama harus diisi.',
                'new_password.required' => 'Password baru harus diisi.',
                'new_password.min' => 'Password baru minimal 8 karakter.',
                'new_password.different' => 'Password baru harus berbeda dengan password lama.',
                'confirm_password.required' => 'Konfirmasi password harus diisi.',
                'confirm_password.same' => 'Konfirmasi password tidak sesuai.'
            ]
        );

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->back()->with('success', 'password berhasil di ganti');
    }

        public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:pengguna,email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['error' => 'Email tidak ditemukan.'], 404);
        }

        $token = Password::createToken($user);

        $resetUrl = URL::temporarySignedRoute(
            'password.reset',
            now()->addMinutes(30),
            [
                'token' => $token,
                'id' => $user->id_pengguna
            ]
        );

        $user->notify(new UbahpasswordEmail($resetUrl, $user->nama));
        return response()->json(['message' => 'Link reset telah dikirim ke email.']);
    }

    public function showResetForm(Request $request, $token, $id)
    {
        $user = User::findOrFail($id);

        Auth::login($user);

        return view('component.pengaturan.form_ubah_kata_sandi', [
            'token' => $token,
            'email' => $user->email,
            'title' => 'Ubah Kata Sandi'
        ]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai.',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Kata sandi baru tidak boleh sama seperti kata sandi lama.',
            ]);
        }

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect('/settings')->with('success', 'Kata sandi berhasil diubah.')
            : back()->withErrors(['email' => [__($status)]]);
    }
}
