<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Infografis;
use App\Models\BeritaMedsos;
use App\Models\UjungDamkar;
use App\Models\EduDamkar;

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

        Infografis::create([
            'judul' => $request->judul,
            'gambar' => $path
        ]);

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
        $medsos = BeritaMedsos::orderBy('created_at', 'desc')->get();
        return view('internal.operator.berita_medsos', compact('medsos'));
    }

    public function storeMedsos(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'sumber' => ['required', 'string'],
            'link' => ['nullable', 'url'],
            'gambar' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        $path = $request->file('gambar')->store('berita_medsos', 'public');

        BeritaMedsos::create([
            'judul' => $request->judul,
            'tanggal' => $request->tanggal,
            'sumber' => $request->sumber,
            'link' => $request->link,
            'gambar' => $path
        ]);

        return back()->with('success', 'Berita media sosial berhasil ditambahkan!');
    }

    public function updateMedsos(Request $request, $id)
    {
        $item = BeritaMedsos::findOrFail($id);

        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'sumber' => ['required', 'string'],
            'link' => ['nullable', 'url'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

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

    // ================= UJUNG-UJUNG DAMKAR =================
    public function indexUjungDamkar()
    {
        $videos = UjungDamkar::orderBy('created_at', 'desc')->get();

        $viewName = view()->exists('internal.operator.ujung_damkar')
            ? 'internal.operator.ujung_damkar'
            : 'internal.operator.ujung-damkar';

        return view($viewName, compact('videos'));
    }

    public function storeUjungDamkar(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'link'  => ['required', 'url'],
        ], [
            'judul.required' => 'Judul kegiatan / video wajib diisi.',
            'link.required'  => 'Link video YouTube wajib diisi.',
            'link.url'       => 'Format link tidak valid.',
        ]);

        $youtubeId = $this->extractYoutubeId($request->link);

        if (!$youtubeId) {
            return back()
                ->withInput()
                ->with('error', 'Link YouTube tidak dikenali! Pastikan menggunakan link video atau Shorts YouTube yang valid.');
        }

        UjungDamkar::create([
            'judul'      => $request->judul,
            'youtube_id' => $youtubeId,
            'link_asli'  => $request->link,
        ]);

        return back()->with('success', 'Video Ujung-Ujung Damkar berhasil ditambahkan!');
    }

    public function updateUjungDamkar(Request $request, $id)
    {
        $item = UjungDamkar::findOrFail($id);

        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'link'  => ['required', 'url'],
        ]);

        $youtubeId = $this->extractYoutubeId($request->link);

        if (!$youtubeId) {
            return back()
                ->withInput()
                ->with('error', 'Link YouTube tidak dikenali! Pastikan menggunakan link video atau Shorts YouTube yang valid.');
        }

        $item->update([
            'judul'      => $request->judul,
            'youtube_id' => $youtubeId,
            'link_asli'  => $request->link,
        ]);

        return back()->with('success', 'Video Ujung-Ujung Damkar berhasil diperbarui!');
    }

    public function destroyUjungDamkar($id)
    {
        $item = UjungDamkar::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Video Ujung-Ujung Damkar berhasil dihapus!');
    }

    // ================= EDU DAMKAR (VIDEO EDUKASI) =================
    public function indexEduDamkar()
    {
        $videos = EduDamkar::orderBy('created_at', 'desc')->get();

        $viewName = view()->exists('internal.operator.edu_damkar')
            ? 'internal.operator.edu_damkar'
            : 'internal.operator.edu-damkar';

        return view($viewName, compact('videos'));
    }

    public function storeEduDamkar(Request $request)
    {
        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'link'  => ['required', 'url'],
        ], [
            'judul.required' => 'Judul materi edukasi wajib diisi.',
            'link.required'  => 'Link video YouTube wajib diisi.',
            'link.url'       => 'Format link tidak valid.',
        ]);

        $youtubeId = $this->extractYoutubeId($request->link);

        if (!$youtubeId) {
            return back()
                ->withInput()
                ->with('error', 'Link YouTube tidak dikenali! Pastikan menggunakan link video atau Shorts YouTube yang valid.');
        }

        EduDamkar::create([
            'judul'      => $request->judul,
            'youtube_id' => $youtubeId,
            'link_asli'  => $request->link,
        ]);

        return back()->with('success', 'Video Edu Damkar berhasil ditambahkan!');
    }

    public function updateEduDamkar(Request $request, $id)
    {
        $item = EduDamkar::findOrFail($id);

        $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'link'  => ['required', 'url'],
        ]);

        $youtubeId = $this->extractYoutubeId($request->link);

        if (!$youtubeId) {
            return back()
                ->withInput()
                ->with('error', 'Link YouTube tidak dikenali! Pastikan menggunakan link video atau Shorts YouTube yang valid.');
        }

        $item->update([
            'judul'      => $request->judul,
            'youtube_id' => $youtubeId,
            'link_asli'  => $request->link,
        ]);

        return back()->with('success', 'Video Edu Damkar berhasil diperbarui!');
    }

    public function destroyEduDamkar($id)
    {
        $item = EduDamkar::findOrFail($id);
        $item->delete();

        return back()->with('success', 'Video Edu Damkar berhasil dihapus!');
    }

    /**
     * Helper pengekstrak 11 karakter ID YouTube dari berbagai format URL
     */
    private function extractYoutubeId(string $url): ?string
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?|shorts)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i';

        if (preg_match($pattern, $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}