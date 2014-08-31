<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class Stride extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('departements', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('departementCode', 64)->unique();
			$table->string('departementResponsable', 64);
			$table->timestamps();
		});
		Schema::create('users', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('userMatricule', 64)->unique()->nullable();
			$table->string('username', 64);
			$table->string('userNom', 64);
			$table->string('userPrenom', 64);
			$table->integer('departement_id')->unsigned()->nullable();
			$table->string('userFonction', 64);
			$table->string('email', 64)->unique();
			$table->string('mdpemail', 64);
			$table->integer('userTelephone');
			$table->enum('userStatut', array('user', 'admin', 'responsable', 'manager'))->default('user');
			$table->string('password', 64);
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
		});
		Schema::create('periodes', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->date('periodeDebut');
			$table->date('periodeFin');
			$table->timestamps();
		});
		Schema::create('adresses', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('numero');
			$table->text('rue');
			$table->integer('codepostal');
			$table->string('ville');
			$table->integer('contact_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('crjs', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->decimal('crjs');
			$table->timestamps();
		});
		Schema::create('evenements', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('titre');
			$table->datetime('date');
			$table->datetime('dateFin')->nullable();
			$table->enum('categorie', array('to do', 'note', 'réunion', 'milestone'))->default('to do');
			$table->text('text');
			$table->integer('user_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('periode_user', function(Blueprint $table) {
			$table->increments('id');
			$table->decimal('coefficient');
			$table->integer('periode_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('datecontrat_workpackage', function(Blueprint $table) {
			$table->increments('id');
			$table->decimal('prixDeVente');
			$table->integer('datecontrat_id')->unsigned()->nullable();
			$table->integer('workpackage_id')->unsigned()->nullable();
			$table->timestamps();			
		});
		Schema::create('domaine_user', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->integer('domaine_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->boolean('estResponsable');
			$table->timestamps();
		});
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('clientNom', 64)->unique();
			$table->timestamps();
		});
		Schema::create('contacts', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('contactNom', 64);
			$table->string('contactPrenom', 64);
			$table->integer('client_id')->unsigned()->nullable();
			$table->integer('adresse_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('domaines', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('domaineCode', 64)->unique();
			$table->string('domaineLibelle', 64);
			$table->integer('contrat_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('applications', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('applicationCode', 64)->unique();
			$table->string('applicationLibelle', 64);
			$table->integer('domaine_id')->unsigned()->nullable();
			$table->integer('contact_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('contrats', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('contratCode', 64)->unique();
			$table->string('contratLibelle', 64);
			$table->integer('client_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('catalogues', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('catalogueCode', 64)->unique();
			$table->string('catalogueLibelle', 64);
			$table->text('catalogueDescription');
			$table->timestamps();
		});
		Schema::create('services', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('serviceCode', 64)->unique();
			$table->string('serviceLibelle', 64);
			$table->integer('catalogue_id')->unsigned()->nullable();
			$table->integer('workpackage_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('conges', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->date('datedebutConge');
			$table->date('datefinConge');
			$table->decimal('congeJours');
			$table->enum('congeStatut', array('accepte', 'refuse', 'en attente'))->default('en attente');
			$table->enum('typeConges', array('conges payes', 'abscence non remunerée', 'conges exceptionnels', 'recuperation'));
			$table->integer('user_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('instanciations', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->integer('contrat_id')->unsigned();
			$table->integer('catalogue_id')->unsigned()->nullable();
			$table->integer('datecontrat_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('datecontrats', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->date('dateDebut');
			$table->date('dateFin');
			$table->timestamps();
		});
		Schema::create('commandes', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('commandeCode')->unique;
			$table->integer('contrat_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('items', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('itemCode')->unique;
			$table->string('itemLibelle', 64);
			$table->decimal('itemMontant');
			$table->date('date');
			$table->enum('itemStatut', array('ouvert', 'clos', 'en attente'))->default('en attente');
			$table->integer('commande_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('tachetransverses', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('tachetransverseCode')->unique;
			$table->string('tachetransverseLibelle');
			$table->decimal('tachetransversePourcentage');
			$table->integer('contrat_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('demandeclients', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('demandeclientCode')->unique;
			$table->string('demandeclientTitre');
			$table->enum('demandeclientEtat', array('terminée', 'en cours', 'enregistrée'))->default('enregistrée');
			$table->date('dateDebut');
			$table->date('dateFinPrevue');
			$table->decimal('pourcentage');
			$table->integer('application_id')->unsigned()->nullable();
			$table->integer('srtype_id')->unsigned()->nullable();
			$table->integer('srcomplexite_id')->unsigned()->nullable();
			$table->integer('item_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('srtypes', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('srtypeCode')->unique;
			$table->string('srtypeLibelle');
			$table->integer('contrat_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('srcomplexites', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('srcomplexiteCode')->unique;
			$table->string('srcomplexiteLibelle');
			$table->integer('contrat_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('unites', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->decimal('unitworkload')->unique;
			$table->integer('service_id')->unsigned();
			$table->integer('datecontrat_id')->unsigned()->nullable();
			$table->integer('srtype_id')->unsigned()->nullable();
			$table->integer('srcomplexite_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('tachesteps', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('tachestepCode')->unique;
			$table->string('tachestepLibelle');
			$table->decimal('chargeinit');
			$table->decimal('raf');
			$table->integer('demandeclient_id')->unsigned()->nullable();
			$table->string('type');
			$table->integer('tacheservice_id')->unsigned()->nullable();
			$table->integer('tacheexterne_id')->unsigned()->nullable();
			$table->integer('tachetransverse_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('tachestep_user', function(Blueprint $table) {
			$table->increments('id');
			$table->date('dateAffectation');
			$table->integer('tachestep_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
		});
		Schema::create('effectuetache', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->decimal('raf');
			$table->decimal('chargeL');
			$table->decimal('chargeMa');
			$table->decimal('chargeMe');
			$table->decimal('chargeJ');
			$table->decimal('chargeV');
			$table->boolean('valide');
			$table->integer('tachestep_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->integer('semaine_id')->unsigned()->nullable();
		});
		Schema::create('semaines', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->date('lundi');
			$table->date('vendredi');
			$table->integer('numeroSemaine');
			$table->boolean('derniereSemaine');
		});
		Schema::create('tacheservices', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('tacheserviceCode')->unique;
			$table->string('tacheserviceLibelle');
			$table->decimal('tacheservicePourcentage');
			$table->integer('service_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('tacheExternes', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('tacheExterneCode')->unique;
			$table->string('tacheExterneLibelle');
			$table->timestamps();
		});
		Schema::create('demandeclient_service', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->decimal('uo');
			$table->integer('demandeclient_id')->unsigned()->nullable();
			$table->integer('service_id')->unsigned()->nullable();
			$table->timestamps();
		});
		Schema::create('workpackages', function(Blueprint $table) {
			$table->increments('id')->unsigned;
			$table->string('workpackageLibelle');
			$table->integer('contrat_id')->unsigned()->nullable();
			$table->timestamps();
		});

		Schema::table('datecontrat_workpackage', function(Blueprint $table) {
			$table->foreign('datecontrat_id')->references('id')->on('datecontrats')->onDelete('cascade');
			$table->foreign('workpackage_id')->references('id')->on('workpackages')->onDelete('cascade');	
		});
		Schema::table('evenements', function($table) {
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
		Schema::table('workpackages', function($table) {
			$table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('no action');
		});
		Schema::table('demandeclient_service', function($table) {
			$table->foreign('demandeclient_id')->references('id')->on('demandeclients')->onDelete('no action');
			$table->foreign('service_id')->references('id')->on('services')->onDelete('no action');
		});
		Schema::table('tacheservices', function($table) {
			$table->foreign('service_id')->references('id')->on('services')->onDelete('no action')->onUpdate('cascade');
		});
		Schema::table('effectuetache', function($table) {
			$table->foreign('tachestep_id')->references('id')->on('tachesteps')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('semaine_id')->references('id')->on('semaines')->onDelete('cascade');
		});
		Schema::table('tachestep_user', function($table) {
			$table->foreign('tachestep_id')->references('id')->on('tachesteps')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
		Schema::table('tachesteps', function($table) {
			$table->foreign('demandeclient_id')->references('id')->on('demandeclients')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('tacheservice_id')->references('id')->on('tacheservices')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('tacheexterne_id')->references('id')->on('tacheExternes')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('tachetransverse_id')->references('id')->on('tachetransverses')->onDelete('no action')->onUpdate('cascade');
		});
		Schema::table('unites', function($table) {
			$table->foreign('service_id')->references('id')->on('services')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('datecontrat_id')->references('id')->on('datecontrats')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('srtype_id')->references('id')->on('srtypes')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('srcomplexite_id')->references('id')->on('srcomplexites')->onDelete('no action')->onUpdate('cascade');
		});
		Schema::table('srtypes', function($table) {
			$table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('cascade')->onUpdate('cascade');
		});
		Schema::table('srcomplexites', function($table) {
			$table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('cascade')->onUpdate('cascade');
		});
		Schema::table('demandeclients', function($table) {
			$table->foreign('application_id')->references('id')->on('applications')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('srtype_id')->references('id')->on('srtypes')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('srcomplexite_id')->references('id')->on('srcomplexites')->onDelete('no action')->onUpdate('cascade');
			$table->foreign('item_id')->references('id')->on('items')->onDelete('no action')->onUpdate('cascade');
		});
		Schema::table('tachetransverses', function($table) {
			$table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('cascade')->onUpdate('cascade');
		});
		Schema::table('items', function($table) {
			$table->foreign('commande_id')->references('id')->on('commandes')->onDelete('cascade')->onUpdate('cascade');
		});
		Schema::table('commandes', function($table) {
			$table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('no action')->onUpdate('no action');
		});
		Schema::table('instanciations', function($table) {
			$table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('no action')->onUpdate('no action');
			$table->foreign('catalogue_id')->references('id')->on('catalogues')->onDelete('no action')->onUpdate('no action');
			$table->foreign('datecontrat_id')->references('id')->on('datecontrats')->onDelete('no action')->onUpdate('no action');
		});
		Schema::table('users', function($table) {
			$table->foreign('departement_id')->references('id')->on('departements')->onDelete('no action')->onUpdate('no action');
		});		
		Schema::table('services', function($table) {
			$table->foreign('catalogue_id')->references('id')->on('catalogues')->onDelete('cascade')->onUpdate('cascade');
		});
		Schema::table('contrats', function($table) {
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
		});
		Schema::table('adresses', function($table) {
			$table->foreign('contact_id')->references('id')->on('contacts')->onDelete('no action');
		});
		Schema::table('applications', function($table) {
			$table->foreign('domaine_id')->references('id')->on('domaines')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('contact_id')->references('id')->on('contacts')->onDelete('no action')->onUpdate('no action');
		});
		Schema::table('domaine_user', function($table) {
			$table->foreign('user_id')->references('id')->on('users')->onDelete('no action')->onUpdate('no action');
			$table->foreign('domaine_id')->references('id')->on('domaines')->onDelete('cascade')->onUpdate('cascade');
		});
		Schema::table('domaines', function($table) {
			$table->foreign('contrat_id')->references('id')->on('contrats')->onDelete('cascade')->onUpdate('cascade');
		});
		Schema::table('contacts', function($table) {
			$table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('adresse_id')->references('id')->on('adresses')->onDelete('cascade')->onUpdate('cascade');
		});
		Schema::table('periode_user', function($table) {
			$table->foreign('periode_id')->references('id')->on('periodes')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
		Schema::drop('periodes');
		Schema::drop('domaine_user');
		Schema::table('domaine_user', function($table) {
			$table->dropForeign('domaine_user_user_id_foreign');
			$table->dropForeign('domaine_user_domaine_id_foreign');
		});
		Schema::drop('clients');
		Schema::drop('contacts');
		Schema::table('contacts', function($table) {
			$table->dropForeign('contacts_client_id_foreign');
			$table->dropForeign('contacts_adresse_id_foreign');
		});		
		Schema::drop('domaines');
		Schema::table('domaines', function($table) {
			$table->dropForeign('domaines_contrat_id_foreign');
		});		
		Schema::drop('applications');
		Schema::table('applications', function($table) {
			$table->dropForeign('applications_contact_id_foreign');
			$table->dropForeign('applications_domaine_id_foreign');
		});
		Schema::drop('catalogues');
		Schema::drop('contrats');	
		Schema::table('contrats', function($table) {
			$table->dropForeign('contrats_client_id_foreign');
		});	
		Schema::drop('services');
		Schema::table('services', function($table) {
			$table->dropForeign('services_catalogue_id_foreign');
		});	
		Schema::drop('periode_user');
		Schema::table('periode_user', function($table) {
			$table->dropForeign('periode_user_periode_id_foreign');
			$table->dropForeign('periode_user_user_id_foreign');
		});	
		Schema::drop('conges');
		Schema::table('conges', function($table) {
			$table->dropForeign('conges_user_id_foreign');
		});	
		Schema::drop('typeconges');
		Schema::drop('instanciations');
		Schema::drop('instanciations', function($table) {
			$table->dropForeignKey('instanciations_catalogue_id');
			$table->dropForeignKey('instanciations_contrat_id');
			$table->dropForeignKey('instanciations_datecontrat_id');
		});
		Schema::drop('datecontrats');
		Schema::drop('commandes');
		Schema::table('commandes', function($table) {
			$table->dropForeign('commandes_contrat_id_foreign');
		});	
		Schema::drop('items');
		Schema::table('items', function($table) {
			$table->dropForeign('items_commande_id_foreign');
		});	
		Schema::drop('tachetransverses');
		Schema::table('tachetransverses', function($table) {
			$table->dropForeign('tachetransverses_contrat_id_foreign');
		});	
		Schema::drop('demandeclients');
		Schema::table('demandeclients', function($table) {
			$table->dropForeign('demandeclient_item_id_foreign');
			$table->dropForeign('demandeclient_application_id_foreign');
			$table->dropForeign('demandeclient_srtype_id_foreign');
			$table->dropForeign('demandeclient_srcomplexite_id_foreign');
		});
		Schema::drop('srtypes');
		Schema::drop('srcomplexites');
		Schema::table('srtypes', function($table) {
			$table->dropForeign('srtypes_contrat_id_foreign');
		});	
		Schema::table('srcomplexites', function($table) {
			$table->dropForeign('srcomplexites_contrat_id_foreign');
		});	
		Schema::drop('unites');
		Schema::table('unites', function($table) {
			$table->dropForeign('unites_datecontrat_id_foreign');
			$table->dropForeign('unites_srtype_id_foreign');
			$table->dropForeign('unites_srcomplexite_id_foreign');
			$table->dropForeign('unites_service_id_foreign');
		});	
		Schema::drop('tachesteps');
		Schema::table('tachesteps', function($table) {
			$table->dropForeign('tachesteps_demandeclient_id_foreign');
			$table->dropForeign('tachesteps_tacheservice_id_foreign');
			$table->dropForeign('tachesteps_tacheexterne_id_foreign');
			$table->dropForeign('tachesteps_tachetransverse_id_foreign');
		});
		Schema::drop('tachestep_user');
		Schema::table('tachestep_user', function($table) {
			$table->dropForeign('tachestep_user_tachestep_id_foreign');
			$table->dropForeign('tachestep_user_user_id_foreign');
		});
		Schema::drop('effectuetache');
		Schema::table('effectuetache', function($table) {
			$table->dropForeign('effectuetache_tachestep_id_foreign');
			$table->dropForeign('effectuetache_user_id_foreign');
			$table->dropForeign('effectuetache_semaine_id_foreign');
		});
		Schema::drop('semaines');
		Schema::drop('tacheservices');
		Schema::table('tacheservices', function($table) {
			$table->dropForeign('tacheservices_service_id_foreign');
		});
		Schema::drop('tacheExternes');
		Schema::drop('demandeclient_service');
		Schema::table('demandeclient_service', function($table) {
			$table->dropForeign('demandeclient_service_demandeclient_id_foreign');
			$table->dropForeign('demandeclient_service_service_id_foreign');
		});
		Schema::drop('adresses');
		Schema::drop('adresses', function($table) {
			$table->dropForeign('adresse_contact_id_foreign');
		});
		Schema::drop('workpackages');
		Schema::drop('workpackages', function($table) {
			$table->dropForeign('workpackages_contrat_id_foreign');
		});
		Schema::drop('demandeclient_item');
		Schema::drop('demandeclient_item', function($table) {
			$table->dropForeign('demandeclient_item_item_id_foreign');
			$table->dropForeign('demandeclient_item_demandeclient_id_foreign');
		});
		Schema::drop('evenements');
		Schema::drop('evenements', function($table) {
			$table->dropForeign('evenement_user_id_foreign');
		});
		Schema::drop('datecontrat_workpackage');
		Schema::drop('datecontrat_workpackage', function($table) {
			$table->dropForeign('datecontrat_workpackage_datecontrat_id_foreign');
			$table->dropForeign('datecontrat_workpackage_workpackage_id_foreign');	
		});
		Schema::drop('crjs');
	}

}
