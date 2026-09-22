<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekLoginPemohon
{
    public function handle(Request $request, Closure $next)
    {
        // Izinkan masuk jika memenuhi salah satu syarat berikut:
        // 1. Sudah login sebagai Pegawai Internal (Admin/Superuser/Operator)
        // 2. Sudah login sebagai Relawan Redkar (Guard redkar)
        // 3. Sudah login sebagai Pemohon Masyarakat (Session pemohon_id)
        if (Auth::check() || Auth::guard('redkar')->check() || session()->has('pemohon_id')) {
            return $next($request);
        }

        // Jika belum login sama sekali, tendang ke halaman login pemohon
        return redirect()->route('pemohon.login')
            ->withErrors(['Silakan masuk atau daftar akun terlebih dahulu untuk mengakses layanan ini.']);
    }
}