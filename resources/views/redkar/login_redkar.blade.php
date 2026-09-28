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
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Plus Jakarta Sans', sans-serif; }
        body {
            background-image: linear-gradient(rgba(17, 24, 39, 0.75), rgba(17, 24, 39, 0.9)), url('/images/background1.png');
            background-size: cover; background-position: center; background-attachment: fixed; background-repeat: no-repeat;
            min-height: 100vh; display: flex; align-items: center; justify-content: center; color: #1f2937;
        }
        .login-card { background-color: #ffffff; width: 100%; max-width: 420px; border-radius: 12px; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5); overflow: hidden; margin: 20px; }
        .login-header-dark { background-color: #111827; padding: 35px 20px 25px 20px; text-align: center; border-bottom: 4px solid #ef4444; }
        .login-header-dark img { height: 65px; margin-bottom: 12px; }
        .login-header-dark h3 { font-size: 16px; font-weight: 800; color: #ffffff; margin-bottom: 5px; }
        .login-header-dark p { font-size: 11.5px; color: #9ca3af; margin: 0; }
        .login-body { padding: 30px 35px 35px 35px; }
        .login-title { text-align: center; font-size: 17px; font-weight: 800; color: #1f2937; margin-bottom: 25px; text-transform: uppercase; }
        .form-label { font-size: 12px; font-weight: 600; color: #4b5563; margin-bottom: 6px; }
        .input-group-text { background-color: #ffffff; border-color: #d1d5db; color: #9ca3af; border-right: none; }
        .form-control { font-size: 13.5px; padding: 12px 15px; border-color: #d1d5db; border-left: none; color: #1f2937; }
        .form-control:focus { border-color: #ef4444; box-shadow: none; background-color: #fffafb; }
        .input-group:focus-within .input-group-text { border-color: #ef4444; color: #ef4444; }
        .btn-toggle-password { cursor: pointer; border-left: none; border-color: #d1d5db; background-color: #ffffff; color: #9ca3af; }
        .btn-login-submit { background-color: #ef4444; color: white; font-weight: 700; font-size: 13.5px; padding: 14px; border: none; border-radius: 6px; width: 100%; margin-top: 10px; cursor: pointer; transition: 0.2s; }
        .btn-login-submit:hover { background-color: #dc2626; }
        .bottom-links { text-align: center; margin-top: 25px; font-size: 12.5px; color: #6b7280; display: flex; flex-direction: column; gap: 10px; }
        .bottom-links a { color: #4b5563; font-weight: 700; text-decoration: none; }
        .bottom-links a:hover { color: #ef4444; }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header-dark">
            <img src="/images/logo-redkar.png" alt="Logo Redkar">
            <h3>SIMERAH KOJA</h3>
            <p>Sistem Informasi Penanggulangan Kebakaran dan Penyelamatan Daerah Kota Jambi</p>
        </div>

        <div class="login-body">
            <h2 class="login-title">MASUK AKUN REDKAR</h2>

            <!-- KOTAK NOTIFIKASI ERROR / PENDING DARI SERVER -->
            @if(session('error'))
                <div class="alert alert-danger mb-4 py-2 px-3" style="font-size: 12.5px; border-radius: 8px;">
                    <i class="fas fa-exclamation-triangle me-1"></i> {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mb-4 py-2 px-3" style="font-size: 12.5px; border-radius: 8px;">
                    <i class="fas fa-exclamation-triangle me-1"></i> <strong>Terjadi Kesalahan:</strong>
                    <ul class="mb-0 ps-3 mt-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORM STANDARD MURNI TANPA AJAX -->
            <form action="{{ url('/login-redkar') }}" method="POST">
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
                        <input class="form-check-input shadow-none" type="checkbox" name="remember" id="rememberMe">
                        <label class="form-check-label text-muted" for="rememberMe" style="font-size: 12.5px;">Ingat Saya</label>
                    </div>
                    <a href="#" class="forgot-link" style="font-size: 12px;">Lupa Password?</a>
                </div>

                <button type="submit" class="btn-login-submit">LOGIN</button>
            </form>

            <div class="bottom-links">
                <div>Belum terdaftar sebagai relawan? <a href="/redkar">Daftar di sini</a></div>
                <div><a href="/"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a></div>
            </div>
        </div>
    </div>

<script>
    function togglePassword() {
        const passwordInput = document.getElementById("password_input");
        const eyeIcon = document.getElementById("eye_icon");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.className = "fas fa-eye-slash";
        } else {
            passwordInput.type = "password";
            eyeIcon.className = "fas fa-eye";
        }
    }
</script>
</body>
</html>