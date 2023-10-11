@section('template_title')
    Restablecer Contraseña
@endsection

<x-guest-layout>
<div class="px-4 py-4 px-md-5 text-center text-lg-start d-flex align-items-center justify-content-center bg-dark" style="background-color: hsl(0, 0%, 96%);min-height:78vh;">
    <div class="container">
      <div class="row gx-lg-5 align-items-center mt-10">
        <div class="col-lg-6 mb-5 mb-lg-0">
          <h1 class="my-5 display-3 fw-bold ls-tight text-white">
            Restablece <br />
            <span class="text-primary">tu contraseña</span>
          </h1>
        </div>

        <div class="col-lg-6 mb-5 mb-lg-0">
          <div class="card">
            <div class="card-body py-5 px-md-5">
                <x-validation-errors class="mb-4" />
             <form method="POST" action="{{ route('password.update') }}">
                @csrf
                
                <input type="hidden" name="token" value="{{ $request->route('token') }}">


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

                <!-- Submit button -->
                <div class="row mb-0">
                    <div>
                        <x-button class="btn-primary mb-4 d-block w-100 p-3" type="submit">
                            {{ __('Restablecer Contraseña') }}
                        </x-button>
                    </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-guest-layout>