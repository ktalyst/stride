<?php

class SemainesController extends BaseController {

	/**
	 * Semaine Repository
	 *
	 * @var Semaine
	 */
	protected $semaine;

	public function __construct(Semaine $semaine)
	{
		$this->semaine = $semaine;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$semaines = $this->semaine->all();

		return View::make('semaines.index', compact('semaines'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('semaines.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Semaine::$rules);

		if ($validation->passes())
		{
			$this->semaine->create($input);

			return Redirect::route('semaines.index');
		}

		return Redirect::route('semaines.create')
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
		$semaine = $this->semaine->findOrFail($id);

		return View::make('semaines.show', compact('semaine'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$semaine = $this->semaine->find($id);

		if (is_null($semaine))
		{
			return Redirect::route('semaines.index');
		}

		return View::make('semaines.edit', compact('semaine'));
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
		$validation = Validator::make($input, Semaine::$rules);

		if ($validation->passes())
		{
			$semaine = $this->semaine->find($id);
			$semaine->update($input);

			return Redirect::route('semaines.show', $id);
		}

		return Redirect::route('semaines.edit', $id)
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
		$this->semaine->find($id)->delete();

		return Redirect::route('semaines.index');
	}

}
