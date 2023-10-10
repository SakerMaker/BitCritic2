@extends('layouts.app')

@section('template_title')
    Verificar Correo Electrónico
@endsection

@section('content')
    <div class="px-4 py-5 px-md-5 text-center text-lg-start d-flex align-items-center justify-content-center bg-dark" style="background-color: hsl(0, 0%, 96%);min-height:78vh;">
        <div class="container">
        <div class="row gx-lg-5 align-items-center mt-10">
            <div class="col-lg-6 mb-5 mb-lg-0">
            <h1 class="my-5 display-3 fw-bold ls-tight text-white">
                Verifica tu <br />
                <span class="text-primary">Correo Electrónico</span>
            </h1>
            <p style="color: hsl(217, 10%, 50.8%)">
                Antes de continuar... ¿podrías confirmar tu mail desde el enlace que te hemos enviado a tu correo electrónico?
            </p>
            </div>

            <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="card">
                <div class="card-body py-5 px-md-5">
                    <x-validation-errors class="mb-4" />
                    @if (session('status') == 'verification-link-sent')
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ __('Se ha enviado de nuevo el correo de verificación.') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
        
                        <div>
                            <x-button type="submit" class="btn-primary mb-4 d-block w-100 p-3">
                                {{ __('Re-enviar Correo de Verificación') }}
                            </x-button>
                        </div>
                    </form>
                    <div>
                        <a
                            href="{{ route('profile.show') }}" class="btn btn-block text-primary border border-2 border-primary d-block mb-4"
                        >
                            {{ __('Editar Perfil') }}</a>
        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
        
                            <x-button type="submit" class="btn btn-block d-block text-danger border border-2 border-danger" style="float:right">
                                {{ __('Cerrar Sesión') }}
                            </x-button>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
@endsection