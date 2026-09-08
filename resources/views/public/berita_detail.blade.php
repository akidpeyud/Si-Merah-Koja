<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - SIMERAH KOJA</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
        body { background-color: #f1f5f9; color: #1e293b; }
        
        /* Navbar Publik Konsisten */
        .navbar-public {
            background-color: #111827;
            padding: 15px 50px;
            border-bottom: 4px solid #ef4444;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .nav-logos { display: flex; gap: 12px; align-items: center; text-decoration: none; }
        .nav-logos img { height: 38px; }
        .nav-brand-text { color: white; font-weight: 800; font-size: 16px; letter-spacing: 0.5px; margin-left: 5px; }

        /* Layout Kartu Artikel Utama */
        .article-container {
            max-width: 850px;
            margin: 40px auto 60px;
            background: white;
            border-radius: 16px;
            padding: 45px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
            border: 1px solid #e2e8f0;
        }
        
        /* Tombol Kembali */
        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #f8fafc;
            color: #475569;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            font-size: 13px;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
            margin-bottom: 25px;
        }
        .btn-back:hover {
            background-color: #f1f5f9;
            color: #0f172a;
            transform: translateX(-3px);
        }

        /* Header Artikel & Judul */
        .article-header {
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 25px;
            margin-bottom: 30px;
        }
        .article-title {
            font-size: 30px;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.35;
            margin-bottom: 20px;
        }
        
        /* Kotak Informasi Detail (Meta Box) */
        .meta-box {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 12px;
            background: #f8fafc;
            padding: 18px 22px;
            border-radius: 12px;
            border-left: 4px solid #ef4444;
            border: 1px solid #e2e8f0;
            border-left-width: 4px;
        }
        .meta-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            color: #475569;
            font-weight: 600;
        }
        .meta-item i {
            color: #ef4444;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }
        
        /* Gambar Dokumentasi */
        .article-image-wrapper {
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 35px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
        }
        .article-image {
            width: 100%;
            height: auto;
            max-height: 450px;
            object-fit: cover;
            display: block;
        }
        .no-image-placeholder {
            height: 220px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
        }
        .no-image-placeholder i { font-size: 36px; }

        /* Isi Konten Berita */
        .article-body {
            font-size: 15px;
            line-height: 1.9;
            color: #334155;
        }
        .article-body p {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar Publik -->
    <nav class="navbar-public">
        <a href="/" class="nav-logos">
            <img src="/images/jambi.png" alt="Logo Pemkot">
            <img src="/images/logo.png" alt="Logo Damkar">
            <span class="nav-brand-text">SIMERAH KOJA</span>
        </a>
    </nav>

    <!-- Konten Utama -->
    <div class="container">
        <div class="article-container">
            
            <!-- Tombol Kembali -->
            <a href="/" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a>

            <!-- Header Berita -->
            <div class="article-header">
                <h1 class="article-title">{{ $berita->judul }}</h1>
                
                <div class="meta-box">
                    <div class="meta-item">
                        <i class="fas fa-calendar-alt"></i> 
                        <span>{{ \Carbon\Carbon::parse($berita->tanggal_kejadian)->translatedFormat('d F Y') }} - {{ \Carbon\Carbon::parse($berita->waktu_kejadian)->format('H:i') }} WIB</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-map-marker-alt"></i> 
                        <span>{{ $berita->lokasi }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-user-circle"></i> 
                        <span>Pelapor: {{ $berita->pelapor }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fas fa-phone-alt"></i> 
                        <span>Sumber: {{ $berita->sumber_informasi }}</span>
                    </div>
                </div>
            </div>

            <!-- Bagian Gambar / Dokumentasi -->
            <div class="article-image-wrapper">
                @if($berita->gambar)
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="Foto Kejadian" class="article-image">
                @else
                    <div class="no-image-placeholder">
                        <i class="fas fa-image"></i>
                        <span>Tidak ada foto dokumentasi untuk kejadian ini</span>
                    </div>
                @endif
            </div>

            <!-- Deskripsi Detail / Isi Berita -->
            <div class="article-body">
                {!! nl2br(e($berita->detail_lengkap)) !!}
            </div>

        </div>
    </div>

</body>
</html>