<?php

class Instanciation extends Eloquent {
	protected $guarded = array();
	public function contrat()
	{
		return $this->belongsTo('Contrat');
	}
		public function catalogue()
	{
		return $this->belongsTo('Catalogue');
	}
		public function datecontrat()
	{
		return $this->belongsTo('Datecontrat');
	}
	public static $rules = array(
		'contrat_id' => 'required',
		'catalogue_id' => 'required',
		'datecontrat_id' => 'required'
	);
}
