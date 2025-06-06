<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('status', 'aktif')->paginate(10);

        return view('admin.manageUsers', [
            "title" => "ManageUsers",
            "penggunas" => $users
        ]);
    }

    public function delete($id_pengguna)
    {
        $user = User::findOrFail($id_pengguna);
        $user->delete();
        return redirect()->back()->with('success', 'User berhasil dihapus');
    }

}
