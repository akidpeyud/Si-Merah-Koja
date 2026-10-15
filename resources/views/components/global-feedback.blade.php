<!-- resources/views/components/global-feedback.blade.php -->

<!-- 1. CSS LOADING SPLASH SCREEN -->
<style>
    #simerah-loader {
        position: fixed;
        inset: 0;
        z-index: 99999;
        background: rgba(13, 27, 42, 0.92);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 16px;
        color: #ffffff;
        font-family: 'Instrument Sans', system-ui, sans-serif;
        transition: opacity 0.35s ease, visibility 0.35s ease;
    }
    #simerah-loader.is-hidden {
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }
    .simerah-spinner-box {
        position: relative;
        width: 84px;
        height: 84px;
        display: grid;
        place-items: center;
    }
    .simerah-spinner-box img {
        width: 48px;
        height: auto;
        animation: pulseLogo 1.5s infinite ease-in-out;
    }
    .simerah-ring {
        position: absolute;
        inset: 0;
        border: 3px solid rgba(255, 255, 255, 0.12);
        border-top-color: #e5392d;
        border-right-color: #ffb627;
        border-radius: 50%;
        animation: spinRing 0.9s linear infinite;
    }
    .simerah-loader-text {
        font-size: 0.9rem;
        font-weight: 600;
        letter-spacing: 0.04em;
        color: rgba(255, 255, 255, 0.9);
    }
    @keyframes spinRing {
        to { transform: rotate(360deg); }
    }
    @keyframes pulseLogo {
        0%, 100% { transform: scale(0.95); opacity: 0.85; }
        50% { transform: scale(1.06); opacity: 1; }
    }
</style>

<!-- 2. HTML LOADING SPLASH SCREEN -->
<div id="simerah-loader">
    <div class="simerah-spinner-box">
        <div class="simerah-ring"></div>
        <img src="{{ asset('images/logo.png') }}" alt="Loading SIMERAH KOJA" onerror="this.src='/images/simerahkoja.png'">
    </div>
    <div class="simerah-loader-text" id="simerah-loader-msg">Memuat halaman...</div>
</div>

<!-- 3. CDN SWEETALERT2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- 4. SCRIPT OTOMATIS (LOADING, CRUD, LOGIN, VALIDASI) -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const loader = document.getElementById('simerah-loader');
    const loaderMsg = document.getElementById('simerah-loader-msg');

    const hideLoader = () => {
        if (loader) loader.classList.add('is-hidden');
    };

    // Sembunyikan splash screen saat halaman selesai atau maksimal 800ms
    window.addEventListener('load', hideLoader);
    setTimeout(hideLoader, 800);

    window.addEventListener('pageshow', (e) => {
        if (e.persisted) hideLoader();
    });

    // A. OTOMATIS MUNCULKAN LOADING SAAT SUBMIT FORM (LOGIN / INPUT / CRUD)
    // & OTOMATIS KONFIRMASI SAAT HAPUS DATA (METHOD DELETE)
    document.addEventListener('submit', function (e) {
        const form = e.target;
        if (form.tagName !== 'FORM' || form.hasAttribute('data-no-loader')) return;

        const methodInput = form.querySelector('input[name="_method"]');
        const isDelete = methodInput && methodInput.value.toUpperCase() === 'DELETE';

        if (isDelete && !form.dataset.confirmed) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus data ini?',
                text: 'Data yang dihapus tidak dapat dikembalikan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.dataset.confirmed = "true";
                    loaderMsg.textContent = 'Menghapus data...';
                    loader.classList.remove('is-hidden');
                    form.submit();
                }
            });
            return;
        }

        loaderMsg.textContent = 'Memproses data, mohon tunggu...';
        loader.classList.remove('is-hidden');
    });

    // B. KONFIGURASI TOAST / ALERT OTOMATIS DARI SESSION LARAVEL
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3800,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    @if (session('success') || session('sukses') || session('status'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: @json(session('success') ?? session('sukses') ?? session('status')),
            confirmButtonColor: '#2563eb',
            timer: 3000,
            timerProgressBar: true
        });
    @endif

    @if (session('error') || session('gagal'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: @json(session('error') ?? session('gagal')),
            confirmButtonColor: '#dc2626'
        });
    @endif

    @if (session('warning') || session('peringatan'))
        Toast.fire({
            icon: 'warning',
            title: @json(session('warning') ?? session('peringatan'))
        });
    @endif

    @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Periksa Input Anda',
            html: `{!! implode('<br>', $errors->all()) !!}`,
            confirmButtonColor: '#dc2626'
        });
    @endif
});

// Extra safeguard langsung di luar DOMContentLoaded jika skrip melambat
setTimeout(function() {
    const l = document.getElementById('simerah-loader');
    if (l) l.classList.add('is-hidden');
}, 1000);
</script>