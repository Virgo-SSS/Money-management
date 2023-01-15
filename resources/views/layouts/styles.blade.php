<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

{{-- icon --}}
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>


{{-- VITE --}}
@auth
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@endauth

@guest
    @vite(['resources/sass/guest.scss'])
@endguest


{{-- css --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
<style>
    .toast-success {
        background-color: #4caf50 !important;
    }

    .toast-error {
        background-color: #f44336 !important;
    }
</style>

@auth
    <link rel="stylesheet" href="{{ asset('css/auth/custom.css') }}">
@endauth

@guest
    <link rel="stylesheet" href="{{ asset('css/guest/guest.css') }}">
@endguest

@yield('css')
@stack('css')