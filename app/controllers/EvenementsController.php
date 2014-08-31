<?php

class EvenementsController extends BaseController {

	/**
	 * Evenement Repository
	 *
	 * @var Evenement
	 */
	protected $evenement;

	public function __construct(Evenement $evenement)
	{
		$this->evenement = $evenement;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$evenements = $this->evenement->all();

		return View::make('evenements.index', compact('evenements'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('evenements.create', array('actif' => 0));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Evenement::$rules);

		if ($validation->passes())
		{
			$evt = $this->evenement->create($input);
			$evt->user_id=Auth::user()->id;
			$evt->save();

			return Redirect::route('evenements.index');
		}

		return Redirect::route('evenements.create')
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
		$evenement = $this->evenement->findOrFail($id);

		return View::make('evenements.show', compact('evenement'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$evenement = $this->evenement->find($id);

		if (is_null($evenement))
		{
			return Redirect::route('evenements.index');
		}

		return View::make('evenements.edit', compact('evenement'));
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
		$validation = Validator::make($input, Evenement::$rules);

		if ($validation->passes())
		{
			$evenement = $this->evenement->find($id);
			$evenement->update($input);

			return Redirect::route('evenements.index');
		}

		return Redirect::route('evenements.edit', $id)
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
		$this->evenement->find($id)->delete();

		return Redirect::route('evenements.index');
	}

}
