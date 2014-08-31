<?php

class Effectuetache extends Eloquent {
	protected $guarded = array();
	public function user()
	{
		return $this->belongsTo('User');
	}
		public function tachestep()
	{
		return $this->belongsTo('TacheStep');
	}
		public function semaine()
	{
		return $this->belongsTo('Semaine');
	}
	public static $rules = array(
		'raf' => 'required',
		'chargeL' => 'required',
		'chargeM' => 'required',
		'chargeMe' => 'required',
		'chargeJ' => 'required',
		'chargeV' => 'required',
		'tachestep_id' => 'required',
		'user_id' => 'required',
		'semaine_id' => 'required'
	);
}
