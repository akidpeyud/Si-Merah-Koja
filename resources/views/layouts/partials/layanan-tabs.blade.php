{{-- Tab layanan perizinan. Butuh variabel $tab_aktif dari halaman pemanggil. --}}
<nav class="tabs" aria-label="Jenis layanan perizinan">
    @foreach(config('layanan') as $key => $l)
        <a class="tab" href="{{ $l['url'] }}" title="{{ $l['ket'] }}" @if($key === ($tab_aktif ?? null)) aria-current="page" @endif>
            <i class="fas {{ $l['ico'] }}"></i> {{ $l['label'] }}
        </a>
    @endforeach
</nav>