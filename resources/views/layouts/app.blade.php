<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('slick/slick.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/styleNestix.css') }}" rel="stylesheet">
	
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm d-flex p-2 flex-column">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <img src="{{asset('img/logo.png')}}" id="logoHeader" alt="Logo nestix"  class="img-fluid" />
					  </li>
					  <li class="nav-item">
						<a class="nav-link active" style="color: white;" href="{{ url('/') }}">Accueil</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" style="color: white;" href="{{ route('films') }}">Les films</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" style="color: white;" href="{{ route('chansons') }}">Les musiques</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" style="color: white;" href="{{ route('livres') }}">Les livres</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" style="color: white;" href="{{ route('historique') }}">Historique</a>
					  </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" style="color: white;" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" style="color: white;" href="{{ route('register') }}">{{ __('S\'enregistrer') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" style="color: white;" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->user_pseudo }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" style="color: white;" href="{{route('home')}}">Mon profil</a>
									<a class="dropdown-item" style="color: white;" href="{{route('collections')}}">Mes collections</a>
									<a class="dropdown-item" style="color: white;" href="{{route('lecteur')}}" target="_blank">Lecteur audio</a>
									<a class="dropdown-item" style="color: white;" href="{{route('propositions')}}">Proposer un média</a>
								
                                    <a class="dropdown-item" style="color: white;" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Se déconnecter') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
								
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
			
			<div>
				<form action="{{ route('recherche') }}" method="POST" class="form-inline">
					@csrf
					<label for="objetRecherche">Rechercher </label>
					<select name="objetRecherche" id="objetRecherche" class="form-control search">
						<option value="mediaByTitle">Un média par titre</option>
						<option value="mediaByGenre">Un média par genre</option>
						<option value="artist">Un artiste</option>
					</select>
					<input type="text" name="elementRecherche" id="elementRecherche" class="form-control search" value="{{$_SESSION['derniereRecherche'] ?? ''}}"/>
					<button type="submit" class="btn btn-primary form-control">Rechercher</button>
				</form>
			</div>
        </nav>
		
        <main class="py-4">
            @yield('content')
        </main>

        <footer>
            <div class="text-center">
                <img src="{{asset('img/logo.png')}}" id="logo" alt="Logo nestix"  class="img-fluid" />
                <p>Nestix ©2020 Tous droits réservés</p>
            </div>
        </footer>
    </div>

    
    <!--
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('slick/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/carousel.js') }}"></script>
-->
</body>
</html>
