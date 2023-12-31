@extends('layouts.panel')

@section('template_title')
    Panel Comentarios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Comment') }}
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
                                        <th>No</th>
                                        
										<th>Id Usuario</th>
                                        <th>Id Review</th>
                                        <th>Contenido</th>

                                        <th>Admin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comments as $comment)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $comment->id_user }}</td>
											<td>{{ $comment->id_review }}</td>
                                            <td>{{ $comment->content }}</td>

                                            <td>
                                                <form action="{{ route('panel.comment.destroy',$comment->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-success" href="{{ route('reviews.show',$comment->id_review) }}"><i class="fa fa-fw fa-edit"></i> Ver</a>
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
                {!! $comments->links() !!}
            </div>
        </div>
    </div>
    @endsection
