<?php

class Evenement extends Eloquent {
	protected $guarded = array();

	public function user()
	{
		$this->belongsTo('User');
	}

	public static $rules = array(
		'titre' => 'required',
		'date' => 'required',
		'categorie' => 'required',
	);
}
