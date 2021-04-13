<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Media;
use App\Film;
use App\Musique;
use App\Livre;
use App\Artiste;
use App\Status;

class MediasController extends Controller
{
    public function index() 
	{ 
		$mediasRecommandes = DB::table('media')->select(DB::raw('AVG(appr_note) as note'),'media.*')->join('appreciation', 'appreciation.'.'media_id', '=', 'media.'.'media_id')->groupby('appreciation.media_id')->orderby('note','DESC')->take(10)->get();
		$musiquesDuMoment = DB::table('media')->join('song', 'song.'.'song_id', '=', 'media.'.'media_id')->where('song_moment', '=', 1)->get();
		$nouveautes = DB::table('media')->join('status', 'status.'.'media_id', '=', 'media.'.'media_id') ->where('asv_id', '=', '1')->orderby('media.media_id', 'DESC')->take(10)->get();
		
		return view('index')->with(['mediasRecommandes' => $mediasRecommandes, 'musiquesDuMoment' => $musiquesDuMoment, 'nouveautes' => $nouveautes]);
    }
	
	public function show($id)
	{
		//
	}
	
	public function recherche()
	{
		session_start();
		
		$critere = request('objetRecherche');
		$entreeUtilisateur = request('elementRecherche');
		
		$_SESSION["derniereRecherche"] = $entreeUtilisateur;
		
		$listeMedias = array();
		$listeArtistes = array();
		
		if($critere == "mediaByTitle" && !empty($entreeUtilisateur))
		{
			$listeMedias = Media::where('media_title', 'LIKE', '%' . $entreeUtilisateur . '%')->get();
		}
		else if($critere == "mediaByGenre" && !empty($entreeUtilisateur))
		{
			$listeMedias = DB::table('media')->join('categorized_by', 'categorized_by.media_id', '=', 'media.media_id')->join('genre', 'genre.genre_id', '=', 'categorized_by.genre_id')->where('genre.genre_name', '=', $entreeUtilisateur)->get();
		}
		else if ($critere == "artist" && !empty($entreeUtilisateur))
		{
			$listeArtistes = DB::table('artist')->join('human', 'human.human_id', '=', 'artist.human_id')->where('artist_nickname', 'LIKE', '%' . $entreeUtilisateur . '%')->get();
		}
		
		$id = auth()->id();
		
		if(count($listeMedias) > 0 || count($listeArtistes) > 0)
			return view('recherche')->with(['listeMedias'=> $listeMedias, 'listeArtistes'=> $listeArtistes]);
		else
		{
			if($id != NULL)
			{
				$error = false;
				return view('propositions')->with(['error' => $error]);
			}
			else
				return view('recherche')->with(['listeMedias'=> $listeMedias, 'listeArtistes'=> $listeArtistes]);
		}
	}

	public function afficheFormulairePropositions() 
	{ 
		$error = false;
		return view('propositions')->with(['error' => $error]);
	}
	
	public function proposerMedia()
	{
		session_start();

		$type = request('type');
		$titre = request('title'); 
		$annee = request('year');
		$lien = request('link');

		$contains = Media::where('media_title', '=', $titre)->where('media_year', '=', $annee)->where('media_type', '=', $type)->get();
		$error = true;
		
		//On insère dans la BDD si le couple idMedia - idCollection n'existe pas
		if(count($contains) == 0)
		{
			$media = Media::create(['media_title' => $titre, 'media_type' => $type, 'media_year' => $annee, 'media_link' => $lien]);

			$idMedia = $media->media_id;
			$idUser = $_SESSION["userId"];

			$status = Status::create(['media_id' => $idMedia, 'asv_id' => 2, 'asv_date_creat' => date('Y-m-d'), 'user_id' => $idUser]);
			$error = false;
		}
		
		return view('propositions')->with(['error' => $error]);;
	}
	
	public function afficherLecteur()
	{
		//return view('lecteurAudio.index');
		$musiquesDuMoment = DB::table('media')->join('song', 'song.'.'song_id', '=', 'media.'.'media_id')->where('song_moment', '=', 1)->get();
		$idM = 0;
		return view('lecteurAudio2.index')->with(['musiquesDuMoment' => $musiquesDuMoment, 'idM' => $idM]);
	}
	
	public function afficherHistorique()
	{
		session_start();
		
		$mediasConsultes = array();
		
		if(isset($_SESSION['visites']) && !empty($_SESSION['visites']))
		{
			$visites = $_SESSION['visites'];
		}
		else
		{
			$visites = array();
		}
		/*
		foreach($_SESSION['visites'] as $v)
		{
			var_dump($v);
			echo "<br />";
		}*/

		arsort($visites);
		//var_dump($visites);
		$visites = array_slice($visites, 0, 3 , true);
		
		foreach($visites as $key => $visite)
		{
			//var_dump($visite);
			$media = Media::findOrFail($key);
			$mediasConsultes[] = $media;
		}
		$i = 0;
		
		return view('historique')->with(['visites'=> $visites, 'i' => $i, 'mediasConsultes' => $mediasConsultes]);
	}

	
}
