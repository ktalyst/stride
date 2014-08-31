<?php

class HomeController extends BaseController {

	public function __construct()
	{
		$this->beforeFilter('csrf', ['on' => 'post']);
	}
	

  /**
	* Affiche la page d'accueil
	*
	* @return View
	*/
	public function accueil()
	{
		return View::make('accueil', array('actif' => 0));
	}


  /**
	* Traitement du formulaire de recherche
	*
	* @return View ou Redirect
	*/
	public function find()
	{

	}

  /**
	* Traitement du formulaire d'ajout de commentaires
	*
	* @return Redirect
	*/
	public function comment()
	{

	}

}