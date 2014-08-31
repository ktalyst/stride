<?php

class Commande extends Eloquent {
	protected $guarded = array();

	public function items(){
		return $this->hasMany('Item');
	}
	public function contrat(){
		return $this->belongsTo('Contrat');
	}
	public static $rules = array(
			'commandeCode' => 'required|AlphaNum|between:4,64|unique:commandes',
			'contrat_id' => 'required'
		);
		
}
