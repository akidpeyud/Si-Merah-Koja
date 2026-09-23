<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PemberdayaanController extends Controller
{
    // 1. TAMPILKAN SEMUA DATA (INDEX)
    public function index()
    {
        $data_pemberdayaan = DB::table('tbl_pemberdayaan')->orderBy('id', 'desc')->get();
        return view('internal.pencegahan.pemberdayaan_masyarakat', compact('data_pemberdayaan'));
    }

    // 2. TAMPILKAN FORM TAMBAH DATA (CREATE)
    public function create()
    {
        return view('internal.pencegahan.create_pemberdayaan');
    }

    // 3. PROSES SIMPAN DATA KE DATABASE (STORE)
    public function store(Request $request)
    {
        DB::table('tbl_pemberdayaan')->insert([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal'       => $request->tanggal,
            'lokasi'        => $request->lokasi,
            'keterangan'    => $request->keterangan,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat')
            ->with('success', 'Data pemberdayaan berhasil ditambahkan!');
    }

    // 4. TAMPILKAN FORM EDIT DATA (EDIT)
    public function edit($id)
    {
        $data = DB::table('tbl_pemberdayaan')->where('id', $id)->first();
        return view('internal.pencegahan.edit_pemberdayaan', compact('data'));
    }

    // 5. PROSES UPDATE DATA KE DATABASE (UPDATE)
    public function update(Request $request, $id)
    {
        DB::table('tbl_pemberdayaan')->where('id', $id)->update([
            'nama_kegiatan' => $request->nama_kegiatan,
            'tanggal'       => $request->tanggal,
            'lokasi'        => $request->lokasi,
            'keterangan'    => $request->keterangan,
            'updated_at'    => now(),
        ]);

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat')
            ->with('success', 'Data pemberdayaan berhasil diperbarui!');
    }

    // 6. PROSES HAPUS DATA (DESTROY)
    public function destroy($id)
    {
        DB::table('tbl_pemberdayaan')->where('id', $id)->delete();

        return redirect('/internal/pencegahan/pemberdayaan-masyarakat')
            ->with('success', 'Data pemberdayaan berhasil dihapus!');
    }
}