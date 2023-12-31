@section('template_title')
    Inicio
@endsection

<x-app-layout>
  
  <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="bd-placeholder-img" width="100%" height="400px" src="{{ url("img/BitCritic-Carrousel1-View-Game-Review-Community.png") }}" aria-hidden="true"
          focusable="false" style="object-fit: cover;">
        <div class="container">
          <div class="carousel-caption text-start">
            <h1 class="fw-bold">Juegos Populares</h1>
            <p class="fw-normal">Descubre cuáles son los juegos más populares de la historia.</p>
            <p><a class="btn btn-lg btn-primary" href="#juegos">Descubrir</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="400px" src="{{ url("img/BitCritic-Carrousel2-View-Game-Review-Community.png") }}" aria-hidden="true"
          focusable="false" style="object-fit: cover;">
        <div class="container">
          <div class="carousel-caption">
            <h1 class="fw-bold">Juegos Recientes</h1>
            <p class="fw-normal">Descubre lo que opina la gente de las novedades del gaming.</p>
            <p><a class="btn btn-lg btn-primary" href="{{ Route("games.index") }}">Descubrir</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img class="bd-placeholder-img" width="100%" height="400px" src="{{ url("img/BitCritic-Carrousel3-View-Game-Review-Community.png") }}" aria-hidden="true"
          focusable="false" style="object-fit: cover;">
        <div class="container">
          <div class="carousel-caption text-end">
            <h1 class="fw-bold">Busca tu juego</h1>
            <p class="fw-normal">Encuentra el juego que buscas y hazle una review.</p>
            <p><a class="btn btn-lg btn-primary" href="{{ Route("games.index") }}">Ver Reviews</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>
  </div>

  <header class="bg-dark py-5">
    <div class="container px-5">
      <div class="row gx-5 align-items-center justify-content-center">
        <div class="col-lg-8 col-xl-7 col-xxl-6">
          <div class="my-5 text-center text-xl-start">
            <h1 class="display-5 fw-bold text-white mb-2">Lee, únete y comparte con la comunidad</h1>
            <p class="lead fw-normal text-white-50 mb-4">Lee todas las opiniones y reviews de la gente sobre tus juegos
              favoritos y aporta tu crítica para que todo el mundo la vea.</p>
            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
              @guest
                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{url("/login")}}">Opinar</a>
              @else
                <a class="btn btn-primary btn-lg px-4 me-sm-3" href="{{url("games/#search")}}">Opinar</a>
              @endguest
              @if (empty($reviews))
              @else
              <a class="btn btn-outline-light btn-lg px-4" href="{{url("/reviews/".$reviews[array_rand($reviews)])}}">Review Aleatoria</a>
              @endif
            </div>
          </div>
        </div>
        <div class="col-xl-5 col-xxl-6 d-xl-block text-center"><img class="img-fluid rounded-3 my-5" src="{{ url("img/main".rand(1,12).".png") }}"
            alt="..." /></div>
      </div>
    </div>
  </header>
  
  <section class="bg-body py-5" id="juegos">
    <div class="container px-5 my-5">
      <div class="row gx-5 justify-content-center">
        <div class="col-lg-8 col-xl-6">
          <div class="text-center text-dark">
            <h2 class="fw-bolder" >Juegos más populares</h2>
            <p class="lead fw-normal mb-5">Descubre los juegos más populares de la historia.</p>
          </div>
        </div>
      </div>
      <div class="row justify-content-center mx-auto">
      @livewire('show-games', ['page' => 0, "canSearch" => false, "columns" => 3, "canLoadButton" => false])
        <a class="fw-bold btn btn-primary col-lg-2 col-8 mx-auto" href="{{route("games.index")}}">Ver más...</a>
    </div>
    
  </section>
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
                <a class="btn btn-outline-light btn-lg col-12 px-4" href="{{url('/login')}}">Escribir Review</a>
              @else
                <a class="btn btn-outline-light btn-lg col-12 px-4" href="{{url("games/#search")}}">Escribir Review</a>
              @endguest
            </div>
            <div class="small text-white-50">Todo lo que compartas será revisado por moderadores.</div>
          </div>
        </div>
      </aside>
    </div>
  </section>
</x-app-layout>