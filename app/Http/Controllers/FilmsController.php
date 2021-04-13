<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Media;
use App\Film;
use App\Artiste;
use App\Genre;

class FilmsController extends Controller
{
    public function index() 
	{ 
		$medias = DB::table('media') ->join('status', 'status.'.'media_id', '=', 'media.'.'media_id') ->where('media_type', '=', 'Film') ->where('asv_id', '=', '1')->get();
		$genres = Genre::all();
		$parGenre = false;

		return view('films.index')->with(['medias'=>$medias, 'genres'=>$genres, 'parGenre'=>$parGenre]);
    }
	
	public function show($id)
	{
		session_start();
		
		$media = Media::findOrFail($id);
		$film = Film::findOrFail($id);
		$genres = $media->genres;
		
		$acteurs = DB::table('artist') ->join('take_part_in','take_part_in.'.'human_id', '=', 'artist.'.'human_id') ->where('media_id', '=', $id) ->where('work_id', '=', 1) ->get();
		$realisateurs = DB::table('artist') ->join('take_part_in','take_part_in.'.'human_id', '=', 'artist.'.'human_id') ->where('media_id', '=', $id) ->where('work_id', '=', 4) ->get();
		$scenaristes = DB::table('artist') ->join('take_part_in','take_part_in.'.'human_id', '=', 'artist.'.'human_id') ->where('media_id', '=', $id) ->where('work_id', '=', 5) ->get();
		
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
		
		return view('films.detailsFilm')->with(['film'=> $film, 'media'=>$media, 'acteurs'=>$acteurs, 'realisateurs'=>$realisateurs, 'scenaristes'=>$scenaristes, 'genres'=>$genres, 'mesCollections'=>$mesCollections, 'status'=>$status]);
	}

	public function afficherFilmsParGenre($id)
	{
		$medias = DB::table('media') ->join('status', 'status.'.'media_id', '=', 'media.'.'media_id') ->join('categorized_by', 'categorized_by.'.'media_id', '=', 'media.'.'media_id') ->where('media_type', '=', 'Film') ->where('genre_id', '=', $id) ->where('asv_id', '=', '1')->get();
		$genres = Genre::all();
		$parGenre = true;
		return view('films.index')->with(['medias'=>$medias, 'genres'=>$genres, 'parGenre'=>$parGenre]);
	}
}
