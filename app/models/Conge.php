<?php

class Conge extends Eloquent {
	protected $guarded = array();

	public function typeconge()
	{
		return $this->belongsTo('Typeconge');
	}
	public function user()
	{
		return $this->belongsTo('User');
	}
	public static function validate($input)
	{
		$rules = array(
			'datedebutConge' => 'required|date',
			'datefinConge' => 'required|date',
			'congeJours' => 'required',
			'typeConge_id' => 'required'
		);
		$messages = array(
			'datedebutConge.required' => 'La date de début de congé est manquante.',
			'datedebutConge.date' => 'La date de début de congé n\'est pas au bon format.',
			'datefinConge.required' => 'La date de fin de congé est manquante.',
			'datefinConge.date' => 'La date de fin de congé n\'est pas au bon format.',
			'congeJours.required' => 'Vous n\'avez pas entré le nombre de jours de congés.',
			'typeConge_id.required' => 'Vous n\'avez pas sélectionné de type de congé.',
		);
		return Validator::make($input, $rules, $messages);	
	}
}
