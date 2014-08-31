-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 31 Août 2014 à 15:29
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `stride`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresses`
--

CREATE TABLE IF NOT EXISTS `adresses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `rue` text COLLATE utf8_unicode_ci NOT NULL,
  `codepostal` int(11) NOT NULL,
  `ville` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `adresses_contact_id_foreign` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `applicationCode` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `applicationLibelle` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `domaine_id` int(10) unsigned DEFAULT NULL,
  `contact_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `applications_applicationcode_unique` (`applicationCode`),
  KEY `applications_domaine_id_foreign` (`domaine_id`),
  KEY `applications_contact_id_foreign` (`contact_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `catalogues`
--

CREATE TABLE IF NOT EXISTS `catalogues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catalogueCode` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `catalogueLibelle` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `catalogueDescription` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `catalogues_cataloguecode_unique` (`catalogueCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clientNom` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `clients_clientnom_unique` (`clientNom`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commandeCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contrat_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `commandes_contrat_id_foreign` (`contrat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

CREATE TABLE IF NOT EXISTS `conges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `datedebutConge` date NOT NULL,
  `datefinConge` date NOT NULL,
  `congeJours` decimal(8,2) NOT NULL,
  `congeStatut` enum('accepte','refuse','en attente') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en attente',
  `typeConges` enum('conges payes','abscence non remunerée','conges exceptionnels','recuperation') COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contactNom` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `contactPrenom` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(10) unsigned DEFAULT NULL,
  `adresse_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `contacts_client_id_foreign` (`client_id`),
  KEY `contacts_adresse_id_foreign` (`adresse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `contrats`
--

CREATE TABLE IF NOT EXISTS `contrats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contratCode` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `contratLibelle` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `contrats_contratcode_unique` (`contratCode`),
  KEY `contrats_client_id_foreign` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `crjs`
--

CREATE TABLE IF NOT EXISTS `crjs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `crjs` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `datecontrats`
--

CREATE TABLE IF NOT EXISTS `datecontrats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateDebut` date NOT NULL,
  `dateFin` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `datecontrat_workpackage`
--

CREATE TABLE IF NOT EXISTS `datecontrat_workpackage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prixDeVente` decimal(8,2) NOT NULL,
  `datecontrat_id` int(10) unsigned DEFAULT NULL,
  `workpackage_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `datecontrat_workpackage_datecontrat_id_foreign` (`datecontrat_id`),
  KEY `datecontrat_workpackage_workpackage_id_foreign` (`workpackage_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `demandeclients`
--

CREATE TABLE IF NOT EXISTS `demandeclients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `demandeclientCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `demandeclientTitre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `demandeclientEtat` enum('terminée','en cours','enregistrée') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'enregistrée',
  `dateDebut` date NOT NULL,
  `dateFinPrevue` date NOT NULL,
  `pourcentage` decimal(8,2) NOT NULL,
  `application_id` int(10) unsigned DEFAULT NULL,
  `srtype_id` int(10) unsigned DEFAULT NULL,
  `srcomplexite_id` int(10) unsigned DEFAULT NULL,
  `item_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `demandeclients_application_id_foreign` (`application_id`),
  KEY `demandeclients_srtype_id_foreign` (`srtype_id`),
  KEY `demandeclients_srcomplexite_id_foreign` (`srcomplexite_id`),
  KEY `demandeclients_item_id_foreign` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `demandeclient_service`
--

CREATE TABLE IF NOT EXISTS `demandeclient_service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uo` decimal(8,2) NOT NULL,
  `demandeclient_id` int(10) unsigned DEFAULT NULL,
  `service_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `demandeclient_service_demandeclient_id_foreign` (`demandeclient_id`),
  KEY `demandeclient_service_service_id_foreign` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE IF NOT EXISTS `departements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `departementCode` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `departementResponsable` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `departements_departementcode_unique` (`departementCode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

CREATE TABLE IF NOT EXISTS `domaines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domaineCode` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `domaineLibelle` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `contrat_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `domaines_domainecode_unique` (`domaineCode`),
  KEY `domaines_contrat_id_foreign` (`contrat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `domaine_user`
--

CREATE TABLE IF NOT EXISTS `domaine_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domaine_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `estResponsable` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `domaine_user_user_id_foreign` (`user_id`),
  KEY `domaine_user_domaine_id_foreign` (`domaine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `effectuetache`
--

CREATE TABLE IF NOT EXISTS `effectuetache` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `raf` decimal(8,2) NOT NULL,
  `chargeL` decimal(8,2) NOT NULL,
  `chargeMa` decimal(8,2) NOT NULL,
  `chargeMe` decimal(8,2) NOT NULL,
  `chargeJ` decimal(8,2) NOT NULL,
  `chargeV` decimal(8,2) NOT NULL,
  `valide` tinyint(1) NOT NULL,
  `tachestep_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `semaine_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `effectuetache_tachestep_id_foreign` (`tachestep_id`),
  KEY `effectuetache_user_id_foreign` (`user_id`),
  KEY `effectuetache_semaine_id_foreign` (`semaine_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

CREATE TABLE IF NOT EXISTS `evenements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `dateFin` datetime DEFAULT NULL,
  `categorie` enum('to do','note','réunion','milestone') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'to do',
  `text` text COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `evenements_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `instanciations`
--

CREATE TABLE IF NOT EXISTS `instanciations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contrat_id` int(10) unsigned NOT NULL,
  `catalogue_id` int(10) unsigned DEFAULT NULL,
  `datecontrat_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `instanciations_contrat_id_foreign` (`contrat_id`),
  KEY `instanciations_catalogue_id_foreign` (`catalogue_id`),
  KEY `instanciations_datecontrat_id_foreign` (`datecontrat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `itemCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `itemLibelle` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `itemMontant` decimal(8,2) NOT NULL,
  `date` date NOT NULL,
  `itemStatut` enum('ouvert','clos','en attente') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en attente',
  `commande_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `items_commande_id_foreign` (`commande_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_08_22_074453_stride', 1),
('2014_08_27_065425_create_password_reminders_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_reminders_email_index` (`email`),
  KEY `password_reminders_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `periodes`
--

CREATE TABLE IF NOT EXISTS `periodes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `periodeDebut` date NOT NULL,
  `periodeFin` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `periode_user`
--

CREATE TABLE IF NOT EXISTS `periode_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `coefficient` decimal(8,2) NOT NULL,
  `periode_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `periode_user_periode_id_foreign` (`periode_id`),
  KEY `periode_user_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `semaines`
--

CREATE TABLE IF NOT EXISTS `semaines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lundi` date NOT NULL,
  `vendredi` date NOT NULL,
  `numeroSemaine` int(11) NOT NULL,
  `derniereSemaine` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serviceCode` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `serviceLibelle` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `catalogue_id` int(10) unsigned DEFAULT NULL,
  `workpackage_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_servicecode_unique` (`serviceCode`),
  KEY `services_catalogue_id_foreign` (`catalogue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `srcomplexites`
--

CREATE TABLE IF NOT EXISTS `srcomplexites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `srcomplexiteCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `srcomplexiteLibelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contrat_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `srcomplexites_contrat_id_foreign` (`contrat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `srtypes`
--

CREATE TABLE IF NOT EXISTS `srtypes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `srtypeCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `srtypeLibelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contrat_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `srtypes_contrat_id_foreign` (`contrat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tacheexternes`
--

CREATE TABLE IF NOT EXISTS `tacheexternes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tacheExterneCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tacheExterneLibelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tacheservices`
--

CREATE TABLE IF NOT EXISTS `tacheservices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tacheserviceCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tacheserviceLibelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tacheservicePourcentage` decimal(8,2) NOT NULL,
  `service_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tacheservices_service_id_foreign` (`service_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tachesteps`
--

CREATE TABLE IF NOT EXISTS `tachesteps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tachestepCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tachestepLibelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chargeinit` decimal(8,2) NOT NULL,
  `raf` decimal(8,2) NOT NULL,
  `demandeclient_id` int(10) unsigned DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tacheservice_id` int(10) unsigned DEFAULT NULL,
  `tacheexterne_id` int(10) unsigned DEFAULT NULL,
  `tachetransverse_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tachesteps_demandeclient_id_foreign` (`demandeclient_id`),
  KEY `tachesteps_tacheservice_id_foreign` (`tacheservice_id`),
  KEY `tachesteps_tacheexterne_id_foreign` (`tacheexterne_id`),
  KEY `tachesteps_tachetransverse_id_foreign` (`tachetransverse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tachestep_user`
--

CREATE TABLE IF NOT EXISTS `tachestep_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateAffectation` date NOT NULL,
  `tachestep_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tachestep_user_tachestep_id_foreign` (`tachestep_id`),
  KEY `tachestep_user_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tachetransverses`
--

CREATE TABLE IF NOT EXISTS `tachetransverses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tachetransverseCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tachetransverseLibelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tachetransversePourcentage` decimal(8,2) NOT NULL,
  `contrat_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tachetransverses_contrat_id_foreign` (`contrat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

CREATE TABLE IF NOT EXISTS `unites` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unitworkload` decimal(8,2) NOT NULL,
  `service_id` int(10) unsigned NOT NULL,
  `datecontrat_id` int(10) unsigned DEFAULT NULL,
  `srtype_id` int(10) unsigned DEFAULT NULL,
  `srcomplexite_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `unites_service_id_foreign` (`service_id`),
  KEY `unites_datecontrat_id_foreign` (`datecontrat_id`),
  KEY `unites_srtype_id_foreign` (`srtype_id`),
  KEY `unites_srcomplexite_id_foreign` (`srcomplexite_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userMatricule` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userNom` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userPrenom` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `departement_id` int(10) unsigned DEFAULT NULL,
  `userFonction` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `mdpemail` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `userTelephone` int(11) NOT NULL,
  `userStatut` enum('user','admin','responsable','manager') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'user',
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_usermatricule_unique` (`userMatricule`),
  KEY `users_departement_id_foreign` (`departement_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `userMatricule`, `username`, `userNom`, `userPrenom`, `departement_id`, `userFonction`, `email`, `mdpemail`, `userTelephone`, `userStatut`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', '', '', NULL, '', 'admin@plop.fr', '', 0, 'admin', '$2y$10$tQV3kS98gpMs33dSMpwH3O8ezlDsuY3GvMpJMJwqBy6CoCyC3Lhqa', NULL, '2014-08-31 11:28:40', '2014-08-31 11:28:40'),
(2, NULL, 'Paul', '', '', NULL, '', 'paul@plop.fr', '', 0, 'admin', '$2y$10$G2MJ0oaiWQrx2D3N/jDBgOzT9EmY2uhpBvsIsRDoWvMRoyK6f98Cq', NULL, '2014-08-31 11:28:40', '2014-08-31 11:28:40'),
(3, NULL, 'Jean', '', '', NULL, '', 'jean@plop.fr', '', 0, 'user', '$2y$10$MAJDfKZmHEG4TM3wklHWlezhTuqNhYFWbZwl3Dk6o5eJZb2IAY.WW', NULL, '2014-08-31 11:28:40', '2014-08-31 11:28:40');

-- --------------------------------------------------------

--
-- Structure de la table `workpackages`
--

CREATE TABLE IF NOT EXISTS `workpackages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `workpackageLibelle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contrat_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `workpackages_contrat_id_foreign` (`contrat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `adresses`
--
ALTER TABLE `adresses`
  ADD CONSTRAINT `adresses_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION;

--
-- Contraintes pour la table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `applications_domaine_id_foreign` FOREIGN KEY (`domaine_id`) REFERENCES `domaines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_adresse_id_foreign` FOREIGN KEY (`adresse_id`) REFERENCES `adresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contacts_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contrats`
--
ALTER TABLE `contrats`
  ADD CONSTRAINT `contrats_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `datecontrat_workpackage`
--
ALTER TABLE `datecontrat_workpackage`
  ADD CONSTRAINT `datecontrat_workpackage_workpackage_id_foreign` FOREIGN KEY (`workpackage_id`) REFERENCES `workpackages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `datecontrat_workpackage_datecontrat_id_foreign` FOREIGN KEY (`datecontrat_id`) REFERENCES `datecontrats` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `demandeclients`
--
ALTER TABLE `demandeclients`
  ADD CONSTRAINT `demandeclients_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `items` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `demandeclients_application_id_foreign` FOREIGN KEY (`application_id`) REFERENCES `applications` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `demandeclients_srcomplexite_id_foreign` FOREIGN KEY (`srcomplexite_id`) REFERENCES `srcomplexites` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `demandeclients_srtype_id_foreign` FOREIGN KEY (`srtype_id`) REFERENCES `srtypes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `demandeclient_service`
--
ALTER TABLE `demandeclient_service`
  ADD CONSTRAINT `demandeclient_service_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION,
  ADD CONSTRAINT `demandeclient_service_demandeclient_id_foreign` FOREIGN KEY (`demandeclient_id`) REFERENCES `demandeclients` (`id`) ON DELETE NO ACTION;

--
-- Contraintes pour la table `domaines`
--
ALTER TABLE `domaines`
  ADD CONSTRAINT `domaines_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `domaine_user`
--
ALTER TABLE `domaine_user`
  ADD CONSTRAINT `domaine_user_domaine_id_foreign` FOREIGN KEY (`domaine_id`) REFERENCES `domaines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `domaine_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `effectuetache`
--
ALTER TABLE `effectuetache`
  ADD CONSTRAINT `effectuetache_semaine_id_foreign` FOREIGN KEY (`semaine_id`) REFERENCES `semaines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `effectuetache_tachestep_id_foreign` FOREIGN KEY (`tachestep_id`) REFERENCES `tachesteps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `effectuetache_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `evenements`
--
ALTER TABLE `evenements`
  ADD CONSTRAINT `evenements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `instanciations`
--
ALTER TABLE `instanciations`
  ADD CONSTRAINT `instanciations_datecontrat_id_foreign` FOREIGN KEY (`datecontrat_id`) REFERENCES `datecontrats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `instanciations_catalogue_id_foreign` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogues` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `instanciations_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_commande_id_foreign` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `periode_user`
--
ALTER TABLE `periode_user`
  ADD CONSTRAINT `periode_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `periode_user_periode_id_foreign` FOREIGN KEY (`periode_id`) REFERENCES `periodes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_catalogue_id_foreign` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogues` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `srcomplexites`
--
ALTER TABLE `srcomplexites`
  ADD CONSTRAINT `srcomplexites_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `srtypes`
--
ALTER TABLE `srtypes`
  ADD CONSTRAINT `srtypes_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `tacheservices`
--
ALTER TABLE `tacheservices`
  ADD CONSTRAINT `tacheservices_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `tachesteps`
--
ALTER TABLE `tachesteps`
  ADD CONSTRAINT `tachesteps_tachetransverse_id_foreign` FOREIGN KEY (`tachetransverse_id`) REFERENCES `tachetransverses` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tachesteps_demandeclient_id_foreign` FOREIGN KEY (`demandeclient_id`) REFERENCES `demandeclients` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tachesteps_tacheexterne_id_foreign` FOREIGN KEY (`tacheexterne_id`) REFERENCES `tacheexternes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tachesteps_tacheservice_id_foreign` FOREIGN KEY (`tacheservice_id`) REFERENCES `tacheservices` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `tachestep_user`
--
ALTER TABLE `tachestep_user`
  ADD CONSTRAINT `tachestep_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tachestep_user_tachestep_id_foreign` FOREIGN KEY (`tachestep_id`) REFERENCES `tachesteps` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `tachetransverses`
--
ALTER TABLE `tachetransverses`
  ADD CONSTRAINT `tachetransverses_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `unites`
--
ALTER TABLE `unites`
  ADD CONSTRAINT `unites_srcomplexite_id_foreign` FOREIGN KEY (`srcomplexite_id`) REFERENCES `srcomplexites` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `unites_datecontrat_id_foreign` FOREIGN KEY (`datecontrat_id`) REFERENCES `datecontrats` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `unites_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `unites_srtype_id_foreign` FOREIGN KEY (`srtype_id`) REFERENCES `srtypes` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `workpackages`
--
ALTER TABLE `workpackages`
  ADD CONSTRAINT `workpackages_contrat_id_foreign` FOREIGN KEY (`contrat_id`) REFERENCES `contrats` (`id`) ON DELETE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
