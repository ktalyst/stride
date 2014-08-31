<?php

class WorkpackagesController extends BaseController {

	/**
	 * Workpackage Repository
	 *
	 * @var Workpackage
	 */
	protected $workpackage;

	public function __construct(Workpackage $workpackage)
	{
		$this->workpackage = $workpackage;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$workpackages = $this->workpackage->all();

		return View::make('workpackages.index', compact('workpackages'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('workpackages.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$libelle=Input::get('workpackageLibelle');
		$contrat = Instanciation::find(Input::get('instanciation_id'));
		$contrat_id = $contrat->contrat_id;

		$wp = $this->workpackage->create(array('workpackageLibelle' => $libelle,'contrat_id' => $contrat_id));
		DB::transaction(function() use($wp)
		{       
			$date = Instanciation::find(Input::get('instanciation_id'));
			$date_id = $date->datecontrat_id;
			$prix = Input::get('prix');
			$wp->datecontrats()->attach($date_id, array('prixDeVente' => $prix));

		});
		$services = Input::get('services');
		foreach($services as $service_id)
		{
			$service = Service::find($service_id);
			$service->workpackage_id = $wp->id;
			$service->save();
		}

		return Redirect::back()
				->with('tab_actif', 6);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$workpackage = $this->workpackage->findOrFail($id);

		return View::make('workpackages.show', compact('workpackage'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$workpackage = $this->workpackage->find($id);

		if (is_null($workpackage))
		{
			return Redirect::route('workpackages.index');
		}

		return View::make('workpackages.edit', compact('workpackage'));
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
		$validation = Validator::make($input, Workpackage::$rules);

		if ($validation->passes())
		{
			$workpackage = $this->workpackage->find($id);
			$workpackage->update($input);

			return Redirect::route('workpackages.show', $id);
		}

		return Redirect::route('workpackages.edit', $id)
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
		$this->workpackage->find($id)->delete();

		return Redirect::route('workpackages.index');
	}

}
