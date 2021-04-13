var player = $('.player'),
    audio = player.find('audio'),
    duration = $('.duration'),
    currentTime = $('.current-time'),
    progressBar = document.querySelector(".progress span"),
    imageDisque = document.querySelector("#imgDisque"),
    mouseDown = false,
    showCurrentTime,
    musique = document.querySelector('#musique'),
    mp3 = document.querySelector('#mp3'),
    ogg = document.querySelector('#ogg'),
  	titre = $('#titre'),
	compositeur = $('#compositeur'),
    musiqueEnCours = 0,
    lesPistes = document.querySelectorAll('.track'),
    leBackground = document.querySelector("#leBackground"),
	laPlanete = document.querySelector("#planete");
	
	var p1 = new Musique("Monika.png","ddlc-main-theme-80s-version-hq","DDLC main theme version 80s","Inconnu","venus"),
		p2 = new Musique("Hunter-X-hunter-Just-awake.jpg","pvjust-awake-english-verfear-and-loathing-in-las-vegas","Just awake","Fear and Loathing in Las vegas","neptune"),
		p3 = new Musique("A-L'aventure-Compagnon.jpg","A L'aventure Compagnon - Donjon de Naheulbeuk","A l'aventure compagnon","Inconnu","mercure"),
		p4 = new Musique("Classic-loudness-clarity-Joakim-Karud.jfif","classic-loudness-clarity-ep-by-joakim-karud-official","Classic","Joakim Karud","terre"),
		p5 = new Musique("la-marmelade.jpg","La marmelade de ma grand mére + Paroles","La marmelade de ma grand-mère","Florent Caubien","io"),
		p6 = new Musique("joly-rene-sp-star-wars.jpg","La Guerre des Etoiles en français dans le texte !","La guerre des étoiles","René Joly","planeteMysterieuse"),
		tableauPistes = [p1,p2,p3,p4,p5,p6];
	
	//duration.text(secsToMins(audio[0].duration));	
    console.log(audio[0]);
  
	//Change de musique
	for(var i=0; i<lesPistes.length;i++)
	{
		console.log(lesPistes[i])
		console.log(lesPistes[i].className.split(' ')[1]);
		
		//On lie un événement à chaque musique
		lesPistes[i].onclick = function()
		{
			musiqueEnCours = parseInt(this.className.split(' ')[1]) - 1; //L'élément contient deux classes, on récupère seulement le numéro qui sert d'identifiant à la musique
			changementMusique(musiqueEnCours);
		};
	}

function Musique(lienImage, lienMusique, leTitre, compo, lienP)
{
	this.lienI = lienImage;
	this.lienM = lienMusique;
	this.titre = leTitre;
	this.compositeur = compo;
	this.planete = lienP;
}

function secsToMins(time) {
  var int = Math.floor(time),
      mins = Math.floor(int / 60),
      secs = int % 60,
      newTime = mins + ':' + ('0' + secs).slice(-2);
  
  return newTime;
}

function getCurrentTime() {
  var currentTimeFormatted = secsToMins(audio[0].currentTime),
      currentTimePercentage = audio[0].currentTime / audio[0].duration * 100;
  
  currentTime.text(currentTimeFormatted);
  progressBar.style.width = currentTimePercentage + '%';
  
  if (player.hasClass('playing')) {
    showCurrentTime = requestAnimationFrame(getCurrentTime);
  } else {
    cancelAnimationFrame(showCurrentTime);
  }
}

audio.on('loadedmetadata', function() {
  var durationFormatted = secsToMins(audio[0].duration);
  duration.text(durationFormatted);
}).on('ended', function() {
  if ($('.repeat').hasClass('active')) {
    audio[0].currentTime = 0;
    audio[0].play();
  } else {
	//changementMusique(musiqueEnCours++);
    /*player.removeClass('playing').addClass('paused');
	leBackground.style.animationPlayState = "paused"*/
	if (musiqueEnCours === tableauPistes.length - 1)
        musiqueEnCours = 0;
    else
        musiqueEnCours++;
    changementMusique(musiqueEnCours);
    audio[0].currentTime = 0;
  }
});

$('button').on('click', function() {
  var self = $(this);
  
  //Gestion Play / Pause
  if (self.hasClass('play-pause') && player.hasClass('paused')) 
  {
    player.removeClass('paused').addClass('playing');
    audio[0].play();
    getCurrentTime();
    leBackground.style.animationPlayState = "running";
	laPlanete.style.animationPlayState = "running";
  } 
  else if (self.hasClass('play-pause') && player.hasClass('playing')) 
  {
    player.removeClass('playing').addClass('paused');
    audio[0].pause();
    leBackground.style.animationPlayState = "paused";
	laPlanete.style.animationPlayState = "paused";
  }
  
  //Reset la musique
  if (self.hasClass('repeat')) {
    audio[0].currentTime = 0;
    if(player.hasClass('playing'))
      audio[0].play();
    currentTime.text("0:00");
	progressBar.style.width = '0%';
	}

  //Piste suivante
  if (self.hasClass('suivant')) { 
      if (musiqueEnCours === tableauPistes.length - 1)
        musiqueEnCours = 0;
      else
        musiqueEnCours++;
      changementMusique(musiqueEnCours);
  } //Piste précédente
  else if (self.hasClass('precedent')) { 
    if (musiqueEnCours === 0)
      musiqueEnCours = tableauPistes.length - 1;
    else
      musiqueEnCours--
      changementMusique(musiqueEnCours);
}
});

player.on('mousedown mouseup', function() {
  mouseDown = !mouseDown;
});

//Barre de progression
progressBar.parentElement.addEventListener('click', eventProgression);
progressBar.parentElement.addEventListener('mousemove', eventProgression);

function eventProgression(e)
{
	var self = $(this),
      totalWidth = self.width(),
      offsetX = e.offsetX,
      offsetPercentage = offsetX / totalWidth;
  
  if (mouseDown || e.type === 'click') {
    audio[0].currentTime = audio[0].duration * offsetPercentage;
    if (player.hasClass('paused')) {
	  progressBar.style.width = offsetPercentage * 100 + '%';
    }
  }
}

//Gestion du volume
function volume(vol) {
  console.log(vol);
    musique.volume = vol;	
  changerCouleurVolume(vol)
}

//Change la couleur des barres du gestionnaire de volume
function changerCouleurVolume(vol)
{
  var flag = true;
  var lesVols = [0,0.3,0.5,0.7,1];

  for(var i=0; i<lesVols.length;i++)
  {
    var styleCouleur = $(".volume a:nth-child(" + (i+1) + ")");
    if(flag == true)
      styleCouleur.css("border-left","5px solid rgb(133, 127, 127)");
    else
      styleCouleur.css("border-left","5px solid #ccc");
    if(lesVols[i] == vol)
      flag = false;
  }

  
}

//Actions effectuées à chaque changement de piste
function changementMusique(mus)
{
  mp3.src = 'musiques/mp3/' + tableauPistes[mus].lienM + '.mp3';
  ogg.src = 'musiques/ogg/' + tableauPistes[mus].lienM + '.ogg';
  audio[0].load();
  imageDisque.src = 'img/imagesPlayerAudio/' + tableauPistes[mus].lienI;
  titre.text(tableauPistes[mus].titre);
  compositeur.text(tableauPistes[mus].compositeur);
  laPlanete.src = 'img/imagesPlayerAudio/planetes/' + tableauPistes[mus].planete + '.png';
  if(player.hasClass('playing'))
      audio[0].play();
  currentTime.text("0:00");
  progressBar.style.width = '0%';
}


/*document.querySelector("#Div1").addEventListener("click", function(){alert("div1");}); 
document.querySelector("#Div2").addEventListener("click", function(){alert("div2");event.preventDefault();});*/