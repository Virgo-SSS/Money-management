<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    {{-- icon --}}
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app" style="height: 100%">
        <div id="outer-container">
            <div class="collapse navbar-collapse" id="sidebar">
                <div class="sidebar">
                    @include('layouts.sidebar')
                </div>
            </div>
        
            <div class="content">
                @include('layouts.navbar')
    
                <main class="py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>


    {{-- DARK MODE --}}
    <script>
        const body = document.querySelector('body'),
        sidebar = body.querySelector('.sidebar'),
        searchBtn = body.querySelector(".search-box"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text");

        modeSwitch.addEventListener("click" , () =>{
            body.classList.toggle("dark");
            
            if(body.classList.contains("dark")){
                modeText.innerText = "Light mode";
            }else{
                modeText.innerText = "Dark mode";
                
            }
        });
    </script>
</body>
</html>
