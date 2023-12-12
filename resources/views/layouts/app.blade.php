<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('template_title') - {{ config('app.name', 'BitCritic') }} - Comunidad de Reviews de Videojuegos</title>
        @hasSection("template_description")
            <meta name="description" content="@yield('template_description')">

        @else
            <meta name="description" content="Lee, escribe y comparte reviews con la comunidad. Lee todas las opiniones y reviews de la gente sobre tus juegos favoritos y aporta tu crítica para que todo el mundo la vea.">
        @endif
        <meta property="og:locale" content="es_ES">
        <meta property="og:type" content="website">
        <meta property="og:title" content="@yield('template_title') - BitCritic - Comunidad de Reviews de Videojuegos">
        <meta property="og:description" content="Lee, escribe y comparte reviews con la comunidad. Lee todas las opiniones y reviews de la gente sobre tus juegos favoritos y aporta tu crítica para que todo el mundo la vea.">
        <meta property="og:site_name" content="BitCritic">
        <meta property="og:image" content="img/BitCritic-Logo-View-Game-Review-Community_SEO.jpg">
        <meta property="og:image:width" content="1000">
        <meta property="og:image:height" content="600">
        <meta property="og:image:type" content="image/jpeg">
        <meta name="twitter:card" content="summary_large_image">
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
            <main class="main-content-view bg-dark" style="min-height:73vh;">
                {{ $slot }}
            </main>

            @include("footer")
            
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
