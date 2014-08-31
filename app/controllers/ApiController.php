<?php
class ApiController extends BaseController
{
    public function __construct()
    {}

    /**
     * Return a list of contacts
     *
     * @return Model
     */
    public function getIndex()
    {
        $input = Input::get('option');
        $client = Client::find($input);
        $contacts = $client->contacts->lists('nom', 'id');
        return $contacts;
    }

    /**
     * Return a list of services
     *
     * @return Model
     */
    public function getIndexCatalogue()
    {
        $input = Input::get('option');
        $contrat = Contrat::find($input);
        $instanciations = Instanciation::where('contrat_id', '=', $contrat->id)->get(); 

        $services = array();
        foreach($instanciations as $i)
        {
            if($i->datecontrat->dateFin > date('Y-m-d'))
            {
                foreach($i->catalogue->services as $s)
                {
                    array_push($services, $s);
                }
            }
        }
        return array('services' => $services);
    }

    /**
     * Return a list of contrats
     *
     * @return Model
     */
    public function getIndexCommande()
    {
        $input = Input::get('option');
        $client = Client::find($input);
        $contrats = $client->contrats->lists('contratCode', 'id');
        return $contrats;
    }

    /**
     * Return a list of contrats
     *
     * @return Model
     */
    public function getIndexPO()
    {
        $input = Input::get('option');
        $contrat = Contrat::find($input);
        $commandes = $contrat->commandes->lists('commandeCode', 'id');
        return $commandes;
    }

    /**
     * Return a list of commandes
     *
     * @return Model
     */
    public function getIndexContrat()
    {
        $input = Input::get('option');
        $contrat = Contrat::find($input);
        $catalogues = $contrat->catalogues->lists('nom', 'id');
        return $catalogues;
    }

    /**
     * Return a list of items
     *
     * @return Model
     */    
    public function getIndexItem()
    {
        $input = Input::get('option');
        $commande = Commande::find($input);
        $items = $commande->items->lists('itemCode', 'id');
        return $items;
    }

    /**
     * Return a list of instanciations
     *
     * @return Model
     */
    public function getIndexIntanciation()
    {
        $input = Input::get('option');
        $instanciation = Instanciation::find($input);
        $contrat = $instanciation->contrat;
        $catalogue = $instanciation->catalogue;
        return array('contrat' => $contrat, 'catalogue' => $catalogue);
    }
}