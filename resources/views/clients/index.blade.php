@extends('layouts.app')

@section('content')
<h1>clients</h1>

<ul>
	<!-- Affichage des clients avec la Syntaxe blade -->
	@foreach($clients as $client)
	<li>{{$client}}</li>
	@endforeach
</ul>
<hr>
<form action="/clients" method="POST">
	@csrf
	<div class="form-group">
		<input type="text" class="form-control" name="pseudo">
	</div>
	<button type="submit" class="btn btn-primary">Ajouter le client</button>
</form>
@endsection