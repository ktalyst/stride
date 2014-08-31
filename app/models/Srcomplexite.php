<?php

class Srcomplexite extends Eloquent {
	protected $guarded = array();
	public function contrat()
	{
		return $this->belongsTo('Contrat');
	}
	public function unites()
	{
		return $this->hasMany('Unite');
	}
	public function demandeclients()
	{
		return $this->hasMany('Demandeclient');
	}
	public static $rules = array(
		'srcomplexiteCode' => 'required|between:3,64|unique:srcomplexites',
		'srcomplexiteLibelle' => 'between:2,64',
	);
}
