@php
    // Logika untuk mendeteksi URL tujuan pengguna untuk menyesuaikan teks
    $urlTujuan = session('url.intended', '');
    $namaLayanan = "Layanan Publik"; // Teks default

    if (str_contains($urlTujuan, 'perizinan') || str_contains($urlTujuan, 'skk')) {
        $namaLayanan = "Layanan Perizinan";
    } elseif (str_contains($urlTujuan, 'edukasi')) {
        $namaLayanan = "Layanan Edukasi & Sosialisasi";
    } elseif (str_contains($urlTujuan, 'redkar')) {
        $namaLayanan = "Pendaftaran Relawan Kebakaran (REDKAR)";
    }
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - SIMERAH KOJA</title>
    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
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
            background-color: #0b0f19;
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
            height: 80px;
            margin-bottom: 15px;
            filter: drop-shadow(0 0 15px rgba(239, 68, 68, 0.4));
        }

        .splash-title {
            color: #ffffff;
            font-weight: 800;
            font-size: 18px;
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 25px;
        }

        .splash-spinner {
            width: 40px;
            height: 40px;
            border: 4px solid rgba(255, 255, 255, 0.1);
            border-top: 4px solid #ef4444;
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
            padding: 1rem 0;
        }

        /* --- REGISTER CARD STYLES --- */
        .login-wrapper {
            width: 100%;
            padding: 10px;
            display: flex;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); 
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .login-header {
            background-color: #111827; 
            border-bottom: 4px solid #ef4444; 
            padding: 25px 20px 15px;
            text-align: center;
        }

        .login-header img {
            height: 75px;
            margin-bottom: 10px;
            filter: drop-shadow(0 4px 6px rgba(0,0,0,0.3));
        }

        .login-header p {
            color: #9ca3af;
            font-size: 11.5px;
            line-height: 1.4;
            margin: 0;
        }

        .login-header strong {
            color: #ffffff;
            font-size: 13px;
            letter-spacing: 0.5px;
            display: block;
            margin-bottom: 3px;
        }

        .login-body {
            padding: 25px 25px;
        }

        .login-title {
            font-size: 18px;
            font-weight: 800;
            color: #111827;
            text-align: center;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- ALERT STYLES --- */
        .custom-alert {
            display: flex;
            align-items: flex-start;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 12px;
            font-weight: 500;
            position: relative;
            line-height: 1.4;
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .custom-alert i.alert-icon {
            font-size: 16px;
            margin-right: 10px;
            margin-top: 2px;
        }

        .custom-alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }
        .custom-alert-error i.alert-icon { color: #ef4444; }
        
        .custom-alert-error ul { margin-left: 18px; margin-top: 4px; margin-bottom: 0; padding-left: 0; }

        .btn-close-alert {
            background: none;
            border: none;
            color: inherit;
            font-size: 18px;
            position: absolute;
            right: 8px;
            top: 8px;
            cursor: pointer;
            opacity: 0.5;
            transition: opacity 0.3s;
        }
        .btn-close-alert:hover { opacity: 1; }

        /* --- FORM STYLES --- */
        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 4px;
        }
        
        .req { color: #ef4444; }

        .input-group-text {
            background-color: #f8fafc;
            border-color: #d1d5db;
            color: #9ca3af;
            padding: 8px 12px;
        }

        .form-control {
            font-size: 13px;
            padding: 8px 15px;
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
            font-size: 13px;
            padding: 10px;
            border: none;
            border-radius: 6px;
            width: 100%;
            margin-top: 5px; 
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-submit:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .back-to-home {
            display: block;
            text-align: center;
            margin-top: 10px;
            font-size: 12px;
            color: #6b7280;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s;
        }

        .back-to-home i { margin-right: 5px; }
        .back-to-home:hover { color: #111827; }

        .register-link {
            text-align: center;
            margin-top: 15px;
            font-size: 12.5px;
            font-weight: 600;
            color: #4b5563;
        }
        .register-link a {
            color: #ef4444;
            text-decoration: none;
            transition: 0.3s;
        }
        .register-link a:hover {
            color: #dc2626;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- SPLASH SCREEN LOADING -->
<div id="splash-screen">
    <div class="splash-logo-container">
        <img src="/images/logo.png" alt="Logo Damkar">
        <div class="splash-title">SIMERAH KOJA</div>
    </div>
    <div class="splash-spinner"></div>
</div>

    <div class="login-wrapper">
        <div class="login-card">
            
            <!-- HEADER BERSERTA LOGO DINAMIS -->
            <div class="login-header">
                <img src="/images/logo.png" alt="Logo Damkar Kota Jambi">
                <strong>Portal {{ $namaLayanan }}</strong>
                <p>Dinas Pemadam Kebakaran dan Penyelamatan<br>Daerah Kota Jambi</p>
            </div>

            <!-- FORM BODY -->
            <div class="login-body">
                <h2 class="login-title">Daftar Akun Pemohon</h2>
                
                <!-- INTEGRASI ALERT LARAVEL -->
                @if($errors->any())
                    <div class="custom-alert custom-alert-error" id="errorAlert">
                        <i class="fas fa-exclamation-circle alert-icon"></i>
                        <div>
                            <strong>Gagal mendaftar:</strong>
                            <ul>
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn-close-alert" onclick="document.getElementById('errorAlert').style.display='none'">&times;</button>
                    </div>
                @endif

                <form action="{{ url('/pemohon/register') }}" method="POST">
                    @csrf 
                    
                    <!-- Input NIK -->
                    <div class="mb-2">
                        <label class="form-label" for="nik">NIK KTP <span class="req">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" class="form-control" name="nik" id="nik" value="{{ old('nik') }}" inputmode="numeric" pattern="[0-9]{16}" placeholder="16 Digit NIK KTP" required autofocus>
                        </div>
                    </div>

                    <!-- Input Nama Lengkap -->
                    <div class="mb-2">
                        <label class="form-label" for="nama_lengkap">Nama Lengkap <span class="req">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" placeholder="Sesuai KTP" required>
                        </div>
                    </div>

                    <!-- Input Email -->
                    <div class="mb-2">
                        <label class="form-label" for="email">Email <span class="req">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="contoh@email.com" required>
                        </div>
                    </div>

                    <!-- Input WhatsApp -->
                    <div class="mb-2">
                        <label class="form-label" for="no_whatsapp">Nomor WhatsApp <span class="req">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fab fa-whatsapp"></i></span>
                            <input type="tel" class="form-control" name="no_whatsapp" id="no_whatsapp" value="{{ old('no_whatsapp') }}" placeholder="Contoh: 08123456789" required>
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div class="mb-2">
                        <label class="form-label" for="passwordInput">Password <span class="req">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Minimal 8 karakter" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border-color: #d1d5db; background-color: #f8fafc; color: #9ca3af;">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Input Konfirmasi Password -->
                    <div class="mb-3">
                        <label class="form-label" for="passwordConfirmationInput">Konfirmasi Password <span class="req">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="password_confirmation" id="passwordConfirmationInput" placeholder="Ulangi password" required>
                            <button class="btn btn-outline-secondary" type="button" id="togglePasswordConfirm" style="border-color: #d1d5db; background-color: #f8fafc; color: #9ca3af;">
                                <i class="fas fa-eye" id="eyeIconConfirm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Tombol Register -->
                    <button type="submit" class="btn-submit">DAFTAR SEKARANG</button>

                </form>

                <!-- Punya Akun? -->
                <div class="register-link">
                    Sudah punya akun? <a href="{{ url('/pemohon/login') }}">Masuk di sini</a>
                </div>

                <!-- Kembali ke Beranda -->
                <a href="/" class="back-to-home">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>

            </div>
        </div>
    </div>
    
    <script>
        // Toggle Password Utama
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('eyeIcon');

        togglePassword.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            if (type === 'password') {
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });

        // Toggle Konfirmasi Password
        const togglePasswordConfirm = document.getElementById('togglePasswordConfirm');
        const passwordConfirmationInput = document.getElementById('passwordConfirmationInput');
        const eyeIconConfirm = document.getElementById('eyeIconConfirm');

        togglePasswordConfirm.addEventListener('click', function () {
            const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationInput.setAttribute('type', type);

            if (type === 'password') {
                eyeIconConfirm.classList.remove('fa-eye-slash');
                eyeIconConfirm.classList.add('fa-eye');
            } else {
                eyeIconConfirm.classList.remove('fa-eye');
                eyeIconConfirm.classList.add('fa-eye-slash');
            }
        });

        // Splash Screen Logic
        window.addEventListener('load', function() {
            const splash = document.getElementById('splash-screen');
            if (splash) {
                splash.classList.add('splash-hidden');
                setTimeout(() => {
                    splash.remove();
                }, 500); 
            }
        });
    </script>
</body>
</html>