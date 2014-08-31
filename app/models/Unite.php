<?php

class Unite extends Eloquent {
	protected $guarded = array();
	public function service()
	{
		return $this->belongsTo('Service');
	}
		public function datecontrat()
	{
		return $this->belongsTo('Datecontrat');
	}
		public function srtype()
	{
		return $this->belongsTo('Srtype');
	}
		public function srcomplexite()
	{
		return $this->belongsTo('Srcomplexite');
	}
	public static $rules = array(
		'unitworkload' => 'required',
		'service_id' => 'required',
		'datecontrat_id' => 'required',
		'srtype_id' => 'required',
		'srcomplexite_id' => 'required'
	);
}
