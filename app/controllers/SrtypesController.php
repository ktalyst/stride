<?php

class SrtypesController extends BaseController {

	/**
	 * Srtype Repository
	 *
	 * @var Srtype
	 */
	protected $srtype;

	public function __construct(Srtype $srtype)
	{
		$this->srtype = $srtype;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$srtypes = $this->srtype->all();

		return View::make('srtypes.index', compact('srtypes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('srtypes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Srtype::$rules);
		if ($validation->passes())
		{
			$this->srtype->create($input);

			return Redirect::back()
				->with('tab_actif', 2);
		}
		return Redirect::back()
		->with('tab_actif', 2)
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
		$srtype = $this->srtype->findOrFail($id);

		return View::make('srtypes.show', compact('srtype'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$srtype = $this->srtype->find($id);

		if (is_null($srtype))
		{
			return Redirect::route('srtypes.index');
		}

		return View::make('srtypes.edit', compact('srtype'));
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
		$validation = Validator::make($input, Srtype::$rules);

		if ($validation->passes())
		{
			$srtype = $this->srtype->find($id);
			$srtype->update($input);

			return Redirect::route('srtypes.show', $id);
		}

		return Redirect::route('srtypes.edit', $id)
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
		$this->srtype->find($id)->delete();

		return Redirect::route('srtypes.index');
	}

}
