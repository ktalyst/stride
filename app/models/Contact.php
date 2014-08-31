<?php

class Contact extends Eloquent {
	protected $guarded = array();

	public function client()
	{
		return $this->belongsTo('Client');
	}
	public function applications()
	{
		return $this->hasMany('Application');
	}

	public function adresse()
	{
		return $this->hasOne('Adresse');
	}

	public static $rules = array(
			'contactNom' => 'required|alpha|between:3,64',
			'contactPrenom' => 'required|alpha|between:3,64',
			'adresse_id' => 'required',
	);
}
