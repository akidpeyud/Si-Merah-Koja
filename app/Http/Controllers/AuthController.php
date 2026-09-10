<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\RedkarRegistration;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('login.login');
    }

    // Memproses data login
    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/internal/index')->with('success', 'Login berhasil, selamat datang di SIMERAH KOJA!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    // Menampilkan halaman lupa password
    public function showForgotPassword()
    {
        return view('login.lupa_password');
    }

    // Memproses reset password
    public function processForgotPassword(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'nomor_pegawai' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'nomor_pegawai.required' => 'Nomor kepegawaian wajib diisi.'
        ]);

        $user = User::where('email', $request->email)
                    ->where('nomor_pegawai', $request->nomor_pegawai)
                    ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Kombinasi Email dan Nomor Kepegawaian tidak ditemukan di sistem.',
            ])->onlyInput('email', 'nomor_pegawai');
        }

        $passwordBaru = 'Damkar' . rand(1000, 9999);
        $user->password = Hash::make($passwordBaru);
        $user->save();

        $pesanEmail = "Halo " . $user->nama_lengkap . ",\n\n"
                    . "Permintaan reset password untuk akun SIMERAH KOJA Anda berhasil diverifikasi.\n"
                    . "Berikut adalah password sementara Anda:\n\n"
                    . "Password Baru: " . $passwordBaru . "\n\n"
                    . "Silakan login menggunakan password ini dan segera ubah password Anda di menu Pengaturan Akun demi keamanan.\n\n"
                    . "Salam,\nTim Administrator SIMERAH KOJA";

        Mail::raw($pesanEmail, function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Reset Password Akun SIMERAH KOJA');
        });

        return redirect('/login')->with('success', 'Password baru telah dikirim ke email Anda. Silakan cek kotak masuk.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }

    // Menampilkan halaman profil
    public function showProfile()
    {
        return view('internal.profil');
    }

    // Memproses perubahan password dari halaman profil
    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => ['required'],
            'password_baru' => ['required', 'min:6', 'confirmed'],
        ], [
            'password_lama.required' => 'Password lama wajib diisi.',
            'password_baru.required' => 'Password baru wajib diisi.',
            'password_baru.min' => 'Password baru minimal 6 karakter.',
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.'
        ]);

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama yang Anda masukkan salah.']);
        }

        $user->password = Hash::make($request->password_baru);
        $user->save();

        return back()->with('success', 'Password Anda berhasil diperbarui!');
    }

    // Menampilkan halaman Kelola User (Khusus Super User)
    public function kelolaUser()
    {
        if (Auth::user()->role !== 'super_user') {
            return redirect('/internal/index')->with('error', 'Akses Ditolak! Hanya Super User yang dapat mengelola pengguna.');
        }

        $users = User::orderBy('created_at', 'desc')->get();
        
        return view('internal.kelola_user', compact('users'));
    }

    // Memproses penambahan user baru
    public function storeUser(Request $request)
    {
        if (Auth::user()->role !== 'super_user') {
            return redirect('/internal/index')->with('error', 'Akses Ditolak!');
        }

        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'nomor_pegawai' => ['required', 'unique:users,nomor_pegawai'],
            'role' => ['required']
        ]);

        $user = new User();
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->nomor_pegawai = $request->nomor_pegawai;
        $user->password = Hash::make('Damkar123'); 
        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'Pengguna baru berhasil ditambahkan! Password default: Damkar123');
    }

    // Memproses update data user
    public function updateUser(Request $request, $id)
    {
        if (Auth::user()->role !== 'super_user') {
            return redirect('/internal/index')->with('error', 'Akses Ditolak!');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'nomor_pegawai' => ['required', 'unique:users,nomor_pegawai,' . $id],
            'role' => ['required']
        ]);

        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->nomor_pegawai = $request->nomor_pegawai;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // Memproses pendaftaran relawan Redkar dari halaman publik
    public function storeRedkar(Request $request)
    {
        $request->validate([
            'nik' => ['required', 'string', 'unique:redkar_registrations,nik'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'jenis_kelamin' => ['required'],
            'tempat_lahir' => ['required'],
            'tanggal_lahir' => ['required', 'date'],
            'status_perkawinan' => ['required'],
            'agama' => ['required'],
            'nomor_telp' => ['required'],
            'ktp' => ['required', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'alamat' => ['required'],
            'rt_rw' => ['required'],
            'kode_pos' => ['required'],
            'kecamatan' => ['required'],
            'kelurahan' => ['required'],
            'pekerjaan' => ['required'],
            'pendidikan_terakhir' => ['required'],
            'sehat_jasmani' => ['required'],
            'buta_warna' => ['required'],
            'golongan_darah' => ['required'],
        ]);

        $ktpPath = null;
        if ($request->hasFile('ktp')) {
            $ktpPath = $request->file('ktp')->store('ktp_redkar', 'public');
        }

        RedkarRegistration::create([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status_perkawinan' => $request->status_perkawinan,
            'agama' => $request->agama,
            'nomor_telp' => $request->nomor_telp,
            'ktp' => $ktpPath,
            'alamat' => $request->alamat,
            'rt_rw' => $request->rt_rw,
            'kode_pos' => $request->kode_pos,
            'provinsi' => 'JAMBI',
            'kabupaten_kota' => 'KOTA JAMBI',
            'kecamatan' => $request->kecamatan,
            'kelurahan' => $request->kelurahan,
            'pekerjaan' => $request->pekerjaan,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'sehat_jasmani' => $request->sehat_jasmani,
            'buta_warna' => $request->buta_warna,
            'golongan_darah' => $request->golongan_darah,
        ]);

        return back()->with('success', 'Pendaftaran relawan REDKAR berhasil dikirim! Data Anda sedang diproses.');
    }

    public function kelolaRedkar()
    {
        // Izinkan 'user' (Pegawai Internal) dan 'super_user' untuk mengakses
        if (!in_array(Auth::user()->role, ['user', 'super_user'])) {
            return redirect('/internal/index')->with('error', 'Akses Ditolak!');
        }

        $relawan = RedkarRegistration::orderBy('created_at', 'desc')->get();
        
        // Diubah ke folder pencegahan
        return view('internal.pencegahan.kelola_redkar', compact('relawan'));
    }

    // Menampilkan halaman cetak PDF untuk 1 relawan
    public function cetakRedkar($id)
    {
        // Izinkan 'user' dan 'super_user'
        if (!in_array(Auth::user()->role, ['user', 'super_user'])) {
            return redirect('/internal/index')->with('error', 'Akses Ditolak!');
        }

        $relawan = RedkarRegistration::findOrFail($id); 
        
        // Diubah ke folder pencegahan
        return view('internal.pencegahan.cetak_redkar', compact('relawan'));
    }
}