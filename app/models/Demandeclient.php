<?php

class Demandeclient extends Eloquent {
	protected $guarded = array();
	public function services()
	{
		return $this->belongsToMany('Service')->withPivot('uo');
	}
	public function application()
	{
		return $this->belongsTo('Application');
	}
	public function srtype()
	{
		return $this->belongsTo('Srtype');
	}
	public function srcomplexite()
	{
		return $this->belongsTo('Srcomplexite');
	}
	public function tachesteps()
	{
		return $this->hasMany('TacheStep');
	}
	public function item()
	{
		return $this->belongsTo('Item');
	}
	public static $rules = array(
		'demandeclientCode' => 'required',
		'demandeclientTitre' => 'required',
		'demandeclientEtat' => 'required',
		'dateDebut' => 'required',
		'dateFinprevue' => 'required',
		'application_id' => 'required',
		'srtype_id' => 'required',
		'srcomplexite_id' => 'required',
		'pourcentage' => 'required',
	);
}
