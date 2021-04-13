<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Media;
use App\Musique;
use App\Genre;

class MusiquesController extends Controller
{
    public function index() 
	{
		$medias = $medias = $medias = DB::table('media') ->join('status', 'status.'.'media_id', '=', 'media.'.'media_id') ->where('media_type', '=', 'Chanson') ->where('asv_id', '=', '1')->get();
		$genres = Genre::all();
		$parGenre = false;

		return view('musiques.index')->with(['medias'=>$medias, 'genres'=>$genres, 'parGenre'=>$parGenre]);
    }
	
	public function show($id)
	{
		session_start();
		
		$media = Media::findOrFail($id);
		$musique = Musique::findOrFail($id);
		
		$genres = $media->genres;
		$interpretes = DB::table('artist') ->join('take_part_in','take_part_in.'.'human_id', '=', 'artist.'.'human_id') ->where('media_id', '=', $id) ->where('work_id', '=', 2) ->get();
		
		$_SESSION['mediaId'] = $id;
		$_SESSION['visites'][$id] = time();

		$id = 0;
		$mesCollections = NULL;
		$status = "";
		if(null !== auth()->user())
		{
			$id = auth()->id();
			$_SESSION['userId'] = $id;
			$mesCollections = DB::table('collection') ->where('human_id', '=', $id) ->get();
			$status = auth()->user()->user_status;
		}
		
		return view('musiques.detailsMusique')->with(['musique'=> $musique, 'media'=>$media, 'interpretes'=>$interpretes, 'genres'=>$genres, 'mesCollections'=>$mesCollections, 'status'=>$status]);
	}

	public function afficherMusiquesParGenre($id)
	{
		$medias = DB::table('media') ->join('status', 'status.'.'media_id', '=', 'media.'.'media_id') ->join('categorized_by', 'categorized_by.'.'media_id', '=', 'media.'.'media_id') ->where('media_type', '=', 'Chanson') ->where('genre_id', '=', $id) ->where('asv_id', '=', '1')->get();
		$genres = Genre::all();
		$parGenre = true;
		return view('musiques.index')->with(['medias'=>$medias, 'genres'=>$genres, 'parGenre'=>$parGenre]);
	}
}
