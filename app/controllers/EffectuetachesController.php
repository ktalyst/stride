<?php

class EffectuetachesController extends BaseController {

	/**
	 * Effectuetache Repository
	 *
	 * @var Effectuetache
	 */
	protected $effectuetache;

	public function __construct(Effectuetache $effectuetache)
	{
		$this->effectuetache = $effectuetache;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$effectuetaches = $this->effectuetache->all();

		return View::make('effectuetaches.index', compact('effectuetaches'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('effectuetaches.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$charges = Input::get('charges');

		$input = Input::all();
		$validation = Validator::make($input, Effectuetache::$rules);

		if ($validation->passes())
		{
			$this->effectuetache->create($input);

			return Redirect::route('effectuetaches.index');
		}

		return Redirect::route('effectuetaches.create')
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
		$effectuetache = $this->effectuetache->findOrFail($id);

		return View::make('effectuetaches.show', compact('effectuetache'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$effectuetache = $this->effectuetache->find($id);

		if (is_null($effectuetache))
		{
			return Redirect::route('effectuetaches.index');
		}

		return View::make('effectuetaches.edit', compact('effectuetache'));
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
		$validation = Validator::make($input, Effectuetach::$rules);

		if ($validation->passes())
		{
			$effectuetache = $this->effectuetache->find($id);
			$effectuetache->update($input);

			return Redirect::route('effectuetaches.show', $id);
		}

		return Redirect::route('effectuetaches.edit', $id)
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
		$this->effectuetache->find($id)->delete();

		return Redirect::route('effectuetaches.index');
	}

}
