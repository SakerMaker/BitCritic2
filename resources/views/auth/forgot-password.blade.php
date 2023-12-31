
@section('template_title')
    Recuperar Contraseña
@endsection

<x-guest-layout>
<div class="px-4 py-5 px-md-5 text-center text-lg-start d-flex align-items-center justify-content-center bg-dark" style="background-color: hsl(0, 0%, 96%);min-height:78vh;">
    <div class="container">
    <div class="row gx-lg-5 align-items-center mt-10">
        <div class="col-lg-6 mb-5 mb-lg-0">
        <h1 class="my-5 display-3 fw-bold ls-tight text-white">
            ¿Has olvidado <br />
            <span class="text-primary">tu contraseña?</span>
        </h1>
        <p style="color: hsl(217, 10%, 50.8%)">
            Escribe tu correo electrónico y te mandaremos un enlace para que la restablezcas. No te preocupes, no tardará más de 5 minutos en llegar.
        </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="card">
            <div class="card-body py-5 px-md-5">
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <x-validation-errors class="mb-4" />
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email input -->
                    <div class="form-outline mb-4 form-floating">
                        <x-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-label for="email" value="{{ __('Correo Electrónico') }}" />
                    </div>


                    <!-- Submit button -->

                    <div class="row mb-0">
                        <div>
                            <x-button class="btn-primary mb-4 d-block w-100 p-3" type="submit">
                                {{ __('Recuperar Contraseña') }}
                            </x-button>
                        </div>
                    </div>

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
</x-guest-layout>