<?php

class Application extends Eloquent {
	protected $guarded = array();

	public function domaine()
	{
		return $this->belongsTo('Domaine');
	}
	public function demandeclients()
	{
		return $this->hasMany('Demandeclient');
	}
	public function contact()
	{
		return $this->belongsTo('Contact');
	}

	public static $rules = array(
			'applicationCode' => 'required|between:6,64|unique:applications',
			'applicationLibelle' => 'between:6,64',
			'domaine_id' => 'required',
	);	
}
