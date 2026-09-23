<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
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
=======
use App\Models\PendaftarRedkar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // <-- PENTING: Tambahkan ini untuk fungsi Login/Logout

class RedkarController extends Controller
{
    // ====================================================
    // AREA PUBLIK (RELAWAN)
    // ====================================================

    // Menampilkan halaman form pendaftaran publik
    public function index()
    {
        // Mengarah ke file resources/views/redkar/form_redkar.blade.php
        return view('redkar.form_redkar'); 
    }

    // Memproses data form pendaftaran (POST /redkar)
    public function store(Request $request)
    {
        // 1. Validasi Input
        $validatedData = $request->validate([
            'username'                  => 'required|string|max:255|unique:redkar_registrations,username',
            'password'                  => 'required|string|min:6|confirmed',
            'nama_lengkap'              => 'required|string|max:150',
            'nik'                       => 'required|string|size:16|unique:redkar_registrations,nik',
            'nomor_telp'                => 'required|string|max:20',
            'tempat_lahir'              => 'required|string|max:100',
            'tanggal_lahir'             => 'required|date',
            'jenis_kelamin'             => 'required|in:Laki-Laki,Perempuan',
            'agama'                     => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan'         => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'alamat'                    => 'required|string',
            'rt_rw'                     => 'required|string|max:10',
            'kode_pos'                  => 'required|string|max:10',
            'kecamatan'                 => 'required|string|max:50',
            'kelurahan'                 => 'required|string|max:50',
            'pendidikan_terakhir'       => 'required|in:SD,SMP,SMA,D3,S1,S2',
            'latar_belakang_pendidikan' => 'required|string|max:255',
            'jenis_pekerjaan'           => 'required|string|max:100',
            'pekerjaan_lainnya'         => 'nullable|string|max:255|required_if:jenis_pekerjaan,Lainnya',
            'sehat_jasmani'             => 'required|in:Ya,Tidak',
            'golongan_darah'            => 'required|in:A,B,AB,O,Tidak Tahu',
            'foto_ktp'                  => 'required|file|image|mimes:jpg,jpeg,png|max:2048', 
        ], [
            'foto_ktp.max' => 'Ukuran file KTP maksimal adalah 2MB.',
            'nik.size' => 'NIK harus berjumlah persis 16 digit.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.'
        ]);

        // 2. Hash Password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // 3. Logika Pekerjaan Lainnya
        $pekerjaanFinal = $request->jenis_pekerjaan;
        if ($pekerjaanFinal === 'Lainnya') {
            $pekerjaanFinal = $request->pekerjaan_lainnya;
        }
        $validatedData['pekerjaan'] = $pekerjaanFinal; 
        unset($validatedData['jenis_pekerjaan']);
        unset($validatedData['pekerjaan_lainnya']);

        // 4. Upload file KTP 
        if ($request->hasFile('foto_ktp')) {
            $path = $request->file('foto_ktp')->store('ktp', 'public');
            $validatedData['file_ktp'] = $path;
        }
        unset($validatedData['foto_ktp']); 

        // 5. NILAI BAWAAN SISTEM & STATUS DEFAULT
        $validatedData['provinsi'] = 'JAMBI';
        $validatedData['kabupaten_kota'] = 'KOTA JAMBI';
        
        // ---> PENAMBAHAN KODE DI SINI <---
        // Set otomatis Nonaktif dan Pending saat pertama kali mendaftar
        $validatedData['status_akun'] = 'Nonaktif'; 
        $validatedData['status_pendaftaran'] = 'Pending';

        // 6. Buat ID kustom berbasis NIK (Contoh: RDK-1571060202870001)
        $validatedData['id'] = 'RDK-' . $validatedData['nik'];

        // 7. Simpan data ke database
        PendaftarRedkar::create($validatedData);

        // 8. Redirect dengan pesan sukses
        return back()->with('success', 'Pendaftaran REDKAR berhasil dikirim! Silakan tunggu konfirmasi admin.');
    }

    // --- FUNGSI BARU: PROSES LOGIN REDKAR ---
    public function processLoginRedkar(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        // Cari relawan berdasarkan username
        $relawan = PendaftarRedkar::where('username', $request->username)->first();

        if ($relawan) {
            // Cocokkan password
            if (Hash::check($request->password, $relawan->password)) {
                
                // CEK STATUS: Apakah akun aktif / sudah diverifikasi admin?
                if ($relawan->status_akun !== 'Aktif') {
                    return back()->with('error', 'Mohon maaf, akun Anda belum diverifikasi oleh admin atau sedang dinonaktifkan.');
                }

                // Jika aktif, loloskan login dengan guard 'redkar'
                Auth::guard('redkar')->login($relawan, $request->has('remember'));
                
                return redirect()->route('redkar.dashboard')->with('success', 'Selamat datang kembali, ' . $relawan->nama_lengkap . '!');
            }
        }

        // Jika salah username/password
        return back()->with('error', 'Username atau Password yang Anda masukkan salah.');
    }

    // --- FUNGSI BARU: PROSES LOGOUT REDKAR ---
    public function logoutRedkar(Request $request)
    {
        Auth::guard('redkar')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.redkar')->with('success', 'Anda telah berhasil keluar dari dasbor relawan.');
    }


    // ====================================================
    // AREA INTERNAL (ADMIN / PEGAWAI)
    // ====================================================

    // Method khusus untuk cetak PDF (Menerima parameter $id dari URL)
    public function cetakRedkar($id)
    {
        $relawan = PendaftarRedkar::findOrFail($id);
        return view('internal.pencegahan.cetak_redkar', compact('relawan'));
    }

    // Method untuk verifikasi / aktivasi akun Redkar oleh admin
    public function verifikasiRedkar(Request $request, $id)
    {
        $relawan = PendaftarRedkar::findOrFail($id);
        
        $request->validate([
            'status_akun'        => 'required|in:Aktif,Nonaktif',
            'status_pendaftaran' => 'required|in:Pending,Diterima,Ditolak'
        ]);

        $relawan->status_akun = $request->status_akun;
        $relawan->status_pendaftaran = $request->status_pendaftaran;
        $relawan->save();

        return back()->with('success', 'Status akun dan pendaftaran relawan ' . $relawan->nama_lengkap . ' berhasil diperbarui!');
    }

    // Menampilkan form edit relawan
    public function editRedkar($id)
    {
        $relawan = PendaftarRedkar::findOrFail($id);
        return view('internal.pencegahan.edit_redkar', compact('relawan'));
    }

    // Memproses update data relawan secara lengkap
    public function updateRedkar(Request $request, $id)
    {
        $relawan = PendaftarRedkar::findOrFail($id);
        
        $validatedData = $request->validate([
            'nama_lengkap'              => 'required|string|max:150',
            'nik'                       => 'required|string|size:16',
            'nomor_telp'                => 'required|string|max:20',
            'tempat_lahir'              => 'required|string|max:100',
            'tanggal_lahir'             => 'required|date',
            'jenis_kelamin'             => 'required|in:Laki-Laki,Perempuan',
            'agama'                     => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan'         => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'alamat'                    => 'required|string',
            'rt_rw'                     => 'required|string|max:10',
            'kode_pos'                  => 'required|string|max:10',
            'kecamatan'                 => 'required|string|max:50',
            'kelurahan'                 => 'required|string|max:50',
            'pendidikan_terakhir'       => 'required|in:SD,SMP,SMA,D3,S1,S2',
            'latar_belakang_pendidikan' => 'required|string|max:255',
            'jenis_pekerjaan'           => 'required|string|max:100',
            'pekerjaan_lainnya'         => 'nullable|string|max:255|required_if:jenis_pekerjaan,Lainnya',
            'sehat_jasmani'             => 'required|in:Ya,Tidak',
            'golongan_darah'            => 'required|in:A,B,AB,O,Tidak Tahu',
            'status_pendaftaran'        => 'required|in:Pending,Diterima,Ditolak',
            'foto_ktp'                  => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048', // Tambahan validasi foto
        ]);

        // Logika penggabungan pekerjaan
        $pekerjaanFinal = $request->jenis_pekerjaan;
        if ($pekerjaanFinal === 'Lainnya') {
            $pekerjaanFinal = $request->pekerjaan_lainnya;
        }
        $validatedData['pekerjaan'] = $pekerjaanFinal; 
        
        unset($validatedData['jenis_pekerjaan']);
        unset($validatedData['pekerjaan_lainnya']);

        // LOGIKA BARU: Cek & Proses Upload Foto KTP Baru
        if ($request->hasFile('foto_ktp')) {
            // Hapus file lama jika ada dan bukan data dummy "offline_registered"
            if ($relawan->file_ktp && $relawan->file_ktp !== 'offline_registered' && Storage::disk('public')->exists($relawan->file_ktp)) {
                Storage::disk('public')->delete($relawan->file_ktp);
            }
            
            // Simpan foto KTP yang baru diupload
            $path = $request->file('foto_ktp')->store('ktp', 'public');
            $validatedData['file_ktp'] = $path;
        }
        // Pastikan input 'foto_ktp' dihapus dari array karena nama kolom di database adalah 'file_ktp'
        unset($validatedData['foto_ktp']); 

        // Simpan perubahan ke database
        $relawan->update($validatedData);

        return redirect('/internal/pencegahan/kelola-redkar')->with('success', 'Data relawan atas nama ' . $relawan->nama_lengkap . ' berhasil diperbarui!');
    }

    // Menghapus data relawan
    public function hapusRedkar($id)
    {
        $relawan = PendaftarRedkar::findOrFail($id);
        
        // Hapus file KTP jika ada
        if ($relawan->file_ktp && $relawan->file_ktp !== 'offline_registered' && Storage::disk('public')->exists($relawan->file_ktp)) {
            Storage::disk('public')->delete($relawan->file_ktp);
        }

        $relawan->delete();

        return back()->with('success', 'Data relawan berhasil dihapus dari sistem.');
    }

    // Menampilkan form tambah relawan offline oleh pegawai
    public function createRedkar()
    {
        return view('internal.pencegahan.tambah_redkar');
    }

    // Memproses penyimpanan data relawan offline
    public function storeRedkarOffline(Request $request)
    {
        $validatedData = $request->validate([
            'username'                  => 'required|string|max:255|unique:redkar_registrations,username',
            'password'                  => 'required|string|min:6',
            'nama_lengkap'              => 'required|string|max:150',
            'nik'                       => 'required|string|size:16|unique:redkar_registrations,nik',
            'nomor_telp'                => 'required|string|max:20',
            'tempat_lahir'              => 'required|string|max:100',
            'tanggal_lahir'             => 'required|date',
            'jenis_kelamin'             => 'required|in:Laki-Laki,Perempuan',
            'agama'                     => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan'         => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'alamat'                    => 'required|string',
            'rt_rw'                     => 'required|string|max:10',
            'kode_pos'                  => 'required|string|max:10',
            'kecamatan'                 => 'required|string|max:50',
            'kelurahan'                 => 'required|string|max:50',
            'pendidikan_terakhir'       => 'required|in:SD,SMP,SMA,D3,S1,S2',
            'latar_belakang_pendidikan' => 'required|string|max:255',
            'jenis_pekerjaan'           => 'required|string|max:100',
            'pekerjaan_lainnya'         => 'nullable|string|max:255|required_if:jenis_pekerjaan,Lainnya',
            'sehat_jasmani'             => 'required|in:Ya,Tidak',
            'golongan_darah'            => 'required|in:A,B,AB,O,Tidak Tahu',
            'status_akun'               => 'required|in:Aktif,Nonaktif',
            'status_pendaftaran'        => 'required|in:Pending,Diterima,Ditolak',
            'foto_ktp'                  => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Hash Password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Logika Pekerjaan Lainnya
        $pekerjaanFinal = $request->jenis_pekerjaan;
        if ($pekerjaanFinal === 'Lainnya') {
            $pekerjaanFinal = $request->pekerjaan_lainnya;
        }
        $validatedData['pekerjaan'] = $pekerjaanFinal; 
        
        unset($validatedData['jenis_pekerjaan']);
        unset($validatedData['pekerjaan_lainnya']);

        // Tangani file KTP (Jika di-upload simpan file, jika tidak berikan teks penanda offline)
        if ($request->hasFile('foto_ktp')) {
            $path = $request->file('foto_ktp')->store('ktp', 'public');
            $validatedData['file_ktp'] = $path;
        } else {
            $validatedData['file_ktp'] = 'offline_registered'; // Mencegah error kolom tidak boleh null
        }
        unset($validatedData['foto_ktp']);

        // Nilai bawaan sistem
        $validatedData['provinsi'] = 'JAMBI';
        $validatedData['kabupaten_kota'] = 'KOTA JAMBI';
        $validatedData['id'] = 'RDK-' . $validatedData['nik'];

        PendaftarRedkar::create($validatedData);

        return redirect('/internal/pencegahan/kelola-redkar')->with('success', 'Data relawan offline berhasil ditambahkan ke sistem!');
    }
    // --- FUNGSI BARU: HALAMAN PROFIL REDKAR ---
    public function profilRedkar()
    {
        // Ambil data relawan yang sedang login
        $user = Auth::guard('redkar')->user();
        
        return view('redkar.profil', compact('user'));
>>>>>>> 7800cb3e9effe44e5ed2c2ab0d8e2c1b18246573
    }
}