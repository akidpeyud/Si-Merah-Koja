<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftarRedkar; // Pastikan model ini sudah ada

class RedkarController extends Controller
{
    // Method untuk menampilkan halaman form
    public function index()
    {
        return view('redkar.redkar'); // Sesuaikan dengan nama folder & file blade kamu
    }

    // Method untuk memproses data dari form
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nik' => 'required|string|max:16|unique:pendaftar_redkars,nik',
            'nama_lengkap' => 'required|string|max:150',
            'jenis_kelamin' => 'required|in:L,P',
            'tempat_lahir' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha',
            'nomor_telp' => 'required|string|max:20',
            'ktp' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'alamat' => 'required|string',
            'rt_rw' => 'required|string|max:10',
            'kode_pos' => 'required|string|max:10',
            'kecamatan' => 'required|string|max:50',
            'kelurahan' => 'required|string|max:50',
            'pekerjaan' => 'required|string|max:100',
            'pendidikan_terakhir' => 'required|in:SMA/SMK,D3,S1',
            'sehat_jasmani' => 'required|in:Ya,Tidak',
            'buta_warna' => 'required|in:Tidak,Ya',
            'golongan_darah' => 'required|in:A,B,AB,O',
        ]);

        // Upload file KTP
        if ($request->hasFile('ktp')) {
            $path = $request->file('ktp')->store('ktp', 'public');
            $validatedData['file_ktp'] = $path; 
        }

        // Nilai bawaan
        $validatedData['provinsi'] = 'JAMBI';
        $validatedData['kabupaten_kota'] = 'KOTA JAMBI';

        // Simpan data ke database
        PendaftarRedkar::create($validatedData);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Pendaftaran berhasil dikirim!');
    }
}