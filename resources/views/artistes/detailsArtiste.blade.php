@extends('layouts.app')

@section('content')
<div class="container contenuShow">

	<div class="titreMedia">
		<h1 class="titresPage">{{$artiste->artist_nickname}}</h1>
	</div>

	<div class="infosMedia">
		<div class="infosGauche">
		@if($humain->human_pic != NULL)
			<img src="../{{$humain->human_pic}}" class="imgDetails"/>
			@else
			<img src="../img/pas-d-image.jpg" class="imgDetails" />
			@endif
			<p><span class="caracteristiquesMedia">Nom : </span>{{$humain->human_lastname}}</p>
			<p><span class="caracteristiquesMedia">Prénom : </span>{{$humain->human_firstname}}</p>
			<p><span class="caracteristiquesMedia">Sexe : </span>{{$humain->human_sex}}</p>
			<p><span class="caracteristiquesMedia">Date de naissance : </span>{{date('d/m/Y', strtotime($humain->human_dob))}}</p>
			

			<p><span class="caracteristiquesMedia">Surnom : </span>{{$artiste->artist_nickname}}</p>
			<p><span class="caracteristiquesMedia">Date de décès : </span>{{$artiste->human_dod}}</p>
		</div>

		<div class="infosDroite">
			<h2 class="sousTitres">Médias réalisés</h2>
			<ul>
			@foreach($medias as $media)
				@if($media->media_type == "Film")
					<li><a href="{{action('FilmsController@show', $media->media_id)}}">{{$media->media_title}}</a></li>
				@elseif($media->media_type == "Livre")
					<li><a href="{{action('LivresController@show', $media->media_id)}}">{{$media->media_title}}</a></li>
				@else
					<li><a href="{{action('MusiquesController@show', $media->media_id)}}">{{$media->media_title}}</a></li>
				@endif
			@endforeach
			</ul>
		</div>
	</div>
</div>

@endsection