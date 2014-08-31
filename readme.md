## Stride 

### Informations en Français sur le framework

[Documentation en français](http://laravel.fr) 

##Inclus

* Twitter Bootstrap pour la mise en forme des pages (design responsive)
* JQuery pour le bon fonctionnement de Bootstrap
* Fichiers de traduction laravel (https://github.com/laravel-france/laravel-lang-fr)
* Pages d'erreur : 403, 404, 500 et 503
* Back-end : Gestion des utilisateurs
* 4 rôles : administrateur, manager, responsable et utilisateur de base
* Front-end : Navigation dans les sections, connexion , inscription, renouvellement du mot de passe de l'utilisateur
* Pages du site : accueil

##Installation

1. Installation classique de Laravel 4
2. Créer une base de données et renseigner le fichier *app/config/database.php*
3. **php artisan migrate** pour créer les tables
4. **php artisan db:seed** pour ajouter des enregistrements

## Fonctionnalités à apporter

* Terminer les validations des formulaires (notamment lors de l'ajout dynamique)
* Récupérer les "anciennes" affectations si il y en a, lors de l'affectation des ressources
* Revoir le modèle Contrat - Catalogue - Datecontrat
* Rajouter un historique pour le CRJS
* Terminer la partie financière
* Vérifier les charges entrées lors de l'affectation des ressources aux taches
* Améliorer les requêtes à la base de données, surtout au niveau de l'affectation des ressources
* Terminer l'historique sur la notation des ressources
* Ajouter la possibilité de voir les taches qui ne sont pas attribuées et se les attribuer en tant qu'utilisateur
* Ajouter le calcul du réestimé
* Terminer la validation d'un step
* Ajouter une relation MorphTo entre tachestep et (tacheservice, tachetransverse, tacheexterne)
* Possibilité de mettre à jour les unit workload
* Terminer la traduction


