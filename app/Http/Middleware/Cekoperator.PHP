<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CekOperator
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || strtolower(trim(Auth::user()->role)) !== 'operator') {
            abort(403, 'Akses Ditolak! Hanya Operator yang boleh menambah, mengedit, atau menghapus data.');
        }

        return $next($request);
    }
}