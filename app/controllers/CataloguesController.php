<?php

class CataloguesController extends BaseController {

	/**
	 * Catalogue Repository
	 *
	 * @var Catalogue
	 */
	protected $catalogue;

	public function __construct(Catalogue $catalogue)
	{
		$this->catalogue = $catalogue;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$catalogues = $this->catalogue->all();

		return View::make('catalogues.index', compact('catalogues'), array('actif' => 1));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('catalogues.create', array('actif' => 6));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$services = Input::get('services');
		$code = Input::get('catalogueCode');
		$libelle = Input::get('catalogueLibelle');
		$description = Input::get('catalogueDescription');
		$input = array('catalogueCode' => $code, 'catalogueLibelle' => $libelle, 'catalogueDescription' => $description);
		$validation = Validator::make($input, Catalogue::$rules);
		if ($validation->passes())
		{
			$catalogue = $this->catalogue->create($input);
		}
		else
		{
			return Redirect::route('catalogues.create', array('actif' => 6))
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');		
		}
		foreach($services as $service)
		{
			$inputservice = array('serviceCode' => $service['code'], 'serviceLibelle' => $service['libelle'], 'catalogue_id' => $catalogue->id);
			$validation = Validator::make($inputservice, Service::$rules);
			if (!$validation->passes())
			{
				return Redirect::route('catalogues.create', array('actif' => 6))
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');	
			}
		}
		foreach($services as $service)
		{
			$inputservice = array('serviceCode' => $service['code'], 'serviceLibelle' => $service['libelle'], 'catalogue_id' => $catalogue->id);
			$service = Service::create($inputservice);
		}
		return Redirect::route('catalogues.index', array('actif' => 6));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$catalogue = $this->catalogue->findOrFail($id);

		return View::make('catalogues.show', compact('catalogue'), array('actif' => 1));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$catalogue = $this->catalogue->find($id);

		if (is_null($catalogue))
		{
			return Redirect::route('catalogues.index');
		}

		return View::make('catalogues.edit', compact('catalogue'), array('actif' => 6));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$services = Input::get('services');
		$description = Input::get('catalogueDescription');
		$input = array('catalogueDescription' => $description);
		$catalogue = $this->catalogue->find($id);
		$catalogue->update($input);

		if($services)
		{
			foreach($services as $service)
			{
				$inputservice = array('serviceCode' => $service['code'], 'serviceLibelle' => $service['libelle'], 'catalogue_id' => $catalogue->id);
				$validation = Validator::make($inputservice, Service::$rules);
				if (!$validation->passes())
				{
					return Redirect::route('catalogues.create', array('actif' => 6))
					->withInput()
					->withErrors($validation)
					->with('message', 'There were validation errors.');	
				}
			}
			foreach($services as $service)
			{
				$inputservice = array('serviceCode' => $service['code'], 'serviceLibelle' => $service['libelle'], 'catalogue_id' => $catalogue->id);
				$service = Service::create($inputservice);
			}
		}
		return Redirect::route('catalogues.index', array('actif' => 6));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->catalogue->find($id)->delete();

		return Redirect::route('catalogues.index', array('actif' => 6));
	}

}
