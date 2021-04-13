<?php

namespace App\Http\Controllers;

use App\Client; //Ce modèle n'existe pas
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function list() {
		$clients = ['Jean', 'Marc', 'Michel'];
	
		//[nom du tableau à appeller dans la vue => tableau]
		return view('clients.index', ['clients' => $clients]);
	}
	
	public function store()
	{
		$pseudo = request('pseudo');
		
		$client = new Client(); //ne fonctionne pas car modèle inexistant
		$client->name = $pseudo; //Affecte le pseudo à l'attribut name de l'objet Client
		$client->save(); //Enregistre dans la BDD
		
		return back();
	}
}
