@extends('layouts.app')

@section('content')
<div class="container contenuShow">

	<div class="titreMedia">
		<h1 class="titresPage">{{$media->media_title}}</h1>
	</div>

	<div class="infosMedia">
		<div class="infosGauche">
			@if($media->media_cover != NULL)
			<img src="../{{$media->media_cover}}" class="imgDetails"/>
			@else
			<img src="../img/pas-d-image.jpg" class="imgDetails" />
			@endif
			
			<p><span class="caracteristiquesMedia">Année sortie : </span>{{$media->media_year}}</p>
			<p><span class="caracteristiquesMedia">Lien : </span>{{$media->media_link}}</p>
			<p><span class="caracteristiquesMedia">Album : </span>{{$musique->song_album}}</p>
		
			<div>
				<h2 class="sousTitres">Genres</h2>
				<ul>
					@foreach($genres as $genre)
					<li>{{$genre->genre_name}}</li>
					@endforeach
				</ul>
			</div>
		</div>
		
		<div class="infosDroite">

			@auth
			
			@if(count($mesCollections) > 0)
			<div>
				<h2 class="sousTitres">Ajouter dans une collection</h2>
				<form action="{{ route('ajouterMediaDansCollection') }}" method="POST">
					@csrf
					<select name="collect" id="collect">
						@foreach($mesCollections as $uneCollection)
							<option value="{{$uneCollection->collect_id}}">{{$uneCollection->collect_title}}</option>
						@endforeach
					</select>
					<button type="submit" class="btn btn-primary">Valider</button>
				</form>
			</div>
			@endif
			@endif

			<div>
				<h2 class="sousTitres">Interprètes</h2>
				<ul>
				@foreach($interpretes as $interprete)
					<li><a href="{{action('ArtistesController@show', $interprete->human_id)}}">{{$interprete->artist_nickname}}</a></li>
				@endforeach
				</ul>
			</div>

			@auth
			<hr>
			<div>
				<form action="{{ route('appreciationsMedia') }}" method="POST">
				@csrf
					<div class="form-group">
						<div class="elementFormulaire">
							<label for="note">Noter le média :</label>
							<select name="note" id="note">
								<option value="1">1</option>
								<option value="2">2</option>
								<option value="3">3</option>
								<option value="4">4</option>
								<option value="5">5</option>
							</select>
							<span> / 5</span>
						</div>
						
						<textarea name="commentaire" class="elementFormulaire" rows="8" cols="75"></textarea>
						
						<br
						/>
						
						@if($status == "Autorisé")
							<button type="submit" class="btn btn-primary">Envoyer</button>
						@else
							<p>Vous n'avez pas le droit de publier votre avis !</p>
						@endif
					</div>
				</form>
			</div>
			@endif
		</div>
	</div>
</div>
@endsection