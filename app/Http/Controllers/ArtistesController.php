<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Humain;
use App\Artiste;
use App\Media;

class ArtistesController extends Controller
{
    public function index() 
	{ 
		//
    }
	
	public function show($id)
	{
		$artiste = Artiste::findOrFail($id);
		$humain = Humain::findOrFail($id);
		
		$medias = DB::table('media') ->join('take_part_in','take_part_in.'.'media_id', '=', 'media.'.'media_id') ->where('human_id', '=', $id) ->get();
		
		return view('artistes.detailsArtiste')->with(['artiste'=> $artiste, 'humain'=> $humain, 'medias'=> $medias]);
	}
}
