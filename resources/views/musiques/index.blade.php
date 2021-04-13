@extends('layouts.app')

@section('content')
<div class="container">
	<h1 class="titresPage">Liste des musiques</h1>

	<div>
		<h2>Filtrer par genres</h2>
		@foreach($genres as $genre)
		<a href="{{route('chansonsParGenre', ['id' => $genre->genre_id])}}" class="genre">{{$genre->genre_name}}</a>
		@endforeach
	</div>

	<hr>

	<div>
		@foreach($medias as $media)
			<div class="listeMedias">
				<div class="elementListe">
					@if($parGenre == false)
						@if($media->media_cover != NULL)
						<img src="{{$media->media_cover}}" class="imageMedia" />
						@else
						<img src="img/pas-d-image.jpg" class="imageMedia" />
						@endif
					@else
						@if($media->media_cover != NULL)
						<img src="../{{$media->media_cover}}" class="imageMedia" />
						@else
						<img src="../img/pas-d-image.jpg" class="imageMedia" />
						@endif
					@endif
				</div>
				<div class="elementListe infos">
					<a href="{{action('MusiquesController@show', $media->media_id)}}"><h5>{{$media->media_title}}</h5></a>
					<br />
					<span>{{$media->media_year}}</span>
				</div>
			</div>
		@endforeach
	</div>
</div>
@endsection