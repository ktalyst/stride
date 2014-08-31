<?php

class ClientsController extends BaseController {

	/**
	 * Client Repository
	 *
	 * @var Client
	 */
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$clients = $this->client->all();

		return View::make('clients.index', compact('clients'), array('actif' => 1));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('clients.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$clients = Input::get('clientNom');
		foreach($clients as $nom)
		{
			$input = array('clientNom' => $nom);
			$validation = Validator::make($input, Client::$rules);
			if (!$validation->passes())
			{
				return Redirect::route('clients.index')
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
			}
		}
		foreach($clients as $nom)
		{
			$input = array('clientNom' => $nom);
			$this->client->create($input);
			
		}
		return Redirect::route('clients.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$client = $this->client->findOrFail($id);

		return View::make('clients.show', compact('client'), array('actif' => 1));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$client = $this->client->find($id);

		if (is_null($client))
		{
			return Redirect::route('clients.index');
		}

		return View::make('clients.edit', compact('client'));
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
		$validation = Validator::make($input, Client::$rules);

		if ($validation->passes())
		{
			$client = $this->client->find($id);
			$client->update($input);

			return Redirect::route('clients.show', $id);
		}

		return Redirect::route('clients.edit', $id)
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
		$this->client->find($id)->delete();

		return Redirect::route('clients.index');
	}

}
