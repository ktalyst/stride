<?php

class DomainesController extends BaseController {

	/**
	 * Domaine Repository
	 *
	 * @var Domaine
	 */
	protected $domaine;

	public function __construct(Domaine $domaine)
	{
		$this->domaine = $domaine;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$domaines = $this->domaine->all();

		return View::make('domaines.index', compact('domaines'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('domaines.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Domaine::$rules);

		if ($validation->passes())
		{
			$this->domaine->create($input);

			return Redirect::back()
				->with('tab_actif', 1);
		}

		return Redirect::back()
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
		$domaine = $this->domaine->findOrFail($id);

		return View::make('domaines.show', compact('domaine'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		return View::make('domaines.edit');
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
		$validation = Validator::make($input, Domaine::$rules);

		if ($validation->passes())
		{
			$domaine = $this->domaine->find($id);
			$domaine->update($input);

			return Redirect::route('domaines.show', $id);
		}

		return Redirect::route('domaines.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	public function allocate()
	{
		$id = Input::get('domaine_id');
		$domaine = Domaine::findOrFail($id);
		DB::transaction(function() use($domaine)
		{
			$users = array_unique(Input::get('users'));
			foreach($users as $user_id)
			{
				if($user_id == Input::get('responsable'))
				{
					$domaine->users()->attach($user_id, array('estResponsable' => true));
				}
				else
				{
					$domaine->users()->attach($user_id, array('estResponsable' => false));
				}
			}
		}); 
		return Redirect::route('domaines.show', $id);
	}	

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->domaine->find($id)->delete();

		return Redirect::route('domaines.index');
	}

}
