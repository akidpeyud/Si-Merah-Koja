<?php

namespace App\Http\Controllers;

use App\Models\RedkarRegistration;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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
            'nomor_pegawai.required' => 'Nomor kepegawaian wajib diisi.',
        ]);

        $user = User::where('email', $request->email)
            ->where('nomor_pegawai', $request->nomor_pegawai)
            ->first();

        if (! $user) {
            return back()->withErrors([
                'email' => 'Kombinasi Email dan Nomor Kepegawaian tidak ditemukan di sistem.',
            ])->onlyInput('email', 'nomor_pegawai');
        }

        $passwordBaru = 'Damkar'.rand(1000, 9999);
        $user->password = Hash::make($passwordBaru);
        $user->save();

        $pesanEmail = 'Halo '.$user->nama_lengkap.",\n\n"
                    ."Permintaan reset password untuk akun SIMERAH KOJA Anda berhasil diverifikasi.\n"
                    ."Berikut adalah password sementara Anda:\n\n"
                    .'Password Baru: '.$passwordBaru."\n\n"
                    ."Silakan login menggunakan password ini dan segera ubah password Anda di menu Pengaturan Akun demi keamanan.\n\n"
                    ."Salam,\nTim Administrator SIMERAH KOJA";

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
            'password_baru.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        $user = Auth::user();

        if (! Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password lama yang Anda masukkan salah.']);
        }

        $user->password = Hash::make($request->password_baru);
        $user->save();

        return back()->with('success', 'Password Anda berhasil diperbarui!');
    }

    // Menampilkan halaman Kelola User (Khusus Super User)
    public function kelolaUser()
    {
        // Menggunakan method bawaan Spatie
        if (! Auth::user()->hasRole('Super User')) {
            return redirect('/internal/index')->with('error', 'Akses Ditolak! Hanya Super User yang dapat mengelola pengguna.');
        }

        $users = User::orderBy('created_at', 'desc')->get();

        return view('internal.kelola_user', compact('users'));
    }

    // Memproses penambahan user baru
    public function storeUser(Request $request)
    {
        if (! Auth::user()->hasRole('Super User')) {
            return redirect('/internal/index')->with('error', 'Akses Ditolak!');
        }

        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'nomor_pegawai' => ['required', 'unique:users,nomor_pegawai'],
            'role' => ['required'],
        ]);

        $user = new User;
        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->nomor_pegawai = $request->nomor_pegawai;
        $user->password = Hash::make('Damkar123');
        $user->role = $request->role; // Tetap simpan di kolom lama untuk berjaga-jaga
        $user->save();

        // TAMBAHAN SPATIE: Assign role ke user baru
        $user->assignRole($request->role);

        return back()->with('success', 'Pengguna baru berhasil ditambahkan! Password default: Damkar123');
    }

    // Memproses update data user
    public function updateUser(Request $request, $id)
    {
        if (! Auth::user()->hasRole('Super User')) {
            return redirect('/internal/index')->with('error', 'Akses Ditolak!');
        }

        $user = User::findOrFail($id);

        $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$id],
            'nomor_pegawai' => ['required', 'unique:users,nomor_pegawai,'.$id],
            'role' => ['required'],
        ]);

        $user->nama_lengkap = $request->nama_lengkap;
        $user->email = $request->email;
        $user->nomor_pegawai = $request->nomor_pegawai;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // TAMBAHAN SPATIE: Cabut role lama & pasangkan role baru
        $user->syncRoles([$request->role]);

        return back()->with('success', 'Data pengguna berhasil diperbarui!');
    }

    // Menghapus data pengguna internal (Khusus Super User)
    public function destroyUser($id)
    {
        if (! Auth::user()->hasRole('Super User')) {
            return redirect('/internal/index')->with('error', 'Akses Ditolak! Hanya Super User yang dapat menghapus pengguna.');
        }

        if (Auth::id() == $id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif digunakan.');
        }

        $user = User::findOrFail($id);
        $nama = $user->nama_lengkap;
        $user->delete();

        return back()->with('success', 'Pengguna '.$nama.' berhasil dihapus!');
    }

    // Menampilkan halaman Kelola Akun Pemohon (Khusus Super User)
    public function kelolaPemohon()
    {
        if (! Auth::user()->hasRole('Super User')) {
            return redirect('/internal/index')->with('error', 'Akses Ditolak! Hanya Super User yang dapat mengelola akun pemohon.');
        }

        $pemohons = DB::table('pemohons')->orderBy('created_at', 'desc')->get();

        return view('pemohon.kelola_pemohon', compact('pemohons'));
    }

    // Menambah akun pemohon secara manual (Khusus Super User)
    public function storePemohon(Request $request)
    {
        if (! Auth::user()->hasRole('Super User')) {
            return redirect('/internal/index')->with('error', 'Akses Ditolak!');
        }

        $request->validate([
            'nik' => ['required', 'string', 'size:16', 'unique:pemohons,nik'],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:pemohons,email'],
            'no_whatsapp' => ['required', 'string', 'max:30'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['nullable', 'string', 'max:50'],
        ]);

        DB::table('pemohons')->insert([
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_whatsapp' => $request->no_whatsapp,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'pemohon',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Akun pemohon baru berhasil ditambahkan!');
    }

    // Mengupdate data akun pemohon (Khusus Super User)
    public function updatePemohon(Request $request, $id)
    {
        if (! Auth::user()->hasRole('Super User')) {
            return redirect('/internal/index')->with('error', 'Akses Ditolak!');
        }

        $request->validate([
            'nik' => ['required', 'string', 'size:16', 'unique:pemohons,nik,'.$id],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:pemohons,email,'.$id],
            'no_whatsapp' => ['required', 'string', 'max:30'],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['nullable', 'string', 'max:50'],
        ]);

        $updateData = [
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'no_whatsapp' => $request->no_whatsapp,
            'role' => $request->role ?? 'pemohon',
            'updated_at' => now(),
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        DB::table('pemohons')->where('id', $id)->update($updateData);

        return back()->with('success', 'Data akun pemohon berhasil diperbarui!');
    }

    // Menghapus akun pemohon (Khusus Super User)
    public function destroyPemohon($id)
    {
        if (! Auth::user()->hasRole('Super User')) {
            return redirect('/internal/index')->with('error', 'Akses Ditolak!');
        }

        $pemohon = DB::table('pemohons')->where('id', $id)->first();
        if ($pemohon) {
            DB::table('pemohons')->where('id', $id)->delete();

            return back()->with('success', 'Akun pemohon '.$pemohon->nama_lengkap.' berhasil dihapus!');
        }

        return back()->with('error', 'Data akun pemohon tidak ditemukan.');
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
        // Dibiarkan terbuka tanpa batasan agar semua role yang login bisa Read-Only data Redkar
        $relawan = RedkarRegistration::orderBy('created_at', 'desc')->get();

        return view('internal.pencegahan.kelola_redkar', compact('relawan'));
    }

    // Menampilkan halaman cetak PDF untuk 1 relawan
    public function cetakRedkar($id)
    {
        // Dibiarkan terbuka tanpa batasan agar semua role bisa mencetak PDF
        $relawan = RedkarRegistration::findOrFail($id);

        return view('internal.pencegahan.cetak_redkar', compact('relawan'));
    }
}
