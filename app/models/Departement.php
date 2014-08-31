<?php

class Departement extends Eloquent {
	protected $guarded = array();

	public function users()
	{
		return $this->hasMany('User');
	}

	public static function validate($input)
	{
		$rules = array(
			'departementCode' => 'required|AlphaNum|between:6,64|unique:departements',
		);	
		$messages = array(
			'departementCode.required' => 'Nous avons besoin du code.',
			'departementCode.AlphaNum' => 'Le code du département doit être composé de caractères alphanumériques.',
			'departementCode.between' => 'Le nombre de caractères du code doit être compris entre :min et :max.',
			'departementCode.unique' => 'Ce code est déjà utilisé.',
		);
		return Validator::make($input, $rules, $messages);	
	}
}
