<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Infografis;
use App\Models\BeritaMedsos;

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
}