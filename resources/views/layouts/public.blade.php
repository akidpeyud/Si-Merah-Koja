<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0d1b2a">
    <meta name="description" content="@yield('meta_description', 'SIMERAH KOJA - Dinas Pemadam Kebakaran dan Penyelamatan Kota Jambi')">
    <title>@yield('title', 'SIMERAH KOJA - Damkar Kota Jambi')</title>

    <link rel="icon" href="/images/simerahkoja.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wdth,wght@12..96,75..100,400..800&family=Instrument+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @include('layouts.partials.public-styles')
    @stack('styles')
</head>
<body>

    @include('layouts.partials.public-header')

    <main id="mainContent">
        @yield('content')
    </main>

    @include('layouts.partials.public-footer')

    @include('layouts.partials.public-sos')

    @include('layouts.partials.public-scripts')
    @stack('scripts')
</body>
</html>
