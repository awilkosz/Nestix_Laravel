@extends('layouts.app')

@section('content')
<div class="container">
	<h1 class="titresPage">Historique</h1>
	
	<div>
		@foreach($visites as $key => $visite)
		<div class="listeMedias">
			<div class="elementListe">
				@if($mediasConsultes[$i]->media_cover != NULL)
				<img src="{{$mediasConsultes[$i]->media_cover}}" class="imageMedia" />
				@else
				<img src="img/pas-d-image.jpg" class="imageMedia" />
				@endif
			</div>

			<div class="elementListe infos">
			@if($mediasConsultes[$i]->media_type == "Film")
				<a href="{{action('FilmsController@show', $mediasConsultes[$i]->media_id)}}">{{$mediasConsultes[$i]->media_title}}</a>
				@elseif($mediasConsultes[$i]->media_type == "Livre")
				<a href="{{action('LivresController@show', $mediasConsultes[$i]->media_id)}}">{{$mediasConsultes[$i]->media_title}}</a>
				@else
				<a href="{{action('MusiquesController@show', $mediasConsultes[$i]->media_id)}}">{{$mediasConsultes[$i]->media_title}}</a>
				@endif
				<br />
				<span>{{$mediasConsultes[$i]->media_year}}</span>
				<span style="display: none;">{{$i++}}</span>
			</div>
		</div>
		@endforeach
	</div>
</div>
@endsection