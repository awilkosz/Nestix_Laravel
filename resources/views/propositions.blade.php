@extends('layouts.app')

@section('content')
<div class="container">
	<h1 class="titresPage">Soumettre une proposition</h1>
	<form action="{{ route('proposer') }}" method="POST">
		@csrf
		<div class="form-group">
			<p>Choisissez un type : </p>
			<label for="film">Film</label>
			<input type="radio" name="type" id="film" value="Film" required />
			<label for="chanson">Musique</label>
			<input type="radio" name="type" id="chanson" value="Chanson" />
			<label for="livre">Livre</label>
			<input type="radio" name="type" id="livre" value="Livre" />
			
			<br />
			<label for="titre">Titre *:</label>
			<input type="text" id="title" name="title" class="form-control" placeholder="Titre" required /> 
			
			<br />
			<label for="year">Année *:</label>
			<input type="number" id="year" name="year" min="1000" max="2020" class="form-control" placeholder="Année" required /> 
			
			<br />
			<label for="link">Insérer un lien:</label>
			<input type="url" id="link" name="link" class="form-control" placeholder="Lien"> 
			
			<br />
			<button type="submit" class="btn btn-primary">Valider</button>
			
			@if($error)
				<p class="alert alert-warning">Ce média a déjà été proposé</p>
			@endif
		</div>
	</form>
</div>
@endsection