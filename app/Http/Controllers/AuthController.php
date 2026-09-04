<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('login.login');
    }

    // Memproses data login
    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/internal/index')->with('success', 'Login berhasil, selamat datang!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Menampilkan halaman lupa password
    public function showForgotPassword()
    {
        return view('login.lupa_password');
    }

    // Memproses reset password menggunakan Email & Nomor Kepegawaian
    public function processForgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'nomor_pegawai' => ['required'],
            'password' => ['required', 'min:6'],
        ]);

        // Cari user berdasarkan email dan nomor pegawai
        $user = User::where('email', $request->email)
                    ->where('nomor_pegawai', $request->nomor_pegawai)
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Kombinasi Email dan Nomor Kepegawaian tidak ditemukan.',
            ]);
        }

        // Update password baru (di-hash otomatis oleh Laravel)
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/login')->with('success', 'Password berhasil diubah. Silakan login.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
