
<div class="row gx-5">
  @if (!Route::is("index") && $canSearch!=false)
  <div class="col-lg-12 pe-3 ps-3">
    <div class="ms-auto col-lg-12 mb-4 p-0 form-floating">
      <input type="text" wire:model="search" class="form-control"/>
      <label class="form-label">Buscar</label>
    </div>
  </div>
  @endif
  @foreach ($allGames as $games)
    @foreach ($games as $game)
    
    <div class="col-lg-{{12/(int)$columns}} mb-5 ps-{{(6+1)-(int)$columns}} pe-{{(6+1)-(int)$columns}}" wire:key="{{$game["id"]}}">
        <div class="card h-100 shadow border-0">
          <a href="{{url("/games") . "/" .$game['id']}}" class="fill-div-link"></a>
          <div style="position:relative;overflow:hidden;padding-bottom:100%;">
            <img class="img img-responsive full-width" style="position:absolute;width:100%;" src="{{$game['cover']}}" alt="..." />
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
                  <div class="fw-bold"></div>
                  <div class="text-muted">{{ isset($game["first_release_date"]) ? substr(date("d-m-Y",$game["first_release_date"]),0,10) : "" }} &middot; {{$game["reviews"]}} reviews</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endforeach
      @include("pn")
</div>
