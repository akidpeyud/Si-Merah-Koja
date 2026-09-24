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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah ada session ID pemohon
        if (!session()->has('pemohon_id')) {
            // Jika belum login, simpan rute yang mau diakses, lalu lempar ke form login
            session(['url.intended' => url()->current()]);
            return redirect()->route('pemohon.login')->with('error', 'Silakan masuk terlebih dahulu untuk mengakses layanan ini.');
        }

        // 2. Jika sudah login, lanjut ke rute yang diminta
        return $next($request);
    }
}