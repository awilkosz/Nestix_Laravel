<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use Illuminate\Support\Facades\DB;
use App\Contains;
use App\Media;
use App\Film;
use App\Musique;
use App\Livre;

class CollectionsController extends Controller
{
	public function index()
	{
		$id = auth()->id();
		$mesMedias = DB::table('media') ->join('appreciation','appreciation.'.'media_id', '=', 'media.'.'media_id') ->where('human_id', '=', $id) ->get();
		$mesCollections = DB::table('collection') ->where('human_id', '=', $id) ->get();
		$_SESSION['userId'] = $id;
		
        return view('collections.index')->with(['mesMedias'=> $mesMedias, 'mesCollections' => $mesCollections]);
	}
	
    public function store()
	{
		session_start();
		
		$titreCollection = request('nomCollection');
		$idUser = $_SESSION["userId"];
		
		$collection = Collection::create(['collect_date_creat' => date('Y-m-d'), 'collect_title' => $titreCollection, 'human_id' => $idUser]);
		$collection->save();
		
		$mesMedias = DB::table('media') ->join('appreciation','appreciation.'.'media_id', '=', 'media.'.'media_id') ->where('human_id', '=', $idUser) ->get();
		$mesCollections = DB::table('collection') ->where('human_id', '=', $idUser) ->get();
		
        return view('collections.index')->with(['mesMedias'=> $mesMedias, 'mesCollections' => $mesCollections]);
	}
	
	public function ajouterMediaDansCollection()
	{
		session_start(); //Restaure la session trouvée
		
		$idMedia = $_SESSION['mediaId']; //On récupère l'id du dernier média consulté avec la superglobale $_SESSION
		$idCollect = request('collect'); //On récupère l'id de la collection sélectionnée
		
		//On fait une requête pour voir si le idMedia - idCollection existe déjà dans la BDD
		$contains = Contains::where('media_id', '=', $idMedia)->where('collect_id', '=', $idCollect)->get();
		
		//Si la taille de contains vaut 0 alors on insère dans la BDD car le couple idMedia - idCollection n'existe pas
		if(count($contains) == 0)
		{
			$contains = Contains::create(['media_id' => $idMedia, 'collect_id' => $idCollect]); //Insertion des données dans la table Contains
			$contains->save(); //Sauvegarde
		}
		
		$media = Media::findOrFail($idMedia);
		
		if($media->media_type == "Film") //Si le média est un film, on fait une redirection sur la méthode show() de FilmsController
		{
			return redirect()->action('FilmsController@show', [$idMedia]);
		}
		else if($media->media_type == "Livre") //Si le média est un livre, on fait une redirection sur la méthode show() de LivresController
		{
			return redirect()->action('LivresController@show', [$idMedia]);
		}
		else //Sinon le média est une musique alors on fait une redirection sur la méthode show() de MusiquesController
		{
			return redirect()->action('MusiquesController@show', [$idMedia]);
		}
		
	}
	
	public function show($id)
	{
		session_start(); //Restaure ou créé une session
		
		$_SESSION["collect_id"] = $id; //On stocke l'id de la collection dans la variable $_SESSION
		$collection = Collection::findOrFail($id); //On récupère la collection sur la BDD avec son id
		//On récupère les médias contenus dans la collection
		$mesMedias = DB::table('media') ->join('contains','contains.'.'media_id', '=', 'media.'.'media_id') ->where('collect_id', '=', $id) ->get();
		
		//On retourne la vue correspondante avec la collection consultée et la liste des médias contenus dans la collection
		return view('collections.detailsCollection')->with(['collection'=> $collection, 'mesMedias'=> $mesMedias]);
	}
	
	public function destroy($id)
	{
		$collection = Collection::where('collect_id', '=', $id)->delete();
		
		$id = auth()->id();
		$mesMedias = DB::table('media') ->join('appreciation','appreciation.'.'media_id', '=', 'media.'.'media_id') ->where('human_id', '=', $id) ->get();
		$mesCollections = DB::table('collection') ->where('human_id', '=', $id) ->get();
		
        //return view('collections.index')->with(['mesMedias'=> $mesMedias, 'mesCollections' => $mesCollections]);
		return redirect()->action('CollectionsController@index');
	}
}
