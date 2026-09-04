<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
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
            return redirect()->intended('/internal/index')->with('success', 'Login berhasil, selamat datang di SIMERAH KOJA!');
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

    // Memproses reset password menggunakan Email & Nomor Kepegawaian, lalu kirim ke Email
    // Memproses reset password menggunakan Email & Nomor Kepegawaian, lalu kirim ke Email
    public function processForgotPassword(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'email' => ['required', 'email'],
            'nomor_pegawai' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'nomor_pegawai.required' => 'Nomor kepegawaian wajib diisi.'
        ]);

        // 2. Cari user berdasarkan kombinasi email dan nomor pegawai
        $user = User::where('email', $request->email)
                    ->where('nomor_pegawai', $request->nomor_pegawai)
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Kombinasi Email dan Nomor Kepegawaian tidak ditemukan di sistem.',
            ])->onlyInput('email', 'nomor_pegawai');
        }

        // 3. Buat password sementara yang bersih (Contoh: gabungan kata sandi pendek + angka acak yang aman)
        // Menggunakan huruf dan angka tanpa simbol agar tidak membingungkan saat diketik ulang
        $passwordBaru = 'Damkar' . rand(1000, 9999); // Contoh hasil: Damkar8492

        // 4. Update password baru ke database (Otomatis di-hash dengan benar)
        $user->password = Hash::make($passwordBaru);
        $user->save();

        // 5. Susun isi email dengan format string yang aman
        $pesanEmail = "Halo " . $user->nama_lengkap . ",\n\n"
                    . "Permintaan reset password untuk akun SIMERAH KOJA Anda berhasil diverifikasi.\n"
                    . "Berikut adalah password sementara Anda:\n\n"
                    . "Password Baru: " . $passwordBaru . "\n\n"
                    . "Silakan login menggunakan password ini dan segera ubah password Anda di menu Pengaturan Akun demi keamanan.\n\n"
                    . "Salam,\nTim Administrator SIMERAH KOJA";

        // Eksekusi pengiriman email
        Mail::raw($pesanEmail, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Reset Password Akun SIMERAH KOJA');
        });

        // 6. Kembalikan ke halaman login beserta alert sukses
        return redirect('/login')->with('success', 'Password baru telah dikirim ke email Anda. Silakan cek kotak masuk.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Tambahkan with('success') agar alert hijau muncul saat berhasil logout
        return redirect('/login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}