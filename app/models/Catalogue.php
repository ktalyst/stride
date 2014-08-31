<?php

class Catalogue extends Eloquent {
	protected $guarded = array();

	public function services()
	{
		return $this->hasMany('Service');
	}
	public function instanciations()
	{
		return $this->hasMany('Instanciation');
	}
	public static $rules = array(
		'catalogueCode' => 'required|between:6,64|unique:catalogues',
		'catalogueLibelle' => 'between:6,64',
	);
}
