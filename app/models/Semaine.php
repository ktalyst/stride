<?php

class Semaine extends Eloquent {
	protected $guarded = array();
	public function effectuetaches()
	{
		return $this->hasMany('Effectuetache');
	}
	public static $rules = array(
		'lundi' => 'required',
		'vendredi' => 'required',
		'numeroSemaine' => 'required',
		'derniereSemaine' => 'required'
	);
}
