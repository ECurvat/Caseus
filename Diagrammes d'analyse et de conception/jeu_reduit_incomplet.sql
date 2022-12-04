-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 04 déc. 2022 à 13:44
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
-- Structure de la table `comprend`
--

CREATE TABLE `comprend` (
  `ID_LIVRAISON` int(11) NOT NULL,
  `ID_PRODUIT` int(11) NOT NULL,
  `QUANTITE_LIVREE` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `conge`
--

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
(7, 4, 3, '2022-11-21', '2022-11-27', '2022-11-29'),
(8, 4, 3, '2022-11-28', '2022-11-30', '2022-11-29'),
(12, 4, 3, '2022-12-19', '2022-12-20', '2022-12-02'),
(13, 4, 3, '2022-12-05', '2023-01-01', '2022-12-02'),
(14, 4, 3, '2023-01-02', '2023-01-09', '2022-12-02'),
(15, 4, 3, '2022-12-05', '2022-12-19', '2022-12-02'),
(16, 4, 3, '2022-12-12', '2022-12-29', '2022-12-03'),
(17, 5, 3, '2022-12-03', '2022-12-13', '2022-12-03'),
(18, 4, 3, '2022-12-02', '2022-12-03', '2022-12-04');

-- --------------------------------------------------------

--
-- Structure de la table `disponibilite`
--

CREATE TABLE `disponibilite` (
  `ID_DISPO` int(11) NOT NULL,
  `ID_EMPLOYE` int(11) NOT NULL,
  `DEBUT_DISPO` datetime DEFAULT NULL,
  `FIN_DISPO` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `disponibilite`
--

INSERT INTO `disponibilite` (`ID_DISPO`, `ID_EMPLOYE`, `DEBUT_DISPO`, `FIN_DISPO`) VALUES
(1, 1, '2022-11-09 15:00:00', '2022-11-09 23:59:00'),
(2, 1, '2022-12-01 05:00:00', '2022-12-01 22:30:00'),
(3, 2, '2022-11-05 12:00:00', '2022-11-05 21:00:00'),
(10, 1, '2022-11-12 01:00:00', '2022-11-12 18:00:00'),
(16, 3, '2022-11-03 10:30:00', '2022-11-03 19:30:00'),
(17, 3, '2022-11-08 19:45:00', '2022-11-08 22:45:00');

-- --------------------------------------------------------

--
-- Structure de la table `echange`
--

CREATE TABLE `echange` (
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
-- Structure de la table `employe`
--

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
  `POSITION` varchar(255) NOT NULL DEFAULT 'POLY'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`ID_EMPLOYE`, `NOM`, `PRENOM`, `ADRESSE_MAIL`, `DATE_EMBAUCHE`, `ADRESSE`, `CODE_POSTAL`, `VILLE`, `MDP`, `POSITION`) VALUES
(1, 'COURTET', 'Tom', 'poly@gmail.com', '2022-10-01', '1 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY'),
(2, 'AGHUMYAN', 'Mesrop', 'assi@gmail.com', '2022-10-10', '2 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'ASSI'),
(3, NULL, NULL, 'mana@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'MANA');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

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

CREATE TABLE `jour` (
  `ID_JOUR` int(11) NOT NULL,
  `ID_PLANNING` int(11) NOT NULL,
  `ID_ECHANGE` int(11) DEFAULT NULL,
  `N_JOUR` int(11) NOT NULL,
  `RETARD` tinyint(1) DEFAULT NULL,
  `DEBUT_JOURNEE` time DEFAULT NULL,
  `FIN_JOURNEE` time DEFAULT NULL,
  `CONGE` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `jour`
--

INSERT INTO `jour` (`ID_JOUR`, `ID_PLANNING`, `ID_ECHANGE`, `N_JOUR`, `RETARD`, `DEBUT_JOURNEE`, `FIN_JOURNEE`, `CONGE`) VALUES
(1, 1, NULL, 1, 0, '10:00:00', '18:00:00', 0),
(2, 1, NULL, 2, 0, '10:00:00', '18:00:00', 0),
(3, 1, NULL, 3, 1, '10:00:00', '18:00:00', 0),
(4, 1, NULL, 6, 0, '15:00:00', '23:00:00', 0),
(5, 1, NULL, 7, 0, '15:00:00', '23:00:00', 0),
(6, 2, NULL, 1, NULL, NULL, NULL, 1),
(7, 2, NULL, 2, NULL, NULL, NULL, 1),
(8, 2, NULL, 3, NULL, NULL, NULL, 1),
(9, 11, NULL, 1, NULL, NULL, NULL, 1),
(10, 11, NULL, 2, NULL, NULL, NULL, 1),
(11, 11, NULL, 3, NULL, NULL, NULL, 1),
(12, 11, NULL, 4, NULL, NULL, NULL, 1),
(13, 11, NULL, 5, NULL, NULL, NULL, 1),
(14, 11, NULL, 6, NULL, NULL, NULL, 1),
(15, 11, NULL, 7, NULL, NULL, NULL, 1),
(16, 5, NULL, 1, NULL, NULL, NULL, 1),
(17, 5, NULL, 2, NULL, NULL, NULL, 1),
(18, 5, NULL, 3, NULL, NULL, NULL, 1),
(19, 5, NULL, 4, NULL, NULL, NULL, 1),
(20, 5, NULL, 5, NULL, NULL, NULL, 1),
(21, 5, NULL, 6, NULL, NULL, NULL, 1),
(22, 5, NULL, 7, NULL, NULL, NULL, 1),
(23, 6, NULL, 1, NULL, NULL, NULL, 1),
(24, 6, NULL, 2, NULL, NULL, NULL, 1),
(25, 6, NULL, 3, NULL, NULL, NULL, 1),
(26, 6, NULL, 4, NULL, NULL, NULL, 1),
(27, 2, NULL, 5, NULL, NULL, NULL, 1),
(28, 2, NULL, 6, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `ID_LIVRAISON` int(11) NOT NULL,
  `DATE_LIVRAISON` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

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
(11, 3, 1, 50, 2022);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

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
-- Structure de la table `supervise`
--

CREATE TABLE `supervise` (
  `ID_EMPLOYE` int(11) NOT NULL,
  `ID_LIVRAISON` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

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
-- Index pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD PRIMARY KEY (`ID_DISPO`),
  ADD KEY `FK_DECLARE` (`ID_EMPLOYE`);

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
  ADD KEY `FK_CONCERNE` (`ID_ECHANGE`),
  ADD KEY `FK_CONTIENT` (`ID_PLANNING`);

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
-- AUTO_INCREMENT pour la table `conge`
--
ALTER TABLE `conge`
  MODIFY `ID_DEMANDE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  MODIFY `ID_DISPO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `echange`
--
ALTER TABLE `echange`
  MODIFY `ID_ECHANGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `ID_EMPLOYE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `ID_ETAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `jour`
--
ALTER TABLE `jour`
  MODIFY `ID_JOUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `ID_LIVRAISON` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `ID_PLANNING` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
-- Contraintes pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD CONSTRAINT `FK_DECLARE` FOREIGN KEY (`ID_EMPLOYE`) REFERENCES `employe` (`ID_EMPLOYE`);

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
  ADD CONSTRAINT `FK_CONCERNE` FOREIGN KEY (`ID_ECHANGE`) REFERENCES `echange` (`ID_ECHANGE`),
  ADD CONSTRAINT `FK_CONTIENT` FOREIGN KEY (`ID_PLANNING`) REFERENCES `planning` (`ID_PLANNING`);

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
