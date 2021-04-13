<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use App\Media;
use App\Contains;
use Illuminate\Support\Facades\DB;

class ContainsController extends Controller
{
    public function destroy($id)
	{
		session_start();
		
		$idCollect = $_SESSION["collect_id"];
		$contains = Contains::where('media_id', '=', $id)->where('collect_id', '=', $idCollect)->delete();
		
		$collection = Collection::findOrFail($idCollect);
		$mesMedias = DB::table('media') ->join('contains','contains.'.'media_id', '=', 'media.'.'media_id') ->where('collect_id', '=', $idCollect) ->get();
		
		return view('collections.detailsCollection')->with(['collection'=> $collection, 'mesMedias'=> $mesMedias]);
	}
}
