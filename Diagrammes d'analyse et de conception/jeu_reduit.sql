-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 17 jan. 2023 à 22:50
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jeu_reduit`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

DROP TABLE IF EXISTS `absence`;
CREATE TABLE IF NOT EXISTS `absence` (
  `ID_ABSENCE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPLOYE` int(11) NOT NULL,
  `DEBUT_ABSENCE` datetime DEFAULT NULL,
  `FIN_ABSENCE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_ABSENCE`),
  KEY `FK_DECLARE` (`ID_EMPLOYE`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `absence`
--

INSERT INTO `absence` (`ID_ABSENCE`, `ID_EMPLOYE`, `DEBUT_ABSENCE`, `FIN_ABSENCE`) VALUES
(1, 1, '2022-11-09 15:00:00', '2022-11-09 23:59:00'),
(2, 1, '2022-12-01 05:00:00', '2022-12-01 22:30:00'),
(3, 2, '2022-11-05 12:00:00', '2022-11-05 21:00:00'),
(10, 1, '2022-11-12 01:00:00', '2022-11-12 18:00:00'),
(16, 3, '2022-11-03 10:30:00', '2022-11-03 19:45:00'),
(18, 3, '2022-12-20 12:02:00', '2022-12-20 12:20:00'),
(19, 1, '2022-12-06 10:21:00', '2022-12-06 14:10:00'),
(20, 1, '2022-12-11 18:00:00', '2022-12-11 23:00:00'),
(21, 4, '2022-12-06 10:00:00', '2022-12-06 15:00:00'),
(22, 1, '2022-12-19 08:00:00', '2022-12-19 23:10:00'),
(23, 1, '2022-12-29 08:00:00', '2022-12-29 23:10:00'),
(24, 7, '2022-12-28 08:00:00', '2022-12-28 23:10:00'),
(25, 10, '2022-12-31 03:00:00', '2022-12-31 20:00:00'),
(29, 14, '2022-12-31 03:00:00', '2022-12-31 20:00:00'),
(31, 13, '2023-01-18 00:00:00', '2023-01-18 18:00:00'),
(32, 13, '2023-01-20 08:00:00', '2023-01-20 18:00:00'),
(33, 14, '2023-01-24 08:00:00', '2023-01-24 22:55:00'),
(34, 15, '2023-01-20 08:00:00', '2023-01-20 22:55:00'),
(35, 15, '2023-01-27 08:00:00', '2023-01-27 22:56:00'),
(36, 16, '2023-01-25 08:00:00', '2023-01-25 22:58:00');

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

DROP TABLE IF EXISTS `conge`;
CREATE TABLE IF NOT EXISTS `conge` (
  `ID_DEMANDE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ETAT` int(11) NOT NULL,
  `ID_EMPLOYE` int(11) NOT NULL,
  `DEBUT_CONGE` date DEFAULT NULL,
  `FIN_CONGE` date DEFAULT NULL,
  `DATE_DEMANDE` date NOT NULL,
  PRIMARY KEY (`ID_DEMANDE`),
  KEY `FK_DEMANDE` (`ID_EMPLOYE`),
  KEY `FK_EST_QUALIFIE_PAR` (`ID_ETAT`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conge`
--

INSERT INTO `conge` (`ID_DEMANDE`, `ID_ETAT`, `ID_EMPLOYE`, `DEBUT_CONGE`, `FIN_CONGE`, `DATE_DEMANDE`) VALUES
(1, 5, 1, '2022-11-27', '2022-11-27', '2022-11-27'),
(6, 4, 1, '2022-11-01', '2022-11-30', '2022-11-27'),
(14, 4, 3, '2023-01-02', '2023-01-09', '2022-12-02'),
(20, 5, 2, '2022-12-12', '2022-12-16', '2022-12-12'),
(22, 4, 3, '2022-12-25', '2022-12-28', '2022-12-28'),
(23, 4, 1, '2022-12-27', '2022-12-28', '2022-12-29'),
(24, 4, 7, '2023-01-17', '2023-01-18', '2023-01-15'),
(25, 5, 7, '2023-01-19', '2023-01-20', '2023-01-15'),
(26, 4, 8, '2023-01-19', '2023-01-20', '2023-01-15'),
(27, 3, 8, '2023-01-23', '2023-01-24', '2023-01-15'),
(28, 5, 8, '2023-01-23', '2023-01-27', '2023-01-15'),
(29, 5, 9, '2023-01-31', '2023-02-03', '2023-01-15'),
(30, 3, 9, '2023-01-20', '2023-01-24', '2023-01-15'),
(31, 4, 9, '2023-01-26', '2023-01-27', '2023-01-15'),
(32, 5, 10, '2023-01-16', '2023-01-20', '2023-01-15'),
(33, 5, 10, '2023-01-21', '2023-01-23', '2023-01-15'),
(34, 4, 11, '2023-01-17', '2023-01-18', '2023-01-15'),
(35, 3, 11, '2023-01-20', '2023-01-23', '2023-01-15'),
(36, 3, 11, '2023-01-31', '2023-02-02', '2023-01-15'),
(37, 3, 12, '2023-02-01', '2023-02-03', '2023-01-15');

-- --------------------------------------------------------

--
-- Structure de la table `echange`
--

DROP TABLE IF EXISTS `echange`;
CREATE TABLE IF NOT EXISTS `echange` (
  `ID_ECHANGE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ETAT` int(11) NOT NULL,
  `ID_JOUR_EMETTEUR` int(11) NOT NULL,
  `ID_EMPLOYE_EMETTEUR` int(11) NOT NULL,
  `ID_JOUR_RECEPTEUR` int(11) NOT NULL,
  `ID_EMPLOYE_RECEPTEUR` int(11) NOT NULL,
  `DATE_PROPOSITION` date DEFAULT NULL,
  PRIMARY KEY (`ID_ECHANGE`),
  KEY `FK_EST_PRECISE_PAR` (`ID_ETAT`),
  KEY `FK_JOUR_RECEPTEUR` (`ID_JOUR_RECEPTEUR`),
  KEY `FK_EMPLOYE_RECEPTEUR` (`ID_EMPLOYE_RECEPTEUR`),
  KEY `FK_EMPLOYE_EMETTEUR` (`ID_EMPLOYE_EMETTEUR`) USING BTREE,
  KEY `FK_JOUR_EMETTEUR` (`ID_JOUR_EMETTEUR`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `echange`
--

INSERT INTO `echange` (`ID_ECHANGE`, `ID_ETAT`, `ID_JOUR_EMETTEUR`, `ID_EMPLOYE_EMETTEUR`, `ID_JOUR_RECEPTEUR`, `ID_EMPLOYE_RECEPTEUR`, `DATE_PROPOSITION`) VALUES
(17, 3, 344, 17, 340, 9, '2023-01-17'),
(18, 5, 358, 17, 355, 14, '2023-01-17'),
(19, 3, 372, 17, 373, 18, '2023-01-17'),
(20, 3, 292, 18, 287, 12, '2023-01-17'),
(21, 3, 373, 18, 371, 16, '2023-01-17'),
(22, 3, 404, 17, 396, 8, '2023-01-17');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE IF NOT EXISTS `employe` (
  `ID_EMPLOYE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) DEFAULT NULL,
  `PRENOM` varchar(255) DEFAULT NULL,
  `ADRESSE_MAIL` varchar(255) DEFAULT NULL,
  `DATE_EMBAUCHE` date DEFAULT NULL,
  `ADRESSE` varchar(255) DEFAULT NULL,
  `CODE_POSTAL` int(11) DEFAULT NULL,
  `VILLE` varchar(255) DEFAULT NULL,
  `MDP` varchar(255) NOT NULL,
  `POSITION` varchar(255) NOT NULL DEFAULT 'POLY',
  `HEURES_SUP` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_EMPLOYE`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`ID_EMPLOYE`, `NOM`, `PRENOM`, `ADRESSE_MAIL`, `DATE_EMBAUCHE`, `ADRESSE`, `CODE_POSTAL`, `VILLE`, `MDP`, `POSITION`, `HEURES_SUP`) VALUES
(1, 'COURTET', 'Tom', 'assi@gmail.com', '2020-09-15', '1 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'ASSI', 0),
(2, 'AGHUMYAN', 'Mesrop', 'assi2@gmail.com', '2020-09-15', '2 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'ASSI', 0),
(3, 'BORIE', 'Yanis', 'assi3@gmail.com', '2020-09-15', '3 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'ASSI', 0),
(4, 'CURVAT', 'Elliot', 'assi4@gmail.com', '2020-09-15', '541 Chemin Des Bulliances', 38460, 'CHAMAGNIEU', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'ASSI', 0),
(5, 'JALOUX', 'Christophe', 'mana@gmail.com', '2020-06-10', '4 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'MANA', 0),
(6, 'NDIAYE', 'Samba', 'mana2@gmail.com', '2020-06-10', '5 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'MANA', 0),
(7, 'HEGELBACHER', 'Eliot', 'poly@gmail.com', '2022-10-10', '6 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(8, 'BROUTIER', 'Charlène', 'poly2@gmail.com', '2022-10-10', '7 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 1),
(9, 'TURC', 'Romane', 'poly3@gmail.com', '2022-10-10', '8 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(10, 'JIN', 'Vanessa', 'poly4@gmail.com', '2022-10-10', '9 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(11, 'COSTE', 'Léo', 'poly5@gmail.com', '2022-10-10', '10 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(12, 'LAVERIE', 'Camille', 'poly6@gmail.com', '2022-10-10', '11 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(13, 'GUICHON', 'Thierry', 'poly7@gmail.com', '2022-10-10', '12 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(14, 'MESNARD--SAUVERZAC', 'Emrys', 'poly8@gmail.com', '2022-10-10', '13 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(15, 'MASSARD', 'Valentin', 'poly9@gmail.com', '2022-10-10', '14 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(16, 'TACHER', 'Adrien', 'poly10@gmail.com', '2022-10-10', '15 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(17, 'LAGOUCHE', 'Erwan', 'poly11@gmail.com', '2022-10-10', '16 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(18, 'MICHEL', 'Noah', 'poly12@gmail.com', '2022-10-10', '17 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(19, 'MENARD', 'Simon', 'poly13@gmail.com', '2022-10-10', '18 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(20, 'ARAUD', 'Jules', 'poly14@gmail.com', '2022-10-10', '19 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(21, 'MOUNIER', 'Bastian', 'poly15@gmail.com', '2022-10-10', '20 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `ID_ETAT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_ETAT` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_ETAT`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`ID_ETAT`, `NOM_ETAT`) VALUES
(1, 'Publié'),
(2, 'Caché'),
(3, 'En attente'),
(4, 'Acceptée'),
(5, 'Refusée');

-- --------------------------------------------------------

--
-- Structure de la table `jour`
--

DROP TABLE IF EXISTS `jour`;
CREATE TABLE IF NOT EXISTS `jour` (
  `ID_JOUR` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PLANNING` int(11) NOT NULL,
  `N_JOUR` int(11) NOT NULL,
  `ID_SERVICE` varchar(1) NOT NULL,
  PRIMARY KEY (`ID_JOUR`),
  KEY `FK_CONTIENT` (`ID_PLANNING`),
  KEY `FK_JOUR_SERVICE` (`ID_SERVICE`)
) ENGINE=InnoDB AUTO_INCREMENT=512 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jour`
--

INSERT INTO `jour` (`ID_JOUR`, `ID_PLANNING`, `N_JOUR`, `ID_SERVICE`) VALUES
(1, 1, 1, 'a'),
(2, 1, 2, 'a'),
(3, 1, 3, 'a'),
(4, 1, 6, 'a'),
(5, 1, 7, 'a'),
(6, 2, 1, 'a'),
(7, 2, 2, 'a'),
(8, 2, 3, 'a'),
(9, 11, 1, 'a'),
(10, 11, 2, 'a'),
(11, 11, 3, 'a'),
(12, 11, 4, 'a'),
(13, 11, 5, 'a'),
(14, 11, 6, 'a'),
(15, 11, 7, 'a'),
(16, 5, 1, 'a'),
(17, 5, 2, 'd'),
(18, 5, 3, 'a'),
(19, 5, 4, 'a'),
(20, 5, 5, 'a'),
(21, 5, 6, 'a'),
(22, 5, 7, 'y'),
(23, 6, 1, 'y'),
(24, 6, 2, 'y'),
(25, 6, 3, 'y'),
(26, 6, 4, 'f'),
(27, 2, 5, 'a'),
(28, 2, 6, 'a'),
(29, 10, 1, 'a'),
(30, 13, 1, 'a'),
(31, 14, 1, 'a'),
(32, 15, 1, 'a'),
(33, 15, 3, 'a'),
(34, 16, 4, 'b'),
(35, 17, 2, 'y'),
(36, 17, 3, 'y'),
(37, 17, 4, 'y'),
(38, 17, 5, 'y'),
(223, 39, 4, 'y'),
(224, 39, 5, 'y'),
(227, 24, 0, 'b'),
(228, 25, 0, 'b'),
(229, 26, 0, 'c'),
(230, 27, 0, 'f'),
(231, 28, 0, 'g'),
(232, 29, 0, 'h'),
(233, 30, 0, 'a'),
(234, 31, 0, 'g'),
(235, 32, 0, 'e'),
(236, 33, 0, 'g'),
(237, 18, 0, 'd'),
(238, 19, 0, 'i'),
(239, 20, 0, 'i'),
(240, 24, 1, 'y'),
(241, 25, 1, 'g'),
(242, 26, 1, 'g'),
(243, 27, 1, 'b'),
(244, 28, 1, 'y'),
(245, 29, 1, 'b'),
(246, 31, 1, 'g'),
(247, 34, 1, 'a'),
(248, 35, 1, 'f'),
(249, 36, 1, 'e'),
(250, 37, 1, 'c'),
(251, 38, 1, 'h'),
(252, 18, 1, 'i'),
(253, 21, 1, 'd'),
(254, 22, 1, 'i'),
(255, 24, 2, 'y'),
(256, 25, 2, 'g'),
(257, 26, 2, 'b'),
(258, 28, 2, 'y'),
(259, 30, 2, 'h'),
(260, 32, 2, 'g'),
(261, 33, 2, 'g'),
(262, 34, 2, 'c'),
(263, 35, 2, 'a'),
(264, 36, 2, 'b'),
(265, 37, 2, 'f'),
(266, 38, 2, 'e'),
(267, 21, 2, 'i'),
(268, 22, 2, 'i'),
(269, 23, 2, 'd'),
(270, 24, 3, 'c'),
(271, 25, 3, 'y'),
(272, 27, 3, 'b'),
(273, 28, 3, 'g'),
(274, 32, 3, 'g'),
(275, 33, 3, 'e'),
(276, 34, 3, 'h'),
(277, 35, 3, 'a'),
(278, 36, 3, 'g'),
(279, 37, 3, 'b'),
(280, 38, 3, 'f'),
(281, 19, 3, 'i'),
(282, 20, 3, 'i'),
(283, 23, 3, 'd'),
(284, 24, 4, 'c'),
(285, 25, 4, 'y'),
(286, 28, 4, 'f'),
(287, 29, 4, 'b'),
(288, 30, 4, 'h'),
(289, 31, 4, 'a'),
(290, 32, 4, 'z'),
(291, 34, 4, 'b'),
(292, 35, 4, 'e'),
(293, 36, 4, 'g'),
(294, 37, 4, 'g'),
(295, 38, 4, 'g'),
(296, 19, 4, 'i'),
(297, 20, 4, 'i'),
(298, 23, 4, 'd'),
(299, 24, 5, 'b'),
(300, 25, 5, 'g'),
(301, 26, 5, 'g'),
(302, 27, 5, 'h'),
(303, 28, 5, 'b'),
(304, 29, 5, 'g'),
(305, 30, 5, 'e'),
(306, 31, 5, 'a'),
(307, 32, 5, 'c'),
(308, 33, 5, 'f'),
(309, 18, 5, 'i'),
(310, 21, 5, 'd'),
(311, 22, 5, 'i'),
(312, 24, 6, 'b'),
(313, 25, 6, 'a'),
(314, 26, 6, 'g'),
(315, 27, 6, 'b'),
(316, 28, 6, 'f'),
(317, 29, 6, 'c'),
(318, 30, 6, 'g'),
(319, 31, 6, 'h'),
(320, 32, 6, 'e'),
(321, 33, 6, 'g'),
(322, 18, 6, 'i'),
(323, 21, 6, 'd'),
(324, 22, 6, 'i'),
(325, 46, 0, 'b'),
(326, 47, 0, 'c'),
(327, 39, 0, 'f'),
(328, 48, 0, 'g'),
(329, 49, 0, 'a'),
(330, 50, 0, 'e'),
(331, 51, 0, 'g'),
(332, 52, 0, 'h'),
(333, 53, 0, 'g'),
(334, 54, 0, 'b'),
(335, 40, 0, 'd'),
(336, 41, 0, 'i'),
(337, 42, 0, 'i'),
(338, 46, 1, 'f'),
(339, 47, 1, 'g'),
(340, 39, 1, 'e'),
(341, 48, 1, 'b'),
(342, 49, 1, 'b'),
(343, 52, 1, 'z'),
(344, 55, 1, 'a'),
(345, 56, 1, 'c'),
(346, 57, 1, 'h'),
(347, 58, 1, 'g'),
(348, 59, 1, 'g'),
(349, 40, 1, 'i'),
(350, 43, 1, 'd'),
(351, 44, 1, 'i'),
(352, 46, 2, 'c'),
(353, 50, 2, 'g'),
(354, 51, 2, 'a'),
(355, 52, 2, 'h'),
(356, 53, 2, 'b'),
(357, 54, 2, 'z'),
(358, 55, 2, 'b'),
(359, 56, 2, 'f'),
(360, 57, 2, 'e'),
(361, 58, 2, 'g'),
(362, 59, 2, 'g'),
(363, 43, 2, 'i'),
(364, 44, 2, 'i'),
(365, 45, 2, 'd'),
(366, 39, 3, 'y'),
(367, 50, 3, 'h'),
(368, 51, 3, 'g'),
(369, 52, 3, 'b'),
(370, 53, 3, 'g'),
(371, 54, 3, 'e'),
(372, 55, 3, 'f'),
(373, 56, 3, 'a'),
(374, 57, 3, 'b'),
(375, 58, 3, 'g'),
(376, 59, 3, 'c'),
(377, 41, 3, 'i'),
(378, 42, 3, 'i'),
(379, 45, 3, 'd'),
(380, 47, 4, 'e'),
(381, 39, 4, 'y'),
(382, 48, 4, 'g'),
(383, 49, 4, 'g'),
(384, 50, 4, 'g'),
(385, 53, 4, 'z'),
(386, 54, 4, 'b'),
(387, 55, 4, 'f'),
(388, 56, 4, 'h'),
(389, 57, 4, 'b'),
(390, 58, 4, 'a'),
(391, 59, 4, 'c'),
(392, 41, 4, 'i'),
(393, 42, 4, 'i'),
(394, 45, 4, 'd'),
(395, 46, 5, 'e'),
(396, 47, 5, 'a'),
(397, 39, 5, 'b'),
(398, 48, 5, 'c'),
(399, 49, 5, 'b'),
(400, 51, 5, 'g'),
(401, 52, 5, 'f'),
(402, 53, 5, 'h'),
(403, 54, 5, 'g'),
(404, 55, 5, 'g'),
(405, 40, 5, 'i'),
(406, 43, 5, 'd'),
(407, 44, 5, 'i'),
(408, 46, 6, 'g'),
(409, 47, 6, 'f'),
(410, 39, 6, 'c'),
(411, 48, 6, 'b'),
(412, 49, 6, 'g'),
(413, 51, 6, 'b'),
(414, 52, 6, 'g'),
(415, 53, 6, 'e'),
(416, 54, 6, 'a'),
(417, 56, 6, 'h'),
(418, 40, 6, 'i'),
(419, 43, 6, 'd'),
(420, 44, 6, 'i'),
(421, 66, 0, 'g'),
(422, 67, 0, 'b'),
(423, 68, 0, 'c'),
(424, 69, 0, 'a'),
(425, 70, 0, 'h'),
(426, 71, 0, 'f'),
(427, 72, 0, 'g'),
(428, 73, 0, 'b'),
(429, 74, 0, 'e'),
(430, 75, 0, 'g'),
(431, 60, 0, 'd'),
(432, 61, 0, 'i'),
(433, 62, 0, 'i'),
(434, 66, 1, 'c'),
(435, 67, 1, 'b'),
(436, 68, 1, 'b'),
(437, 69, 1, 'g'),
(438, 70, 1, 'g'),
(439, 76, 1, 'h'),
(440, 77, 1, 'f'),
(441, 78, 1, 'e'),
(442, 79, 1, 'g'),
(443, 80, 1, 'a'),
(444, 60, 1, 'i'),
(445, 63, 1, 'd'),
(446, 64, 1, 'i'),
(447, 71, 2, 'c'),
(448, 72, 2, 'b'),
(449, 73, 2, 'a'),
(450, 74, 2, 'h'),
(451, 75, 2, 'e'),
(452, 76, 2, 'g'),
(453, 77, 2, 'g'),
(454, 78, 2, 'f'),
(455, 79, 2, 'b'),
(456, 80, 2, 'g'),
(457, 63, 2, 'i'),
(458, 64, 2, 'i'),
(459, 65, 2, 'd'),
(460, 71, 3, 'e'),
(461, 72, 3, 'a'),
(462, 73, 3, 'f'),
(463, 74, 3, 'c'),
(464, 75, 3, 'h'),
(465, 76, 3, 'g'),
(466, 77, 3, 'g'),
(467, 78, 3, 'b'),
(468, 79, 3, 'g'),
(469, 80, 3, 'b'),
(470, 61, 3, 'i'),
(471, 62, 3, 'i'),
(472, 65, 3, 'd'),
(473, 66, 4, 'f'),
(474, 67, 4, 'a'),
(475, 68, 4, 'e'),
(476, 69, 4, 'c'),
(477, 70, 4, 'g'),
(478, 76, 4, 'b'),
(479, 77, 4, 'g'),
(480, 78, 4, 'g'),
(481, 79, 4, 'b'),
(482, 80, 4, 'h'),
(483, 61, 4, 'i'),
(484, 62, 4, 'i'),
(485, 65, 4, 'd'),
(486, 66, 5, 'g'),
(487, 67, 5, 'g'),
(488, 68, 5, 'g'),
(489, 69, 5, 'b'),
(490, 70, 5, 'b'),
(491, 71, 5, 'e'),
(492, 72, 5, 'a'),
(493, 73, 5, 'c'),
(494, 74, 5, 'f'),
(495, 75, 5, 'h'),
(496, 60, 5, 'i'),
(497, 63, 5, 'd'),
(498, 64, 5, 'i'),
(499, 66, 6, 'a'),
(500, 67, 6, 'g'),
(501, 68, 6, 'e'),
(502, 69, 6, 'h'),
(503, 70, 6, 'g'),
(504, 71, 6, 'b'),
(505, 72, 6, 'g'),
(506, 73, 6, 'c'),
(507, 74, 6, 'b'),
(508, 75, 6, 'f'),
(509, 60, 6, 'i'),
(510, 63, 6, 'd'),
(511, 64, 6, 'i');

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

DROP TABLE IF EXISTS `planning`;
CREATE TABLE IF NOT EXISTS `planning` (
  `ID_PLANNING` int(11) NOT NULL AUTO_INCREMENT,
  `ID_EMPLOYE` int(11) NOT NULL,
  `N_SEMAINE` int(11) DEFAULT NULL,
  `ANNEE_PLANNING` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`ID_PLANNING`),
  KEY `FK_POSSEDE` (`ID_EMPLOYE`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`ID_PLANNING`, `ID_EMPLOYE`, `N_SEMAINE`, `ANNEE_PLANNING`) VALUES
(1, 1, 44, 2022),
(2, 3, 48, 2022),
(5, 3, 51, 2022),
(6, 3, 52, 2022),
(8, 3, 1, 2023),
(9, 3, 2, 2023),
(10, 3, 49, 2022),
(11, 3, 50, 2022),
(13, 2, 49, 2022),
(14, 1, 49, 2022),
(15, 2, 50, 2022),
(16, 2, 52, 2022),
(17, 1, 52, 2022),
(18, 1, 3, 2023),
(19, 2, 3, 2023),
(20, 3, 3, 2023),
(21, 4, 3, 2023),
(22, 5, 3, 2023),
(23, 6, 3, 2023),
(24, 7, 3, 2023),
(25, 8, 3, 2023),
(26, 9, 3, 2023),
(27, 10, 3, 2023),
(28, 11, 3, 2023),
(29, 12, 3, 2023),
(30, 13, 3, 2023),
(31, 14, 3, 2023),
(32, 15, 3, 2023),
(33, 16, 3, 2023),
(34, 17, 3, 2023),
(35, 18, 3, 2023),
(36, 19, 3, 2023),
(37, 20, 3, 2023),
(38, 21, 3, 2023),
(39, 9, 4, 2023),
(40, 1, 4, 2023),
(41, 2, 4, 2023),
(42, 3, 4, 2023),
(43, 4, 4, 2023),
(44, 5, 4, 2023),
(45, 6, 4, 2023),
(46, 7, 4, 2023),
(47, 8, 4, 2023),
(48, 10, 4, 2023),
(49, 11, 4, 2023),
(50, 12, 4, 2023),
(51, 13, 4, 2023),
(52, 14, 4, 2023),
(53, 15, 4, 2023),
(54, 16, 4, 2023),
(55, 17, 4, 2023),
(56, 18, 4, 2023),
(57, 19, 4, 2023),
(58, 20, 4, 2023),
(59, 21, 4, 2023),
(60, 1, 5, 2023),
(61, 2, 5, 2023),
(62, 3, 5, 2023),
(63, 4, 5, 2023),
(64, 5, 5, 2023),
(65, 6, 5, 2023),
(66, 7, 5, 2023),
(67, 8, 5, 2023),
(68, 9, 5, 2023),
(69, 10, 5, 2023),
(70, 11, 5, 2023),
(71, 12, 5, 2023),
(72, 13, 5, 2023),
(73, 14, 5, 2023),
(74, 15, 5, 2023),
(75, 16, 5, 2023),
(76, 17, 5, 2023),
(77, 18, 5, 2023),
(78, 19, 5, 2023),
(79, 20, 5, 2023),
(80, 21, 5, 2023);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `ID_PRODUIT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_UNITE` int(11) NOT NULL,
  `DENOMINATION` varchar(255) DEFAULT NULL,
  `DERNIERE_MODIF` datetime DEFAULT NULL,
  `QUANTITE_EN_STOCK` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`ID_PRODUIT`),
  KEY `FK_EST_EN` (`ID_UNITE`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`ID_PRODUIT`, `ID_UNITE`, `DENOMINATION`, `DERNIERE_MODIF`, `QUANTITE_EN_STOCK`) VALUES
(1, 2, 'Pâte à pizza', '2022-11-20 22:25:58', '10'),
(2, 1, 'Champignons', '2022-11-16 21:20:18', '49'),
(3, 3, 'Sauce tomate ', '2022-11-20 20:02:53', '20'),
(4, 1, 'Fromage', '2022-11-20 22:25:58', '5'),
(5, 2, 'Boîte', '2022-11-16 21:20:18', '126');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `ID_SERVICE` varchar(1) NOT NULL,
  `NOMBRE` int(2) NOT NULL DEFAULT '1',
  `DEBUT_SERVICE` time NOT NULL,
  `FIN_SERVICE` time NOT NULL,
  PRIMARY KEY (`ID_SERVICE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`ID_SERVICE`, `NOMBRE`, `DEBUT_SERVICE`, `FIN_SERVICE`) VALUES
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
-- Structure de la table `unite`
--

DROP TABLE IF EXISTS `unite`;
CREATE TABLE IF NOT EXISTS `unite` (
  `ID_UNITE` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_UNITE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID_UNITE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `unite`
--

INSERT INTO `unite` (`ID_UNITE`, `NOM_UNITE`) VALUES
(1, 'kg'),
(2, 'unités'),
(3, 'litres');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `FK_DECLARE` FOREIGN KEY (`ID_EMPLOYE`) REFERENCES `employe` (`ID_EMPLOYE`);

--
-- Contraintes pour la table `conge`
--
ALTER TABLE `conge`
  ADD CONSTRAINT `FK_DEMANDE` FOREIGN KEY (`ID_EMPLOYE`) REFERENCES `employe` (`ID_EMPLOYE`),
  ADD CONSTRAINT `FK_EST_QUALIFIE_PAR` FOREIGN KEY (`ID_ETAT`) REFERENCES `etat` (`ID_ETAT`);

--
-- Contraintes pour la table `echange`
--
ALTER TABLE `echange`
  ADD CONSTRAINT `FK_EMPLOYE_EMETTEUR` FOREIGN KEY (`ID_EMPLOYE_EMETTEUR`) REFERENCES `employe` (`ID_EMPLOYE`),
  ADD CONSTRAINT `FK_EMPLOYE_RECEPTEUR` FOREIGN KEY (`ID_EMPLOYE_RECEPTEUR`) REFERENCES `employe` (`ID_EMPLOYE`),
  ADD CONSTRAINT `FK_EST_PRECISE_PAR` FOREIGN KEY (`ID_ETAT`) REFERENCES `etat` (`ID_ETAT`),
  ADD CONSTRAINT `FK_JOUR_EMETTEUR` FOREIGN KEY (`ID_JOUR_EMETTEUR`) REFERENCES `jour` (`ID_JOUR`),
  ADD CONSTRAINT `FK_JOUR_RECEPTEUR` FOREIGN KEY (`ID_JOUR_RECEPTEUR`) REFERENCES `jour` (`ID_JOUR`);

--
-- Contraintes pour la table `jour`
--
ALTER TABLE `jour`
  ADD CONSTRAINT `FK_CONTIENT` FOREIGN KEY (`ID_PLANNING`) REFERENCES `planning` (`ID_PLANNING`),
  ADD CONSTRAINT `FK_JOUR_SERVICE` FOREIGN KEY (`ID_SERVICE`) REFERENCES `service` (`ID_SERVICE`);

--
-- Contraintes pour la table `planning`
--
ALTER TABLE `planning`
  ADD CONSTRAINT `FK_POSSEDE` FOREIGN KEY (`ID_EMPLOYE`) REFERENCES `employe` (`ID_EMPLOYE`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_EST_EN` FOREIGN KEY (`ID_UNITE`) REFERENCES `unite` (`ID_UNITE`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
