<?php

class Item extends Eloquent {
	protected $guarded = array();
	public function commande()
	{
		return $this->belongsTo('Commande');
	}
	public function demandeclients()
	{
		return $this->hasMany('Demandeclient');
	}
	public static $rules = array(
		'itemCode' => 'required',
		'itemLibelle' => 'required',
		'itemMontant' => 'required',
		'dateFacturation' => 'required',
		'itemStatut' => 'required',
		'commande_id' => 'required'
	);
}
