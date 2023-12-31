@section('template_title')
    Actividad
@endsection

<x-app-layout>
    <header class="bg-dark pb-5">
        <div class="container px-5">
          <div class="row gx-5 align-items-center justify-content-center">
            <div class="col-lg-8 col-xl-7 col-xxl-6">
              <div class="my-5 text-center text-xl-start">
                <h1 class="display-5 fw-bold text-white mb-2">Descubre qué opinan tus referentes</h1>
                <p class="lead fw-normal text-white-50 mb-4">Lee las reviews de las personas a las que sigues.</p>
                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                  <a class="btn btn-primary btn-lg px-4 me-sm-3" href="#search">Leer</a>
                  <a class="btn btn-light btn-lg px-4 me-sm-3" href="#searchUsers">Buscar Usuarios</a>
                </div>
              </div>
            </div>
            <div class="col-xl-5 col-xxl-6 d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="{{ url("img/main".rand(1,12).".png") }}"
                alt="..." /></div>
          </div>
        </div>
      </header>
      <section class="bg-body py-5" id="search">
        <div class="container px-5 my-5">
            <div class="row gx-5 justify-content-center">
              <div class="col-lg-8 col-xl-6">
                <div class="text-center text-dark">
                  <h2 class="fw-bolder mb-3" id="buscar">Reviews</h2>
                  
                </div>
              </div>
            </div>
            
            <div>
            <div class="mt-1 mb-4">
                  {{-- <form action="{{ route('games.search') }}" method="POST">
                    @csrf
                    <div class="flex form-outline mb-4 form-floating col-lg-3 col-md-9 ms-auto">
                      <input class="form-control bg-white" type="text" placeholder="Búsqueda..." name="s">
                      <label class="form-check-label mb-4" for="search">
                        {{ __('Búsqueda...') }}
                      </label>
                      <button type="submit" class="btn btn-primary mb-4 p-2 d-block ms-auto">
                        {{ __('Buscar') }}
                      </button>
                    </div>
                  </form> --}}
            </div>
            
            @livewire('feed', ['page' => 0])
            @livewire('show-users')
          <div>
          
          
          {{-- <div class="text-center mx-auto w-100">
            <nav aria-label="Page navigation example" class="mx-auto p-0 d-inline-block">
                <ul class="pagination mx-auto">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
          </div> --}}
    
          
    
        </div>
        
        
      </section>
      
        </main>
        
        <section class="py-5 bg-dark">
          <div class="container px-5 my">
            <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5">
              <div
                class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                <div class="mb-4 mb-xl-0">
                  <div class="fs-3 fw-bold text-white">Empieza a escribir tu review ya.</div>
                  <div class="text-white-50">Comparte tus opiniones con toda la comunidad.</div>
                </div>
                <div class="ms-xl-4">
                  <div class="input-group mb-2">
                  @guest
                    <a class="btn btn-outline-light btn-lg col-12 px-4" href="{{url("/login")}}">Escribir Review</a>
                  
                  @else
                  <a class="btn btn-outline-light btn-lg col-12 px-4" href="#search">Escribir Review</a>
    
                  @endguest
                  </div>
                  <div class="small text-white-50">Todo lo que compartas será revisado por moderadores.</div>
                </div>
              </div>
            </aside>
          </div>
        </section>
    
</x-app-layout>