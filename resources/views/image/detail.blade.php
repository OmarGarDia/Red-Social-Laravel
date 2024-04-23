@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @include('includes.message')

                <div class="card pub_image pub_image_detail">
                    <div class="card-header">
                        @if ($image->user->image)
                            <div class="avatar">
                                <img src="{{ route('user.avatar', ['filename' => $image->user->image]) }}" class="avatar" />
                            </div>
                        @endif
                        <div class="data-user">
                            {{ $image->user->name . ' ' . $image->user->surname }}
                            <span class="nickname">{{ ' | @' . $image->user->nick }}</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="image-container">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" />
                        </div>

                        <div class="description">
                            <span class="nickname">{{ '@' . $image->user->nick }}</span>
                            <span class="nickname date">
                                {{ ' | ' . \FormatTime::LongTimeFilter($image->created_at) }}</span>
                            <p>{{ $image->description }}</p>
                        </div>
                        <div class="likes">

                            <!-- Comprobar si el usuario le dio like a la imagen -->
                            <?php $user_like = false; ?>
                            @foreach ($image->likes as $like)
                                @if ($like->user->id == Auth::user()->id)
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach

                            @if ($user_like)
                                <img src="{{ asset('img/heart-red.png') }}" class="btn-dislike"
                                    data-id = "{{ $image->id }}">
                            @else
                                <img src="{{ asset('img/heart-grey.png') }}" class="btn-like"
                                    data-id = "{{ $image->id }}">
                            @endif
                            <span class="number-likes">{{ count($image->likes) }}</span>
                        </div>
                        @if (Auth::user() && Auth::user()->id == $image->user->id)
                            <div class="actions">
                                <a href="{{ route('image.edit', ['id' => $image->id]) }}"
                                    class="btn btn-sm btn-primary">Actualizar</a>
                                <a data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-sm btn-danger">Borrar</a>

                                <div class="modal" id="myModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Confirmar borrado</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Si eliminas esta imagen nunca podras recuperarla, ¿Estás seguro?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <a href="{{ route('image.delete', ['id' => $image->id]) }}"
                                                    class="btn btn-danger">Borrar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                        <div class="clearfix"></div>
                        <div class="comments">
                            <h2>Comentarios ({{ count($image->comments) }})</h2>
                            <hr>
                            <form action="{{ route('comment.save') }}" method="post">
                                @csrf
                                <input type="hidden" name="image_id" value="{{ $image->id }}" />
                                <p>
                                    <textarea name="content" cols="30" rows="10"
                                        class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}"></textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </p>
                                <button type="submit" class="btn btn-success">Enviar</button>

                            </form>
                            <hr>
                            @foreach ($image->comments as $comment)
                                <div class="comment">
                                    <span class="nickname">{{ '@' . $comment->user->nick }}</span>
                                    <span class="nickname date">
                                        {{ ' | ' . \FormatTime::LongTimeFilter($comment->created_at) }}</span>
                                    <p>{{ $comment->content }} <br />
                                        @if (Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id))
                                            <a href="{{ route('comment.delete', ['id' => $comment->id]) }}"
                                                class="btn btn-sm btn-danger">Eliminar</a>
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
