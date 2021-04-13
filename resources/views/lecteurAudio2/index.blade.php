<!doctype HTML>
<html lang="fr">
	<head>
		<title>Lecteur audio</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style2.css" />
	</head>

    <body style="background-color: #333; background-image: url('img/imagesPlayerAudio/DeepSpace2.gif');" id="leBackground">
        <img src="img/imagesPlayerAudio/planetes/venus.png" alt="planete" id="planete"/>

        <div class="player paused">
            <div class="album">
                <div class="cover">
                    @if($musiquesDuMoment[0]->media_cover == NULL)
                    <div><img src="img/pas-d-image.jpg" alt="cd" id="imgDisque"/></div>
                    @else
                    <div><img src="{{$musiquesDuMoment[0]->media_cover}}" alt="cd" id="imgDisque"/></div>
                    @endif
                </div>
            </div>
                
            <div class="info">
                <div class="time">
                <span class="current-time">0:00</span>
                <span class="progress"><span></span></span>
                <span class="duration">2:04</span>
                </div>
                
                <h1 id="titre">{{$musiquesDuMoment[0]->media_title}}</h1>
                <h2 id="compositeur">Inconnu</h2>
            </div>
            
            <div class="actions">
                <span class="volume">
                    <a class="stick1" onclick="volume(0)"></a>
                    <a class="stick2" onclick="volume(0.3)"></a>
                    <a class="stick3" onclick="volume(0.5)"></a>
                    <a class="stick4" onclick="volume(0.7)"></a>
                    <a class="stick5" onclick="volume(1)"></a>
                </span>
                
                <button class="button precedent">
                <span class="arrow"></span>
                <span class="arrow"></span>
                </button>
                <button class="button play-pause">
                <span class="arrow"></span>
                </button>
                <button class="button suivant">
                <span class="arrow"></span>
                <span class="arrow"></span>
                </button>
                <button class="repeat"></button>
                
            </div>

            <audio preload id="musique">
                <source src="musiques/mp3/{{$musiquesDuMoment[0]->song_path}}.mp3" id="mp3">
                <source src="musiques/ogg/{{$musiquesDuMoment[0]->song_path}}.ogg" id="ogg">
            </audio>
        </div>

        <div>
            <div class="lesPistes">
            @foreach($musiquesDuMoment as $musiqueDM)
            <figure class="track {{$idM}}">
                @if($musiqueDM->media_cover != NULL)
                <img src="{{$musiqueDM->media_cover}}" class="miniature" />
                @else
                <img src="img/pas-d-image.jpg" class="miniature" />
                @endif
                <figcaption style="visibility: hidden;">{{$musiqueDM->media_title}}</figcaption>
            </figure>
            <p style="visibility: hidden;">{{$idM++}}</p>
            @endforeach
            </div>
        </div>

        <div id="listePlanetes" style="display:none;">
            <span class="lesPlanetes">venus</span>
            <span class="lesPlanetes">terre</span>
            <span class="lesPlanetes">planeteMysterieuse</span>
            <span class="lesPlanetes">neptune</span>
            <span class="lesPlanetes">mercure</span>
            <span class="lesPlanetes">io</span>
            <span class="lesPlanetes">saturne</span>
            <span class="lesPlanetes">uranus</span>
            <span class="lesPlanetes">volcanic</span>
            <span class="lesPlanetes">randell</span>
        </div>

        <div style="display:none;">
            @foreach($musiquesDuMoment as $musiqueDM)
            <span class="nomDesPistes">{{$musiqueDM->media_title}}</span>
            <span class="cheminDesPistes">{{$musiqueDM->song_path}}</span>
            @if($musiqueDM->media_cover != NULL)
            <span class="imageDesPistes">{{$musiqueDM->media_cover}}</span>
            @else
            <span class="imageDesPistes">pas-d-image.jpg</span>
            @endif
            @endforeach
        </div>

        <script src="js/jquery-3.4.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script src="js/lecteur2.js"></script>
    </body>
</html>