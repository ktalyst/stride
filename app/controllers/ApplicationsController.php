<?php

class ApplicationsController extends BaseController {

	/**
	 * Application Repository
	 *
	 * @var Application
	 */
	protected $application;

	public function __construct(Application $application)
	{
		$this->application = $application;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$applications = $this->application->all();

		return View::make('applications.index', compact('applications'), array('actif' => 1));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('applications.create', array('actif' => 1));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Application::$rules);

		if ($validation->passes())
		{
			$this->application->create($input);
			return Redirect::route('contacts.index');
		}

		return Redirect::route('applications.create')
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
		$application = $this->application->findOrFail($id);

		return View::make('applications.show', compact('application'), array('actif' => 1));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$application = $this->application->find($id);

		if (is_null($application))
		{
			return Redirect::route('applications.index');
		}

		return View::make('applications.edit', compact('application'));
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
		$validation = Validator::make($input, Application::$rules);

		if ($validation->passes())
		{
			$application = $this->application->find($id);
			$application->update($input);

			return Redirect::route('applications.show', $id);
		}

		return Redirect::route('applications.edit', $id)
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
		$this->application->find($id)->delete();

		return Redirect::route('applications.index');
	}

}
