<?php

class TacheExternesController extends BaseController {

	/**
	 * TacheExterne Repository
	 *
	 * @var TacheExterne
	 */
	protected $tacheExterne;

	public function __construct(TacheExterne $tacheExterne)
	{
		$this->tacheExterne = $tacheExterne;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tacheExternes = $this->tacheExterne->all();

		return View::make('tacheExternes.index', compact('tacheExternes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tacheExternes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, TacheExterne::$rules);

		if ($validation->passes())
		{
			$this->tacheExterne->create($input);

			return Redirect::route('accueil');
		}

		return Redirect::route('tacheExternes.create')
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
		$tacheExterne = $this->tacheExterne->findOrFail($id);

		return View::make('tacheExternes.show', compact('tacheExterne'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tacheExterne = $this->tacheExterne->find($id);

		if (is_null($tacheExterne))
		{
			return Redirect::route('tacheExternes.index');
		}

		return View::make('tacheExternes.edit', compact('tacheExterne'));
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
		$validation = Validator::make($input, TacheExterne::$rules);

		if ($validation->passes())
		{
			$tacheExterne = $this->tacheExterne->find($id);
			$tacheExterne->update($input);

			return Redirect::route('tacheExternes.show', $id);
		}

		return Redirect::route('tacheExternes.edit', $id)
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
		$this->tacheExterne->find($id)->delete();

		return Redirect::route('tacheExternes.index');
	}

}
