-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 29 déc. 2022 à 10:48
-- Version du serveur : 5.7.34
-- Version de PHP : 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `p2020739`
--

-- --------------------------------------------------------

--
-- Structure de la table `COMPREND`
--

DROP TABLE IF EXISTS `COMPREND`;
CREATE TABLE `COMPREND` (
  `ID_LIVRAISON` int(11) NOT NULL,
  `ID_PRODUIT` int(11) NOT NULL,
  `QUANTITE_LIVREE` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `COMPREND`
--

INSERT INTO `COMPREND` (`ID_LIVRAISON`, `ID_PRODUIT`, `QUANTITE_LIVREE`) VALUES
(1, 1, '13'),
(1, 5, '16'),
(1, 7, '17'),
(1, 12, '21'),
(2, 1, '20'),
(2, 2, '20'),
(2, 6, '3'),
(2, 10, '16'),
(2, 14, '3'),
(3, 5, '21'),
(3, 6, '16'),
(3, 11, '7'),
(4, 5, '10'),
(4, 6, '15'),
(4, 8, '2'),
(4, 9, '12'),
(4, 14, '10'),
(5, 6, '10'),
(5, 12, '4'),
(6, 1, '2'),
(6, 4, '9'),
(6, 5, '13'),
(6, 6, '9'),
(6, 11, '17'),
(6, 13, '19'),
(7, 4, '7'),
(7, 5, '10'),
(7, 9, '18'),
(7, 12, '18'),
(8, 1, '6'),
(8, 5, '10'),
(8, 7, '20'),
(8, 13, '7');

-- --------------------------------------------------------

--
-- Structure de la table `CONGE`
--

DROP TABLE IF EXISTS `CONGE`;
CREATE TABLE `CONGE` (
  `ID_DEMANDE` int(11) NOT NULL,
  `ID_ETAT` int(11) NOT NULL,
  `ID_EMPLOYE` int(11) NOT NULL,
  `DEBUT_CONGE` date DEFAULT NULL,
  `FIN_CONGE` date DEFAULT NULL,
  `DATE_DEMANDE` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `CONGE`
--

INSERT INTO `CONGE` (`ID_DEMANDE`, `ID_ETAT`, `ID_EMPLOYE`, `DEBUT_CONGE`, `FIN_CONGE`, `DATE_DEMANDE`) VALUES
(1, 3, 8, '2022-11-30', '2022-12-14', '2022-09-01'),
(2, 2, 12, '2023-05-01', '2023-06-01', '2022-09-01'),
(3, 1, 13, '2022-10-31', '2022-11-09', '2022-09-01'),
(4, 3, 7, '2022-12-16', '2022-12-31', '2022-09-01'),
(5, 1, 8, '2022-11-09', '2022-11-16', '2022-09-01'),
(6, 3, 12, '2022-10-31', '2022-11-05', '2022-09-01'),
(7, 1, 16, '2023-02-06', '2023-02-21', '2022-09-01'),
(8, 3, 18, '2023-01-26', '2023-02-04', '2022-09-01'),
(9, 2, 8, '2023-03-17', '2023-04-01', '2022-09-01'),
(10, 3, 16, '2023-03-25', '2023-04-25', '2022-09-01');

-- --------------------------------------------------------

--
-- Structure de la table `DISPONIBILITE`
--

DROP TABLE IF EXISTS `DISPONIBILITE`;
CREATE TABLE `DISPONIBILITE` (
  `ID_DISPO` int(11) NOT NULL,
  `ID_EMPLOYE` int(11) NOT NULL,
  `DEBUT_DISPO` datetime DEFAULT NULL,
  `FIN_DISPO` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `DISPONIBILITE`
--

INSERT INTO `DISPONIBILITE` (`ID_DISPO`, `ID_EMPLOYE`, `DEBUT_DISPO`, `FIN_DISPO`) VALUES
(1, 15, '2022-11-04 09:33:00', '2022-11-04 17:47:00'),
(2, 7, '2022-11-04 11:49:00', '2022-11-04 16:08:00'),
(3, 7, '2022-11-04 06:37:00', '2022-11-04 17:23:00'),
(4, 10, '2022-11-04 05:28:00', '2022-11-04 17:06:00'),
(5, 15, '2022-11-04 07:53:00', '2022-11-04 15:08:00'),
(6, 7, '2022-11-04 10:24:00', '2022-11-04 19:26:00'),
(7, 14, '2022-11-04 08:46:00', '2022-11-04 23:44:00'),
(8, 16, '2022-11-04 12:39:00', '2022-11-04 14:15:00'),
(9, 11, '2022-11-04 11:06:00', '2022-11-04 17:08:00'),
(10, 16, '2022-11-04 09:57:00', '2022-11-04 21:49:00'),
(11, 16, '2022-11-04 09:06:00', '2022-11-04 21:39:00'),
(12, 9, '2022-11-04 07:19:00', '2022-11-04 20:26:00'),
(13, 15, '2022-11-04 10:37:00', '2022-11-04 13:42:00'),
(14, 15, '2022-11-04 12:05:00', '2022-11-04 16:07:00'),
(15, 14, '2022-11-04 10:32:00', '2022-11-04 15:11:00'),
(16, 12, '2022-11-04 08:36:00', '2022-11-04 22:32:00'),
(17, 16, '2022-11-04 11:31:00', '2022-11-04 15:07:00'),
(18, 19, '2022-11-04 11:06:00', '2022-11-04 13:52:00'),
(19, 13, '2022-11-04 05:05:00', '2022-11-04 21:04:00'),
(20, 13, '2022-11-04 11:58:00', '2022-11-04 18:09:00'),
(21, 20, '2022-11-04 07:08:00', '2022-11-04 18:08:00'),
(22, 14, '2022-11-04 06:08:00', '2022-11-04 18:58:00'),
(23, 11, '2022-11-04 06:40:00', '2022-11-04 21:09:00'),
(24, 10, '2022-11-04 09:20:00', '2022-11-04 17:11:00'),
(25, 13, '2022-11-04 07:02:00', '2022-11-04 13:50:00'),
(26, 7, '2022-11-04 12:21:00', '2022-11-04 19:01:00'),
(27, 18, '2022-11-04 06:36:00', '2022-11-04 14:57:00'),
(28, 20, '2022-11-04 07:48:00', '2022-11-04 14:36:00'),
(29, 16, '2022-11-04 11:40:00', '2022-11-04 20:13:00'),
(30, 7, '2022-11-04 08:08:00', '2022-11-04 19:53:00'),
(31, 19, '2022-11-04 10:02:00', '2022-11-04 17:38:00'),
(32, 20, '2022-11-04 08:28:00', '2022-11-04 17:46:00'),
(33, 15, '2022-11-04 07:25:00', '2022-11-04 17:56:00'),
(34, 9, '2022-11-04 12:15:00', '2022-11-04 21:13:00'),
(35, 20, '2022-11-04 09:59:00', '2022-11-04 23:36:00'),
(36, 8, '2022-11-04 08:29:00', '2022-11-04 21:50:00'),
(37, 17, '2022-11-04 12:40:00', '2022-11-04 16:01:00'),
(38, 8, '2022-11-04 06:37:00', '2022-11-04 23:09:00'),
(39, 11, '2022-11-04 11:21:00', '2022-11-04 13:06:00'),
(40, 8, '2022-11-04 11:01:00', '2022-11-04 17:25:00'),
(41, 10, '2022-11-04 05:44:00', '2022-11-04 15:28:00'),
(42, 11, '2022-11-04 10:37:00', '2022-11-04 22:41:00'),
(43, 9, '2022-11-04 09:22:00', '2022-11-04 17:58:00'),
(44, 12, '2022-11-04 07:52:00', '2022-11-04 17:10:00'),
(45, 7, '2022-11-04 08:36:00', '2022-11-04 15:48:00'),
(46, 13, '2022-11-04 08:48:00', '2022-11-04 23:13:00'),
(47, 8, '2022-11-04 05:50:00', '2022-11-04 20:43:00'),
(48, 16, '2022-11-04 07:07:00', '2022-11-04 22:36:00'),
(49, 20, '2022-11-04 09:44:00', '2022-11-04 18:50:00'),
(50, 12, '2022-11-04 05:38:00', '2022-11-04 16:31:00');

-- --------------------------------------------------------

--
-- Structure de la table `ECHANGE`
--

DROP TABLE IF EXISTS `ECHANGE`;
CREATE TABLE `ECHANGE` (
  `ID_ECHANGE` int(11) NOT NULL,
  `ID_ETAT` int(11) NOT NULL,
  `ID_JOUR_EMETTEUR` int(11) NOT NULL,
  `ID_EMPLOYE_EMETTEUR` int(11) NOT NULL,
  `ID_JOUR_RECEPTEUR` int(11) NOT NULL,
  `ID_EMPLOYE_RECEPTEUR` int(11) NOT NULL,
  `DATE_PROPOSITION` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `EMPLOYE`
--

DROP TABLE IF EXISTS `EMPLOYE`;
CREATE TABLE `EMPLOYE` (
  `ID_EMPLOYE` int(11) NOT NULL,
  `NOM` varchar(255) DEFAULT NULL,
  `PRENOM` varchar(255) DEFAULT NULL,
  `ADRESSE_MAIL` varchar(255) DEFAULT NULL,
  `DATE_EMBAUCHE` date DEFAULT NULL,
  `ADRESSE` varchar(255) DEFAULT NULL,
  `CODE_POSTAL` int(11) DEFAULT NULL,
  `VILLE` varchar(255) DEFAULT NULL,
  `MDP` varchar(255) NOT NULL DEFAULT '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe',
  `POSITION` varchar(255) NOT NULL DEFAULT 'POLY',
  `HEURES_SUP` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `EMPLOYE`
--

INSERT INTO `EMPLOYE` (`ID_EMPLOYE`, `NOM`, `PRENOM`, `ADRESSE_MAIL`, `DATE_EMBAUCHE`, `ADRESSE`, `CODE_POSTAL`, `VILLE`, `MDP`, `POSITION`, `HEURES_SUP`) VALUES
(1, 'Sealand', 'Arte', 'asealand0@sina.com.cn', '2021-09-18', '338 Namekagon Plaza', NULL, 'Sosándra', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'MANA', 0),
(2, 'Misson', 'Tildie', 'tmisson1@ebay.com', '2020-10-31', '0 Arkansas Crossing', NULL, 'Bitung', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'MANA', 0),
(3, 'Pinke', 'Fayth', 'fpinke2@tiny.cc', '2022-10-19', '100 Roxbury Trail', 4785, 'Finzes', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'ASSI', 0),
(4, 'Voas', 'Bentley', 'bvoas3@amazon.co.jp', '2021-09-05', '13 Jenifer Avenue', NULL, 'Purworejo', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'ASSI', 0),
(5, 'Fancy', 'Ange', 'afancy4@mozilla.com', '2021-11-09', '43390 East Drive', NULL, 'Yanwukou', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'ASSI', 0),
(6, 'Cowpertwait', 'Dannie', 'dcowpertwait5@yellowpages.com', '2022-06-30', '3 Harper Pass', NULL, 'Nusajaya', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'ASSI', 0),
(7, 'Pandey', 'Dionisio', 'dpandey6@vinaora.com', '2021-04-30', '9 Sundown Plaza', 31110, 'Nakhon Ratchasima', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(8, 'Vakhrushev', 'Traci', 'tvakhrushev7@adobe.com', '2021-07-13', '1982 Towne Park', NULL, 'Bokaa', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(9, 'Warsop', 'Nikolaos', 'nwarsop8@businessweek.com', '2021-06-19', '027 Golf Course Avenue', NULL, 'Hougong', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(10, 'Gadsby', 'Kelbee', 'kgadsby9@thetimes.co.uk', '2021-06-06', '65709 Arkansas Terrace', 188992, 'Svetogorsk', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(11, 'Soigne', 'Velma', 'vsoignea@xinhuanet.com', '2021-12-14', '08909 Hoepker Pass', NULL, 'Peristerona', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(12, 'Jedryka', 'Joseph', 'jjedrykab@engadget.com', '2020-12-10', '95 Hoard Avenue', 96925, 'Yigo Village', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(13, 'Shreenan', 'Jasper', 'jshreenanc@jiathis.com', '2021-07-05', '69 Cascade Drive', 58330, 'Juripiranga', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(14, 'Gleave', 'Mannie', 'mgleaved@cargocollective.com', '2021-10-09', '48190 Esker Park', NULL, 'Madara', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(15, 'Smallman', 'Gustave', 'gsmallmane@vinaora.com', '2021-08-13', '63 Sheridan Pass', 7100, 'Monte da Boavista', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(16, 'Lyal', 'Reider', 'rlyalf@engadget.com', '2021-12-30', '5278 Bunker Hill Lane', NULL, 'Pavlohrad', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(17, 'Conisbee', 'Nickola', 'nconisbeeg@gmpg.org', '2021-01-10', '0551 Texas Drive', 2900, 'San Nicolás de los Arroyos', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(18, 'Burmaster', 'Kali', 'kburmasterh@eventbrite.com', '2022-01-26', '9 Holmberg Park', 2755, 'Almoínhas Velhas', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(19, 'Fayre', 'Flo', 'ffayrei@altervista.org', '2022-08-22', '54 Bluestem Pass', 606125, 'Gorbatov', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0),
(20, 'Oldcroft', 'Marve', 'moldcroftj@ihg.com', '2021-02-23', '6725 Northwestern Street', 182460, 'Vybor', '$2y$10$cvyHw2LaX3XRmouK0EpsLORDleSIRWdfrLhlpuC9vsOM3RnFXqLTe', 'POLY', 0);

-- --------------------------------------------------------

--
-- Structure de la table `ETAT`
--

DROP TABLE IF EXISTS `ETAT`;
CREATE TABLE `ETAT` (
  `ID_ETAT` int(11) NOT NULL,
  `NOM_ETAT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ETAT`
--

INSERT INTO `ETAT` (`ID_ETAT`, `NOM_ETAT`) VALUES
(1, 'Accepté'),
(2, 'Refusé'),
(3, 'En attente de réponse'),
(4, 'Reçu'),
(5, 'Envoyé'),
(6, 'Publié'),
(7, 'Caché');

-- --------------------------------------------------------

--
-- Structure de la table `JOUR`
--

DROP TABLE IF EXISTS `JOUR`;
CREATE TABLE `JOUR` (
  `ID_JOUR` int(11) NOT NULL,
  `ID_PLANNING` int(11) NOT NULL,
  `N_JOUR` int(11) NOT NULL,
  `ID_SERVICE` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `JOUR`
--

INSERT INTO `JOUR` (`ID_JOUR`, `ID_PLANNING`, `N_JOUR`, `ID_SERVICE`) VALUES
(1, 15, 2, 'a'),
(2, 15, 4, 'a'),
(3, 15, 1, 'a'),
(4, 15, 7, 'a'),
(5, 15, 3, 'a'),
(6, 16, 2, 'a'),
(7, 16, 4, 'a'),
(8, 16, 6, 'a'),
(9, 16, 7, 'a'),
(10, 16, 5, 'a'),
(11, 17, 2, 'a'),
(12, 17, 1, 'a'),
(13, 17, 3, 'a'),
(14, 17, 4, 'a'),
(15, 17, 5, 'a'),
(16, 18, 7, 'a'),
(17, 18, 4, 'a'),
(18, 18, 3, 'a'),
(19, 18, 6, 'a'),
(20, 18, 5, 'a'),
(21, 19, 1, 'a'),
(22, 19, 4, 'a'),
(23, 19, 5, 'a'),
(24, 19, 2, 'a'),
(25, 19, 3, 'a'),
(26, 20, 7, 'a'),
(27, 20, 6, 'a'),
(28, 20, 2, 'a'),
(29, 20, 5, 'a'),
(30, 20, 3, 'a'),
(31, 21, 5, 'a'),
(32, 21, 4, 'a'),
(33, 21, 1, 'a'),
(34, 21, 2, 'a'),
(35, 21, 6, 'a'),
(36, 22, 2, 'a'),
(37, 22, 4, 'a'),
(38, 22, 6, 'a'),
(39, 22, 7, 'a'),
(40, 22, 1, 'a'),
(41, 23, 3, 'a'),
(42, 23, 2, 'a'),
(43, 23, 5, 'a'),
(44, 23, 6, 'a'),
(45, 23, 1, 'a'),
(46, 24, 1, 'a'),
(47, 24, 7, 'a'),
(48, 24, 3, 'a'),
(49, 24, 4, 'a'),
(50, 24, 5, 'a'),
(51, 25, 2, 'a'),
(52, 25, 3, 'a'),
(53, 25, 6, 'a'),
(54, 25, 7, 'a'),
(55, 25, 5, 'a'),
(56, 26, 5, 'a'),
(57, 26, 3, 'a'),
(58, 26, 7, 'a'),
(59, 26, 1, 'a'),
(60, 26, 2, 'a'),
(61, 27, 4, 'a'),
(62, 27, 3, 'a'),
(63, 27, 2, 'a'),
(64, 27, 7, 'a'),
(65, 27, 5, 'a'),
(66, 28, 1, 'a'),
(67, 28, 3, 'a'),
(68, 28, 5, 'a'),
(69, 28, 7, 'a'),
(70, 28, 4, 'a');

-- --------------------------------------------------------

--
-- Structure de la table `LIVRAISON`
--

DROP TABLE IF EXISTS `LIVRAISON`;
CREATE TABLE `LIVRAISON` (
  `ID_LIVRAISON` int(11) NOT NULL,
  `DATE_LIVRAISON` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `LIVRAISON`
--

INSERT INTO `LIVRAISON` (`ID_LIVRAISON`, `DATE_LIVRAISON`) VALUES
(1, '2022-10-04'),
(2, '2022-10-07'),
(3, '2022-10-11'),
(4, '2022-10-14'),
(5, '2022-10-17'),
(6, '2022-10-21'),
(7, '2022-10-24'),
(8, '2022-10-28');

-- --------------------------------------------------------

--
-- Structure de la table `PLANNING`
--

DROP TABLE IF EXISTS `PLANNING`;
CREATE TABLE `PLANNING` (
  `ID_PLANNING` int(11) NOT NULL,
  `ID_EMPLOYE` int(11) NOT NULL,
  `ID_ETAT` int(11) NOT NULL,
  `N_SEMAINE` int(11) DEFAULT NULL,
  `ANNEE_PLANNING` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `PLANNING`
--

INSERT INTO `PLANNING` (`ID_PLANNING`, `ID_EMPLOYE`, `ID_ETAT`, `N_SEMAINE`, `ANNEE_PLANNING`) VALUES
(1, 7, 6, 44, 2022),
(2, 8, 6, 44, 2022),
(3, 9, 6, 44, 2022),
(4, 10, 6, 44, 2022),
(5, 11, 6, 44, 2022),
(6, 12, 6, 44, 2022),
(7, 13, 6, 44, 2022),
(8, 14, 6, 44, 2022),
(9, 15, 6, 44, 2022),
(10, 16, 6, 44, 2022),
(11, 17, 6, 44, 2022),
(12, 18, 6, 44, 2022),
(13, 19, 6, 44, 2022),
(14, 20, 6, 44, 2022),
(15, 7, 6, 45, 2022),
(16, 8, 7, 45, 2022),
(17, 9, 6, 45, 2022),
(18, 10, 6, 45, 2022),
(19, 11, 6, 45, 2022),
(20, 12, 6, 45, 2022),
(21, 13, 6, 45, 2022),
(22, 14, 7, 45, 2022),
(23, 15, 6, 45, 2022),
(24, 16, 6, 45, 2022),
(25, 17, 7, 45, 2022),
(26, 18, 6, 45, 2022),
(27, 19, 6, 45, 2022),
(28, 20, 6, 45, 2022),
(29, 7, 7, 46, 2022),
(30, 8, 7, 46, 2022),
(31, 9, 7, 46, 2022),
(32, 10, 7, 46, 2022),
(33, 11, 7, 46, 2022),
(34, 12, 6, 46, 2022),
(35, 13, 6, 46, 2022),
(36, 14, 7, 46, 2022),
(37, 15, 7, 46, 2022),
(38, 16, 7, 46, 2022),
(39, 17, 7, 46, 2022),
(40, 18, 6, 46, 2022),
(41, 19, 7, 46, 2022),
(42, 20, 6, 46, 2022);

-- --------------------------------------------------------

--
-- Structure de la table `PRODUIT`
--

DROP TABLE IF EXISTS `PRODUIT`;
CREATE TABLE `PRODUIT` (
  `ID_PRODUIT` int(11) NOT NULL,
  `ID_UNITE` int(11) NOT NULL,
  `DENOMINATION` varchar(255) DEFAULT NULL,
  `DERNIERE_MODIF` datetime DEFAULT NULL,
  `QUANTITE_EN_STOCK` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `PRODUIT`
--

INSERT INTO `PRODUIT` (`ID_PRODUIT`, `ID_UNITE`, `DENOMINATION`, `DERNIERE_MODIF`, `QUANTITE_EN_STOCK`) VALUES
(1, 2, 'Pâte à pizza', '2022-10-29 00:00:00', '75'),
(2, 1, 'Champignons', '2022-10-03 00:00:00', '56'),
(3, 3, 'Sauce tomate ', '2022-10-06 00:00:00', '17'),
(4, 1, 'Fromage', '2022-10-04 00:00:00', '70'),
(5, 2, 'Boîte', '2022-10-11 00:00:00', '125'),
(6, 1, 'Jambon', '2022-10-26 00:00:00', '62'),
(7, 3, 'Crème', '2022-10-24 00:00:00', '76'),
(8, 1, 'Oignons', '2022-10-24 00:00:00', '77'),
(9, 2, 'Oeufs', '2022-10-14 00:00:00', '40'),
(10, 1, 'Poivrons', '2022-10-21 00:00:00', '44'),
(11, 1, 'Saumon', '2022-10-14 00:00:00', '95'),
(12, 1, 'Mozzarella', '2022-10-09 00:00:00', '53'),
(13, 1, 'Olives', '2022-10-23 00:00:00', '10'),
(14, 1, 'Chorizo', '2022-10-29 00:00:00', '80');

-- --------------------------------------------------------

--
-- Structure de la table `SERVICE`
--

DROP TABLE IF EXISTS `SERVICE`;
CREATE TABLE `SERVICE` (
  `ID_SERVICE` varchar(1) NOT NULL,
  `NOMBRE` int(2) NOT NULL DEFAULT '1',
  `DEBUT_SERVICE` time NOT NULL,
  `FIN_SERVICE` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `SERVICE`
--

INSERT INTO `SERVICE` (`ID_SERVICE`, `NOMBRE`, `DEBUT_SERVICE`, `FIN_SERVICE`) VALUES
('a', 1, '09:00:00', '13:30:00'),
('b', 2, '10:00:00', '14:30:00'),
('c', 1, '11:00:00', '15:30:00'),
('d', 1, '08:30:00', '16:00:00'),
('e', 1, '16:00:00', '20:30:00'),
('f', 1, '17:00:00', '21:30:00'),
('g', 3, '18:00:00', '22:30:00'),
('h', 1, '18:30:00', '23:00:00'),
('i', 2, '15:30:00', '23:00:00'),
('y', 0, '00:00:00', '23:59:59'),
('z', 0, '00:00:00', '23:59:59');

-- --------------------------------------------------------

--
-- Structure de la table `SUPERVISE`
--

DROP TABLE IF EXISTS `SUPERVISE`;
CREATE TABLE `SUPERVISE` (
  `ID_EMPLOYE` int(11) NOT NULL,
  `ID_LIVRAISON` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `SUPERVISE`
--

INSERT INTO `SUPERVISE` (`ID_EMPLOYE`, `ID_LIVRAISON`) VALUES
(6, 1),
(2, 2),
(6, 3),
(4, 4),
(4, 5),
(4, 6),
(1, 7),
(5, 8);

-- --------------------------------------------------------

--
-- Structure de la table `UNITE`
--

DROP TABLE IF EXISTS `UNITE`;
CREATE TABLE `UNITE` (
  `ID_UNITE` int(11) NOT NULL,
  `NOM_UNITE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `UNITE`
--

INSERT INTO `UNITE` (`ID_UNITE`, `NOM_UNITE`) VALUES
(1, 'kg'),
(2, 'unités'),
(3, 'litres');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `COMPREND`
--
ALTER TABLE `COMPREND`
  ADD PRIMARY KEY (`ID_LIVRAISON`,`ID_PRODUIT`),
  ADD KEY `FK_COMPREND2` (`ID_PRODUIT`);

--
-- Index pour la table `CONGE`
--
ALTER TABLE `CONGE`
  ADD PRIMARY KEY (`ID_DEMANDE`),
  ADD KEY `FK_EST_QUALIFIE_PAR` (`ID_ETAT`),
  ADD KEY `FK_CONGE_EMPLOYE` (`ID_EMPLOYE`);

--
-- Index pour la table `DISPONIBILITE`
--
ALTER TABLE `DISPONIBILITE`
  ADD PRIMARY KEY (`ID_DISPO`),
  ADD KEY `FK_DISPO_EMPLOYE` (`ID_EMPLOYE`);

--
-- Index pour la table `ECHANGE`
--
ALTER TABLE `ECHANGE`
  ADD PRIMARY KEY (`ID_ECHANGE`),
  ADD KEY `FK_EST_PRECISE_PAR` (`ID_ETAT`),
  ADD KEY `FK_JOUR_RECEPTEUR` (`ID_JOUR_RECEPTEUR`),
  ADD KEY `FK_EMPLOYE_RECEPTEUR` (`ID_EMPLOYE_RECEPTEUR`),
  ADD KEY `FK_EMPLOYE_EMETTEUR` (`ID_EMPLOYE_EMETTEUR`) USING BTREE,
  ADD KEY `FK_JOUR_EMETTEUR` (`ID_JOUR_EMETTEUR`) USING BTREE;

--
-- Index pour la table `EMPLOYE`
--
ALTER TABLE `EMPLOYE`
  ADD PRIMARY KEY (`ID_EMPLOYE`);

--
-- Index pour la table `ETAT`
--
ALTER TABLE `ETAT`
  ADD PRIMARY KEY (`ID_ETAT`);

--
-- Index pour la table `JOUR`
--
ALTER TABLE `JOUR`
  ADD PRIMARY KEY (`ID_JOUR`),
  ADD KEY `FK_CONTIENT` (`ID_PLANNING`),
  ADD KEY `FK_JOUR_SERVICE` (`ID_SERVICE`);

--
-- Index pour la table `LIVRAISON`
--
ALTER TABLE `LIVRAISON`
  ADD PRIMARY KEY (`ID_LIVRAISON`);

--
-- Index pour la table `PLANNING`
--
ALTER TABLE `PLANNING`
  ADD PRIMARY KEY (`ID_PLANNING`),
  ADD KEY `FK_EST_CARACTERISE_PAR` (`ID_ETAT`),
  ADD KEY `FK_PLANNING_EMPLOYE` (`ID_EMPLOYE`);

--
-- Index pour la table `PRODUIT`
--
ALTER TABLE `PRODUIT`
  ADD PRIMARY KEY (`ID_PRODUIT`),
  ADD KEY `FK_EST_EN` (`ID_UNITE`);

--
-- Index pour la table `SERVICE`
--
ALTER TABLE `SERVICE`
  ADD PRIMARY KEY (`ID_SERVICE`);

--
-- Index pour la table `SUPERVISE`
--
ALTER TABLE `SUPERVISE`
  ADD PRIMARY KEY (`ID_EMPLOYE`,`ID_LIVRAISON`),
  ADD KEY `FK_SUPERVISE_LIVRAISON` (`ID_LIVRAISON`);

--
-- Index pour la table `UNITE`
--
ALTER TABLE `UNITE`
  ADD PRIMARY KEY (`ID_UNITE`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `CONGE`
--
ALTER TABLE `CONGE`
  MODIFY `ID_DEMANDE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `DISPONIBILITE`
--
ALTER TABLE `DISPONIBILITE`
  MODIFY `ID_DISPO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `ECHANGE`
--
ALTER TABLE `ECHANGE`
  MODIFY `ID_ECHANGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `EMPLOYE`
--
ALTER TABLE `EMPLOYE`
  MODIFY `ID_EMPLOYE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `ETAT`
--
ALTER TABLE `ETAT`
  MODIFY `ID_ETAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `JOUR`
--
ALTER TABLE `JOUR`
  MODIFY `ID_JOUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT pour la table `LIVRAISON`
--
ALTER TABLE `LIVRAISON`
  MODIFY `ID_LIVRAISON` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `PLANNING`
--
ALTER TABLE `PLANNING`
  MODIFY `ID_PLANNING` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `PRODUIT`
--
ALTER TABLE `PRODUIT`
  MODIFY `ID_PRODUIT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `UNITE`
--
ALTER TABLE `UNITE`
  MODIFY `ID_UNITE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `COMPREND`
--
ALTER TABLE `COMPREND`
  ADD CONSTRAINT `FK_COMPREND` FOREIGN KEY (`ID_LIVRAISON`) REFERENCES `LIVRAISON` (`ID_LIVRAISON`),
  ADD CONSTRAINT `FK_COMPREND2` FOREIGN KEY (`ID_PRODUIT`) REFERENCES `PRODUIT` (`ID_PRODUIT`);

--
-- Contraintes pour la table `CONGE`
--
ALTER TABLE `CONGE`
  ADD CONSTRAINT `FK_CONGE_EMPLOYE` FOREIGN KEY (`ID_EMPLOYE`) REFERENCES `EMPLOYE` (`ID_EMPLOYE`),
  ADD CONSTRAINT `FK_EST_QUALIFIE_PAR` FOREIGN KEY (`ID_ETAT`) REFERENCES `ETAT` (`ID_ETAT`);

--
-- Contraintes pour la table `DISPONIBILITE`
--
ALTER TABLE `DISPONIBILITE`
  ADD CONSTRAINT `FK_DISPO_EMPLOYE` FOREIGN KEY (`ID_EMPLOYE`) REFERENCES `EMPLOYE` (`ID_EMPLOYE`);

--
-- Contraintes pour la table `ECHANGE`
--
ALTER TABLE `ECHANGE`
  ADD CONSTRAINT `FK_EMPLOYE_EMETTEUR` FOREIGN KEY (`ID_EMPLOYE_EMETTEUR`) REFERENCES `EMPLOYE` (`ID_EMPLOYE`),
  ADD CONSTRAINT `FK_EMPLOYE_RECEPTEUR` FOREIGN KEY (`ID_EMPLOYE_RECEPTEUR`) REFERENCES `EMPLOYE` (`ID_EMPLOYE`),
  ADD CONSTRAINT `FK_EST_PRECISE_PAR` FOREIGN KEY (`ID_ETAT`) REFERENCES `ETAT` (`ID_ETAT`),
  ADD CONSTRAINT `FK_JOUR_EMETTEUR` FOREIGN KEY (`ID_JOUR_EMETTEUR`) REFERENCES `JOUR` (`ID_JOUR`),
  ADD CONSTRAINT `FK_JOUR_RECEPTEUR` FOREIGN KEY (`ID_JOUR_RECEPTEUR`) REFERENCES `JOUR` (`ID_JOUR`);

--
-- Contraintes pour la table `JOUR`
--
ALTER TABLE `JOUR`
  ADD CONSTRAINT `FK_CONTIENT` FOREIGN KEY (`ID_PLANNING`) REFERENCES `PLANNING` (`ID_PLANNING`),
  ADD CONSTRAINT `FK_JOUR_SERVICE` FOREIGN KEY (`ID_SERVICE`) REFERENCES `SERVICE` (`ID_SERVICE`);

--
-- Contraintes pour la table `PLANNING`
--
ALTER TABLE `PLANNING`
  ADD CONSTRAINT `FK_EST_CARACTERISE_PAR` FOREIGN KEY (`ID_ETAT`) REFERENCES `ETAT` (`ID_ETAT`),
  ADD CONSTRAINT `FK_PLANNING_EMPLOYE` FOREIGN KEY (`ID_EMPLOYE`) REFERENCES `EMPLOYE` (`ID_EMPLOYE`);

--
-- Contraintes pour la table `PRODUIT`
--
ALTER TABLE `PRODUIT`
  ADD CONSTRAINT `FK_EST_EN` FOREIGN KEY (`ID_UNITE`) REFERENCES `UNITE` (`ID_UNITE`);

--
-- Contraintes pour la table `SUPERVISE`
--
ALTER TABLE `SUPERVISE`
  ADD CONSTRAINT `FK_SUPERVISE_EMPLOYE` FOREIGN KEY (`ID_EMPLOYE`) REFERENCES `EMPLOYE` (`ID_EMPLOYE`),
  ADD CONSTRAINT `FK_SUPERVISE_LIVRAISON` FOREIGN KEY (`ID_LIVRAISON`) REFERENCES `LIVRAISON` (`ID_LIVRAISON`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
