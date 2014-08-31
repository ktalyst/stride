<?php

class InstanciationsController extends BaseController {

	/**
	 * Instanciation Repository
	 *
	 * @var Instanciation
	 */
	protected $instanciation;

	public function __construct(Instanciation $instanciation)
	{
		$this->instanciation = $instanciation;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$instanciations = $this->instanciation->all();

		return View::make('instanciations.index', compact('instanciations'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('instanciations.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Instanciation::$rules);

		if ($validation->passes())
		{
			$this->instanciation->create($input);

			return Redirect::route('instanciations.index');
		}

		return Redirect::route('instanciations.create')
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
		$instanciation = $this->instanciation->findOrFail($id);

		return View::make('instanciations.show', compact('instanciation'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$instanciation = $this->instanciation->find($id);

		if (is_null($instanciation))
		{
			return Redirect::route('instanciations.index');
		}

		return View::make('instanciations.edit', compact('instanciation'));
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
		$validation = Validator::make($input, Instanciation::$rules);

		if ($validation->passes())
		{
			$instanciation = $this->instanciation->find($id);
			$instanciation->update($input);

			return Redirect::route('instanciations.show', $id);
		}

		return Redirect::route('instanciations.edit', $id)
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
		$this->instanciation->find($id)->delete();

		return Redirect::route('instanciations.index');
	}

}
