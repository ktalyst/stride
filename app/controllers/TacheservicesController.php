<?php

class TacheservicesController extends BaseController {

	/**
	 * Tacheservice Repository
	 *
	 * @var Tacheservice
	 */
	protected $tacheservice;

	public function __construct(Tacheservice $tacheservice)
	{
		$this->tacheservice = $tacheservice;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tacheservices = $this->tacheservice->all();

		return View::make('tacheservices.index', compact('tacheservices'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tacheservices.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$tacheservices = Input::get('tacheservices');
		$service_id = Input::get('service');
		foreach($tacheservices as $tacheservice)
		{
			$input = array('tacheserviceCode' => $tacheservice['tacheserviceCode'], 'tacheserviceLibelle' => $tacheservice['tacheserviceLibelle'], 'tacheservicePourcentage' => $tacheservice['tacheservicePourcentage'] ,'service_id' => $service_id);
			$tache = $this->tacheservice->create($input);
		}
		return Redirect::route('services.edit', $service_id);
	
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tacheservice = $this->tacheservice->findOrFail($id);

		return View::make('tacheservices.show', compact('tacheservice'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tacheservice = $this->tacheservice->find($id);

		if (is_null($tacheservice))
		{
			return Redirect::route('tacheservices.index');
		}

		return View::make('tacheservices.edit', compact('tacheservice'));
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
		$validation = Validator::make($input, Tacheservice::$rules);

		if ($validation->passes())
		{
			$tacheservice = $this->tacheservice->find($id);
			$tacheservice->update($input);

			return Redirect::route('tacheservices.show', $id);
		}

		return Redirect::route('tacheservices.edit', $id)
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
		$this->tacheservice->find($id)->delete();

		return Redirect::route('tacheservices.index');
	}

}
