<?php

class Typeconge extends Eloquent {
	protected $guarded = array();

	public function conges()
	{
		return $this->hasMany('Conge');
	}
	public static $rules = array(
		'typecongeLibelle' => 'required'
	);
}
