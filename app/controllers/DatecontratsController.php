<?php

class DatecontratsController extends BaseController {

	/**
	 * Datecontrat Repository
	 *
	 * @var Datecontrat
	 */
	protected $datecontrat;

	public function __construct(Datecontrat $datecontrat)
	{
		$this->datecontrat = $datecontrat;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$datecontrats = $this->datecontrat->all();

		return View::make('datecontrats.index', compact('datecontrats'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('datecontrats.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Datecontrat::$rules);

		if ($validation->passes())
		{
			$this->datecontrat->create($input);

			return Redirect::route('datecontrats.index');
		}

		return Redirect::route('datecontrats.create')
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
		$datecontrat = $this->datecontrat->findOrFail($id);

		return View::make('datecontrats.show', compact('datecontrat'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$datecontrat = $this->datecontrat->find($id);

		if (is_null($datecontrat))
		{
			return Redirect::route('datecontrats.index');
		}

		return View::make('datecontrats.edit', compact('datecontrat'));
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
		$validation = Validator::make($input, Datecontrat::$rules);

		if ($validation->passes())
		{
			$datecontrat = $this->datecontrat->find($id);
			$datecontrat->update($input);

			return Redirect::route('datecontrats.show', $id);
		}

		return Redirect::route('datecontrats.edit', $id)
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
		$this->datecontrat->find($id)->delete();

		return Redirect::route('datecontrats.index');
	}

}
