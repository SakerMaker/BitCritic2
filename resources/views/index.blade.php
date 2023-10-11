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
            <h1 class="fw-bold">Juegos del Mes</h1>
            <p class="fw-normal">Descubre cuáles son los juegos mejor valorados del mes.</p>
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
            <p><a class="btn btn-lg btn-primary" href="{{ Route("games") }}">Descubrir</a></p>
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
            <p><a class="btn btn-lg btn-primary" href="{{ Route("games") }}">Ver Reviews</a></p>
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
</x-app-layout>