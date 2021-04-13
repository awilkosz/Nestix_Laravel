<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Media;
use App\Collection;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		session_start();
		
        $id = auth()->id();
        $user = User::find($id);
		$mesMedias = DB::table('media') ->join('appreciation','appreciation.'.'media_id', '=', 'media.'.'media_id') ->where('human_id', '=', $id) ->get();
		$mesCollections = DB::table('collection') ->where('human_id', '=', $id) ->get();
		$_SESSION['userId'] = $id;
        
        if($user->reinitialiser == 1)
            return redirect()->route('reset');
        else
            return view('home')->with(['mesMedias'=> $mesMedias, 'mesCollections' => $mesCollections, 'user' => $user]);
    }

    public function reset()
    {
        $erreur1 = "";
        $erreur2 = "";

        return view('reset')->with(['erreur1'=>$erreur1, 'erreur2'=>$erreur2]);
    }

    public function resetPassword()
    {
        session_start();

        $newPassword = request('newPassword');
        $confirmPassword = request('passwordConfirm');

        $erreur1 = "";
        $erreur2 = "";

        if($newPassword == $confirmPassword)
        {
            if (preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{10,}$/',$newPassword))
            {
                $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $user = User::find($_SESSION['userId']); 
                $user->password = $newPassword; 
                $user->reinitialiser = 0;
                $user->save();

                return redirect()->route('home');
            }
            else
            {
                $erreur2 = "Le mot de passe doit faire minimum 10 caractères et doit contenir au moins une majuscule et un chiffre !";
                return view('reset')->with(['erreur1'=>$erreur1, 'erreur2'=>$erreur2]);
            }
        }
        else
        {
            $erreur1 = "Les mots de passe ne correspondent pas !";
            return view('reset')->with(['erreur1'=>$erreur1, 'erreur2'=>$erreur2]);
        }
    }
}
