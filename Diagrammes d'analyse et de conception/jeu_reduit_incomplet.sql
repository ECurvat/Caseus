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
-- Base de données : `jeu_reduit`
--

-- --------------------------------------------------------

--
-- Structure de la table `absence`
--

DROP TABLE IF EXISTS `absence`;
CREATE TABLE `absence` (
  `ID_ABSENCE` int(11) NOT NULL,
  `ID_EMPLOYE` int(11) NOT NULL,
  `DEBUT_ABSENCE` datetime DEFAULT NULL,
  `FIN_ABSENCE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(29, 14, '2022-12-31 03:00:00', '2022-12-31 20:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `comprend`
--

DROP TABLE IF EXISTS `comprend`;
CREATE TABLE `comprend` (
  `ID_LIVRAISON` int(11) NOT NULL,
  `ID_PRODUIT` int(11) NOT NULL,
  `QUANTITE_LIVREE` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

DROP TABLE IF EXISTS `conge`;
CREATE TABLE `conge` (
  `ID_DEMANDE` int(11) NOT NULL,
  `ID_ETAT` int(11) NOT NULL,
  `ID_EMPLOYE` int(11) NOT NULL,
  `DEBUT_CONGE` date DEFAULT NULL,
  `FIN_CONGE` date DEFAULT NULL,
  `DATE_DEMANDE` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `conge`
--

INSERT INTO `conge` (`ID_DEMANDE`, `ID_ETAT`, `ID_EMPLOYE`, `DEBUT_CONGE`, `FIN_CONGE`, `DATE_DEMANDE`) VALUES
(1, 5, 1, '2022-11-27', '2022-11-27', '2022-11-27'),
(6, 4, 1, '2022-11-01', '2022-11-30', '2022-11-27'),
(14, 4, 3, '2023-01-02', '2023-01-09', '2022-12-02'),
(20, 5, 2, '2022-12-12', '2022-12-16', '2022-12-12'),
(22, 4, 3, '2022-12-25', '2022-12-28', '2022-12-28'),
(23, 4, 1, '2022-12-27', '2022-12-28', '2022-12-29');

-- --------------------------------------------------------

--
-- Structure de la table `echange`
--

DROP TABLE IF EXISTS `echange`;
CREATE TABLE `echange` (
  `ID_ECHANGE` int(11) NOT NULL,
  `ID_ETAT` int(11) NOT NULL,
  `ID_JOUR_EMETTEUR` int(11) NOT NULL,
  `ID_EMPLOYE_EMETTEUR` int(11) NOT NULL,
  `ID_JOUR_RECEPTEUR` int(11) NOT NULL,
  `ID_EMPLOYE_RECEPTEUR` int(11) NOT NULL,
  `DATE_PROPOSITION` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `echange`
--

INSERT INTO `echange` (`ID_ECHANGE`, `ID_ETAT`, `ID_JOUR_EMETTEUR`, `ID_EMPLOYE_EMETTEUR`, `ID_JOUR_RECEPTEUR`, `ID_EMPLOYE_RECEPTEUR`, `DATE_PROPOSITION`) VALUES
(7, 4, 9, 3, 32, 2, '2022-12-10'),
(9, 5, 30, 2, 29, 3, '2022-12-12'),
(11, 5, 32, 2, 9, 3, '2022-12-12'),
(13, 4, 33, 2, 11, 3, '2022-12-13'),
(16, 4, 26, 3, 34, 2, '2022-12-28');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

DROP TABLE IF EXISTS `employe`;
CREATE TABLE `employe` (
  `ID_EMPLOYE` int(11) NOT NULL,
  `NOM` varchar(255) DEFAULT NULL,
  `PRENOM` varchar(255) DEFAULT NULL,
  `ADRESSE_MAIL` varchar(255) DEFAULT NULL,
  `DATE_EMBAUCHE` date DEFAULT NULL,
  `ADRESSE` varchar(255) DEFAULT NULL,
  `CODE_POSTAL` int(11) DEFAULT NULL,
  `VILLE` varchar(255) DEFAULT NULL,
  `MDP` varchar(255) NOT NULL,
  `POSITION` varchar(255) NOT NULL DEFAULT 'POLY',
  `HEURES_SUP` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`ID_EMPLOYE`, `NOM`, `PRENOM`, `ADRESSE_MAIL`, `DATE_EMBAUCHE`, `ADRESSE`, `CODE_POSTAL`, `VILLE`, `MDP`, `POSITION`, `HEURES_SUP`) VALUES
(1, 'COURTET', 'Tom', 'poly@gmail.com', '2022-10-01', '1 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(2, 'AGHUMYAN', 'Mesrop', 'assi@gmail.com', '2022-10-10', '2 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'ASSI', 0),
(3, NULL, NULL, 'mana@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'MANA', 0),
(4, 'Curvat', 'Elliot', 'poly2@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(5, 'Curvat', 'Elliot', 'poly3@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(6, 'Curvat', 'Elliot', 'poly4@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(7, 'Curvat', 'Elliot', 'poly5@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(8, 'Curvat', 'Elliot', 'poly6@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(9, 'Curvat', 'Elliot', 'poly7@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(10, 'Curvat', 'Elliot', 'poly8@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(11, 'Curvat', 'Elliot', 'poly9@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(12, 'Curvat', 'Elliot', 'poly10@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(13, 'Curvat', 'Elliot', 'poly11@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(14, 'Curvat', 'Elliot', 'poly12@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(15, 'Curvat', 'Elliot', 'poly13@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 1);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE `etat` (
  `ID_ETAT` int(11) NOT NULL,
  `NOM_ETAT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
CREATE TABLE `jour` (
  `ID_JOUR` int(11) NOT NULL,
  `ID_PLANNING` int(11) NOT NULL,
  `N_JOUR` int(11) NOT NULL,
  `ID_SERVICE` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(38, 17, 5, 'y');

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE `livraison` (
  `ID_LIVRAISON` int(11) NOT NULL,
  `DATE_LIVRAISON` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

DROP TABLE IF EXISTS `planning`;
CREATE TABLE `planning` (
  `ID_PLANNING` int(11) NOT NULL,
  `ID_EMPLOYE` int(11) NOT NULL,
  `ID_ETAT` int(11) NOT NULL,
  `N_SEMAINE` int(11) DEFAULT NULL,
  `ANNEE_PLANNING` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`ID_PLANNING`, `ID_EMPLOYE`, `ID_ETAT`, `N_SEMAINE`, `ANNEE_PLANNING`) VALUES
(1, 1, 1, 44, 2022),
(2, 3, 1, 48, 2022),
(5, 3, 1, 51, 2022),
(6, 3, 1, 52, 2022),
(8, 3, 1, 1, 2023),
(9, 3, 1, 2, 2023),
(10, 3, 1, 49, 2022),
(11, 3, 1, 50, 2022),
(13, 2, 1, 49, 2022),
(14, 1, 1, 49, 2022),
(15, 2, 1, 50, 2022),
(16, 2, 1, 52, 2022),
(17, 1, 1, 52, 2022);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE `produit` (
  `ID_PRODUIT` int(11) NOT NULL,
  `ID_UNITE` int(11) NOT NULL,
  `DENOMINATION` varchar(255) DEFAULT NULL,
  `DERNIERE_MODIF` datetime DEFAULT NULL,
  `QUANTITE_EN_STOCK` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
CREATE TABLE `service` (
  `ID_SERVICE` varchar(1) NOT NULL,
  `NOMBRE` int(2) NOT NULL DEFAULT '1',
  `DEBUT_SERVICE` time NOT NULL,
  `FIN_SERVICE` time NOT NULL
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
-- Structure de la table `supervise`
--

DROP TABLE IF EXISTS `supervise`;
CREATE TABLE `supervise` (
  `ID_EMPLOYE` int(11) NOT NULL,
  `ID_LIVRAISON` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

DROP TABLE IF EXISTS `unite`;
CREATE TABLE `unite` (
  `ID_UNITE` int(11) NOT NULL,
  `NOM_UNITE` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `unite`
--

INSERT INTO `unite` (`ID_UNITE`, `NOM_UNITE`) VALUES
(1, 'kg'),
(2, 'unités'),
(3, 'litres');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `absence`
--
ALTER TABLE `absence`
  ADD PRIMARY KEY (`ID_ABSENCE`),
  ADD KEY `FK_DECLARE` (`ID_EMPLOYE`);

--
-- Index pour la table `comprend`
--
ALTER TABLE `comprend`
  ADD PRIMARY KEY (`ID_LIVRAISON`,`ID_PRODUIT`),
  ADD KEY `FK_COMPREND2` (`ID_PRODUIT`);

--
-- Index pour la table `conge`
--
ALTER TABLE `conge`
  ADD PRIMARY KEY (`ID_DEMANDE`),
  ADD KEY `FK_DEMANDE` (`ID_EMPLOYE`),
  ADD KEY `FK_EST_QUALIFIE_PAR` (`ID_ETAT`);

--
-- Index pour la table `echange`
--
ALTER TABLE `echange`
  ADD PRIMARY KEY (`ID_ECHANGE`),
  ADD KEY `FK_EST_PRECISE_PAR` (`ID_ETAT`),
  ADD KEY `FK_JOUR_RECEPTEUR` (`ID_JOUR_RECEPTEUR`),
  ADD KEY `FK_EMPLOYE_RECEPTEUR` (`ID_EMPLOYE_RECEPTEUR`),
  ADD KEY `FK_EMPLOYE_EMETTEUR` (`ID_EMPLOYE_EMETTEUR`) USING BTREE,
  ADD KEY `FK_JOUR_EMETTEUR` (`ID_JOUR_EMETTEUR`) USING BTREE;

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`ID_EMPLOYE`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`ID_ETAT`);

--
-- Index pour la table `jour`
--
ALTER TABLE `jour`
  ADD PRIMARY KEY (`ID_JOUR`),
  ADD KEY `FK_CONTIENT` (`ID_PLANNING`),
  ADD KEY `FK_JOUR_SERVICE` (`ID_SERVICE`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`ID_LIVRAISON`);

--
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`ID_PLANNING`),
  ADD KEY `FK_EST_CARACTERISE_PAR` (`ID_ETAT`),
  ADD KEY `FK_POSSEDE` (`ID_EMPLOYE`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`ID_PRODUIT`),
  ADD KEY `FK_EST_EN` (`ID_UNITE`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`ID_SERVICE`);

--
-- Index pour la table `supervise`
--
ALTER TABLE `supervise`
  ADD PRIMARY KEY (`ID_EMPLOYE`,`ID_LIVRAISON`);

--
-- Index pour la table `unite`
--
ALTER TABLE `unite`
  ADD PRIMARY KEY (`ID_UNITE`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `absence`
--
ALTER TABLE `absence`
  MODIFY `ID_ABSENCE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `conge`
--
ALTER TABLE `conge`
  MODIFY `ID_DEMANDE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `echange`
--
ALTER TABLE `echange`
  MODIFY `ID_ECHANGE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `ID_EMPLOYE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `ID_ETAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `jour`
--
ALTER TABLE `jour`
  MODIFY `ID_JOUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `ID_LIVRAISON` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `ID_PLANNING` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `ID_PRODUIT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `unite`
--
ALTER TABLE `unite`
  MODIFY `ID_UNITE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `absence`
--
ALTER TABLE `absence`
  ADD CONSTRAINT `FK_DECLARE` FOREIGN KEY (`ID_EMPLOYE`) REFERENCES `employe` (`ID_EMPLOYE`);

--
-- Contraintes pour la table `comprend`
--
ALTER TABLE `comprend`
  ADD CONSTRAINT `FK_COMPREND` FOREIGN KEY (`ID_LIVRAISON`) REFERENCES `livraison` (`ID_LIVRAISON`),
  ADD CONSTRAINT `FK_COMPREND2` FOREIGN KEY (`ID_PRODUIT`) REFERENCES `produit` (`ID_PRODUIT`);

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
  ADD CONSTRAINT `FK_EST_CARACTERISE_PAR` FOREIGN KEY (`ID_ETAT`) REFERENCES `etat` (`ID_ETAT`),
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
