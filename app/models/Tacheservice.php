<?php

class Tacheservice extends Eloquent {
	protected $guarded = array();
	public function service()
	{
		return $this->belongsTo('Service');
	}
	public function tachesteps()
	{
		return $this->hasMany('Tachestep');
	}
	public static $rules = array(
		'tacheserviceCode' => 'required',
		'tacheserviceLibelle' => 'required',
		'tacheservicePourcentage' => 'required',
		'service_id' => 'required'
	);
}
