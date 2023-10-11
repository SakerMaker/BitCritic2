@section('template_title')
    Registrarse
@endsection

<x-guest-layout>
<div class="px-4 py-4 px-md-5 text-center text-lg-start d-flex align-items-center justify-content-center bg-dark" style="background-color: hsl(0, 0%, 96%);min-height:78vh;">
    <div class="container">
      <div class="row gx-lg-5 align-items-center mt-10">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight text-white">
            Únete hoy <br />
            <span class="text-primary">a la comunidad</span>
          </h1>
          <p style="color: hsl(217, 10%, 50.8%)">
            Escribe, comenta y valora reviews de todos los videojuegos que se te puedan ocurrir. Todas las reviews son revisadas para que el contenido de la web sea lo más legítimo y real posible.
          </p>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
                <x-validation-errors class="mb-4" />
             <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Text input -->
                <div class="form-outline mb-4 form-floating">
                    <x-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-label for="name" value="{{ __('Nombre de Usuario') }}" />
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4 form-floating">
                    <x-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-label for="email" value="{{ __('Correo Electrónico') }}" />
                </div>

                    


                <!-- Password input -->
                <div class="form-outline mb-4 form-floating">
                    <x-input id="password" type="password" name="password" required autocomplete="new-password" />
                    <x-label for="password" value="{{ __('Contraseña') }}" />
                </div>
    
                <div class="form-outline mb-4 form-floating">
                    <x-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                </div>


                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="form-check d-flex mb-4">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="form-check-label">
                                {!! __('He leído y acepto las :terms_of_service y :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('condiciones de uso').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('política de privacidad').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
                @endif

                <!-- Submit button -->
                <div class="row mb-0">
                    <div>
                        <x-button class="btn-primary mb-4 d-block w-100 p-3" type="submit">
                            {{ __('Registrarse') }}
                        </x-button>
                    </div>
                </div>
                
                <p class="m-0">
                  <a href="{{ route("login")}}">Ya tengo cuenta</a>
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