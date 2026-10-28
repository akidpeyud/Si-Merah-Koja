<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekLoginPemohon
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Periksa apakah pengguna sudah login melalui salah satu akses yang diizinkan:
        // 1. Pegawai Internal (Auth default)
        // 2. Pemohon Masyarakat (Session pemohon_id)
        if (Auth::check() || session()->has('pemohon_id')) {
            return $next($request);
        }

        // MENYIMPAN URL TUJUAN (INTENDED URL) SEBELUM REDIRECT
        // Baris ini sangat penting agar pengguna dikembalikan ke layanan yang mereka klik
        session(['url.intended' => url()->current()]);

        // Jika belum login sama sekali, arahkan ke halaman login pemohon dengan pesan flash
        return redirect()->route('pemohon.login')
            ->with('error', 'Silakan masuk atau daftar akun terlebih dahulu untuk mengakses layanan ini.');
    }
}
