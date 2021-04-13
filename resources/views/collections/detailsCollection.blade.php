@extends('layouts.app')

@section('content')
<div class="container contenuShow">
	<h1 class="titresPage">{{$collection->collect_title}}</h1>

	<div>
		@foreach($mesMedias as $unMedia)
			<div class="listeMedias">

				<div class="elementListe">
					@if($unMedia->media_cover != NULL)
					<img src="{{asset($unMedia->media_cover)}}" class="imageMedia" />
					@else
					<img src="{{asset('img/pas-d-image.jpg')}}" class="imageMedia" />
					@endif
				</div>

				<div class="elementListe infos">
				@if($unMedia->media_type == "Film")
					<a href="{{action('FilmsController@show', $unMedia->media_id)}}">{{$unMedia->media_title}}</a></td>
				@elseif($unMedia->media_type == "Livre")
					<a href="{{action('LivresController@show', $unMedia->media_id)}}">{{$unMedia->media_title}}</a></td>
				@else
					<a href="{{action('MusiquesController@show', $unMedia->media_id)}}">{{$unMedia->media_title}}</a></td>
				@endif

				<br />

					<form action="{{route('contains.destroy',[$unMedia->media_id])}}" method="POST">
						@method('DELETE')
						@csrf
						<button type="submit" class="btn btn-danger">Retirer</button>               
					</form>
				</div>
			</div>
		@endforeach
	</div>
</div>
@endsection