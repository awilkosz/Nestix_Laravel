<!doctype HTML>
<html lang="fr">
	<head>
		<title>Lecteur audio</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" href="css/style.css" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/style2.css" />
	</head>
	
	<body style="background-color: #333; background-image: url('img/imagesPlayerAudio/DeepSpace2.gif');" id="leBackground" class="stopper"> <!-- background-image: url('img/imagesPlayerAudio/DeepSpace2.gif'); -->
	<img src="img/imagesPlayerAudio/planetes/venus.png" alt="planete" id="planete"/>
		<div class="player paused">
			<div class="album">
				<div class="cover">
					<div><img src="https://image.noelshack.com/fichiers/2018/30/5/1532681786-spirouedz.png" alt="cd" id="imgDisque"/></div>
				</div>
			</div>
		  
		  <div class="info">
			<div class="time">
			  <span class="current-time">0:00</span>
			  <span class="progress"><span></span></span>
			  <span class="duration">2:04</span>
			</div>
			
			<h1 id="titre">DDLC main theme version 80s</h1>
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
			  <div class="arrow"></div>
			  <div class="arrow"></div>
			</button>
			<button class="button play-pause">
			  <div class="arrow"></div>
			</button>
			<button class="button suivant">
			  <div class="arrow"></div>
			  <div class="arrow"></div>
			</button>
			<button class="repeat"></button>
			
			<!--<div id="Div1">
				<a id="Div2" href="https://needemand.com">cliquer</a>
			</div>-->
		  </div>
			
		  <audio preload id="musique">
				<source src="musiques/mp3/ddlc-main-theme-80s-version-hq.mp3" id="mp3">
				<source src="musiques/ogg/ddlc-main-theme-80s-version-hq.ogg" id="ogg">
		  </audio>
		</div>

		 <div id="myCarousel" class="carousel slide" data-ride="carousel" ><!-- style="background-color: #333;border-radius:0.25em; "-->

		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">
			<div class="item active">
			  <span class="lesPistes"><figure class="track 1">
							<img class="miniature" src="img/imagesPlayerAudio/Monika.png" alt="" />
							<figcaption style="visibility: hidden;">DDLC main theme 80s version</figcaption>
						</figure>
			

			
			  <figure class="track 2">
							<img class="miniature" src="img/imagesPlayerAudio/Hunter-X-hunter-Just-awake.jpg" alt="" />
							<figcaption style="visibility: hidden;">Just Awake - Fear and Loathing in Las Vegas</figcaption>
						</figure>
			

			
			  <figure class="track 3">
							<img class="miniature" src="img/imagesPlayerAudio/A-L'aventure-Compagnon.jpg" alt="" />
							<figcaption style="visibility: hidden;">A l'aventure compagnon</figcaption>
						</figure>
						
			</span></div>
			<div class="item">
			<span class="lesPistes">
						  <figure class="track 4">
							<img class="miniature" src="img/imagesPlayerAudio/Classic-loudness-clarity-Joakim-Karud.jfif" alt="" />
							<figcaption style="visibility: hidden;">Classic Joakim Karud</figcaption>
						</figure>
						<figure class="track 5">
							<img class="miniature" src="img/imagesPlayerAudio/la-marmelade.jpg" alt="" />
							<figcaption style="visibility: hidden;">La marmelade de ma grand-mère - Florent Caubien</figcaption>
						</figure>
						<figure class="track 6">
							<img class="miniature" src="img/imagesPlayerAudio/joly-rene-sp-star-wars.jpg" alt="" />
							<figcaption style="visibility: hidden;">La guerre des étoiles - René Joly</figcaption>
						</figure>
					</span>
			</div>
		  </div>

		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span>
		  </a>
		</div>
  
		<script src="js/jquery-3.4.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/lecteur.js"></script>
	</body>
</html>