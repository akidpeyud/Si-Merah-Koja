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
        if (!auth()->user()->hasAnyRole(['Super User', 'Sekretariat'])) {
            abort(403, 'Anda tidak memiliki akses untuk menambah data.');
        }

        return view('internal.kepegawaian.duk_tambah');
    }

    // Menyimpan data pegawai baru
    public function store(Request $request)
    {
        if (!auth()->user()->hasAnyRole(['Super User', 'Sekretariat'])) {
            abort(403, 'Anda tidak memiliki akses untuk menyimpan data.');
        }

        $validatedData = $request->validate([
            // Tambahkan validasi required dan unique untuk no_urut
            'no_urut' => 'required|integer|unique:pegawais,no_urut',
            'nip' => 'required|string|max:20|unique:pegawais,nip',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255', // Disesuaikan dengan form baru
            'tanggal_lahir' => 'nullable|date',         // Disesuaikan dengan form baru
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
        ], [
            // Pesan error kustom untuk no_urut
            'no_urut.unique' => 'Nomor urut ini sudah digunakan, silakan masukkan nomor urut yang lain.',
            'no_urut.required' => 'Nomor urut wajib diisi.',
            'nip.unique' => 'NIP ini sudah terdaftar di sistem.',
        ]);

        Pegawai::create($validatedData);

        // Redirect ke halaman tabel DUK setelah data tersimpan
        return redirect()->route('kepegawaian.duk.index')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    // Menampilkan halaman form edit pegawai
    public function edit($id)
    {
        if (!auth()->user()->hasAnyRole(['Super User', 'Sekretariat'])) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data.');
        }

        $pegawai = Pegawai::findOrFail($id);
        return view('internal.kepegawaian.duk_edit', compact('pegawai')); 
    }

    // Menyimpan perubahan data pegawai (Update)
    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasAnyRole(['Super User', 'Sekretariat'])) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data.');
        }

        $pegawai = Pegawai::findOrFail($id);

        $validatedData = $request->validate([
            // Pengecualian ID saat update agar tidak error "unique" pada no_urut miliknya sendiri
            'no_urut' => 'required|integer|unique:pegawais,no_urut,' . $pegawai->id,
            'nip' => 'required|string|max:20|unique:pegawais,nip,' . $pegawai->id,
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
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
        ], [
            'no_urut.unique' => 'Nomor urut ini sudah digunakan, silakan masukkan nomor urut yang lain.',
            'no_urut.required' => 'Nomor urut wajib diisi.',
            'nip.unique' => 'NIP ini sudah terdaftar di sistem.',
        ]);

        $pegawai->update($validatedData);

        return redirect()->route('kepegawaian.duk.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }

    // Menghapus data pegawai
    public function destroy($id)
    {
        if (!auth()->user()->hasAnyRole(['Super User', 'Sekretariat'])) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data.');
        }

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('kepegawaian.duk.index')->with('success', 'Data pegawai berhasil dihapus!');
    }
}