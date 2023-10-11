<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'BitCritic') }} - @yield('template_title') - Video Game Review Community</title>

        <!-- Fonts -->
        <link rel="shortcut icon" href="{{url("/favicon.ico")}}" type="image/x-icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
        
        <!-- Scripts -->
        @vite(['resources/sass/app.scss', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="min-vh-100 bg-dark">
        <x-banner />

        <div>

            @include('nav', ["current_page" => Route::current()->getName()]) 

            <!-- Page Content -->
            <main class="main-content-view bg-dark">
                {{ $slot }}
            </main>

            @include("footer")
            
        </div>
    </body>
</html>
