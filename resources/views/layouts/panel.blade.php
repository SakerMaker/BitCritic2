

  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
        @hasSection("template_title")
            <title>@yield('template_title') - {{ config('app.name', 'BitCritic') }} - Comunidad de Reviews de Videojuegos</title>
        @else
            <title>{{ config('app.name', 'BitCritic') }} - Comunidad de Reviews de Videojuegos</title>
        @endif
        @hasSection("template_description")
            <meta name="description" content="@yield('template_description')">
        @else
            <meta name="description" content="Lee, escribe y comparte reviews con la comunidad. Lee todas las opiniones y reviews de la gente sobre tus juegos favoritos y aporta tu crítica para que todo el mundo la vea.">
        @endif
        <meta property="og:locale" content="es_ES">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}" />
        <meta property="og:title" content="@yield('template_title') - BitCritic - Comunidad de Reviews de Videojuegos">
        <meta property="og:description" content="Lee, escribe y comparte reviews con la comunidad. Lee todas las opiniones y reviews de la gente sobre tus juegos favoritos y aporta tu crítica para que todo el mundo la vea.">
        <meta property="og:site_name" content="BitCritic">
        <meta property="og:image" content="http://bitcritic.es/img/BitCritic-Logo-View-Game-Review-Community_SEO.jpg">
        <meta property="og:image:secure_url" content="https://bitcritic.es/img/BitCritic-Logo-View-Game-Review-Community_SEO.jpg" /> 
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
                <section class="bg-dark py-5">
                  <div class="container d-flex justify-content-center align-items-center">
                      <form action="{{ route('panel.users') }}" method="GET" class="px-3">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-trash"></i> Usuarios</button>
                      </form>
                      <form action="{{ route('panel.reviews') }}" method="GET" class="px-3">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-trash"></i> Reviews</button>
                      </form>
                      <form action="{{ route('panel.comments') }}" method="GET" class="px-3">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-fw fa-trash"></i> Comentarios</button>
                      </form>
                  </div>
              </section>
                <section class="bg-dark">
                    <div class="container">
                        @yield("content")
                    </div>
                </section>
            </main>

            @include("footer")
            
        </div>

        @stack('modals')

        @livewireScripts

        @include('cookie-consent::index')
    </body>
</html>