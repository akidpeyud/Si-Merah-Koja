<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - SIMERAH KOJA</title>

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
            padding: 30px 30px 20px;
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
            padding: 30px 30px;
        }

        .login-title {
            font-size: 20px;
            font-weight: 800;
            color: #111827;
            text-align: center;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .reset-desc {
            text-align: center;
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        /* --- ALERT STYLES --- */
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
        }
        .custom-alert i.alert-icon {
            font-size: 18px;
            margin-right: 12px;
            margin-top: 1px;
        }
        .custom-alert-error {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }
        .custom-alert-error i.alert-icon { color: #ef4444; }

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
        }
        .btn-close-alert:hover { opacity: 1; }

        /* --- FORM STYLES --- */
        .form-label {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .input-group-text {
            background-color: #f8fafc;
            border-color: #d1d5db;
            color: #9ca3af;
            font-size: 13px;
        }

        .form-control {
            font-size: 13px;
            padding: 10px 15px;
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
            margin-top: 10px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);
        }

        .back-to-home {
            display: block;
            text-align: center;
            margin-top: 20px;
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
            
            <div class="login-header">
                <img src="/images/simerahkoja.png" alt="Logo Simerah Koja">
                <p>Sistem Informasi Penanggulangan Kebakaran dan Penyelamatan Daerah Kota Jambi</p>
            </div>

            <div class="login-body">
                <h2 class="login-title">Reset Password</h2>
                <p class="reset-desc">Masukkan Email dan Nomor Kepegawaian Anda. Password baru akan dikirim otomatis ke email Anda.</p>
                
                <!-- Notifikasi Error Laravel -->
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

                <form action="/lupa-password" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Masukkan email terdaftar" required autofocus>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Nomor Kepegawaian</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                            <input type="text" class="form-control" name="nomor_pegawai" value="{{ old('nomor_pegawai') }}" placeholder="Masukkan NIP/Nomor Kepegawaian" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">Kirim Password Baru</button>

                </form>

                <a href="/login" class="back-to-home">
                    <i class="fas fa-arrow-left"></i> Kembali ke Login
                </a>

            </div>
        </div>
    </div>

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