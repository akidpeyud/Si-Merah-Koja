{{-- Isi dropdown menu "Layanan" di navbar. Butuh variabel $tab_aktif dari halaman pemanggil. --}}
@foreach(config('layanan') as $key => $l)
    <li><a href="{{ $l['url'] }}" @if($key === ($tab_aktif ?? null)) aria-current="page" @endif>{{ $l['menu'] }}</a></li>
@endforeach