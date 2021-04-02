@extends('layouts.site')
@section('content')
	<h1 class="mt-2 mb-3">создать пост</h1>
	<form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">

<!-- NB! <form ... enctype="multipart/form-data">  mustbe for correct load image -->

		@csrf
        <div class="form-group">
            <input type="text" class="form-control" name="title" placeholder="Заголовок" required>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="excerpt" placeholder="Анонс поста" required></textarea>
        </div>
        <div class="form-group">
            <textarea class="form-control" name="body" placeholder="Текст поста" rows="7" required></textarea>
        </div>
        <div class="form-group">
            <input type="file" class="form-control-file" name="image">
        </div>		
		<div class="form-group">
			<button type="submit" class="btn btn-primary">сохранить</button>
		</div>
	</form>
@endsection