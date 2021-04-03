@extends('layouts.site')

@section('content')
	<div class="row">
		<div class="col-12">
			<div class="cart mt-4 mb-4">
				<div class="card-header">
					<h1>{{$post->title}}</h1>
				</div>	
				<div class="card-body">
					<img src="{{$post->image ?? asset('img/noimage.png')}}" alt="" class="img-fluid">
					<p class="mt-3 mb-0">
						{{$post->body}}
					</p>
				</div>	
				<div class="card-footer">
					<div class="clearfix">
                        <span class="float-left">
                            Автор: {{ $post->author }}
                            <br>
                            Дата: {{ date_format($post->created_at, 'd.m.Y H:i') }}
                        </span>
                        <nav class="float-right">
                         <a href="/" class="btn btn-dark float-left">назад</a>
                         &nbsp;
                        <a href="{{ route('post.edit', ['id' => $post->id]) }}" class="btn btn-dark float-right">Редактировать</a>
                    	</nav>
                    </div>
				</div>	

			</div>			
		</div>	
	</div>
@endsection