@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mon profil</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Pseudo: {{$user->user_pseudo}}</p>
                    <p>Adresse E-Mail: {{$user->email}}</p>
                    
                    @if($user->user_status == "Autorisé")
                    <p>Aucune sanction pour le moment</p>
                    @else
                    <p>Votre compte a été bloqué par un administrateur</p>
                    @endif

                    <a href="{{route('collections')}}">Accéder à mes collections</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
