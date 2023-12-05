<div class="d-flex flex-row flex-wrap">
    @foreach ($allreviews as $reviews)
    <?php
      $count=0;
    ?>
    @foreach ($reviews as $review)

    <div class="col-md-3 col-12 mb-5 p-0 ps-md-1 ps-lg-3 pe-md-1 pe-lg-3" wire:key="{{$review["id"]}}">
      <div class="card h-100 shadow border-0">
        <a href="{{url("/reviews")."/".$review["id"]}}" class="fill-div-link"></a>
        <div class="card-game">
          <div style="background:url({{$review["games"]["cover"]}});background-size: cover;background-position: center center;background-repeat: no-repeat; " class="card-game-parent-div">            
            {{-- <div style="position:relative;overflow:hidden;padding-bottom:100%;"> --}}
            <div class="d-flex flex-wrap align-content-center card-game-child-div">
              {{-- <img class="img img-responsive full-width" style="position:absolute;width:100%;" src="{{$game["cover"]}}" alt="..." /> --}}
              <img class="img img-responsive card-game-image" src="{{$review["games"]["cover"]}}" alt="..." />
            </div>
          </div>
        </div>
          
        <div class="card-body p-4">
          <div class="d-flex flex-row align-content-center flex-wrap align-items-end justify-content-between">
              <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{"@"}}{{Auth::user()->name}}</div>
              <div>{{$review["likes"]}}<i class="ms-2 bi bi-hand-thumbs-up lead"></i></div>
          </div>
          <a class="text-decoration-none link-dark stretched-link" href="{{url("/reviews")."/".$review["id"]}}">
            <h5 class="card-title mb-2">{{$review["title"]}}</h5>
          </a>
          <p class="card-text mb-0">

            @if (strlen($review["content"])>100)
              {{substr($review["content"],0,100)}}...
            @else
              {{$review["content"]}}
            @endif  

          </p>
        </div>
        <div class="card-footer p-4 mt-4 pt-0 bg-transparent border-top-0">
          <div class="d-flex align-items-end justify-content-between">
            <div class="d-flex align-items-center">
              <div class="small">
                <div class="fw-bold"><span class="fw-bolder">Juego: </span>{{$review["games"]["name"]}}</div>
                <div class="text-muted">{{substr($review["created_at"],0,10)}} &middot; {{ isset($review["games"]["genres"]) ? $review["games"]["genres"][0] : "" }}</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    $count++
    ?>
    @endforeach
    @endforeach
    
    @if (empty($allreviews[0]))
      <p>Vaya... parece que este usuario aún no ha escrito ninguna review...
    @endif
    <div class="mx-auto">
    @if ($this->canLoadMore)
        @include("pn")
      @endif
    </div>
</div>