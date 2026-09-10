<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIMERAH KOJA</title>

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
            /* --- SPLASH SCREEN STYLES --- */
#splash-screen {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background-color: #0b0f19; /* Latar belakang gelap */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    transition: opacity 0.5s ease, visibility 0.5s ease;
}

.splash-logo-container {
    text-align: center;
    animation: pulseLogo 1.5s infinite alternate;
}

.splash-logo-container img {
    height: 100px;
    margin-bottom: 20px;
    filter: drop-shadow(0 0 15px rgba(239, 68, 68, 0.4));
}

.splash-title {
    color: #ffffff;
    font-weight: 800;
    font-size: 20px;
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-bottom: 25px;
}

.splash-spinner {
    width: 45px;
    height: 45px;
    border: 4px solid rgba(255, 255, 255, 0.1);
    border-top: 4px solid #ef4444; /* Warna merah loading */
    border-radius: 50%;
    animation: spinLoader 0.8s linear infinite;
}

@keyframes spinLoader {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes pulseLogo {
    0% { transform: scale(0.95); opacity: 0.8; }
    100% { transform: scale(1.05); opacity: 1; }
}

.splash-hidden {
    opacity: 0;
    visibility: hidden;
}
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-image: linear-gradient(rgba(17, 24, 39, 0.7), rgba(17, 24, 39, 0.8)), url('/images/background2.jpeg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #1f2937;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        /* --- LOGIN CARD STYLES --- */
        .login-wrapper {
            width: 100%;
            padding: 20px;
            display: flex;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); 
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .login-header {
            background-color: #111827; 
            border-bottom: 4px solid #ef4444; 
            padding: 40px 30px 30px;
            text-align: center;
        }

        .login-header img {
            height: 130px; 
            margin-bottom: 20px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));
        }

        .login-header p {
            color: #9ca3af;
            font-size: 12px;
            line-height: 1.5;
            margin: 0;
        }

        .login-body {
            padding: 40px 30px;
        }

        .login-title {
            font-size: 20px;
            font-weight: 800;
            color: #111827;
            text-align: center;
            margin-bottom: 25px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- ALERT STYLES (BARU) --- */
        .custom-alert {
            display: flex;
            align-items: flex-start;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            font-weight: 500;
            position: relative;
            line-height: 1.5;
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .custom-alert i.alert-icon {
            font-size: 18px;
            margin-right: 12px;
            margin-top: 1px;
        }

        /* Alert Error (Gagal Login) */
        .custom-alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }
        .custom-alert-error i.alert-icon { color: #ef4444; }

        /* Alert Success (Berhasil/Logout) */
        .custom-alert-success {
            background-color: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #166534;
        }
        .custom-alert-success i.alert-icon { color: #22c55e; }

        /* Tombol Silang Alert */
        .btn-close-alert {
            background: none;
            border: none;
            color: inherit;
            font-size: 20px;
            position: absolute;
            right: 10px;
            top: 10px;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.3s;
        }
        .btn-close-alert:hover { opacity: 1; }

        /* --- FORM STYLES --- */
        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .input-group-text {
            background-color: #f8fafc;
            border-color: #d1d5db;
            color: #9ca3af;
        }

        .form-control {
            font-size: 13px;
            padding: 12px 15px;
            border-color: #d1d5db;
            color: #4b5563;
        }

        .form-control:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 0.25rem rgba(239, 68, 68, 0.1);
        }

        .input-group:focus-within .input-group-text {
            border-color: #ef4444;
            color: #ef4444;
        }

        /* --- BUTTON & LINKS --- */
        .btn-submit {
            background-color: #ef4444;
            color: white;
            font-weight: 700;
            font-size: 14px;
            padding: 12px;
            border: none;
            border-radius: 6px;
            width: 100%;
            margin-top: 5px; /* Disesuaikan agar tidak terlalu jauh */
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-submit:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .forgot-password {
            font-size: 12px;
            color: #ef4444;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .forgot-password:hover {
            color: #dc2626;
            text-decoration: underline;
        }

        .back-to-home {
            display: block;
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #6b7280;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .back-to-home i {
            margin-right: 5px;
        }

        .back-to-home:hover {
            color: #111827;
        }

        .form-check-label {
            font-size: 12px;
            color: #4b5563;
            cursor: pointer;
        }
        .form-check-input:checked {
            background-color: #ef4444;
            border-color: #ef4444;
        }
    </style>
</head>
<body>
<!-- SPLASH SCREEN LOADING -->
<div id="splash-screen">
    <div class="splash-logo-container">
        <!-- Pastikan path gambarnya benar -->
        <img src="/images/simerahkoja.png" alt="Logo Simerah Koja">
        <div class="splash-title">SIMERAH KOJA</div>
    </div>
    <div class="splash-spinner"></div>
</div>
    <div class="login-wrapper">
        <div class="login-card">
            
            <!-- HEADER BERSERTA LOGO -->
            <div class="login-header">
                <img src="/images/simerahkoja.png" alt="Logo Simerah Koja">
                <p>Sistem Informasi Penanggulangan Kebakaran dan Penyelamatan Daerah Kota Jambi</p>
            </div>

            <!-- FORM BODY -->
            <div class="login-body">
                <h2 class="login-title">Masuk Akun</h2>
                
                <!-- INTEGRASI ALERT LARAVEL -->
                
                <!-- 1. Alert Error (Email/Password Salah) -->
                @if($errors->any())
                    <div class="custom-alert custom-alert-error" id="errorAlert">
                        <i class="fas fa-exclamation-circle alert-icon"></i>
                        <div>
                            @foreach($errors->all() as $error)
                                <span>{{ $error }}</span><br>
                            @endforeach
                        </div>
                        <button type="button" class="btn-close-alert" onclick="document.getElementById('errorAlert').style.display='none'">&times;</button>
                    </div>
                @endif

                <!-- 2. Alert Success (Berhasil Ubah Password / Logout) -->
                @if(session('success'))
                    <div class="custom-alert custom-alert-success" id="successAlert">
                        <i class="fas fa-check-circle alert-icon"></i>
                        <div>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button type="button" class="btn-close-alert" onclick="document.getElementById('successAlert').style.display='none'">&times;</button>
                    </div>
                @endif

                <form action="/login" method="POST">
                    @csrf <!-- Jangan lupa tag ini untuk keamanan form Laravel -->
                    
                    <!-- Input Email -->
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Masukkan email Anda" required autofocus>
                        </div>
                    </div>

<!-- Input Password dengan Tombol Mata -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Masukkan password Anda" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-color: #d1d5db; background-color: #f8fafc; color: #9ca3af;">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">
                                Ingat Saya
                            </label>
                        </div>
                        <a href="/lupa-password" class="forgot-password">Lupa Password?</a>
                    </div>

                    <!-- Tombol Login -->
                    <button type="submit" class="btn-submit">LOGIN</button>

                </form>

                <!-- Kembali ke Beranda -->
                <a href="/" class="back-to-home">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>

            </div>
        </div>
    </div>
    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            // Ubah tipe input dari password ke text atau sebaliknya
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Ubah ikon mata (fa-eye menjadi fa-eye-slash)
            if (type === 'password') {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });
    </script>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    window.addEventListener('load', function() {
        const splash = document.getElementById('splash-screen');
        if (splash) {
            // Tambahkan kelas untuk memicu animasi transisi (fade out)
            splash.classList.add('splash-hidden');
            
            // Hapus elemen dari DOM setelah animasi selesai agar tidak menutupi klik
            setTimeout(() => {
                splash.remove();
            }, 500); 
        }
    });
</script>
</body>
</html>