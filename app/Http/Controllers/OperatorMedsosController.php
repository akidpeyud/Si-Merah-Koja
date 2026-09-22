<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\Infografis;
use App\Models\BeritaMedsos;
use App\Models\KategoriBerita; 

class OperatorMedsosController extends Controller
{
    // ================= INFOGRAFIS =================
    public function indexInfografis()
    {
        $infografis = Infografis::orderBy('created_at', 'desc')->get();
        return view('internal.operator.infografis', compact('infografis'));
    }

    public function storeInfografis(Request $request)
    {
        $request->validate([
            'judul' => ['nullable', 'string', 'max:255'],
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        $path = $request->file('gambar')->store('infografis', 'public');
        Infografis::create(['judul' => $request->judul, 'gambar' => $path]);

        return back()->with('success', 'Infografis baru berhasil ditambahkan!');
    }

    public function destroyInfografis($id)
    {
        $item = Infografis::findOrFail($id);
        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();
        return back()->with('success', 'Infografis berhasil dihapus!');
    }

    // ================= BERITA MEDSOS =================
    public function indexMedsos()
    {
        $medsos = BeritaMedsos::with('kategori')->orderBy('created_at', 'desc')->get();
        $kategori = KategoriBerita::all();
        return view('internal.operator.berita_medsos', compact('medsos', 'kategori'));
    }

    // FUNGSI SIMPAN MEDSOS (SISTEM HYBRID: BISA OTOMATIS / BISA MANUAL)
    public function storeMedsos(Request $request)
    {
        $request->validate([
            'link' => ['required', 'url'],
            'kategori_id' => ['required', 'exists:kategori_berita,id'],
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'gambar_url' => ['nullable', 'url'], // Hasil dari penarikan JS (Opsional)
            'gambar_manual' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'] // Upload Manual (Opsional)
        ]);

        // 1. Deteksi Sumber Otomatis
        $sumber = 'Website / Portal Berita';
        $link = strtolower($request->link);
        if (strpos($link, 'instagram.com') !== false) { $sumber = 'Instagram'; } 
        elseif (strpos($link, 'facebook.com') !== false || strpos($link, 'fb.com') !== false) { $sumber = 'Facebook'; } 
        elseif (strpos($link, 'youtube.com') !== false || strpos($link, 'youtu.be') !== false) { $sumber = 'YouTube'; } 
        elseif (strpos($link, 'tiktok.com') !== false) { $sumber = 'TikTok'; } 
        elseif (strpos($link, 'twitter.com') !== false || strpos($link, 'x.com') !== false) { $sumber = 'X / Twitter'; }

        $filename = null;

        // 2. Jika Tarik Data Berhasil, coba download otomatis
        if ($request->filled('gambar_url')) {
            try {
                $imageResponse = Http::withHeaders([
                    'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0 Safari/537.36'
                ])->withOptions(['verify' => false])->timeout(15)->get($request->gambar_url);
                
                if ($imageResponse->successful()) {
                    $filename = 'berita_medsos/' . time() . '_' . uniqid() . '.jpg';
                    Storage::disk('public')->put($filename, $imageResponse->body());
                }
            } catch (\Throwable $e) {
                // Biarkan $filename tetap null, akan ditangani oleh upload manual di bawah
            }
        }

        // 3. Jika Download Otomatis Gagal, Gunakan Gambar Upload Manual
        if (!$filename && $request->hasFile('gambar_manual')) {
            $filename = $request->file('gambar_manual')->store('berita_medsos', 'public');
        }

        // 4. Jika keduanya kosong (Tidak ditarik dan tidak upload manual), tolak
        if (!$filename) {
            return back()->withErrors(['gambar_manual' => 'Mohon "Tarik Data" otomatis ATAU upload file gambar secara manual jika sistem web sumber terkunci.']);
        }

        // 5. Simpan ke Database
        BeritaMedsos::create([
            'kategori_id' => $request->kategori_id,
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'sumber' => $sumber, 
            'link' => $request->link,
            'gambar' => $filename 
        ]);

        return back()->with('success', 'Berita media sosial berhasil disimpan!');
    }

    public function updateMedsos(Request $request, $id)
    {
        $item = BeritaMedsos::findOrFail($id);

        $request->validate([
            'kategori_id' => ['required', 'exists:kategori_berita,id'],
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'sumber' => ['required', 'string'],
            'link' => ['nullable', 'url'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        $item->kategori_id = $request->kategori_id;
        $item->judul = $request->judul;
        $item->tanggal = $request->tanggal;
        $item->sumber = $request->sumber;
        $item->link = $request->link;

        if ($request->hasFile('gambar')) {
            if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
                Storage::disk('public')->delete($item->gambar);
            }
            $item->gambar = $request->file('gambar')->store('berita_medsos', 'public');
        }

        $item->save();
        return back()->with('success', 'Berita media sosial berhasil diperbarui!');
    }

    public function destroyMedsos($id)
    {
        $item = BeritaMedsos::findOrFail($id);
        if ($item->gambar && Storage::disk('public')->exists($item->gambar)) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();
        return back()->with('success', 'Berita media sosial berhasil dihapus!');
    }
}