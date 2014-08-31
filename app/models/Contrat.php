<?php

class Contrat extends Eloquent {
	protected $guarded = array();
	public function commandes()
	{
		return $this->hasMany('Commande');
	}
	public function client()
	{
		return $this->belongsTo('Client');
	}
	public function domaines()
	{
		return $this->hasMany('Domaine');
	}
	public function workpackages()
	{
		return $this->hasMany('Workpackage');
	}
	public function srtypes()
	{
		return $this->hasMany('Srtype');
	}
	public function srcomplexites()
	{
		return $this->hasMany('Srcomplexite');
	}
	public function tachetransverses()
	{
		return $this->hasMany('Tachetransverse');
	}
	public function intanciations()
	{
		return $this->hasMany('Instanciation');
	}
	public static $rules = array(
			'contratCode' => 'required|between:4,64|unique:contrats',
			'contratLibelle' => 'between:4,64',
			'client_id' => 'required'
	);
}
