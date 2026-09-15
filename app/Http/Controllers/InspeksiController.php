<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class InspeksiController extends Controller
{
    // Fungsi untuk NYIMPAN data BARU
    public function store(Request $request)
    {
        $namaFile = null;
        if ($request->hasFile('dokumen_pendukung')) {
            $file = $request->file('dokumen_pendukung');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/inspeksi'), $namaFile); 
        }

        $data = $request->except(['_token']); 
        if ($namaFile) {
            $data['dokumen_pendukung'] = $namaFile;
        }

        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table('jadwal_inspeksis')->insert($data);

        return redirect('/internal/pencegahan/layanan-inspeksi')->with('success', 'Data Inspeksi berhasil ditambahkan!');
    }

    // Fungsi untuk LIHAT DETAIL (Tombol Mata)
    public function show($id)
    {
        $data = DB::table('jadwal_inspeksis')->where('id', $id)->first();
        return view('internal.pencegahan.lihat_inspeksi', compact('data'));
    }

    // Fungsi untuk BUKA FORM EDIT (Tombol Pensil)
    public function edit($id)
    {
        $data = DB::table('jadwal_inspeksis')->where('id', $id)->first();
        return view('internal.pencegahan.edit_inspeksi', compact('data'));
    }

    // Fungsi untuk NYIMPAN HASIL EDITAN
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token']);
        
        if ($request->hasFile('dokumen_pendukung')) {
            $file = $request->file('dokumen_pendukung');
            $namaFile = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('uploads/inspeksi'), $namaFile);
            $data['dokumen_pendukung'] = $namaFile;
        }

        $data['updated_at'] = now();

        DB::table('jadwal_inspeksis')->where('id', $id)->update($data);

        return redirect('/internal/pencegahan/layanan-inspeksi')->with('success', 'Data Inspeksi berhasil diubah!');
    }
}