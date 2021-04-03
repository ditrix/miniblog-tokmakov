@extends('layouts.site')

@section('content')

	<h1>результаты поиска</h1>
	<div class="row">
		@foreach($posts as $post)
			<div class="col-6 mb-4">
				<div class="card">
					<div class="card-header">
						<h3>{{$post->title}}</h3>
					</div>
					<div class="card-body">
						<img src="{{$post->thumb ?? asset('img/noimage.png')}}" alt="" class="img-fluid">
						<p>{{$post->excerpt}}</p>
					</div>
					<div class="card-footer">
						<div class="clearfix">
                            <span class="float-left">
                                Автор: {{ $post->author }}
                                <br>
                                Дата: {{ date_format($post->created_at, 'd.m.Y H:i') }}
                            </span>
                            <a href="#" class="btn btn-dark float-right">Читать дальше</a>
                        </div>
					</div>
				</div>
			</div>
		@endforeach
		
	</div>
	{{ $posts->links() }}
@endsection