<?php

class Tachetransverse extends Eloquent {
	protected $guarded = array();
	public function tachesteps()
	{
		return $this->hasMany('Tachestep');
	}
	public function contrat()
	{
		return $this->belongsTo('Contrat');
	}
	public static $rules = array(
		'tachetransverseCode' => 'required|between:3,64|unique:tachetransverses',
		'tachetransverseLibelle' => 'between:3,64',
		'tachetransversePourcentage' => 'required|digitsbetween:0,100',
	);
}
