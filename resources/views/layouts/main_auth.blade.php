<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- icon --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>


    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/auth/custom.css') }}">
    @yield('css')
    @stack('css')


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <div class="sidebar" id="sidebar">
            @include('layouts.sidebar')
        </div>
        <div class="content">
            @include('layouts.navbar')

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </div>

    {{-- JAVASCRIPT --}}
    <script src="{{ Vite::js('jquery-3.6.1.min.js') }}"></script>
    <script src="https://jsuites.net/v4/jsuites.js"></script>
    @yield('js')
    @stack('js')

    <script>
        function showModal(id) {
            $(`#${id}`).modal('show');
        }

        function closeModal(id, reset_form = '') {
            $(`#${id}`).modal('hide');
            if (reset_form != '') {
                $(`#${reset_form}`)[0].reset();
            }
        }
    </script>
</body>
</html>
