<?php

class Service extends Eloquent {
	protected $guarded = array();
	public function tacheservices()
	{
		return $this->hasMany('Tacheservice');
	}
	public function demandeclients()
	{
		return $this->belongsToMany('Demandeclient')->withPivot('uo');
	}
	public function catalogue()
	{
		return $this->belongsTo('Catalogue');
	}
	public function workpackage()
	{
		return $this->belongsTo('Workpackage');
	}
	public static $rules = array(
		'serviceCode' => 'required',
		'serviceLibelle' => 'required',
		'catalogue_id' => 'required',
	);
}
