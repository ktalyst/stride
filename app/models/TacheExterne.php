<?php

class TacheExterne extends Eloquent {
	protected $guarded = array();
	public function tachesteps()
	{
		return $this->hasMany('Tachestep');
	}
	public static $rules = array(
		'tacheExterneCode' => 'required',
		'tacheExterneLibelle' => 'required'
	);
}
