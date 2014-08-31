<?php

class Tachestep extends Eloquent {
	protected $guarded = array();

	public function demandeclient()
	{
		return $this->belongsTo('Demandeclient');
	}
	public function users()
	{
		return $this->belongsToMany('User', 'tachestep_user');
	}
	public function effectuetaches()
	{
		return $this->hasMany('Effectuetache');
	}
	public function tacheservice()
	{
		return $this->belongsTo('Tacheservice');
	}
	public function tachetransverse()
	{
		return $this->belongsTo('Tachetransverse');
	}
	public function tacheexterne()
	{
		return $this->belongsTo('TacheExterne');
	}
	public static $rules = array(
		'tachestepCode' => 'required',
		'tachestepLibelle' => 'required',
		'chargeinit' => 'required',
		'raf' => 'required',
		'demandeclient_id' => 'required',
		'type' => 'required'
		);
}
