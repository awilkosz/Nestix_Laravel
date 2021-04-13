@extends('layouts.app')

@section('content')
<div class="container" id="collections">
	
		<div class="container card">
			<div class="card-header">
				<h2>Mes collections</h2>
			</div>
			<ul class="card-body" id="listeCollections">
			@foreach($mesCollections as $uneCollection)
				<li>
					<a href="{{action('CollectionsController@show', $uneCollection->collect_id)}}">{{$uneCollection->collect_title}}</a>
					<form action="{{route('collections.destroy',[$uneCollection->collect_id])}}" method="POST" class="supprimerCollection">
						@method('DELETE')
						@csrf
						<button type="submit" class="btn btn-danger">Supprimer</button>               
					</form>
				</li>
			@endforeach
			</ul>
		</div>

		<div class="container card">
			<form action="{{ route('ajouterCollection') }}" method="POST">
				@csrf
				<div class="card-header">
					<h2>Créer une nouvelle collection</h2>
				</div>

				<div class="card-body">
					<label for="nomCollection">Nom de la collection :</label>
					<input type="text" id="nomCollection" name="nomCollection" />
					<button type="submit" class="btn btn-primary">Valider</button>
				</div>
			</form>
		</div>
	

	<div class="container card">
		<div class="card-header">
			<h2>Mes avis</h2>
		</div>

		
		<table class="mediaNotes card-body">
			<thead>
				<tr>
					<th>Image</th>
					<th>Titre</th>
					<th>Avis</th>
					<th>Note</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				@foreach($mesMedias as $unMedia)
						<td>
							@if($unMedia->media_cover != NULL)
							<img src="{{$unMedia->media_cover}}" class="imageMedia" />
							@else
							<img src="img/pas-d-image.jpg" class="imageMedia" />
							@endif
						</td>
					@if($unMedia->media_type == "Film")
						<td><h5><a href="{{action('FilmsController@show', $unMedia->media_id)}}">{{$unMedia->media_title}}</a></h5></td>
					@elseif($unMedia->media_type == "Livre")
						<td><h5><a href="{{action('LivresController@show', $unMedia->media_id)}}">{{$unMedia->media_title}}</a></h5></td>
					@else
						<td><h5><a href="{{action('MusiquesController@show', $unMedia->media_id)}}">{{$unMedia->media_title}}</a></h5></td>
					@endif
					<td>{{$unMedia->appr_com}}</td>
					<td>{{$unMedia->appr_note}}/5</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection