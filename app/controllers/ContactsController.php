<?php

class ContactsController extends BaseController {

	/**
	 * Contact Repository
	 *
	 * @var Contact
	 */
	protected $contact;

	public function __construct(Contact $contact)
	{
		$this->contact = $contact;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contacts = $this->contact->all();

		return View::make('contacts.index', compact('contacts'), array('actif' => 1));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('contacts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{	
		$contacts = Input::get('contacts');
		$client = Input::get('client');
		foreach($contacts as $contact)
		{
			$adresse = $contact['adresse'];
			$adresse = Adresse::create($adresse);
			$input = array('contactNom' => $contact['nom'], 'contactPrenom' => $contact['prenom'], 'client_id' => $client, 'adresse_id' => $adresse->id);
			$contact = $this->contact->create($input);
			$adresse->contact_id = $contact->id;
			$adresse->save();
		}
		return Redirect::route('clients.show', $client);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$contact = $this->contact->findOrFail($id);

		return View::make('contacts.show', compact('contact'), array('actif' => 1));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$contact = $this->contact->find($id);

		if (is_null($contact))
		{
			return Redirect::route('contacts.index');
		}

		return View::make('contacts.edit', compact('contact'));
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
		$validation = Validator::make($input, Contact::$rules);

		if ($validation->passes())
		{
			$contact = $this->contact->find($id);
			$contact->update($input);

			return Redirect::route('contacts.show', $id);
		}

		return Redirect::route('contacts.edit', $id)
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
		if(Request::ajax()) 
		{
			$contact = $this->contact->find($id);
			$contact->delete();
			return Response::make(array($id));
		}	
	}

}
