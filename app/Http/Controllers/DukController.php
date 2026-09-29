<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class DukController extends Controller
{
    // Menampilkan halaman tabel DUK
    public function index()
    {
        // Menarik semua data pegawai, diurutkan berdasarkan no_urut
        $pegawais = Pegawai::orderBy('no_urut', 'asc')->get();
        return view('internal.kepegawaian.duk', compact('pegawais'));
    }

    // Menampilkan halaman form tambah pegawai
    public function create()
    {
        return view('internal.kepegawaian.duk_tambah');
    }

    // Menyimpan data pegawai baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'no_urut' => 'nullable|integer',
            'nip' => 'required|string|max:20|unique:pegawais,nip',
            'nama' => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'status_pegawai' => 'nullable|in:Aktif,Cuti,Pensiun,Pindah',
            'pangkat_gol_ruang' => 'nullable|string|max:255',
            'pangkat_tmt' => 'nullable|date',
            'jabatan_nama' => 'nullable|string|max:255',
            'jabatan_tmt' => 'nullable|date',
            'masa_kerja_th' => 'nullable|integer',
            'masa_kerja_bln' => 'nullable|integer',
            'pendidikan_tingkat_ijazah' => 'nullable|string|max:255',
            'pendidikan_nama' => 'nullable|string|max:255',
            'pendidikan_tahun_lulus' => 'nullable|string|max:4',
            'latihan_jabatan_nama' => 'nullable|string|max:255',
            'latihan_jabatan_tahun_lulus' => 'nullable|string|max:4',
            'latihan_jabatan_tempat' => 'nullable|string|max:255',
            'catatan_mutasi_pegawai' => 'nullable|string',
        ]);

        Pegawai::create($validatedData);

        // Redirect ke halaman tabel DUK setelah data tersimpan
        return redirect()->route('kepegawaian.duk.index')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    // Menampilkan halaman form edit pegawai
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        // Pastikan Anda membuat file view duk_edit.blade.php nantinya
        return view('internal.kepegawaian.duk_edit', compact('pegawai')); 
    }

    // Menyimpan perubahan data pegawai (Update)
    public function update(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $validatedData = $request->validate([
            'no_urut' => 'nullable|integer',
            // Validasi NIP diabaikan untuk ID pegawai yang sedang diedit agar tidak error "unique"
            'nip' => 'required|string|max:20|unique:pegawais,nip,' . $pegawai->id,
            'nama' => 'required|string|max:255',
            'tempat_tanggal_lahir' => 'nullable|string|max:255',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'status_pegawai' => 'nullable|in:Aktif,Cuti,Pensiun,Pindah',
            'pangkat_gol_ruang' => 'nullable|string|max:255',
            'pangkat_tmt' => 'nullable|date',
            'jabatan_nama' => 'nullable|string|max:255',
            'jabatan_tmt' => 'nullable|date',
            'masa_kerja_th' => 'nullable|integer',
            'masa_kerja_bln' => 'nullable|integer',
            'pendidikan_tingkat_ijazah' => 'nullable|string|max:255',
            'pendidikan_nama' => 'nullable|string|max:255',
            'pendidikan_tahun_lulus' => 'nullable|string|max:4',
            'latihan_jabatan_nama' => 'nullable|string|max:255',
            'latihan_jabatan_tahun_lulus' => 'nullable|string|max:4',
            'latihan_jabatan_tempat' => 'nullable|string|max:255',
            'catatan_mutasi_pegawai' => 'nullable|string',
        ]);

        $pegawai->update($validatedData);

        return redirect()->route('kepegawaian.duk.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }

    // Menghapus data pegawai
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('kepegawaian.duk.index')->with('success', 'Data pegawai berhasil dihapus!');
    }
}