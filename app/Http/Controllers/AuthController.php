<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek kredensial user
        $user = User::where('username', $request->username)->first();

        if ($user && ($request->password == $user->password)) {
            // Jika berhasil login, simpan sesi
            session(['user_id' => $user->id, 'username' => $user->username, 'divisi' => $user->divisi, 'role' => $user->role]);
            return redirect('/tasks')->with('success', 'Login berhasil!');
        }

        // Jika gagal
        return back()->with('error', 'Username atau Password salah!');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}
