<?php

class ContratsController extends BaseController {

	/**
	 * Contrat Repository
	 *
	 * @var Contrat
	 */
	protected $contrat;

	public function __construct(Contrat $contrat)
	{
		$this->contrat = $contrat;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contrats = $this->contrat->all();

		return View::make('contrats.index', compact('contrats'), array('actif' => 1));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('contrats.create', array('actif' => 1));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$client = Input::get('client_id');
		$code = Input::get('contratCode');
		$libelle = Input::get('contratLibelle');
		$input = array("contratCode" => $code, "contratLibelle" => $libelle, 'client_id' => $client);

		$contrat = $this->contrat->create($input);
		$date = new DateTime(Input::get('date'));
		$datecontrat = Datecontrat::create(array('dateDebut' => $date->format('Y-m-d'), 'dateFin' => date_add($date, new DateInterval('P1Y'))));
		$catalogues = array_unique(Input::get('catalogues'));
		foreach($catalogues as $catalogue_id)
		{
			$instanciation = Instanciation::create(array('contrat_id' => $contrat->id, 'catalogue_id' => $catalogue_id, 'datecontrat_id' => $datecontrat->id));
		}

		$srts = Input::get('srts');
		if(count($srts)){
			foreach($srts as $srt_id)
			{
				$srt = Srtype::findOrFail($srt_id);
				$srt->contrat_id = $contrat->id;
				$srt->save();
			}
		}
		$srcs = Input::get('srcs');
		if(count($srcs)){
			foreach($srcs as $src_id)
			{
				$src = Srcomplexite::findOrFail($src_id);
				$src->contrat_id = $contrat->id;
				$src->save();
			}	
		}			$domaines = Input::get('domaines');
		if(count($domaines)){
			foreach($domaines as $domaine_id)
			{
				$domaine = Domaine::findOrFail($domaine_id);
				$domaine->contrat_id = $contrat->id;
				$domaine->save();
			}	
		}	
		$taches = Input::get('taches');
		if(count($taches)){
			foreach($taches as $tache_id)
			{
				$tache = Tachetransverse::findOrFail($tache_id);
				$tache->contrat_id = $contrat->id;
				$tache->save();
			}	
		}	
		return Redirect::route('contrats.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$contrat = $this->contrat->findOrFail($id);

		return View::make('contrats.show', compact('contrat'), array('actif' => 1));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$contrat = $this->contrat->find($id);

		if (is_null($contrat))
		{
			return Redirect::route('contrats.index');
		}

		return View::make('contrats.edit', compact('contrat'), array('actif' => 1));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$workload = Input::get('input');
		if($workload){
			foreach($workload as $unit)
			{
				Unite::create($unit);
			}
			return Redirect::route('contrats.index');			
		}
		return Redirect::route('contrats.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->contrat->find($id)->delete();

		return Redirect::route('contrats.index');
	}

}
