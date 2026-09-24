<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekLoginPemohon
{
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah pengguna sudah login melalui salah satu akses yang diizinkan:
        // 1. Pegawai Internal (Auth default)
        // 2. Relawan Redkar (Guard redkar)
        // 3. Pemohon Masyarakat (Session pemohon_id)
        if (Auth::check() || Auth::guard('redkar')->check() || session()->has('pemohon_id')) {
            return $next($request);
        }

        // Jika belum login sama sekali, arahkan ke halaman login pemohon dengan pesan flash
        return redirect()->route('pemohon.login')
            ->with('error', 'Silakan masuk atau daftar akun terlebih dahulu untuk mengakses layanan ini.');
    }
}