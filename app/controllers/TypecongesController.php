<?php

class TypecongesController extends BaseController {

	/**
	 * Typeconge Repository
	 *
	 * @var Typeconge
	 */
	protected $typeconge;

	public function __construct(Typeconge $typeconge)
	{
		$this->typeconge = $typeconge;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$typeconges = $this->typeconge->all();

		return View::make('typeconges.index', compact('typeconges'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('typeconges.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Typeconge::$rules);

		if ($validation->passes())
		{
			$this->typeconge->create($input);

			return Redirect::route('typeconges.index');
		}

		return Redirect::route('typeconges.create')
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
		$typeconge = $this->typeconge->findOrFail($id);

		return View::make('typeconges.show', compact('typeconge'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$typeconge = $this->typeconge->find($id);

		if (is_null($typeconge))
		{
			return Redirect::route('typeconges.index');
		}

		return View::make('typeconges.edit', compact('typeconge'));
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
		$validation = Validator::make($input, Typeconge::$rules);

		if ($validation->passes())
		{
			$typeconge = $this->typeconge->find($id);
			$typeconge->update($input);

			return Redirect::route('typeconges.show', $id);
		}

		return Redirect::route('typeconges.edit', $id)
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
		$this->typeconge->find($id)->delete();

		return Redirect::route('typeconges.index');
	}

}
