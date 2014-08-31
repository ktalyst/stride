<?php

class Srtype extends Eloquent {
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
		'srtypeCode' => 'required|between:2,64|unique:srtypes',
		'srtypeLibelle' => 'between:2,64',
	);
}
