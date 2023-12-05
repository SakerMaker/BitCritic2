<div class="d-flex flex-wrap align-items-center col-12 justify-content-between">
    <div class="text-light me-3 dropdown dropdown-center dropdown-like">
        <p class="m-0 p-0 dropdown-toggle dropdown-like-toggle d-block">{{$this->likesCount}}<i class="ms-2 bi bi-hand-thumbs-up lead"></i></p>
        <ul class="dropdown-menu p-2">
            @foreach ($this->likers as $user)
                <li style="width:fit-content;"><a style="white-space: nowrap;width:auto;display:inline-block;padding:0;" class="dropdown-item" href="{{url("/u"."/".$user->name)}}"><img src="@if (str_contains($user->profile_photo_path, 'Profile-Picture-Default')){{url($user->profile_photo_path)}}@else{{url("storage/".$user->profile_photo_path)}}@endif" alt="..." style="width:50px;height:50px;object-fit:cover;"/></a></li>
            @endforeach
          </ul>
    </div>
    <div>
        @if ($this->liked)
        <button class="btn btn-primary d-flex align-items-center" wire:click="likeToggle">Me gusta <i class="ms-2 bi bi-hand-thumbs-up-fill lead"></i></button>
        {{-- <button class="btn btn-primary d-flex align-items-center fw-bold" wire:click="likeToggle">Me gusta <i class="ms-2 bi bi-hand-thumbs-up-fill lead"></i></button> --}}
        @else
        <button class="btn btn-light d-flex align-items-center" wire:click="likeToggle">Me gusta <i class="ms-2 bi bi-hand-thumbs-up lead"></i></button>
        @endif
    </div>
</div>
