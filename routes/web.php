<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//https://www.youtube.com/watch?v=c2cRW72U6QM&list=PLeeuvNW2FHVgvC-PdSfi309DbDMoEswiT&index=7

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'MediasController@index');

Route::resource('medias','MediasController');
Route::resource('films','FilmsController');
Route::resource('musiques','MusiquesController');
Route::resource('livres','LivresController');
Route::resource('artistes','ArtistesController');
Route::resource('collections', 'CollectionsController');
Route::resource('contains', 'ContainsController');

Route::get('medias', 'MediasController@index');
Route::get('films', 'FilmsController@index')->name('films');
Route::get('chansons', 'MusiquesController@index')->name('chansons');
Route::get('livres', 'LivresController@index')->name('livres');
Route::get('collections', 'CollectionsController@index')->name('collections');
Route::get('propositions', 'MediasController@afficheFormulairePropositions')->name('propositions');
Route::get('lecteur', 'MediasController@afficherLecteur')->name('lecteur');
Route::get('historique', 'MediasController@afficherHistorique')->name('historique');
Route::get('filmsParGenre/{id}', 'FilmsController@afficherFilmsParGenre')->name('filmsParGenre');
Route::get('chansonsParGenre/{id}', 'MusiquesController@afficherMusiquesParGenre')->name('chansonsParGenre');
Route::get('livresParGenre/{id}', 'LivresController@afficherLivresParGenre')->name('livresParGenre');

Route::post('appreciationsMedia', 'AppreciationsController@storeMedia')->name('appreciationsMedia');
Route::post('ajouterCollection', 'CollectionsController@store')->name('ajouterCollection');
Route::post('ajouterMediaDansCollection', 'CollectionsController@ajouterMediaDansCollection')->name('ajouterMediaDansCollection');
Route::post('recherche', 'MediasController@recherche')->name('recherche');
Route::post('proposer', 'MediasController@proposerMedia')->name('proposer');
Route::post('resetPassword', 'HomeController@resetPassword')->name('resetPassword');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('reset', 'HomeController@reset')->name('reset');

//Reset email
