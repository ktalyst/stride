<?php

class SrcomplexitesController extends BaseController {

	/**
	 * Srcomplexite Repository
	 *
	 * @var Srcomplexite
	 */
	protected $srcomplexite;

	public function __construct(Srcomplexite $srcomplexite)
	{
		$this->srcomplexite = $srcomplexite;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$srcomplexites = $this->srcomplexite->all();

		return View::make('srcomplexites.index', compact('srcomplexites'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('srcomplexites.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Srcomplexite::$rules);

		if ($validation->passes())
		{
			$this->srcomplexite->create($input);

			return Redirect::back()
			->with('tab_actif', 3);
		}

		return Redirect::back()
		->with('tab_actif', 3)
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
		$srcomplexite = $this->srcomplexite->findOrFail($id);

		return View::make('srcomplexites.show', compact('srcomplexite'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$srcomplexite = $this->srcomplexite->find($id);

		if (is_null($srcomplexite))
		{
			return Redirect::route('srcomplexites.index');
		}

		return View::make('srcomplexites.edit', compact('srcomplexite'));
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
		$validation = Validator::make($input, Srcomplexite::$rules);

		if ($validation->passes())
		{
			$srcomplexite = $this->srcomplexite->find($id);
			$srcomplexite->update($input);

			return Redirect::route('srcomplexites.show', $id);
		}

		return Redirect::route('srcomplexites.edit', $id)
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
		$this->srcomplexite->find($id)->delete();

		return Redirect::route('srcomplexites.index');
	}

}
