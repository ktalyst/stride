<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'HomeController@accueil', 'before' => 'auth','as' => 'accueil'));
Route::controller('auth', 'AuthController');
Route::controller('remind', 'RemindersController');


Route::group(array('before' => 'auth'), function()
{
	Route::get('api/dropdowncommande','ApiController@getIndexCommande');
	Route::get('api/dropdownpo','ApiController@getIndexPO');
	Route::get('api/dropdownitem','ApiController@getIndexItem');
	Route::get('api/dropdowninst','ApiController@getIndexIntanciation');
	Route::get('api/dropdowncatalogue','ApiController@getIndexCatalogue');
	Route::post('crjs/{id}', array('as' => 'crjsupdate', 'uses' => 'CrjsController@update'));
	Route::resource('departements', 'DepartementsController');
	Route::resource('periodes', 'PeriodesController');
	Route::resource('clients', 'ClientsController');
	Route::resource('contacts', 'ContactsController');
	Route::resource('domaines', 'DomainesController');
	Route::resource('applications', 'ApplicationsController');
	Route::resource('clients', 'ClientsController');
	Route::resource('contrats', 'ContratsController');
	Route::resource('catalogues', 'CataloguesController');
	Route::resource('services', 'ServicesController');
	Route::resource('conges', 'CongesController');
	Route::resource('typeconges', 'TypecongesController');
	Route::resource('instanciations', 'InstanciationsController');
	Route::resource('datecontrats', 'DatecontratsController');
	Route::resource('commandes', 'CommandesController');
	Route::resource('items', 'ItemsController');
	Route::resource('tachetransverses', 'TachetransversesController');
	Route::resource('demandeclients', 'DemandeclientsController');
	Route::resource('srtypes', 'SrtypesController');
	Route::resource('srcomplexites', 'SrcomplexitesController');
	Route::resource('unites', 'UnitesController');
	Route::resource('tachesteps', 'TachestepsController');
	Route::resource('effectuetaches', 'EffectuetachesController');
	Route::resource('semaines', 'SemainesController');
	Route::resource('tacheservices', 'TacheservicesController');
	Route::resource('tacheexternes', 'TacheexternesController');
	Route::resource('workpackages', 'WorkpackagesController');
	Route::resource('Users', 'UsersController');
	Route::post('domaines/allocate', array('as' => 'allocation', 'uses' => 'DomainesController@allocate'));
	Route::post('conges/valider', array('as' => 'validerconges', 'uses' => 'CongesController@valider'));
	Route::resource('evenements', 'EvenementsController');
	Route::resource('adresses', 'AdressesController');
	Route::post('conges/valider', array('as' => 'conges.valider', 'uses' => 'CongesController@validerconges'));
	Route::get('crjs/', array('as' => 'crjs', function()
	{
		return View::make('crjs');
	}));
	Route::get('cra/', array('as' => 'cra', function()
	{
		return View::make('cra');
	}));
	Route::post('servicerequests/allocate/{id}', array('as' => 'allocateResource', 'uses' => 'DemandeclientsController@allocate'));
});

App::missing(function($exception)
{
	return Response::make('error.404');
});

Route::get('language/{lang}', 
	array(
		'as' => 'language.select', 
		'uses' => 'LanguageController@select'
		)
	);