@section('template_title')
    Editar Perfil - {{ $user->name }}
@endsection

@includeif('partials.errors')

<x-app-layout>
  <form method="POST" action="{{ route('user.update', $user->id) }}"  role="form" enctype="multipart/form-data">
    {{ method_field('PATCH') }}
    @csrf
    @method('PUT')
<section class="h-100 gradient-custom-2" style="min-height:75vh">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col col-lg-12 col-xl-12">
          <div class="card">
            <div class="rounded-top text-white d-flex obj-fit-cover d-flex flex-wrap" id="output2" style="background: url('@if (str_contains($user->banner_photo_path, 'Banner-Default')){{url($user->banner_photo_path)}}@else{{url("/storage/".$user->banner_photo_path)}}@endif'); height:200px; background-size:cover; background-position:center center;">
              <div class="ms-4 mt-5 d-flex flex-column order-pfp" style="width: 150px;min-height:150px;">
                <div class="profile-pic img-fluid mt-4 mb-2">
                    <label class="-label" for="file">
                      <span class="glyphicon glyphicon-camera"></span>
                      <span>Cambiar Foto</span>
                    </label>
                    
                      <input type="file" name="profile_photo_path"  id="file" onchange="loadFile(event)">
                      <img src="@if (str_contains($user->profile_photo_path, 'Profile-Picture-Default')){{url($user->profile_photo_path)}}@else{{url("/storage/".$user->profile_photo_path)}}@endif" id="output" width="200" />
                    
                  </div>
                
              </div>
              <div class="text-right py-1 m-auto mr-0 overflow-hidden order-banner" style="margin-right:auto!important;">
                <div class="upload-btn-wrapper">
                  <button class="btn btn-outline-light btn-lg px-4 rounded-circle text-white" style="cursor:pointer;width:70px;height:70px;"><i class="bi bi-camera-fill"></i></button>
                  <input type="file" name="banner_photo_path" id="file" onchange="loadFileBanner(event)">
                  <span class="text-danger">{{ $errors->first('banner_photo_path') }}</span>
                </div>
              </div>
            </div>
            <div class="card-body pt-4 ps-4 pe-4 mt-4 pb-0 text-black">
                <h5>{{$user->name}}</h5>
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
            <div class="card-body ps-4 pe-4 pt-0 mt-3 text-black">
              <div class="mb-5">
                <p class="lead fw-normal mb-1">Sobre Mí</p>
                {{ Form::textarea('about_me', $user->about_you, ['class' => 'form-control' . ($errors->has('about_me') ? ' is-invalid' : ''), 'placeholder' => 'Escribe sobre ti...']) }}
                {!! $errors->first('about_me', '<div class="invalid-feedback">:message</div>') !!}
              </div>
              <div class="p-4 text-black">
                <div class="d-flex justify-content-end text-center py-1">
                  <button type="submit" class="btn btn-outline-dark" data-mdb-ripple-color="dark" style="z-index: 1;">
                    Guardar Cambios
                  </button>
                </div>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </section>
  
</form>

<script>
var loadFile = function (event) {
var image = document.getElementById("output");
image.src = URL.createObjectURL(event.target.files[0]);
};

var loadFileBanner = function (event) {
var image2 = document.getElementById("output2");
image2.style.background = "url("+URL.createObjectURL(event.target.files[0])+")";
image2.style.backgroundSize = "cover";
image2.style.backgroundPosition = "center center";
};

</script>


</x-app-layout>