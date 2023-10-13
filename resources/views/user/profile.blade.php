@section('template_title')
    Perfil de {{ $user->name }}
@endsection

<x-app-layout>
  <section class="h-100 gradient-custom-2">
      <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col col-lg-12 col-xl-12">
            <div class="card">
              <div class="rounded-top text-white d-flex flex-row" style="background: url(@if (str_contains($user->banner_photo_path, 'Banner-Default')){{url($user->banner_photo_path)}}@else{{url("/storage/".$user->banner_photo_path)}}@endif); height:200px; background-size:cover;background-position:center center;">
                <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;min-height:150px;">
                  <img src="@if (str_contains($user->profile_photo_path, 'Profile-Picture-Default')){{url($user->profile_photo_path)}}@else{{url("/storage/".$user->profile_photo_path)}}@endif"
                    alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                    style="width: 150px!important; min-height:150px;z-index: 1;object-fit:cover;">
                  </div>
                  <div class="ms-3 d-none d-md-block" style="margin-top: 130px;">
                    <h5 style="text-shadow: #000000ab 2px 5px 10px" class="fw-bold">{{$user->name}}</h5>
                    <div class="d-flex gap-4">
                        @if(isset($user->location))<p style="text-shadow: #000000ab 2px 5px 10px"><i class="bi bi-geo-alt-fill"></i> {{$user->location}}</p>@else<p style="text-shadow: #000000ab 2px 5px 10px"><i class="bi bi-geo-alt-fill opacity-100"></i> <span class="opacity-50"></span> @endif
                        @if(isset($user->birthday))<p style="text-shadow: #000000ab 2px 5px 10px"><i class="bi bi-calendar-heart-fill"></i> {{$user->birthday}}</p>@else<p style="text-shadow: #000000ab 2px 5px 10px"><i class="bi bi-calendar-heart-fill"></i> <span class="opacity-50"></span> @endif
                    </div>
                  </div>
                </div>
                <div class="p-4 text-black d-flex justify-content-between align-items-center flex-wrap" style="background-color: #f8f9fa;">
                  @if (Auth::id()==$user->id)
                    <a href="{{Route('user.edit',["name"=>Auth::user()->name])}}" type="button" class="btn btn-outline-dark mt-2" style="width:150px;" data-mdb-ripple-color="dark"
                      style="z-index: 1;">
                      Editar Perfil
                  </a>
                  @endif
                  <div class="d-flex justify-content-end text-center py-1 mt-lg-0 mt-4 d-none d-md-flex" style="float:right;">
                  <div>
                    <p class="mb-1 h5">{{$reviews}}</p>
                    <p class="small text-muted mb-0">Reviews</p>
                  </div>
                  <div class="px-3">
                    <p class="mb-1 h5">{{$comments}}</p>
                    <p class="small text-muted mb-0">Comentarios</p>
                  </div>
                  <div class="px-3">
                    <p class="mb-1 h5">{{$likes}}</p>
                    <p class="small text-muted mb-0">Likes</p>
                  </div>
                  <div class="px-3">
                    <p class="mb-1 h5">{{$followers}}</p>
                    <p class="small text-muted mb-0">Seguidores</p>
                  </div>
                </div>
              </div>
              <div class="card-body pd-0 ps-4 pe-4 pb-0 text-black d-md-none d-block">
                <h5 class="pb-2 pb-md-0 mb-4 fw-bold border-bottom">{{$user->name}}</h5>
                <div class="d-flex justify-content-between align-items-center align-self-center flex-wrap">
                  <div class="d-flex gap-1 flex-wrap">
                    <p class="m-0"><i class="bi bi-geo-alt-fill"></i>
                      {{ Form::text('location', $user->location, ['class' => 'form-control w-75 d-inline-block mx-3' . ($errors->has('location') ? ' is-invalid' : ''), 'placeholder' => 'Ubicación...']) }}
                      {!! $errors->first('location', '<div class="invalid-feedback">:message</div>') !!}
                    </p>
                    <p class="m-0"><i class="bi bi-calendar-heart-fill"></i>
                      {{ Form::date('birthday', $user->birthday, ['class' => 'form-control w-75 d-inline-block mx-3' . ($errors->has('birthday') ? ' is-invalid' : ''), 'placeholder' => 'Cumpleaños...']) }}
                      {!! $errors->first('birthday', '<div class="invalid-feedback">:message</div>') !!}
                    </p>
                  </div>
                  <div class="d-flex justify-content-lg-end justify-content-center text-center py-1 mt-4 mt-lg-0 flex-wrap user-counts" style="float:right;">
                    <div>
                      <p class="mb-1 h5">{{$reviews}}</p>
                      <p class="small text-muted mb-0">Reviews</p>
                    </div>
                    <div class="px-3">
                      <p class="mb-1 h5">{{$comments}}</p>
                      <p class="small text-muted mb-0">Comentarios</p>
                    </div>
                    <div class="px-3">
                      <p class="mb-1 h5">{{$likes}}</p>
                      <p class="small text-muted mb-0">Likes</p>
                    </div>
                    <div class="px-3">
                      <p class="mb-1 h5">{{$followers}}</p>
                      <p class="small text-muted mb-0">Seguidores</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body p-4 text-black">
                <div class="mb-5">
                  <p class="lead fw-normal mb-1">Sobre Mí</p>
                  <div class="p-4 rounded" style="background-color: #f8f9fa;">
                    <p class="font-italic mb-1">{{$user->about_me}}</p>
                  </div>
                </div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                  <p class="lead fw-normal mb-0">Últimas Reviews</p>
                  
                </div>
                <div class="row gx-5">
                  {{-- @foreach ($allreviews as $single_review)
                  <div class="col-lg-4 mb-5 fill-div">
                    <a href="{{url("/reviews/") . "/" .$single_review[0]->id_review}}" class="fill-div-link"></a>
                    <div class="card h-100 shadow border-0">
                      <div style="position:relative;overflow:hidden;padding-bottom:100%;">
                        <img class="img img-responsive full-width" style="position:absolute;width:100%;" src="{{url($single_review[0]->game_image)}}" alt="..." />
                      </div>
                      <div class="card-body p-4">
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{$single_review[0]->game_genero}}</div>
                        <a class="text-decoration-none link-dark stretched-link" href="#!">
                          <h5 class="card-title mb-3">{{$single_review[0]->review_title}}</h5>
                        </a>
  
                        <p class="card-text mb-0">
                          @if (strlen($single_review[0]->review_content)>100)
                          {{substr($single_review[0]->review_content,0,100)}}...
                        @else
                          {{$single_review[0]->review_content}}
                        @endif  </p>
                      </div>
                      <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                        <div class="d-flex align-items-end justify-content-between">
                          <div class="d-flex align-items-center">
                            <div class="small">
                              <div class="fw-bold"><span class="fw-bolder">Juego: </span>{{$single_review[0]->game_title}}</div>
                              <div class="text-muted">{{substr($single_review[0]->created_at,0,10)}} &middot; by {{$user->name}}</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach --}}
                  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</x-app-layout>