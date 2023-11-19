@section('template_title')
    {{$game["name"]}}
@endsection

<x-app-layout>
    <section>
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4  gx-lg-5 align-items-start text-white">
                <div class="col-md-4 col-lg-4 d-flex justify-content-end"><img class="card-img-top mb-5 mb-md-0 rounded-3" src="{{ url($game['cover_url'] )}}" alt="..." /></div>
                <div class="col-md-8 col-lg-8">
                    @if (isset($game["genres"]))
                    @foreach ($game["genres"] as $genre)
                        <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{$genre}}</div>
                    @endforeach
                    @endif
                    <h1 class="display-5 fw-bolder">{{$game["name"]}}</h1>
                    <div class="fs-5 mb-4">
                        <span>&middot; {{$review_count}} reviews</span>
                    </div>
                    <p>
                        <p class="lead d-lg-block d-sm-block d-md-none" id="summary">
                            @if (isset($game["summary"]))
                            {{$game["summary"]}}
                        </p>
                        @if (strlen($game["summary"])>500)
                            <a class="link-light d-lg-block d-sm-block d-md-none" id="showSummary" href="#" onclick="toggleSummary()">Leer más...</a>
                            <script>
                                let summary = false;
                                let text = document.getElementById("summary").innerHTML;
                                document.getElementById("summary").innerHTML = text.slice(0,500)+"...";

                                function showSummary() {
                                    document.getElementsByClassName("lead")[0].innerHTML = text;
                                    document.getElementById("showSummary").innerHTML = "Leer menos...";
                                    summary = true;
                                }

                                function unshowSummary() {
                                    document.getElementsByClassName("lead")[0].innerHTML = text.slice(0,500)+"...";
                                    document.getElementById("showSummary").innerHTML = "Leer más...";
                                    summary = false;
                                }

                                function toggleSummary() {
                                    summary ? unshowSummary() : showSummary();
                                }
                            </script>
                        @else
                        @endif
                    
                    </p>
                    @endif
                    <div class="d-flex">
                        <a class="btn btn-outline-light flex-shrink-0" type="button" href="#reviews">
                            <i class="bi bi-star me-1"></i>
                            Poner Review
                        </a>
                    </div>
                </div>
                <div class="mt-4">
                    <p>
                        <p class="lead d-none d-md-block d-lg-none" id="summary_tablet">
                            @if (isset($game["summary"]))
                            {{$game["summary"]}}
                            @endif
                        </p>
                    </p>
                </div>
            </div>
            <section id="reviews">
              <div class="card bg-light mt-5">
                @if ($message = Session::get('error'))
                            <div class="alert alert-danger mb-0">
                                <p class="m-0">{{ $message }}</p>
                            </div>
                @endif
                  <div class="card-body text-dark p-5">
                      <!-- Comment form-->
                      @includeif('partials.errors')
                      <form method="POST" action="{{ route('reviews.store') }}"  role="form" class="mb-4 d-flex flex-column justify-content-end" enctype="multipart/form-data">
                        @csrf
                        <h1 class="text-dark mb-4 fw-bold">Escribe tu Review</h1>
                        {{ Form::hidden('id_game', $game["id"]) }}
                        {{ Form::hidden('id_user', Auth::id()) }}
                        {{ Form::text('title', "", ['class' => 'form-control' . ($errors->has('title') ? ' is-invalid' : ''), 'placeholder' => 'Título de la Review']) }}
                        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
                        {{ Form::textarea('content', "", ['class' => 'form-control mt-4' . ($errors->has('content') ? ' is-invalid' : ''), 'placeholder' => 'Redacta tu Review']) }}
                        {!! $errors->first('content', '<div class="invalid-feedback">:message</div>') !!}
                        @guest
                            <a class="btn btn-lg btn-primary mt-4 mb-4 ms-auto" href="{{url("/login")}}">Enviar Review</a>
                        @else
                            <button type="submit" class="btn btn-lg btn-primary mt-4 mb-4 ms-auto">Enviar Review</button>
                        @endguest
                    </form>
                    <h1 class="text-dark mt-5 mb-4 fw-bold">Reviews</h1>
                      <!-- Comment with nested comments-->
                      @foreach ($reviews as $single_review)
                        <a href="{{url("/reviews/".$single_review[0]->id_review)}}">
                            <div class="d-flex mb-4 p-4 border rounded align-items-center flex-wrap">
                                <!-- Parent comment-->
                                <a href={{url("/u/".$single_review[0]->name)}}><div class="flex-shrink-0"><img class="rounded-circle" src="@if (str_contains($single_review[0]->profile_photo_path, 'Profile-Picture-Default')){{url($single_review[0]->profile_photo_path)}}@else{{url("storage/".$single_review[0]->profile_photo_path)}}@endif" alt="..." style="width:50px;height:50px;object-fit:cover;"/></div></a>
                                <div class="ms-lg-3">
                                
                                    <div class="fw-bold d-none d-md-block"><span class="fw-bolder">{{$single_review[0]->review_title}}</span> &middot; by <a href={{url("/u/".$single_review[0]->name)}}>{{$single_review[0]->name}}</a> &middot; <span class="small text-secondary">{{substr($single_review[0]->created_at,0,10)}}</span></div>
                                    <div class="fw-bold d-block d-md-none"><span class="fw-bolder">{{$single_review[0]->review_title}}</span> <br/> by <a href={{url("/u/".$single_review[0]->name)}}>{{$single_review[0]->name}}</a><br/><span class="small text-secondary">{{substr($single_review[0]->created_at,0,10)}}</span></div>
                                    @if (strlen($single_review[0]->review_content)>100)
                                        {{substr($single_review[0]->review_content,0,100)}}...
                                    @else
                                        {{substr($single_review[0]->review_content,0,100)}}
                                    @endif
                                    <br>
                                
                                </div>
                                <div class="ms-auto">
                                    <a class="btn btn-primary" href="{{url("/reviews/".$single_review[0]->id_review)}}">Ver Review</a>
                                </div>
                            </div>
                        </a>
                      @endforeach
                      @if ($reviews == NULL)
                        <p>Vaya... parece que aún no hay reviews para este juego. ¡Sé el primero en redactar una!
                      @endif
                      
                  </div>
              </div>
          </section>
        </div>
        
    </section>
    
    <!-- Related items section-->
    {{-- <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Juegos Relacionados</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-start">
                @foreach ($related as $related_game)
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="{{ url($related_game->image) }}" alt="..." />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder">{{ $related_game->title }}</h5>
                                <!-- Product price-->
                               
                                @if (strlen($related_game->description)>100)
                                    {{substr($related_game->description,0,100)}}...
                                @else
                                    {{$related_game->description}}
                                @endif
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="{{url("/games/".$related_game->id)}}">Ver Juego</a></div>
                        </div>
                    </div>
                </div>
                @endforeach
                @if ($related->count() == 0)
                <h5 class="fw-bolder mb-4">Parece que aún no hay juegos similares...</h5>
                @endif
                
            </div>
        </div>
    </section> --}}
</x-app-layout>