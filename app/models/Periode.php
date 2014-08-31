<?php

class Periode extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'periodeDebut' => 'required',
	);

	public function users()
	{
	    return $this->belongsToMany('User', 'periode_user')->withPivot('coefficient');
	}

	public static function validate($input)
	{
		$rules = array(
			'periodeDebut' => 'required|date',
			'periodeFin' => 'date|after:periodeDebut'
		);	
		$messages = array(
			'periodeDebut.required' => 'Nous avons besoin du début de la période.',
			'periodeDebut.date' => 'Le date n\'est pas valide.',
			'periodeFin.date' => 'La date n\'est pas valide.',
			'periodeFin.after' => 'La date entrée n\'est pas après la date de début',
		);
		return Validator::make($input, $rules, $messages);	
	}
}
