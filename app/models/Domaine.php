<?php

class Domaine extends Eloquent {
	protected $guarded = array();

	public function applications()
	{
		return $this->hasMany('Application');
	}
	public function contrats()
	{
		return $this->belongsTo('Contrat');
	}
	public function users()
	{
		return $this->belongsToMany('user','domaine_user')->withPivot('estResponsable');
	}

	public static $rules = array(
			'domaineCode' => 'required|between:2,64|unique:domaines',
			'domaineLibelle' => 'between:2,64',
	);	
		
}
