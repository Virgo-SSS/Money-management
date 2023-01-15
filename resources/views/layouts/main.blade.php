<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.styles')
</head>
<body>
    @auth
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
    @endauth

    @guest
        <div class="main">
            <input type="checkbox" id="chk" aria-hidden="true">
            <div class="login">
                @include('auth.login')
            </div>

            <div class="signup">
                @include('auth.register')
            </div>
        </div>
    @endguest


    {{-- SCRIPT --}}
    @include('layouts.scripts')
</body>
</html>
