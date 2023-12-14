<?php use \App\Http\Livewire\ShowGames; ?>
<div class="row">

  @if (!Route::is("index") && $canSearch!=false)
  <div class="col-lg-12 pe-3 ps-3">
    <div class="ms-auto col-lg-12 mb-4 p-0 form-floating">
      <input type="text" wire:model.live="search" class="form-control"/>
      <label class="form-label">Buscar</label>
    </div>
  </div>
  
  <div class="d-flex justify-content-center">
    <div wire:loading><img src="{{ url("img/loading.gif")}}" alt="" style="width:50px;" class="mb-4"></div>
</div>
  @endif
  
  @foreach ($allGames as $games)
    @foreach ($games as $game)

    
    <div class="col-lg-{{12/(int)$columns}} col-md-6 col-12 mb-5 p-0 ps-md-{{(4+1)-(int)$columns}} ps-lg-{{(6+1)-(int)$columns}} pe-md-{{(4+1)-(int)$columns}} pe-lg-{{(6+1)-(int)$columns}}" wire:key="{{$game["id"]}}">
        <div class="card h-100 shadow border-0">
          <a href="{{url("/games") . "/" .$game['id']}}" class="fill-div-link"></a>
          <div class="card-game">
            <div style="background:url({{$game["cover"]}});background-size: cover;background-position: center center;background-repeat: no-repeat; " class="card-game-parent-div">            
              {{-- <div style="position:relative;overflow:hidden;padding-bottom:100%;"> --}}
              <div class="d-flex flex-wrap align-content-center card-game-child-div">
                {{-- <img class="img img-responsive full-width" style="position:absolute;width:100%;" src="{{$game["cover"]}}" alt="..." /> --}}
                <img class="img img-responsive card-game-image" src="{{$game["cover"]}}" alt="..." />
              </div>
            </div>
          </div>
            
          <div class="card-body p-4">
            <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ isset($game["genres"]) ? $game["genres"][0] : "" }}</div>
            <a class="text-decoration-none link-dark stretched-link" href="{{url("/games") . "/" .$game["id"]}}">
              <h5 class="card-title mb-3">{{$game["name"]}}</h5>
            </a>
            <p class="card-text mb-0">
              @if (isset($game["summary"]))

                @if (strlen($game["summary"])>100)
                  {{substr($game["summary"],0,100)}}...
                @else
                  {{$game["summary"]}}
                @endif  

              @endif
            </p>
          </div>
          <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
            <div class="d-flex align-items-end justify-content-between">
              <div class="d-flex align-items-center">
                <div class="small">
                  <div class="text-muted">{{ isset($game["first_release_date"]) ? substr(date("d/m/Y",$game["first_release_date"]),0,10) : "" }} &middot; {{$game["reviews"]}} reviews</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endforeach
      @if ($allGames[0] == NULL)
      <p>Vaya... parece que no se ha encontrado ningún juego.</p>
      @endif
      @if ($this->canLoadMore && $this->canLoadButton)
        @include("pn")
      @endif
</div>
