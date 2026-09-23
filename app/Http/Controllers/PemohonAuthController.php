<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PemohonAuthController extends Controller
{
    // Proses Pendaftaran Akun Pemohon Baru
    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|numeric|digits:16|unique:pemohons,nik',
            'nama_lengkap' => 'required|string|max:255',
            'email' => 'required|email|unique:pemohons,email',
            'no_whatsapp' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'nik.digits' => 'NIK KTP harus tepat 16 digit.',
            'nik.unique' => 'NIK KTP sudah terdaftar di sistem.',
            'email.unique' => 'Email sudah terdaftar, gunakan email lain.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal harus 8 karakter.',
        ]);

        // Simpan ke tabel pemohons
        DB::table('pemohons')->insert([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_whatsapp' => $request->no_whatsapp,
            'password' => Hash::make($request->password),
            'role' => 'pemohon',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('pemohon.login')->with('success', 'Akun berhasil didaftarkan! Silakan masuk.');
    }

    // Proses Login Pemohon
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cari data pemohon berdasarkan email
        $pemohon = DB::table('pemohons')->where('email', $request->email)->first();

        // Cek apakah data ada dan passwordnya cocok
        if ($pemohon && Hash::check($request->password, $pemohon->password)) {
            
            // Buat session login manual untuk pemohon
            session([
                'pemohon_id' => $pemohon->id,
                'pemohon_nama' => $pemohon->nama_lengkap,
                'pemohon_email' => $pemohon->email,
                'pemohon_role' => $pemohon->role,
            ]);

            // Arahkan kembali ke halaman yang tadinya ingin dia tuju
            return redirect()->intended('/layanan-fasilitas/layanan_perizinan');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->withInput();
    }

    // Proses Logout Pemohon
    public function logout(Request $request)
    {
        $request->session()->forget(['pemohon_id', 'pemohon_nama', 'pemohon_email', 'pemohon_role']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/pemohon/login')->with('success', 'Anda telah keluar dari akun.');
    }
}