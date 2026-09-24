<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftarRedkar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class RedkarController extends Controller
{
    // ====================================================
    // AREA PUBLIK (RELAWAN)
    // ====================================================

    // Menampilkan halaman form pendaftaran publik
    public function index()
    {
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
        
        // Set otomatis Nonaktif dan Pending saat pertama kali mendaftar
        $validatedData['status_akun'] = 'Nonaktif'; 
        $validatedData['status_pendaftaran'] = 'Pending';

        // 6. Buat ID kustom berbasis NIK
        $validatedData['id'] = 'RDK-' . $validatedData['nik'];

        // 7. Simpan data ke database
        PendaftarRedkar::create($validatedData);

        // 8. Redirect dengan pesan sukses
        return back()->with('success', 'Pendaftaran REDKAR berhasil dikirim! Silakan tunggu konfirmasi admin.');
    }

   public function processLoginRedkar(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $relawan = PendaftarRedkar::where('username', $request->username)->first();

        if (!$relawan) {
            return back()->withInput()->with('error', 'Username tidak terdaftar di sistem.');
        }

        if (!Hash::check($request->password, $relawan->password)) {
            return back()->withInput()->with('error', 'Password yang Anda masukkan salah.');
        }

        // --- UBAH DI SINI: HANYA CEK STATUS AKUN YANG AKTIF ---
        if ($relawan->status_akun !== 'Aktif') {
            return back()->withInput()->with('error', 'Mohon maaf, akun Anda belum diaktifkan oleh admin.');
        }

        Auth::guard('redkar')->login($relawan);
        $request->session()->regenerate();
        
        return redirect()->to('/redkar/dashboard')->with('success', 'Selamat datang kembali, ' . $relawan->nama_lengkap . '!');
    }
    // --- PROSES LOGOUT REDKAR ---
    public function logoutRedkar(Request $request)
    {
        Auth::guard('redkar')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login-redkar')->with('success', 'Anda telah berhasil keluar dari dasbor relawan.');
    }

    // --- HALAMAN PROFIL REDKAR ---
    public function profilRedkar()
    {
        $user = Auth::guard('redkar')->user();
        return view('redkar.profil', compact('user'));
    }

    // ====================================================
    // AREA INTERNAL (ADMIN / PEGAWAI)
    // ====================================================

    public function kelolaRedkarInternal()
    {
        $relawan = PendaftarRedkar::orderBy('created_at', 'desc')->get();
        return view('internal.pencegahan.kelola_redkar', compact('relawan'));
    }

    public function cetakRedkar($id)
    {
        $relawan = PendaftarRedkar::findOrFail($id);
        return view('internal.pencegahan.cetak_redkar', compact('relawan'));
    }

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

    public function editRedkar($id)
    {
        $relawan = PendaftarRedkar::findOrFail($id);
        return view('internal.pencegahan.edit_redkar', compact('relawan'));
    }

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
            'foto_ktp'                  => 'nullable|file|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pekerjaanFinal = $request->jenis_pekerjaan;
        if ($pekerjaanFinal === 'Lainnya') {
            $pekerjaanFinal = $request->pekerjaan_lainnya;
        }
        $validatedData['pekerjaan'] = $pekerjaanFinal; 
        
        unset($validatedData['jenis_pekerjaan']);
        unset($validatedData['pekerjaan_lainnya']);

        if ($request->hasFile('foto_ktp')) {
            if ($relawan->file_ktp && $relawan->file_ktp !== 'offline_registered' && Storage::disk('public')->exists($relawan->file_ktp)) {
                Storage::disk('public')->delete($relawan->file_ktp);
            }
            
            $path = $request->file('foto_ktp')->store('ktp', 'public');
            $validatedData['file_ktp'] = $path;
        }
        unset($validatedData['foto_ktp']); 

        $relawan->update($validatedData);

        return redirect('/internal/pencegahan/kelola-redkar')->with('success', 'Data relawan atas nama ' . $relawan->nama_lengkap . ' berhasil diperbarui!');
    }

    public function hapusRedkar($id)
    {
        $relawan = PendaftarRedkar::findOrFail($id);
        
        if ($relawan->file_ktp && $relawan->file_ktp !== 'offline_registered' && Storage::disk('public')->exists($relawan->file_ktp)) {
            Storage::disk('public')->delete($relawan->file_ktp);
        }

        $relawan->delete();

        return back()->with('success', 'Data relawan berhasil dihapus dari sistem.');
    }

    public function createRedkar()
    {
        return view('internal.pencegahan.tambah_redkar');
    }

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

        $validatedData['password'] = Hash::make($validatedData['password']);

        $pekerjaanFinal = $request->jenis_pekerjaan;
        if ($pekerjaanFinal === 'Lainnya') {
            $pekerjaanFinal = $request->pekerjaan_lainnya;
        }
        $validatedData['pekerjaan'] = $pekerjaanFinal; 
        
        unset($validatedData['jenis_pekerjaan']);
        unset($validatedData['pekerjaan_lainnya']);

        if ($request->hasFile('foto_ktp')) {
            $path = $request->file('foto_ktp')->store('ktp', 'public');
            $validatedData['file_ktp'] = $path;
        } else {
            $validatedData['file_ktp'] = 'offline_registered'; 
        }
        unset($validatedData['foto_ktp']);

        $validatedData['provinsi'] = 'JAMBI';
        $validatedData['kabupaten_kota'] = 'KOTA JAMBI';
        $validatedData['id'] = 'RDK-' . $validatedData['nik'];

        PendaftarRedkar::create($validatedData);

        return redirect('/internal/pencegahan/kelola-redkar')->with('success', 'Data relawan offline berhasil ditambahkan ke sistem!');
    }
    }

}