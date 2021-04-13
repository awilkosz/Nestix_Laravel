var player = $('.player'),
    audio = player.find('audio'),
    currentTime = $('.current-time'),
    showCurrentTime,
    duration = $('.duration'),
    imageDisque = document.querySelector("#imgDisque"),
    progressBar = document.querySelector(".progress span"),
    lesPistes = document.querySelectorAll('.track'),
    leBackground = document.querySelector("#leBackground"),
    laPlanete = document.querySelector("#planete"),
    lesPlanete = document.querySelectorAll(".lesPlanetes"),
    nomDesPistes = document.querySelectorAll(".nomDesPistes"),
    cheminDesPistes = document.querySelectorAll(".cheminDesPistes"),
    imageDesPistes = document.querySelectorAll(".imageDesPistes"),
    mp3 = document.querySelector('#mp3'),
    ogg = document.querySelector('#ogg'),
    titre = $('#titre'),
    tableauPistes = [],
    mouseDown = false,
    musiqueEnCours = 0;

  duration.text(secsToMins(audio[0].duration));

for (var i=0; i<nomDesPistes.length;i++)
{
    //console.log(nomDesPistes[i].innerHTML);
    var mus = new Musique(imageDesPistes[i].innerHTML, cheminDesPistes[i].innerHTML, nomDesPistes[i].innerHTML, lesPlanete[i].innerHTML);
    tableauPistes[i] = mus;
}

for (var i=0; i<lesPistes.length;i++)
{
    console.log(lesPistes[i]);
    console.log(lesPistes[i].className.split(' ')[1]);
		
    //On lie un événement à chaque musique
    lesPistes[i].onclick = function()
    {
        musiqueEnCours = parseInt(this.className.split(' ')[1]); //L'élément contient deux classes, on récupère seulement le numéro qui sert d'identifiant à la musique
        changementMusique(musiqueEnCours);
    };
}

function Musique(lienImage, lienMusique, leTitre, lienP)
{
	this.lienI = lienImage;
	this.lienM = lienMusique;
	this.titre = leTitre;
	this.planete = lienP;
}

function secsToMins(time) 
{
    var int = Math.floor(time),
        mins = Math.floor(int / 60),
        secs = int % 60,
        newTime = mins + ':' + ('0' + secs).slice(-2);
    
    return newTime;
}

function getCurrentTime() 
{
    var currentTimeFormatted = secsToMins(audio[0].currentTime),
        currentTimePercentage = audio[0].currentTime / audio[0].duration * 100;
    
    currentTime.text(currentTimeFormatted);
    progressBar.style.width = currentTimePercentage + '%';
    
    if (player.hasClass('playing')) 
    {
      showCurrentTime = requestAnimationFrame(getCurrentTime);
    } 
    else 
    {
      cancelAnimationFrame(showCurrentTime);
    }
}

audio.on('loadedmetadata', function() 
{
  var durationFormatted = secsToMins(audio[0].duration);
  duration.text(durationFormatted);
}).on('ended', function() 
{
  if ($('.repeat').hasClass('active')) 
  {
    audio[0].currentTime = 0;
    audio[0].play();
  } 
  else 
  {
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

$('button').on('click', function() 
{
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
    if (self.hasClass('repeat')) 
    {
      audio[0].currentTime = 0;
      if(player.hasClass('playing'))
        audio[0].play();
      currentTime.text("0:00");
      progressBar.style.width = '0%';
    }
  
    //Piste suivante
    if (self.hasClass('suivant')) 
    { 
        if (musiqueEnCours === tableauPistes.length - 1)
          musiqueEnCours = 0;
        else
          musiqueEnCours++;
        changementMusique(musiqueEnCours);
    }

    //Piste précédente
    else if (self.hasClass('precedent')) 
    { 
      if (musiqueEnCours === 0)
        musiqueEnCours = tableauPistes.length - 1;
      else
        musiqueEnCours--
        changementMusique(musiqueEnCours);
    }
});

player.on('mousedown mouseup', function() 
{
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
function volume(vol) 
{
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
    console.log(mus);
    mp3.src = 'musiques/mp3/' + tableauPistes[mus].lienM + '.mp3';
    ogg.src = 'musiques/ogg/' + tableauPistes[mus].lienM + '.ogg';
    audio[0].load();

    if(tableauPistes[mus].lienI === "pas-d-image.jpg")
        imageDisque.src = 'img/' + tableauPistes[mus].lienI;
    else
        imageDisque.src = tableauPistes[mus].lienI;

    titre.text(tableauPistes[mus].titre);
    //compositeur.text(tableauPistes[mus].compositeur);
    laPlanete.src = 'img/imagesPlayerAudio/planetes/' + tableauPistes[mus].planete + '.png';
    if(player.hasClass('playing'))
        audio[0].play();
    currentTime.text("0:00");
    progressBar.style.width = '0%';
}