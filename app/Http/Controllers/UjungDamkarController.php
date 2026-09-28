<?php

namespace App\Http\Controllers;

use App\Models\UjungDamkar;
use Illuminate\Http\Request;

class UjungDamkarController extends Controller
{
    /**
     * Menampilkan halaman kelola beserta daftar video terbaru.
     */
    public function index()
    {
        $videos = UjungDamkar::latest()->get();

        // Sesuaikan nama view dengan lokasi file blade Anda
        // Contoh: resources/views/internal/operator/ujung-damkar.blade.php
        return view('internal.operator.ujung-damkar', compact('videos'));
    }

    /**
     * Menyimpan video baru ke tabel ujung_damkar.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link'  => 'required|url',
        ], [
            'judul.required' => 'Judul kegiatan atau video wajib diisi.',
            'link.required'  => 'Tautan video YouTube wajib diisi.',
            'link.url'       => 'Format tautan tidak valid.',
        ]);

        // Ekstrak 11 karakter ID YouTube dari link
        $youtubeId = $this->extractYoutubeId($request->link);

        if (!$youtubeId) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Link YouTube tidak dikenali! Pastikan menggunakan link video atau Shorts YouTube yang valid.');
        }

        UjungDamkar::create([
            'judul'      => $request->judul,
            'youtube_id' => $youtubeId,
            'link_asli'  => $request->link,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Video Ujung-Ujung Damkar berhasil ditambahkan.');
    }

    /**
     * Menghapus video berdasarkan ID.
     */
    public function destroy($id)
    {
        $video = UjungDamkar::findOrFail($id);
        $video->delete();

        return redirect()
            ->back()
            ->with('success', 'Video berhasil dihapus dari daftar tayang.');
    }

    /**
     * Helper untuk mengambil ID YouTube (11 karakter) dari berbagai jenis URL YouTube.
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