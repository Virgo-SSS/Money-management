<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- icon --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- Custom css --}}
    <link rel="stylesheet" href="{{ asset('css/guest/guest.css') }}">

    {{-- Vite Bundling Asset --}}
    @vite(['resources/sass/guest.scss'])
    <script src="{{ Vite::js('jquery-3.6.1.min.js') }}"></script>
</head>
<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="login">
            @include('auth.login')
        </div>

        <div class="signup">
            @include('auth.register')
        </div>
    </div>

    @stack('scripts')
</body>
</html>
