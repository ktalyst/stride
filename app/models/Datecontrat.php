<?php

class Datecontrat extends Eloquent {
	protected $guarded = array();
	public function workpackages()
	{
		return $this->belongsToMany('Workpackage')->withPivot('prixDeVente');
	}
	public function instanciations()
	{
		return $this->hasMany('Instanciation');
	}
	public function unites()
	{
		return $this->hasMany('Unite');
	}
	public static function validate($input)
	{
		$rules = array(
		'datedebutContrat' => 'required|date',
		'datefinContrat' => 'required|date'
	);
		$messages = array(
			'datedebutContrat.required' => 'La date de debut de contrat est manquante.',
			'datedebutContrat.date' => 'La date n\'est pas au bon format.',
			'datefinContrat.required' => 'La date de fin de contrat est manquante.',
			'datefinContrat.date' => 'La date n\'est pas au bon format.',
		);
		return Validator::make($input, $rules, $messages);	
	}
}
