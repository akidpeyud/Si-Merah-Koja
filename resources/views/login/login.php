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
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            /* Background image with a dark overlay for readability */
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
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); /* Enhanced shadow for image background */
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .login-header {
            background-color: #111827; /* Dark blue seragam dengan navbar & footer */
            border-bottom: 4px solid #ef4444; /* Garis aksen merah */
            padding: 40px 30px 30px;
            text-align: center;
        }

        .login-header img {
            height: 130px; /* Logo diperbesar dari 70px ke 100px */
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
            margin-top: 15px;
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

        /* Checkbox custom */
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
                
                <form action="/login" method="POST">
                    
                    <!-- Input Email -->
                    <div class="mb-3">
                        <label class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" class="form-control" name="email" placeholder="Masukkan email Anda" required>
                        </div>
                    </div>

                    <!-- Input Password -->
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" name="password" placeholder="Masukkan password Anda" required>
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe">
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

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>