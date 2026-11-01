<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    /**
     * Menampilkan daftar riwayat aktivitas di halaman internal
     */
    public function index(Request $request): View
    {
        $query = ActivityLog::with('user')->latest();

        // Filter pencarian teks
        if ($request->filled('q')) {
            $keyword = trim($request->input('q'));
            $query->where(function ($q) use ($keyword) {
                $q->where('description', 'like', "%{$keyword}%")
                    ->orWhere('user_name', 'like', "%{$keyword}%")
                    ->orWhere('module', 'like', "%{$keyword}%")
                    ->orWhere('ip_address', 'like', "%{$keyword}%");
            });
        }

        // Filter Aksi
        if ($request->filled('action')) {
            $query->where('action', $request->input('action'));
        }

        // Filter Modul
        if ($request->filled('module')) {
            $query->where('module', $request->input('module'));
        }

        // Filter Tanggal Mulai
        if ($request->filled('date_start')) {
            $query->whereDate('created_at', '>=', $request->input('date_start'));
        }

        // Filter Tanggal Selesai
        if ($request->filled('date_end')) {
            $query->whereDate('created_at', '<=', $request->input('date_end'));
        }

        $logs = $query->paginate(20)->withQueryString();

        // Opsi modul untuk filter dropdown
        $modules = ActivityLog::select('module')
            ->distinct()
            ->whereNotNull('module')
            ->orderBy('module')
            ->pluck('module');

        // Ringkasan statistik
        $today = Carbon::today();
        $stats = [
            'total' => ActivityLog::count(),
            'today' => ActivityLog::whereDate('created_at', $today)->count(),
            'tambah' => ActivityLog::where('action', 'Tambah')->count(),
            'ubah' => ActivityLog::where('action', 'Ubah')->count(),
            'hapus' => ActivityLog::where('action', 'Hapus')->count(),
        ];

        return view('internal.riwayat_aktivitas', compact('logs', 'modules', 'stats'));
    }
}
