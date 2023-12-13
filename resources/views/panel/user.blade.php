@extends('layouts.panel')

@section('template_title')
    Panel Usuarios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('User') }}
                            </span>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Id</th>
                                        
										<th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Ubicación</th>
                                        <th>Foto Perfil</th>
                                        <th>Foto Banner</th>
                                        <th>Sobre mí</th>

                                        <th>Admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            
											<td>{{ $user->name }}</td>
											<td>{{ $user->email }}</td>
                                            <td>{{ $user->location }}</td>
                                            <td>
                                            @if (str_starts_with($user->profile_photo_path,"img"))
                                                <img width=50 src="/{{$user->profile_photo_path}}" alt="">
                                            @else
                                                <img width=50 src="/storage/{{$user->profile_photo_path}}" alt="">
                                            @endif
                                            </td>
                                            <td>
                                            @if (str_starts_with($user->banner_photo_path,"img"))
                                                <img width=100 src="/{{$user->banner_photo_path}}" alt="">
                                            @else
                                                <img width=100 src="/storage/{{$user->banner_photo_path}}" alt="">
                                            @endif
                                            </td>
                                            <td>{{ $user->about_you }}</td>

                                            <td>
                                                <form action="{{ route('panel.user.destroy',$user->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('user.profile',$user->name) }}"><i class="fa fa-fw fa-edit"></i> Ver</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Borrar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $users->links() !!}
            </div>
        </div>
    </div>
    @endsection