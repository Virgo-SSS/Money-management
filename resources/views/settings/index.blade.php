@extends('layouts.main_auth')

@section('css')
    @vite(['resources/sass/settings.scss'])
    @vite(['resources/sass/appearance_card.scss'])
    <style>
        .appearance-active{
            box-shadow: 0 0 14px 1px  blue;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{ session()->get('success') }}
            </div>
        @endif
        <div class="collapse-accordion" id="accordion2" role="tablist" aria-multiselectable="true">
            {{-- Profile --}}
            @include('settings.profile')

            {{-- Change Password --}}
            @include('settings.change_password')

            {{-- Appearance --}}
            @include('settings.appearance')
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function(){
                $(this).parent(".card").find(".toggle").addClass("rotate");
            }).on('hide.bs.collapse', function(){
                $(this).parent(".card").find(".toggle").removeClass("rotate");
            });
        });

        function webTheme(mode) {
            $('#mode').val(mode);
            if(mode == 'dark') {
                $('#card-dark').addClass('appearance-active');
                $('#card-light').removeClass('appearance-active');
            } else {
                $('#card-light').addClass('appearance-active');
                $('#card-dark').removeClass('appearance-active');
            }
        }
    </script>
@endsection

