@section('template_title')
    Review - {{ $review->title }}
@endsection

<x-app-layout>

    <section class="text-white">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-3">
                    <div class="d-flex align-items-center flex-wrap pb-4">
                        <a href="{{url("/u/".$user->name)}}"><img class="rounded-circle" src="@if (str_contains($user->profile_photo_path, 'Profile-Picture-Default')){{url($user->profile_photo_path)}}@else{{url("storage/".$user->profile_photo_path)}}@endif" alt="..." style="width:50px;height:50px;object-fit:cover;"/></a>
                        <div class="ms-md-3 ms-0">
                            <div class="fw-bold"><a class="text-white" href="{{url("/u/".$user->name)}}">{{$user->name}}</a></div>
                            <div class="text-white-50 small">
                                @if (strlen($user->about_me)>20)
                            {{substr($user->about_me,0,20)}}...
                          @else
                            {{$user->about_me}}
                          @endif</div>
                        </div>
                        <div class="col-lg-12 ms-auto ms-lg-0">

                            @if (Auth::id()==$user->id)
                                  <a href="{{Route('user.edit',["name"=>Auth::user()->name])}}" type="button" class="btn btn-outline-light mt-2 w-100" style="width:150px;" data-mdb-ripple-color="dark"
                                  style="z-index: 1;">
                                  Editar Perfil
                              </a>
                              @else
                              @livewire('followbc', ['follower' => Auth::user()->id, 'followed' => $user->id, "sizeCss"=>true])
                            @endif
                        </div>
                    </div>
                    <div class="pt-4 border-top border-secondary">

                        <h5 class="fw-bold mb-1"><a href="{{url("/games/".$game["id"])}}" class="fw-bolder text-white link-offset-3 link-underline link-underline-opacity-0">{{$game["name"]}}</a></h5>
                        @if (isset($game["genres"]))
                                @foreach ($game["genres"] as $genre)
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">{{$genre}}</div>
                                @endforeach
                            @endif
                        <p class="text-white-50 small">
                        @if (isset($game["summary"]))

                            @if (strlen($game["summary"])>100)
                            {{substr($game["summary"],0,100)}}...
                            @else
                            {{$game["summary"]}}
                            @endif  

                        @endif
                        </p>
                        <figure class="mb-4 mt-3"><a href="{{url("/games/".$game["id"])}}"><img class="img-fluid rounded" style="width:100%;object-fit:cover;" src="{{url($game["cover"])}}" alt="..." /></a></figure>
                    </div>

                </div>
                <div class="col-lg-9">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4 rounded d-flex flex-wrap flex-row justify-content-between align-items-end">
                            <!-- Post title-->
                            <div>
                                <h1 class="fw-bolder mb-1">{{$review->title}}</h1>
                                <!-- Post meta content-->
                                <!-- Post categories-->
                                <div class="text-light fst-italic" style="font-size:12px;">Publicado el {{substr($review->created_at,8,2)}}/{{substr($review->created_at,5,2)}}/{{substr($review->created_at,0,4)}} a las {{substr($review->created_at,11,5)}}</div>
                            </div>
                            <div class="col-lg-auto col-12">
                                @livewire('like', ["review" => $review->id])
                            </div>
                        </header>
                        <!-- Preview image figure-->
                        <!-- Post content-->
                        <section class="mb-5" style="width:100%; word-wrap: break-word;">
                            <p class="fs-5 mb-4 p-4 border border-secondary rounded text-white" style="white-space: pre-line;">{{trim($review->content)}}
                                {{-- @if ($user->id==Auth::id())
                                    <form action="{{ route('reviews.destroy',$review->id) }}" method="POST" >
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="reviewUsuario">
                                        <button type="submit" class="text-white btn btn-secondary" style="float:right!important;"><i class="fa fa-fw fa-trash"></i> Borrar Review</button>
                                    </form>
                                    @else
                                    @endif --}}
                                </p>
                                <div>
                                    @if ($review->id_user==Auth::id())
                                    <form action="{{ route('reviews.destroy',$review->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-white btn btn-danger ms-auto d-block"><i class="fa fa-fw fa-trash"></i> Borrar Review</button>
                                    </form>
                                    @endif
                                </div>
                        </section>
                        
                    </article>
                    
                    <!-- Comments section-->
                    <section>
                        {{-- <div class="card bg-light text-dark">
                            <div class="card-body">
                                <!-- Comment form-->
                                <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                                <!-- Comment with nested comments-->
                                <div class="d-flex mb-4">
                                    <!-- Parent comment-->
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                        <!-- Child comment 1-->
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                            </div>
                                        </div>
                                        <!-- Child comment 2-->
                                        <div class="d-flex mt-4">
                                            <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                            <div class="ms-3">
                                                <div class="fw-bold">Commenter Name</div>
                                                When you put money directly to a problem, it makes a good headline.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single comment-->
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                    <div class="ms-3">
                                        <div class="fw-bold">Commenter Name</div>
                                        When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        
                        <div class="card bg-light p-md-5 p-4">
                    <h2 class="text-dark mb-4 fw-bold">Comentarios</h2>
                    
                    <div class="card-body text-dark p-0 ">
                        <!-- Comment form-->
                        <!-- Comment with nested comments-->
                        @foreach ($users as $user_comment)
                        
                        <div class="d-flex mb-4 pb-4 flex-wrap flex-row align-items-center border-bottom">
                            <!-- Parent comment-->
                            <a href={{url("/u/".$user_comment[0]->name)}}><div class="flex-shrink-0 d-none d-md-block"><img class="rounded-circle" src="@if (str_contains($user_comment[0]->profile_photo_path, 'Profile-Picture-Default')){{url($user_comment[0]->profile_photo_path)}}@else{{url("storage/".$user_comment[0]->profile_photo_path)}}@endif" alt="..." style="width:50px"/></div></a>
                            <div class="ms-md-3 ms-0 d-md-block d-none" style="word-wrap: break-word;">
                                
                                <div class="fw-bold"><a href={{url("/u/".$user_comment[0]->name)}}>{{$user_comment[0]->name}}</a> &middot; <span class="small text-secondary">{{substr($review->created_at,8,2)}}/{{substr($review->created_at,5,2)}}/{{substr($review->created_at,0,4)}} a las {{substr($review->created_at,11,5)}}</span></div>
                                <p class="m-0">{{$user_comment[0]->comment_content}}</p>
                            </div>
                            <div class="ms-md-3 ms-0 d-md-none d-block" style="word-wrap: break-word;">
                                <div class=" d-flex flex-wrap flex-row align-items-center">
                                    <a href={{url("/u/".$user_comment[0]->name)}}><div class="flex-shrink-0"><img class="rounded-circle" src="@if (str_contains($user_comment[0]->profile_photo_path, 'Profile-Picture-Default')){{url($user_comment[0]->profile_photo_path)}}@else{{url("storage/".$user_comment[0]->profile_photo_path)}}@endif" alt="..." style="width:50px"/></div></a>
                                    
                                    <div class="fw-bold"><a href={{url("/u/".$user_comment[0]->name)}}>{{$user_comment[0]->name}}</a> <br/><span class="small text-secondary">{{substr($review->created_at,8,2)}}/{{substr($review->created_at,5,2)}}/{{substr($review->created_at,0,4)}} a las {{substr($review->created_at,11,5)}}</span></div>
                                </div>
                                <p class="m-0">{{$user_comment[0]->comment_content}}</p>
                            </div>
                            <div class="ms-auto">
                                @if ($user_comment[0]->id==Auth::id())
                                <form action="{{ route('comments.destroy',$user_comment[0]->id_commnent) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white btn btn-secondary" style="float:right!important;"><i class="fa fa-fw fa-trash"></i> Borrar</button>
                                </form>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @if ($users == NULL)
                        <p>Vaya... parece que aún no hay comentarios para esta review. ¡Sé el primero en escribir uno!
                        @endif
                        @includeif('partials.errors')
                        <form method="POST" action="{{ route('comments.store') }}"  role="form" class="mt-5 d-flex flex-column flex-wrap" enctype="multipart/form-data">
                            <h4 class="text-dark mt-4 fw-bold">Escribe tu comentario</h4>

                            @csrf
                            
                            {{ Form::hidden('id_user', Auth::id()) }}
                            {{ Form::hidden('id_review', $review->id) }}
                            {{ Form::text('content', "", ['class' => 'form-control mb-0' . ($errors->has('content') ? ' is-invalid' : ''), 'placeholder' => 'Escribe tu comentario']) }}
                            {!! $errors->first('content', '<div class="invalid-feedback">:message</div>') !!}
                            
                            <button type="submit" class="btn btn-lg btn-primary mt-4 mb-2 ms-md-auto ms-0">Enviar</button>
                        </form>
                      
                  </div>
              </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
    </main>

</x-app-layout>
