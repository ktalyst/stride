<?php

class CongesController extends BaseController {

	/**
	 * Conge Repository
	 *
	 * @var Conge
	 */
	protected $conge;

	public function __construct(Conge $conge)
	{
		$this->conge = $conge;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$conges = $this->conge->all();

		return View::make('conges.index', compact('conges'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('conges.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();

		$this->conge->create($input);

		return Redirect::route('conges.index');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$conges = $this->conge->all();

		return View::make('conges.valider', compact('conges'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$conge = $this->conge->find($id);

		if (is_null($conge))
		{
			return Redirect::route('conges.index');
		}

		return View::make('conges.edit', compact('conge'));
	}

	/**
	 * Show the form to validate holidays.
	 *
	 * @return Response
	 */
	public function valider()
	{
		$conges = $this->conge->all();
		return View::make('conges.valider', compact('conges'));
	}

	/**
	 * Update the specified status of holidays in storage.
	 *
	 * @return Response
	 */
	public function validerConges()
	{
		$input = Input::get('conges');
		foreach($input as $key => $data)
		{
			$conge = $this->conge->find($key);
			$conge->congeStatut = $data;	
			$conge->save();
		}
		return Redirect::route('conges.valider');
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
		$validation = Validator::make($input, Conge::$rules);

		if ($validation->passes())
		{
			$conge = $this->conge->find($id);
			$conge->update($input);

			return Redirect::route('conges.show', $id);
		}

		return Redirect::route('conges.edit', $id)
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
		$this->conge->find($id)->delete();

		return Redirect::route('conges.index');
	}

}
