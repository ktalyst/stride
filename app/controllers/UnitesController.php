<?php

class UnitesController extends BaseController {

	/**
	 * Unite Repository
	 *
	 * @var Unite
	 */
	protected $unite;

	public function __construct(Unite $unite)
	{
		$this->unite = $unite;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$unites = $this->unite->all();

		return View::make('unites.index', compact('unites'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('unites.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Unite::$rules);

		if ($validation->passes())
		{
			$this->unite->create($input);

			return Redirect::route('unites.index');
		}

		return Redirect::route('unites.create')
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
		$unite = $this->unite->findOrFail($id);

		return View::make('unites.show', compact('unite'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$unite = $this->unite->find($id);

		if (is_null($unite))
		{
			return Redirect::route('unites.index');
		}

		return View::make('unites.edit', compact('unite'));
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
		$validation = Validator::make($input, Unite::$rules);

		if ($validation->passes())
		{
			$unite = $this->unite->find($id);
			$unite->update($input);

			return Redirect::route('unites.show', $id);
		}

		return Redirect::route('unites.edit', $id)
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
		$this->unite->find($id)->delete();

		return Redirect::route('unites.index');
	}

}
