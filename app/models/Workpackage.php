<?php

class Workpackage extends Eloquent {
	protected $guarded = array();
	public function services()
	{
		return $this->hasMany('Service');
	}
	public function datecontrats()
	{
		return $this->belongsToMany('Datecontrat')->withPivot('prixDeVente');
	}
	public function contrat()
	{
		return $this->belongsTo('Contrat');
	}
	public static $rules = array(
		'workpackageLibelle' => 'required',
		'contrat_id' => 'required'
	);
}
