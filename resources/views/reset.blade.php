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
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/styleNestix.css') }}" rel="stylesheet">
        
    </head>
    <body class="py-4">
        <main>
            <div class="container card">
                <div class="card-header">
                    <h1>Votre mot de passe doit être changé</h1>
                </div>

                <div class="card-body">
                    <form action="{{ route('resetPassword') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="newPassword">Saisissez votre nouveau mot de passe :
                                <input type="password" name="newPassword" id="newPassword" class="form-control" required />
                            </label>

                            <br />

                            <label for="passwordConfirm">Confirmez votre nouveau mot de passe :
                                <input type="password" name="passwordConfirm" id="passwordConfirm" class="form-control" required />
                            </label>

                            <br />

                            @if($erreur1 != "")
                                <p class="error">{{$erreur1}}</p>
                            @endif

                            @if($erreur2 != "")
                                <p class="error">{{$erreur2}}</p>
                            @endif

                            <br />

                            <input type="submit" value="Valider" class="btn btn-primary" />
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <footer>
            <div class="text-center">
                <img src="{{asset('img/logo.png')}}" id="logo" alt="Logo nestix"  class="img-fluid" />
                <p>Nestix ©2020 Tous droits réservés</p>
            </div>
        </footer>

    </body>
</html>