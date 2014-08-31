<?php

class TachetransversesController extends BaseController {

	/**
	 * Tachetransverse Repository
	 *
	 * @var Tachetransverse
	 */
	protected $tachetransverse;

	public function __construct(Tachetransverse $tachetransverse)
	{
		$this->tachetransverse = $tachetransverse;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tachetransverses = $this->tachetransverse->all();

		return View::make('tachetransverses.index', compact('tachetransverses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tachetransverses.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Tachetransverse::$rules);

		if ($validation->passes())
		{
			$this->tachetransverse->create($input);

			return Redirect::back()
				->with('tab_actif', 4);
		}

		return Redirect::back()
				->with('tab_actif', 4)
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
		$tachetransverse = $this->tachetransverse->findOrFail($id);

		return View::make('tachetransverses.show', compact('tachetransverse'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$tachetransverse = $this->tachetransverse->find($id);

		if (is_null($tachetransverse))
		{
			return Redirect::route('tachetransverses.index');
		}

		return View::make('tachetransverses.edit', compact('tachetransverse'));
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
		$validation = Validator::make($input, Tachetransverse::$rules);

		if ($validation->passes())
		{
			$tachetransverse = $this->tachetransverse->find($id);
			$tachetransverse->update($input);

			return Redirect::route('tachetransverses.show', $id);
		}

		return Redirect::route('tachetransverses.edit', $id)
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
		$this->tachetransverse->find($id)->delete();

		return Redirect::route('tachetransverses.index');
	}

}
