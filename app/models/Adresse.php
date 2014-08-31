<?php

class Adresse extends Eloquent {
	protected $guarded = array();

	public function contact()
	{
		return $this->hasOne('Contact');
	}

	public static $rules = array(
		'numero' => 'required',
		'rue' => 'required',
		'codepostal' => 'required',
		'ville' => 'required'
		);
}
