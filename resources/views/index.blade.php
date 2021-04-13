@extends('layouts.app')

@section('content')
<div class="container" id="mediasMisEnAvant">
	<h1 class="titresPage">Bienvenue sur Nestix !</h1>

	<div class="container card">
		<div class="card-header">
			<h2 class="sousTitres">Recommandations des utilisateurs</h2>
		</div>

		<div class="multiple-items card-body">
			@foreach($mediasRecommandes as $media)
			<!--<div>-->
				@if($media->media_type == "Film")
					<a href="{{action('FilmsController@show', $media->media_id)}}">
				@elseif($media->media_type == "Livre")
					<a href="{{action('LivresController@show', $media->media_id)}}">
				@else
					<a href="{{action('MusiquesController@show', $media->media_id)}}">
				@endif
				@if($media->media_cover != NULL)
				<img src="{{$media->media_cover}}" class="imageMedia" alt="Média recommandé" />
				@else
				<img src="img/pas-d-image.jpg" class="imageMedia" alt="Pas d'images" />
				@endif
				</a>
			<!--</div>-->
			@endforeach
		</div>
	</div>

	<div class="container card">
		<div class="card-header">
			<h2 class="sousTitres">Les musiques du moment</h2>
		</div>

		<div class="multiple-items card-body">
			@foreach($musiquesDuMoment as $musiqueDM)
			<a href="{{action('MusiquesController@show', $musiqueDM->media_id)}}">
			@if($musiqueDM->media_cover != NULL)
			<img src="{{$musiqueDM->media_cover}}" class="imageMedia" alt="Musique du moment" />
			@else
			<img src="img/pas-d-image.jpg" class="imageMedia" alt="Pas d'images" />
			@endif
			</a>
			@endforeach
		</div>
	</div>

	<div class="container card">
		<div class="card-header">
			<h2 class="sousTitres">Nos nouveautés</h2>
		</div>

		<div class="multiple-items card-body">
			@foreach($nouveautes as $nouveauMedia)
			@if($nouveauMedia->media_type == "Film")
				<a href="{{action('FilmsController@show', $nouveauMedia->media_id)}}">
			@elseif($nouveauMedia->media_type == "Livre")
				<a href="{{action('LivresController@show', $nouveauMedia->media_id)}}">
			@else
				<a href="{{action('MusiquesController@show', $nouveauMedia->media_id)}}">
			@endif
			@if($nouveauMedia->media_cover != NULL)
			<img src="{{$nouveauMedia->media_cover}}" class="imageMedia" alt="Nouveau média" />
			@else
			<img src="img/pas-d-image.jpg" class="imageMedia" alt="Pas d'images" />
			@endif
			</a>
			@endforeach
		</div>
	</div>
</div>
@endsection