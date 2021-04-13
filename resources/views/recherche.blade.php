@extends('layouts.app')

@section('content')
<div class="container contenuShow">
	<h1 class="titresPage">Recherche</h1>

	@if(count($listeMedias) > 0)
		<div>
			@foreach($listeMedias as $media)
				<div class="listeMedias">
					<div class="elementListe">
						@if($media->media_cover != NULL)
						<img src="{{$media->media_cover}}" class="imageMedia" />
						@else
						<img src="img/pas-d-image.jpg" class="imageMedia" />
						@endif
					</div>
					
					<div class="elementListe infos">
						@if($media->media_type == "Film")
							<a href="{{action('FilmsController@show', $media->media_id)}}">{{$media->media_title}}</a>
						@elseif($media->media_type == "Livre")
							<a href="{{action('LivresController@show', $media->media_id)}}">{{$media->media_title}}</a>
						@else
							<a href="{{action('MusiquesController@show', $media->media_id)}}">{{$media->media_title}}</a>
						@endif
						<br />
						<span>{{$media->media_year}}</span>
					</div>
				</div>
				@endforeach
			@elseif (count($listeArtistes) > 0)
				@foreach($listeArtistes as $artiste)
				<div class="listeMedias">
					<div class="elementListe">
						@if($artiste->human_pic != NULL)
						<img src="{{$artiste->human_pic}}" class="imageMedia" />
						@else
						<img src="img/pas-d-image.jpg" class="imageMedia" />
						@endif
					</div>
					
					<div class="elementListe infos">
						<a href="{{action('ArtistesController@show', $artiste->human_id)}}">{{$artiste->artist_nickname}}</a>
					</div>
				</div>
			@endforeach
		</div>
	@endif
</div>
@endsection