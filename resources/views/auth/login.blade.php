@extends('layouts.app')

@section('template_title')
    Iniciar Sesión
@endsection

@section('content')
    <div class="px-4 py-5 px-md-5 text-center text-lg-start d-flex align-items-center justify-content-center bg-dark" style="background-color: hsl(0, 0%, 96%);min-height:78vh;">
        <div class="container">
        <div class="row gx-lg-5 align-items-center mt-10">
            <div class="col-lg-6 mb-5 mb-lg-0">
            <h1 class="my-5 display-3 fw-bold ls-tight text-white">
                ¿De vuelta a <br />
                <span class="text-primary">escribir reviews?</span>
            </h1>
            <p style="color: hsl(217, 10%, 50.8%)">
                Te damos de nuevo la bienvenida a nuestra página web. Redescubre todas las opiniones más recientes y aporta tu grano de arena.
            </p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card">
                <div class="card-body py-5 px-md-5">
                    <x-validation-errors class="mb-4" />
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <!-- Email input -->
                        <div class="form-outline mb-4 form-floating">
                            <x-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-label for="email" value="{{ __('Correo Electrónico') }}" />
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4 form-floating">
                            <x-input id="password" type="password" name="password" required autocomplete="current-password" />
                            <x-label for="password" value="{{ __('Contraseña') }}" />
                        </div>

                        <!-- Remember Me -->
                        <div class="form-check">
                            <label for="remember_me" class="form-check-label mb-4">
                                <x-checkbox id="remember_me" name="remember" />
                                <span>{{ __('Recordarme') }}</span>
                            </label>
                        </div>

                        <!-- Submit button -->

                        <div class="row mb-0">
                            <div>
                                <x-button class="btn-primary mb-4 d-block w-100 p-3" type="submit">
                                    {{ __('Iniciar Sesión') }}
                                </x-button>
                            </div>
                        </div>
                        

                        @if (Route::has('password.request'))
                        <a class="link-secondary" href="{{ route('password.request') }}">
                            {{ __('¿Has olvidado tu contraseña?') }}
                        </a>
                        @endif
                        <p class="m-0">
                        <a href="{{ route('register') }}">Aún no tengo cuenta</a>
                        </p>
                        <p class="m-0 mt-4 mr-auto">
                            <a href="{{ URL::previous() }}" class="bg-dark p-3 text-white btn text-decoration-none d-inline-block float-right" style="float:right;">Volver</a>
                        </p>
                        
                    </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection