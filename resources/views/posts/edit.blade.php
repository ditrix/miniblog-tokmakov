@extends('layouts.site')
@section('content')
	<h1 class="mt-2 mb-3">редактировать пост</h1>
	<form method="post" action="{{route('post.update', ['id' => $post->id])}}" enctype="multipart/form-data">

<!-- NB! <form ... enctype="multipart/form-data">  mustbe for correct load image -->

		@csrf
        @method('PATCH')
        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="Заголовок" required value="{{$post->title}}">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="excerpt" placeholder="Анонс поста" required>{{ $post->excerpt}}</textarea>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="body" placeholder="Текст поста" rows="7" required>
                {{ $post->body }}
            </textarea>
        </div>
        <div class="form-group">
            <input type="file" class="form-control-file" name="image">
        </div>		
        @isset($post->image)
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="remove" id="remove">
                <label class="form-check-label" for="remove">
                    Удалить загруженное <a href="{{ $post->image }}" target="_blank">изображение</a>
                </label>    
            </div>
        @endisset

		<div class="form-group">
            <a type="button" class="btn btn-info" href="{{ route('post.show', ['id' => $post->id]) }}">отменить</a>
			<button type="submit" class="btn btn-primary">сохранить</button>
		</div>
	</form>
@endsection