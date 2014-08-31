<?php

class Client extends Eloquent {
	protected $guarded = array();

	public function contrats()
	{
		return $this->hasMany('Contrat');
	}
	public function contacts()
	{
		return $this->hasMany('Contact');
	}
	public static $rules = array(
		'clientNom' => 'required|between:2,64|unique:clients',
	);	
    public static function findByNameOrFail(
        $clientNom,
        $columns = array('*')
    ) {
        if ( ! is_null($client = static::whereClientnom($clientNom)->first($columns))) {
            return $client;
        }

        else return false;
    }
		
}
