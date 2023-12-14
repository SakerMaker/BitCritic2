<div class="mt-5">
    <div class="row gx-5 justify-content-center mt-5">
        <div class="col-lg-12 col-xl-6 mt-5">
          <div class="text-center text-dark">
            <h2 class="fw-bolder mb-3" id="buscar">Buscar Usuarios</h2>
            
          </div>
        </div>
      </div>
    <div class="col-lg-12 pe-3 ps-3">
      <div class="ms-auto col-lg-12 mb-4 p-0 form-floating">
        <input type="text" wire:model.live="search" class="form-control"/>
        <label class="form-label">Buscar</label>
      </div>
    </div>
    
    <div class="d-flex justify-content-center">
      <div wire:loading><img src="{{ url("img/loading.gif")}}" alt="" style="width:50px;" class="mb-4"></div>
  </div>
    <div class="row">
    @foreach ($allUsers as $users)
        @foreach ($users as $user)
  
      <div class="col-lg-3 col-md-6 col-12 mb-5 p-0 ps-md-1 ps-lg-2 pe-md-1 pe-lg-2" wire:key="{{$user["id"]}}">
          <div class="card h-100 shadow border-0">
            <a href="{{url("/u") . "/" .$user["name"]}}" class="fill-div-link"></a>
            <div>
              <div style="background:url(@if (str_contains($user["profile_photo_path"], 'Profile-Picture-Default')){{url($user["profile_photo_path"])}}@else{{url("/storage/".$user["profile_photo_path"])}}@endif);background-size: cover;background-position: center center;background-repeat: no-repeat; " class="card-game-parent-div">            
                {{-- <div style="position:relative;overflow:hidden;padding-bottom:100%;"> --}}
                <div class="d-flex flex-wrap align-content-center card-game-child-div">
                  {{-- <img class="img img-responsive full-width" style="position:absolute;width:100%;" src="{{$game["cover"]}}" alt="..." /> --}}
                  <img class="img img-responsive card-game-image w-100" src="@if (str_contains($user["profile_photo_path"], 'Profile-Picture-Default')){{url($user["profile_photo_path"])}}@else{{url("/storage/".$user["profile_photo_path"])}}@endif" alt="..." />
                </div>
              </div>
            </div>
              
            <div class="card-body p-4">
              <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{ isset($user["location"]) ? $user["location"] : "" }}</div>
              <a class="text-decoration-none link-dark stretched-link" href="{{url("/u") . "/" .$user["name"]}}">
                <h5 class="card-title mb-3 bold">{{"@".$user["name"]}}</h5>
              </a>
              <p class="card-text mb-0">
                @if (isset($user["about_me"]))
  
                  @if (strlen($user["about_me"])>100)
                    {{substr($user["about_me"],0,100)}}...
                  @else
                    {{$user["about_me"]}}
                  @endif  
  
                @endif
              </p>
            </div>
            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
              <div class="d-flex align-items-end justify-content-between">
                    <div class="text-muted d-flex flex-wrap justify-content-end w-100 gap-4"><div><p class="mb-1 h5">{{$user["reviews"]}} <i class="ms-2 bi bi-file-text lead"></i></p></div><div><p class="mb-1 h5">{{$user["likes"]}} <i class="ms-2 bi bi-hand-thumbs-up lead"></i></p></div></div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        @endforeach
    </div>
        @if ($allUsers == NULL && !$this->canLoadMore)
        <p>Vaya... parece que no se ha encontrado ningún usuario.</p>
        @endif
        @if ($this->canLoadMore && isset($this->search) && !empty($this->search))
        @include("pn")
        @endif
  </div>
  