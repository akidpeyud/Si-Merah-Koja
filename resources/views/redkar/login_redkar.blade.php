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

        /* --- POPUP NOTIFIKASI STYLES (SUKSES & ERROR) --- */
        .popup-overlay {
            position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
            background-color: rgba(17, 24, 39, 0.85); backdrop-filter: blur(4px);
            display: flex; align-items: center; justify-content: center; z-index: 999999;
            animation: fadeInOverlay 0.3s ease forwards;
        }
        .popup-box {
            background: #ffffff; border-radius: 16px; padding: 40px 30px; text-align: center;
            max-width: 420px; width: 90%; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: popInBox 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
            position: relative; overflow: hidden;
        }
        .popup-box.success::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background-color: #10b981; }
        .popup-box.error::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 6px; background-color: #ef4444; }
        
        .popup-icon {
            width: 80px; height: 80px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center; font-size: 40px; margin: 0 auto 20px;
        }
        .popup-box.success .popup-icon { background-color: #ecfdf5; color: #10b981; box-shadow: 0 0 20px rgba(16, 185, 129, 0.15); }
        .popup-box.error .popup-icon { background-color: #fef2f2; color: #ef4444; box-shadow: 0 0 20px rgba(239, 68, 68, 0.15); }
        
        .popup-title { color: #111827; font-size: 22px; font-weight: 800; margin-bottom: 10px; letter-spacing: 0.5px; }
        .popup-message { color: #6b7280; font-size: 14px; line-height: 1.6; margin-bottom: 30px; padding: 0 10px; }
        
        .btn-close-popup {
            color: #ffffff; border: none; padding: 14px 30px; border-radius: 50px; font-weight: 700; font-size: 14px;
            cursor: pointer; transition: all 0.3s; width: 100%; letter-spacing: 1px;
        }
        .popup-box.success .btn-close-popup { background-color: #10b981; }
        .popup-box.success .btn-close-popup:hover { background-color: #059669; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3); }
        
        .popup-box.error .btn-close-popup { background-color: #ef4444; }
        .popup-box.error .btn-close-popup:hover { background-color: #dc2626; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(239, 68, 68, 0.3); }

        @keyframes fadeInOverlay { from { opacity: 0; } to { opacity: 1; } }
        @keyframes popInBox { from { transform: scale(0.7); opacity: 0; } to { transform: scale(1); opacity: 1; } }
        @keyframes fadeOutOverlay { from { opacity: 1; } to { opacity: 0; } }
        @keyframes popOutBox { from { transform: scale(1); opacity: 1; } to { transform: scale(0.7); opacity: 0; } }
    </style>
</head>
<body>

    <!-- ALERT SUKSES POPUP -->
    @if(session('success'))
        <div class="popup-overlay" id="success-popup-overlay">
            <div class="popup-box success" id="success-popup-box">
                <div class="popup-icon"><i class="fas fa-check"></i></div>
                <div class="popup-title">BERHASIL!</div>
                <div class="popup-message">{{ session('success') }}</div>
                <button class="btn-close-popup" onclick="closePopup('success-popup-overlay', 'success-popup-box')">OKE, TERIMA KASIH</button>
            </div>
        </div>
    @endif

    <!-- ALERT ERROR POPUP (Gagal Login atau Kolom Kosong) -->
    @if(session('error') || $errors->any())
        <div class="popup-overlay" id="error-popup-overlay">
            <div class="popup-box error" id="error-popup-box">
                <div class="popup-icon"><i class="fas fa-times"></i></div>
                <div class="popup-title">GAGAL MASUK!</div>
                <div class="popup-message">
                    @if(session('error'))
                        {{ session('error') }}
                    @endif
                    @if($errors->any())
                        <ul style="list-style:none; padding:0; margin:0;">
                            @foreach($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>
                <button class="btn-close-popup" onclick="closePopup('error-popup-overlay', 'error-popup-box')">COBA LAGI</button>
            </div>
        </div>
    @endif

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
    // Fungsi untuk menutup popup animasi
    function closePopup(overlayId, boxId) {
        let overlay = document.getElementById(overlayId);
        let box = document.getElementById(boxId);
        if(overlay && box) { 
            overlay.style.animation = 'fadeOutOverlay 0.4s ease forwards'; 
            box.style.animation = 'popOutBox 0.4s ease forwards'; 
            setTimeout(() => overlay.remove(), 400); 
        }
    }

    // Fungsi untuk menampilkan/menyembunyikan password
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