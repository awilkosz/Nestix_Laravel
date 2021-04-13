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
			<p><span class="caracteristiquesMedia">Visa : </span>{{$film->visa}}</p>
			<p><span class="caracteristiquesMedia">Durée : </span>{{$film->movie_runtime}} minutes</p>
			<p><span class="caracteristiquesMedia">Trailer : </span>{{$film->movie_trailer}}</p>
			<p><span class="caracteristiquesMedia">saga : </span>{{$film->movie_saga}}</p>
			<p><span class="caracteristiquesMedia">budget : </span>{{$film->movie_budget}}</p>
			
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
			<h2 class="sousTitres">synopsis</h2>
			<p>	{{$film->movie_synop}}</p>
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
				<h2 class="sousTitres">Acteurs</h2>
				<ul>
				@foreach($acteurs as $acteur)
					<li><a href="{{action('ArtistesController@show', $acteur->human_id)}}">{{$acteur->artist_nickname}}</a></li>
				@endforeach
				</ul>
			</div>

			<div>
				<h2 class="sousTitres">Réalisateurs</h2>
				<ul>
				@foreach($realisateurs as $realisateur)
					<li><a href="{{action('ArtistesController@show', $realisateur->human_id)}}">{{$realisateur->artist_nickname}}</a></li>
				@endforeach
				</ul>
			</div>

			<div>
				<h2 class="sousTitres">Scénaristes</h2>
				<ul>
				@foreach($scenaristes as $scenariste)
					<li><a href="{{action('ArtistesController@show', $scenariste->human_id)}}">{{$scenariste->artist_nickname}}</a></li>
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