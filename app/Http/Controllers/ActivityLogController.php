<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    /**
     * Menampilkan daftar riwayat aktivitas operasional internal (pegawai).
     */
    public function index(Request $request): View
    {
        $query = ActivityLog::with('user')
            ->where(function ($q) {
                $q->whereNull('user_role')->orWhere('user_role', '!=', 'Pemohon');
            })
            ->latest();

        // Filter pencarian teks
        if ($request->filled('q')) {
            $keyword = trim((string) $request->input('q'));
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

        // Opsi modul untuk filter dropdown (khusus internal)
        $modules = ActivityLog::select('module')
            ->where(function ($q) {
                $q->whereNull('user_role')->orWhere('user_role', '!=', 'Pemohon');
            })
            ->distinct()
            ->whereNotNull('module')
            ->orderBy('module')
            ->pluck('module');

        // Ringkasan statistik aktivitas internal
        $today = Carbon::today();
        $internalQuery = fn () => ActivityLog::where(function ($q) {
            $q->whereNull('user_role')->orWhere('user_role', '!=', 'Pemohon');
        });

        $stats = [
            'total' => $internalQuery()->count(),
            'today' => $internalQuery()->whereDate('created_at', $today)->count(),
            'tambah' => $internalQuery()->where('action', 'Tambah')->count(),
            'ubah' => $internalQuery()->where('action', 'Ubah')->count(),
            'hapus' => $internalQuery()->where('action', 'Hapus')->count(),
        ];

        return view('internal.riwayat_aktivitas', compact('logs', 'modules', 'stats'));
    }

    /**
     * Menampilkan daftar riwayat penginputan permohonan surat oleh pemohon.
     */
    public function pemohon(Request $request): View
    {
        $query = ActivityLog::where('user_role', 'Pemohon')->latest();

        // Filter pencarian teks
        if ($request->filled('q')) {
            $keyword = trim((string) $request->input('q'));
            $query->where(function ($q) use ($keyword) {
                $q->where('description', 'like', "%{$keyword}%")
                    ->orWhere('user_name', 'like', "%{$keyword}%")
                    ->orWhere('module', 'like', "%{$keyword}%")
                    ->orWhere('ip_address', 'like', "%{$keyword}%");
            });
        }

        // Filter Modul / Jenis Surat
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

        // Opsi modul untuk filter dropdown (khusus pemohon)
        $modules = ActivityLog::where('user_role', 'Pemohon')
            ->select('module')
            ->distinct()
            ->whereNotNull('module')
            ->orderBy('module')
            ->pluck('module');

        // Ringkasan statistik permohonan pemohon
        $today = Carbon::today();
        $pemohonQuery = fn () => ActivityLog::where('user_role', 'Pemohon');

        $stats = [
            'total' => $pemohonQuery()->count(),
            'today' => $pemohonQuery()->whereDate('created_at', $today)->count(),
            'rpkbgl' => $pemohonQuery()->where('module', 'Permohonan RPKBGL')->count(),
            'skk' => $pemohonQuery()->where('module', 'Permohonan SKK')->count(),
            'izin' => $pemohonQuery()->where('module', 'Permohonan Izin Keramaian')->count(),
            'sarana' => $pemohonQuery()->where('module', 'Permohonan Sarana Damkar')->count(),
            'edukasi' => $pemohonQuery()->where('module', 'Permohonan Edukasi & Sosialisasi')->count(),
        ];

        return view('internal.riwayat_aktivitas_pemohon', compact('logs', 'modules', 'stats'));
    }
}
