<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ Route('index') }}">
            <img src="{{ url("img/BitCritic-Logo-View-Game-Review-Community.png") }}" alt="Logo" width="100" height="100" class="align-text-top me-2 logo--static">
            <img src="{{ url("img/BitCritic-Logo-View-Game-Review-Community-S.gif") }}" alt="Logo" width="100" height="100" class="align-text-top me-2 logo--spin">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar--links" aria-controls="navbar--links" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse p-4 rounded-3" id="navbar--links">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item ms-lg-4 ms-0">
                    <a class="nav-link {{ ($current_page=="index" ? 'nav-link--active' : '') }}" href="{{ Route('index') }}">Inicio</a>
                </li>
                <li class="nav-item ms-lg-4 ms-0">
                    <a class="nav-link {{ (str_starts_with($current_page,"games") ? 'nav-link--active' : '') }}" href="{{ Route('games.index') }}">Juegos</a>
                </li>
                @guest
                <li class="nav-item ms-lg-4 ms-0">
                    <a class="nav-link {{ $current_page=="login" ? 'nav-link--active' : '' }}" href="{{ Route('login') }}">Iniciar Sesión</a>
                </li>
                <li class="nav-item ms-lg-4 ms-0">
                    <a class="nav-link {{ $current_page=="register" ? 'nav-link--active' : '' }}" href="{{ Route('register') }}">Registrarse</a>
                </li>
                @else
                <li class="nav-item ms-lg-4 ms-0">
                    <div class="btn-group d-sm-flex flex-column align-items-center">
                        <button class="btn border border-2 border-primary rounded-circle nav-link--profile-picture dropdown-toggle p-0 ms-sm-0 object-fit-cover" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width:50px!important;height:50px!important;">
                            <img class="rounded-circle object-fit-cover p-0" style="" src="@if (str_contains(Auth::user()->profile_photo_path, 'Profile-Picture-Default')){{ url(Auth::user()->profile_photo_path) }}@else{{ url("/storage/".Auth::user()->profile_photo_path ) }}@endif" alt="{{ Auth::user()->name }}" />
                        </button>
                        <div class="dropdown-menu dropdown-menu-end animate slideIn">
                            <!-- Account Management -->
                            <div class="dropdown-header">
                                {{ __('Ajustes') }}
                            </div>
    
                            <x-dropdown-link href="{{ route('user.profile',Auth::user()->name) }}">
                                <span class="span-text">{{ __('Mi Perfil') }}</span>
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('profile.show') }}">
                                <span class="span-text">{{ __('Configuración') }}</span>
                            </x-dropdown-link>
    
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
    
                                <x-dropdown-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                        <span class="span-text">{{ __('Cerrar Sesión') }}</span>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>