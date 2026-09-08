<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    // 1. TAMPILAN PUBLIK (Bisa diakses siapa saja saat klik "Selengkapnya")
    public function showPublic($id)
    {
        $berita = Berita::findOrFail($id);
        return view('public.berita_detail', compact('berita'));
    }

    // 2. KELOLA BERITA INTERNAL (HANYA OPERATOR & SUPER USER)
    public function indexInternal()
    {
        // Validasi Role
        if (!in_array(Auth::user()->role, ['operator', 'super_user'])) {
            return redirect('/internal/index')->with('error', 'Akses Ditolak! Hanya Operator yang bisa mengelola berita.');
        }

        $berita = Berita::orderBy('tanggal_kejadian', 'desc')->get();
        return view('internal.operator.kelola_berita', compact('berita'));
    }

    // (Tambahkan juga fungsi create(), store(), edit(), update(), destroy() di sini dengan validasi role yang sama)
}