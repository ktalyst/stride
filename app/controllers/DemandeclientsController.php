<?php

class DemandeclientsController extends BaseController {

	/**
	 * Demandeclient Repository
	 *
	 * @var Demandeclient
	 */
	protected $demandeclient;

	public function __construct(Demandeclient $demandeclient)
	{
		$this->demandeclient = $demandeclient;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$demandeclients = $this->demandeclient->all();

		return View::make('demandeclients.index', compact('demandeclients'), array('actif' => 1));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('demandeclients.create', array('actif' => 1));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$item = Input::get('item_id');
		$srtype = Input::get('type_id');
		$app = Input::get('app_id');
		$src = Input::get('comp_id') ;
		$code = Input::get('demandeclientcode');
		$titre = Input::get('demandeclienttitre');
		$dateD = Input::get('dateDebut');
		$dateF = Input::get('dateFinPrevue');
		$input = array('demandeclientCode' => $code, 'item_id' => $item, 'demandeclientTitre' => $titre, 'srtype_id' => $srtype, 'srcomplexite_id' => $src, 'application_id' => $app, 'dateDebut' => $dateD, 'dateFinprevue' => $dateF);

		$sr = $this->demandeclient->create($input);
		DB::transaction(function() use($sr)
		{
			$services = Input::get('service');
			for($i = 0; $i < count($services); $i++)
			{
				if($services[$i] != "")
				{
					if(!empty($services[$i][1]))
					$sr->services()->attach($services[$i][0], array("uo" => $services[$i][1]));
				}
			}
		}); 
		return Redirect::route('demandeclients.index', array('actif' => 1));
			/*return Input::all();
			$input = Input::all();
			$validation = Validator::make($input, Demandeclient::$rules);

			if ($validation->passes())
			{
				$this->demandeclient->create($input);

				return Redirect::route('demandeclients.index', array('actif' => 1));
			}

			return Redirect::route('demandeclients.create', array('actif' => 1))
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');*/
		}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$demandeclient = $this->demandeclient->findOrFail($id);

		return View::make('demandeclients.show', compact('demandeclient'), array('actif' => 1));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function allocate($id)
	{
		$taches = Input::get('taches');
		$tachesTT = Input::get('tachesTT');
		$servicerequest = Demandeclient::find($id);
		foreach ($tachesTT as $tache_id => $ressources) {
			$tache = Tachetransverse::find($tache_id);
			for($i = 0; $i < count($ressources); $i+2) {
				$tache_step = new Tachestep();
				$tache_step->tachestepCode = $tache->tachetransverseCode;
				$tache_step->chargeinit = $ressources[$i+1][0];
				$tache_step->raf = $ressources[$i+1][0];
				$tache_step->demandeclient_id = $servicerequest->id;
				$tache_step->save();
				$tache_step->users()->attach($ressources[$i]);
			}
		}
		foreach ($taches as $tache_id => $ressources) {
			$tache = Tacheservice::find($tache_id);
			for($i = 0; $i < count($ressources); $i+2) {
				$tache_step = new Tachestep();
				$tache_step->tachestepCode = $tache->tacheserviceCode;
				$tache_step->chargeinit = $ressources[$i+1][0];
				$tache_step->raf = $ressources[$i+1][0];
				$tache_step->demandeclient_id = $servicerequest->id;
				$tache_step->save();
				$tache_step->users()->attach($ressources[$i]);
			}
		}
		return Redirect::route('tachesteps.index');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$demandeclient = $this->demandeclient->find($id);

		if (is_null($demandeclient))
		{
			return Redirect::route('demandeclients.index');
		}

		return View::make('demandeclients.edit', compact('demandeclient'), array('actif' => 1));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Demandeclient::$rules);

		if ($validation->passes())
		{
			$demandeclient = $this->demandeclient->find($id);
			$demandeclient->update($input);

			return Redirect::route('demandeclients.show', $id);
		}

		return Redirect::route('demandeclients.edit', $id)
		->withInput()
		->withErrors($validation)
		->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->demandeclient->find($id)->delete();

		return Redirect::route('demandeclients.index');
	}

}
