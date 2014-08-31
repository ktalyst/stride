<?php

class TachestepsController extends BaseController {

	/**
	 * Tachestep Repository
	 *
	 * @var Tachestep
	 */
	protected $tachestep;

	public function __construct(Tachestep $tachestep)
	{
		$this->tachestep = $tachestep;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tachesteps = $this->tachestep->all();

		return View::make('tachesteps.index', compact('tachesteps'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tachesteps.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Tachestep::$rules);

		if ($validation->passes())
		{
			$this->tachestep->create($input);

			return Redirect::route('tachesteps.index');
		}

		return Redirect::route('tachesteps.create')
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
		$tachestep = $this->tachestep->findOrFail($id);

		return View::make('tachesteps.show', compact('tachestep'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tachestep = $this->tachestep->find($id);

		if (is_null($tachestep))
		{
			return Redirect::route('tachesteps.index');
		}

		return View::make('tachesteps.edit', compact('tachestep'));
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
		$validation = Validator::make($input, Tachestep::$rules);

		if ($validation->passes())
		{
			$tachestep = $this->tachestep->find($id);
			$tachestep->update($input);

			return Redirect::route('tachesteps.show', $id);
		}

		return Redirect::route('tachesteps.edit', $id)
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
		$this->tachestep->find($id)->delete();

		return Redirect::route('tachesteps.index');
	}

}
