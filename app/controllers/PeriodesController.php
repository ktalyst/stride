<?php

class PeriodesController extends BaseController {

	/**
	 * Periode Repository
	 *
	 * @var Periode
	 */
	protected $periode;

	public function __construct(Periode $periode)
	{
		$this->periode = $periode;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$periodes = $this->periode->all();

		return View::make('periodes.index', compact('periodes'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('periodes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$coefficients = Input::get('coefficient');
		foreach ($coefficients as $key => $value) 
		{
			$periode = Periode::create(array('periodeDebut' => date('Y-m-j')));
			$periode->users()->attach($key, array('coefficient' => $value));
			
		}
		return Redirect::route('periodes.index');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$periode = $this->periode->findOrFail($id);
		return View::make('periodes.show', compact('periode'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$periode = $this->periode->find($id);

		if (is_null($periode))
		{
			return Redirect::route('periodes.index');
		}

		return View::make('periodes.edit', compact('periode'));
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
		$validation = Validator::make($input, Periode::$rules);

		if ($validation->passes())
		{
			$periode = $this->periode->find($id);
			$periode->update($input);

			return Redirect::route('periodes.show', $id);
		}

		return Redirect::route('periodes.edit', $id)
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
		$this->periode->find($id)->delete();

		return Redirect::route('periodes.index');
	}

}
