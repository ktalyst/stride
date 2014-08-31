<?php

class DepartementsController extends BaseController {

	/**
	 * Departement Repository
	 *
	 * @var Departement
	 */
	protected $departement;

	public function __construct(Departement $departement)
	{
		$this->departement = $departement;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$departements = $this->departement->all();

		return View::make('departements.index', compact('departements'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('departements.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Departement::$rules);

		if ($validation->passes())
		{
			$this->departement->create($input);

			return Redirect::route('departements.index');
		}

		return Redirect::route('departements.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$departement = $this->departement->findOrFail($id);

		return View::make('departements.show', compact('departement'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$departement = $this->departement->find($id);

		if (is_null($departement))
		{
			return Redirect::route('departements.index');
		}

		return View::make('departements.edit', compact('departement'));
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
		$validation = Validator::make($input, Departement::$rules);

		if ($validation->passes())
		{
			$departement = $this->departement->find($id);
			$departement->update($input);

			return Redirect::route('departements.show', $id);
		}

		return Redirect::route('departements.edit', $id)
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
		$this->departement->find($id)->delete();

		return Redirect::route('departements.index');
	}

}
