<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun REDKAR | SIMERAH KOJA</title>
<link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
            font-family: 'Plus Jakarta Sans', sans-serif; 
        }

        body {
            /* Background layar penuh dengan overlay gelap elegan */
            background-image: linear-gradient(rgba(17, 24, 39, 0.75), rgba(17, 24, 39, 0.9)), url('/images/background1.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1f2937;
        }

        /* --- NOTIFIKASI TOAST (Sama seperti Kelola Redkar) --- */
        .toast-wrap { 
            position: fixed; z-index: 9999; top: 20px; left: 50%; 
            transform: translateX(-50%); display: grid; gap: 10px; 
            width: max-content; max-width: calc(100vw - 24px); 
        }
        .toast {
            display: flex; align-items: flex-start; gap: 12px; padding: 12px 12px 12px 16px;
            border-radius: 20px; background: #fff; border: 1px solid #d1d5db;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            font-weight: 600; font-size: 13.5px; color: #1f2937;
            animation: toastIn .45s cubic-bezier(.16,.84,.3,1) both;
        }
        .toast.ok { border-radius: 999px; align-items: center; } /* Membulat jika sukses */
        .toast.leaving { animation: toastOut .3s ease forwards; }
        
        .toast-ico { flex: none; width: 28px; height: 28px; border-radius: 50%; display: grid; place-items: center; color: #fff; font-size: 12px; margin-top: 2px; }
        .toast.ok .toast-ico { background: #10b981; margin-top: 0; }
        .toast.err .toast-ico { background: #ef4444; }
        
        .toast-content { flex: 1; display: flex; flex-direction: column; justify-content: center; min-height: 28px; padding-top: 3px; }
        .toast.ok .toast-content { padding-top: 0; }
        .toast-content ul { margin: 4px 0 0 0; padding-left: 18px; font-weight: 500; font-size: 12.5px; color: #ef4444; }
        
        .toast-x { flex: none; width: 30px; height: 30px; border-radius: 50%; display: grid; place-items: center; background: #f3f4f6; color: #6b7280; transition: background .2s, color .2s; border: none; cursor: pointer; }
        .toast-x:hover { background: #111827; color: #fff; }
        
        @keyframes toastIn { from { opacity: 0; transform: translateY(-14px); } to { opacity: 1; transform: none; } }
        @keyframes toastOut { from { opacity: 1; transform: none; } to { opacity: 0; transform: translateY(-14px); } }

        /* --- LOGIN CARD STYLES --- */
        .login-card {
            background-color: #ffffff;
            width: 100%;
            max-width: 420px;
            border-radius: 12px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden; 
            animation: slideUpFade 0.6s cubic-bezier(0.16, 1, 0.3, 1);
            margin: 20px;
        }

        .login-header-dark {
            background-color: #111827;
            padding: 35px 20px 25px 20px;
            text-align: center;
            border-bottom: 4px solid #ef4444; 
        }
        
        .login-header-dark img {
            height: 65px;
            margin-bottom: 12px;
            filter: drop-shadow(0 0 10px rgba(239, 68, 68, 0.3));
        }

        .login-header-dark h3 {
            font-size: 16px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }

        .login-header-dark p {
            font-size: 11.5px;
            color: #9ca3af;
            margin: 0;
            line-height: 1.4;
        }

        .login-body { padding: 30px 35px 35px 35px; }
        .login-title { text-align: center; font-size: 17px; font-weight: 800; color: #1f2937; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-label { font-size: 12px; font-weight: 600; color: #4b5563; margin-bottom: 6px; }

        .input-group-text { background-color: #ffffff; border-color: #d1d5db; color: #9ca3af; border-right: none; transition: all 0.2s; }
        .form-control { font-size: 13.5px; padding: 12px 15px; border-color: #d1d5db; border-left: none; color: #1f2937; transition: all 0.2s; }

        .input-group:focus-within .input-group-text,
        .input-group:focus-within .form-control,
        .input-group:focus-within .btn-toggle-password { border-color: #ef4444; box-shadow: none; }
        .input-group:focus-within .input-group-text i { color: #ef4444; }
        .form-control:focus { background-color: #fffafb; }

        .btn-toggle-password { cursor: pointer; border-left: none; border-color: #d1d5db; background-color: #ffffff; color: #9ca3af; transition: 0.2s; }
        .btn-toggle-password:hover i { color: #1f2937; }

        .btn-login-submit {
            background-color: #ef4444; color: white; font-weight: 700; font-size: 13.5px;
            padding: 14px; border: none; border-radius: 6px; width: 100%; transition: 0.3s;
            margin-top: 10px; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .btn-login-submit:hover { background-color: #dc2626; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }

        .forgot-link { font-size: 12px; font-weight: 600; color: #9ca3af; text-decoration: none; transition: 0.2s; }
        .forgot-link:hover { color: #ef4444; }

        .bottom-links { text-align: center; margin-top: 25px; font-size: 12.5px; color: #6b7280; display: flex; flex-direction: column; gap: 10px; }
        .bottom-links a { color: #4b5563; font-weight: 700; text-decoration: none; transition: 0.2s; }
        .bottom-links a:hover { color: #ef4444; }

        @keyframes slideUpFade { from { transform: translateY(40px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }
    </style>
</head>
<body>

    <!-- NOTIFIKASI TOAST (Sama seperti halaman Kelola Redkar) -->
    <div class="toast-wrap" id="toastWrap" aria-live="polite">
        @if(session('success'))
            <div class="toast ok" data-toast>
                <span class="toast-ico"><i class="fas fa-check"></i></span>
                <div class="toast-content">{{ session('success') }}</div>
                <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
            </div>
        @endif
        
        @if(session('error') || $errors->any())
            <div class="toast err" data-toast>
                <span class="toast-ico"><i class="fas fa-triangle-exclamation"></i></span>
                <div class="toast-content">
                    @if(session('error'))
                        <span>{{ session('error') }}</span>
                    @endif
                    
                    @if($errors->any())
                        @if(!session('error')) <span>Gagal Masuk:</span> @endif
                        <ul>
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <button type="button" class="toast-x" aria-label="Tutup notifikasi" data-toast-close><i class="fas fa-times"></i></button>
            </div>
        @endif
    </div>

    <div class="login-card">
        <!-- HEADER GELAP -->
        <div class="login-header-dark">
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
            <h3>SIMERAH KOJA</h3>
            <p>Sistem Informasi Penanggulangan Kebakaran dan Penyelamatan Daerah Kota Jambi</p>
        </div>

        <!-- BODY PUTIH -->
        <div class="login-body">
            <h2 class="login-title">MASUK AKUN REDKAR</h2>

            <form action="/login-redkar" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label class="form-label">Username Redkar</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Masukkan username Anda" required autofocus autocomplete="off">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" class="form-control" name="password" id="password_input" placeholder="Masukkan password Anda" required>
                        <span class="input-group-text btn-toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye" id="eye_icon"></i>
                        </span>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check m-0">
                        <input class="form-check-input shadow-none" type="checkbox" name="remember" id="rememberMe" style="cursor: pointer;">
                        <label class="form-check-label text-muted" for="rememberMe" style="font-size: 12.5px; cursor: pointer; padding-top: 2px;">
                            Ingat Saya
                        </label>
                    </div>
                    <a href="#" class="forgot-link">Lupa Password?</a>
                </div>

                <button type="submit" class="btn-login-submit">
                    LOGIN
                </button>
            </form>

            <div class="bottom-links">
                <div>Belum terdaftar sebagai relawan? <a href="/redkar" style="color: #ef4444;">Daftar di sini</a></div>
                <div><a href="/"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a></div>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    /* ---------- Notifikasi Toast Logic ---------- */
    document.querySelectorAll('[data-toast]').forEach(function (t) {
        var hide = function () {
            t.classList.add('leaving');
            setTimeout(function () { t.remove(); }, 350);
        };
        var x = t.querySelector('[data-toast-close]');
        if (x) x.addEventListener('click', hide);
        setTimeout(hide, 6000); // Otomatis hilang setelah 6 detik
    });

    /* ---------- Fungsi Toggle Password ---------- */
    function togglePassword() {
        const passwordInput = document.getElementById("password_input");
        const eyeIcon = document.getElementById("eye_icon");
        
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        }
    }
</script>
</body>
</html>