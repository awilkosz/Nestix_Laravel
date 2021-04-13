<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appreciation;
use App\Media;
use App\Film;
use App\Musique;
use App\Livre;
use App\Artiste;
use App\Collection;

use Illuminate\Support\Facades\DB;

class AppreciationsController extends Controller
{
	public function storeMedia()
	{
		session_start();
		
		$note = request('note'); //On récupère la note
		$commentaire = request('commentaire'); //On récupère le commentaire
		$idUser = $_SESSION['userId']; //On récupère le nom d'utilisateur dans la variable $_SESSION
		$idMedia = $_SESSION['mediaId']; //L'id du dernier média consulté est dans la variable $_SESSION
		
		//On regarde si l'utilisateur a déjà posté une appréciation pour le média
		$appreciation = Appreciation::where('media_id', '=', $idMedia)->where('human_id', '=', $idUser)->get();
		
		//On insère dans la BDD si le couple idMedia - idUser n'existe pas sinon on met l'appreciation à jour
		if(count($appreciation) == 0)
		{
			$appreciation = Appreciation::create(['appr_note' => $note, 'appr_com' => $commentaire, 'appr_date' => date('Y-m-d'), 'human_id' => $idUser, 'media_id' => $idMedia]);
			$appreciation->save();
		}
		else
		{
			$apprId = $appreciation[0]->appr_id;
			$appreciation = Appreciation::find($apprId);
			$appreciation->appr_note = $note;
			$appreciation->appr_com = $commentaire;
			$appreciation->save();
		}
		
		$media = Media::findOrFail($idMedia); //On récupère le média avec son id
		
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
	
    public function storeFilm()
	{
		session_start();
		
		$note = request('note');
		$commentaire = request('commentaire');
		$idUser = $_SESSION['userId'];
		$idMedia = $_SESSION['mediaId'];
		
		
		$appreciation = Appreciation::where('media_id', '=', $idMedia)->where('human_id', '=', $idUser)->get();
		
		//On insère dans la BDD si le couple idMedia - idUser n'existe pas sinon on met l'appreciation à jour
		if(count($appreciation) == 0)
		{
			$appreciation = Appreciation::create(['appr_note' => $note, 'appr_com' => $commentaire, 'appr_date' => date('Y-m-d'), 'human_id' => $idUser, 'media_id' => $idMedia]);
			$appreciation->save();
		}
		else
		{
			$apprId = $appreciation[0]->appr_id;
			$appreciation = Appreciation::find($apprId);
			$appreciation->appr_note = $note;
			$appreciation->appr_com = $commentaire;
			$appreciation->save();
		}
		
		return redirect()->action('FilmsController@show', [$idMedia]);
	}
	
	public function storeLivre()
	{
		session_start();
		
		$note = request('note');
		$commentaire = request('commentaire');
		$idUser = $_SESSION['userId'];
		$idMedia = $_SESSION['mediaId'];
		
		$appreciation = Appreciation::where('media_id', '=', $idMedia)->where('human_id', '=', $idUser)->get();
		
		//On insère dans la BDD si le couple idMedia - idUser n'existe pas sinon on met l'appreciation à jour
		if(count($appreciation) == 0)
		{
			$appreciation = Appreciation::create(['appr_note' => $note, 'appr_com' => $commentaire, 'appr_date' => date('Y-m-d'), 'human_id' => $idUser, 'media_id' => $idMedia]);
			$appreciation->save();
		}
		else
		{
			$apprId = $appreciation[0]->appr_id;
			$appreciation = Appreciation::find($apprId);
			$appreciation->appr_note = $note;
			$appreciation->appr_com = $commentaire;
			$appreciation->save();
		}
		
		return redirect()->action('LivresController@show', [$idMedia]);
		
	}
	
	public function storeMusique()
	{
		session_start();
		
		$note = request('note');
		$commentaire = request('commentaire');
		$idUser = $_SESSION['userId'];
		$idMedia = $_SESSION['mediaId'];
		
		$appreciation = Appreciation::where('media_id', '=', $idMedia)->where('human_id', '=', $idUser)->get();
		
		//On insère dans la BDD si le couple idMedia - idUser n'existe pas sinon on met l'appreciation à jour
		if(count($appreciation) == 0)
		{
			$appreciation = Appreciation::create(['appr_note' => $note, 'appr_com' => $commentaire, 'appr_date' => date('Y-m-d'), 'human_id' => $idUser, 'media_id' => $idMedia]);
			$appreciation->save();
		}
		else
		{
			$apprId = $appreciation[0]->appr_id;
			$appreciation = Appreciation::find($apprId);
			$appreciation->appr_note = $note;
			$appreciation->appr_com = $commentaire;
			$appreciation->save();
		}
		
		return redirect()->action('MusiquesController@show', [$idMedia]);
		
	}
}
