-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 16 jan. 2023 à 16:10
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
(1, 3, '2023-01-06 16:40:00', '2023-01-06 18:40:00'),
(2, 3, '2023-01-16 08:40:00', '2023-01-16 16:40:00');

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
(1, 3, 3, '2023-01-18', '2023-01-22', '2023-01-16');

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
(17, 4, 793, 10, 794, 11, '2023-01-05'),
(18, 4, 769, 9, 766, 6, '2023-01-06'),
(19, 3, 836, 3, 834, 16, '2023-01-06');

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
(1, 'COURTET', 'Tom1', 'poly@gmail.com', '2022-10-01', '1 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$iOhJ2WZF9Ure/aDWNBap7e7H8908J00XZGZo.03jM6QQcKFFEVgkm', 'POLY', 0),
(2, 'AGHUMYAN', 'Mesrop2', 'assi@gmail.com', '2022-10-10', '2 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'ASSI', 0),
(3, 'Curvat', 'Elliot3', 'mana@gmail.com', NULL, '541 chemin des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'MANA', 1),
(4, 'Curvat', 'Elliot4', 'poly2@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(5, 'Curvat', 'Elliot5', 'poly3@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 1),
(6, 'Curvat', 'Elliot6', 'poly4@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(7, 'Curvat', 'Elliot7', 'poly5@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(8, 'Curvat', 'Elliot8', 'poly6@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$wuF93Lqi7CWUNszmcjzXnOcwbtFEUkWNfrbFKevXVdtapEiLOUBMe', 'POLY', 0),
(9, 'Curvat', 'Elliot9', 'poly7@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(10, 'Curvat', 'Elliot10', 'curvat.elliot@outlook.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$W/iNYAGpT6BRKOr0xWQ/x.0ezBtvj5SccJQorqRg4i1xnu9lGiU4y', 'POLY', 0),
(11, 'Curvat', 'Elliot11', 'poly9@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 1),
(12, 'Curvat', 'Elliot12', 'poly10@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 1),
(13, 'Curvat', 'Elliot13', 'poly11@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 0),
(15, 'Curvat', 'Elliot15', 'poly13@gmail.com', '2022-10-10', '541 Chemin Des Bulliances', 38460, 'Chamagnieu', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'POLY', 1),
(16, 'AGHUMYAN', 'Mesrop16', 'assi2@gmail.com', '2022-10-10', '2 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'ASSI', 0),
(17, 'AGHUMYAN', 'Mesrop17', 'assi3@gmail.com', '2022-10-10', '2 rue de la Technologie', 69100, 'VILLEURBANNE', '$2y$10$4hjO0EeVCpXqVxbm34bWCeuAcTyMuqw7DtMRW99ji2y6/oLvjkQdW', 'ASSI', 1),
(18, NULL, '18', 'mana2@gmail.com', NULL, NULL, NULL, NULL, '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', 'MANA', 1),
(22, 'CURVAT', 'Elliot22', 'curvat.elliot@outlook.com', '2022-12-02', 'test', 69100, 'Villeurbanne', '$2y$10$uVkj6cZj80Z4pvRuMywNouJdv0fJVPDNwPG9nwRX0/qyjvCZVu9Pe', 'MANA', 1);

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
(750, 88, 0, 'h'),
(751, 91, 0, 'f'),
(752, 92, 0, 'a'),
(753, 93, 0, 'e'),
(754, 94, 0, 'g'),
(755, 95, 0, 'c'),
(756, 96, 0, 'g'),
(757, 97, 0, 'g'),
(758, 98, 0, 'b'),
(759, 99, 0, 'b'),
(760, 89, 0, 'd'),
(761, 103, 0, 'i'),
(762, 104, 0, 'i'),
(763, 88, 1, 'h'),
(764, 91, 1, 'c'),
(765, 92, 1, 'f'),
(766, 93, 1, 'b'),
(767, 94, 1, 'g'),
(768, 95, 1, 'a'),
(769, 96, 1, 'g'),
(770, 100, 1, 'g'),
(772, 102, 1, 'e'),
(773, 89, 1, 'i'),
(774, 90, 1, 'd'),
(775, 105, 1, 'i'),
(776, 88, 2, 'g'),
(777, 91, 2, 'g'),
(778, 92, 2, 'b'),
(779, 93, 2, 'e'),
(780, 97, 2, 'c'),
(781, 98, 2, 'a'),
(782, 99, 2, 'b'),
(783, 100, 2, 'h'),
(785, 102, 2, 'f'),
(786, 103, 2, 'i'),
(787, 90, 2, 'd'),
(788, 105, 2, 'i'),
(789, 88, 3, 'f'),
(790, 94, 3, 'g'),
(791, 95, 3, 'g'),
(792, 96, 3, 'e'),
(793, 97, 3, 'a'),
(794, 98, 3, 'h'),
(795, 99, 3, 'g'),
(796, 100, 3, 'b'),
(798, 102, 3, 'b'),
(799, 103, 3, 'i'),
(800, 104, 3, 'd'),
(801, 90, 3, 'i'),
(802, 91, 4, 'g'),
(803, 94, 4, 'f'),
(804, 95, 4, 'b'),
(805, 96, 4, 'e'),
(806, 97, 4, 'g'),
(807, 98, 4, 'g'),
(808, 99, 4, 'c'),
(809, 100, 4, 'b'),
(811, 102, 4, 'a'),
(812, 89, 4, 'i'),
(813, 104, 4, 'd'),
(814, 105, 4, 'i'),
(815, 92, 5, 'f'),
(816, 93, 5, 'c'),
(817, 94, 5, 'g'),
(818, 95, 5, 'g'),
(819, 97, 5, 'h'),
(820, 98, 5, 'a'),
(821, 99, 5, 'b'),
(822, 100, 5, 'b'),
(824, 102, 5, 'e'),
(825, 89, 5, 'i'),
(826, 104, 5, 'd'),
(827, 105, 5, 'i'),
(828, 88, 6, 'e'),
(829, 91, 6, 'c'),
(830, 92, 6, 'h'),
(831, 93, 6, 'b'),
(832, 96, 6, 'g'),
(833, 102, 6, 'f'),
(834, 103, 6, 'i'),
(835, 104, 6, 'i'),
(836, 90, 6, 'd'),
(1012, 142, 0, 'c'),
(1013, 145, 0, 'h'),
(1014, 146, 0, 'g'),
(1015, 147, 0, 'a'),
(1016, 148, 0, 'b'),
(1017, 149, 0, 'e'),
(1018, 150, 0, 'g'),
(1019, 151, 0, 'f'),
(1020, 152, 0, 'g'),
(1021, 153, 0, 'b'),
(1022, 143, 0, 'd'),
(1023, 157, 0, 'i'),
(1024, 158, 0, 'i'),
(1025, 142, 1, 'a'),
(1026, 145, 1, 'g'),
(1027, 146, 1, 'g'),
(1028, 147, 1, 'g'),
(1029, 148, 1, 'f'),
(1030, 149, 1, 'h'),
(1031, 150, 1, 'b'),
(1032, 154, 1, 'c'),
(1034, 156, 1, 'e'),
(1035, 143, 1, 'i'),
(1036, 144, 1, 'd'),
(1037, 159, 1, 'i'),
(1038, 142, 2, 'g'),
(1039, 145, 2, 'b'),
(1040, 146, 2, 'g'),
(1041, 147, 2, 'c'),
(1042, 151, 2, 'b'),
(1043, 152, 2, 'a'),
(1044, 153, 2, 'e'),
(1045, 154, 2, 'f'),
(1047, 156, 2, 'h'),
(1048, 157, 2, 'i'),
(1049, 144, 2, 'd'),
(1050, 159, 2, 'i'),
(1051, 142, 3, 'a'),
(1052, 148, 3, 'h'),
(1053, 149, 3, 'g'),
(1054, 150, 3, 'b'),
(1055, 151, 3, 'e'),
(1056, 152, 3, 'g'),
(1057, 153, 3, 'b'),
(1058, 154, 3, 'g'),
(1060, 156, 3, 'c'),
(1061, 157, 3, 'i'),
(1062, 158, 3, 'd'),
(1063, 144, 3, 'i'),
(1064, 145, 4, 'g'),
(1065, 148, 4, 'g'),
(1066, 149, 4, 'e'),
(1067, 150, 4, 'a'),
(1068, 151, 4, 'h'),
(1069, 152, 4, 'b'),
(1070, 153, 4, 'g'),
(1071, 154, 4, 'f'),
(1073, 156, 4, 'c'),
(1074, 143, 4, 'i'),
(1075, 158, 4, 'd'),
(1076, 159, 4, 'i'),
(1077, 146, 5, 'c'),
(1078, 147, 5, 'f'),
(1079, 148, 5, 'g'),
(1080, 149, 5, 'g'),
(1081, 151, 5, 'a'),
(1082, 152, 5, 'e'),
(1083, 153, 5, 'h'),
(1084, 154, 5, 'b'),
(1086, 156, 5, 'b'),
(1087, 143, 5, 'i'),
(1088, 158, 5, 'd'),
(1089, 159, 5, 'i'),
(1090, 142, 6, 'g'),
(1091, 145, 6, 'f'),
(1092, 146, 6, 'g'),
(1093, 147, 6, 'b'),
(1094, 150, 6, 'b'),
(1095, 156, 6, 'g'),
(1096, 157, 6, 'i'),
(1097, 158, 6, 'i'),
(1098, 144, 6, 'd'),
(1708, 160, 1, 'y'),
(1709, 160, 2, 'y'),
(1710, 160, 3, 'y'),
(1711, 160, 4, 'y'),
(1712, 160, 5, 'y'),
(1713, 160, 6, 'y'),
(1714, 160, 7, 'y'),
(2049, 124, 0, 'g'),
(2050, 127, 0, 'c'),
(2051, 128, 0, 'b'),
(2052, 129, 0, 'f'),
(2053, 130, 0, 'h'),
(2054, 131, 0, 'b'),
(2055, 132, 0, 'g'),
(2056, 133, 0, 'e'),
(2057, 134, 0, 'a'),
(2058, 125, 0, 'd'),
(2059, 139, 0, 'i'),
(2060, 140, 0, 'i'),
(2061, 124, 1, 'b'),
(2062, 127, 1, 'f'),
(2063, 128, 1, 'a'),
(2064, 129, 1, 'c'),
(2065, 130, 1, 'e'),
(2066, 131, 1, 'g'),
(2067, 135, 1, 'g'),
(2068, 136, 1, 'h'),
(2069, 138, 1, 'b'),
(2070, 125, 1, 'i'),
(2071, 126, 1, 'd'),
(2072, 141, 1, 'i'),
(2073, 124, 2, 'b'),
(2074, 127, 2, 'h'),
(2075, 128, 2, 'e'),
(2076, 132, 2, 'b'),
(2077, 133, 2, 'g'),
(2078, 134, 2, 'c'),
(2079, 135, 2, 'f'),
(2080, 136, 2, 'g'),
(2081, 138, 2, 'a'),
(2082, 139, 2, 'i'),
(2083, 126, 2, 'd'),
(2084, 141, 2, 'i'),
(2085, 129, 3, 'b'),
(2086, 130, 3, 'c'),
(2087, 131, 3, 'g'),
(2088, 132, 3, 'e'),
(2089, 133, 3, 'a'),
(2090, 134, 3, 'h'),
(2091, 135, 3, 'b'),
(2092, 136, 3, 'f'),
(2093, 138, 3, 'g'),
(2094, 139, 3, 'i'),
(2095, 140, 3, 'd'),
(2096, 126, 3, 'i'),
(2097, 129, 4, 'b'),
(2098, 130, 4, 'c'),
(2099, 131, 4, 'g'),
(2100, 132, 4, 'g'),
(2101, 133, 4, 'b'),
(2102, 134, 4, 'a'),
(2103, 135, 4, 'f'),
(2104, 136, 4, 'h'),
(2105, 138, 4, 'e'),
(2106, 125, 4, 'i'),
(2107, 140, 4, 'd'),
(2108, 141, 4, 'i'),
(2109, 124, 5, 'h'),
(2110, 127, 5, 'b'),
(2111, 128, 5, 'g'),
(2112, 132, 5, 'b'),
(2113, 133, 5, 'e'),
(2114, 134, 5, 'c'),
(2115, 135, 5, 'a'),
(2116, 136, 5, 'g'),
(2117, 138, 5, 'f'),
(2118, 125, 5, 'i'),
(2119, 140, 5, 'd'),
(2120, 126, 5, 'y'),
(2121, 141, 5, 'i'),
(2122, 124, 6, 'b'),
(2123, 127, 6, 'g'),
(2124, 128, 6, 'c'),
(2125, 129, 6, 'g'),
(2126, 130, 6, 'h'),
(2127, 131, 6, 'a'),
(2128, 134, 6, 'f'),
(2129, 135, 6, 'e'),
(2130, 138, 6, 'b'),
(2131, 139, 6, 'd'),
(2132, 140, 6, 'i'),
(2133, 126, 6, 'y'),
(2134, 141, 6, 'i'),
(2219, 162, 0, 'a'),
(2220, 165, 0, 'b'),
(2221, 166, 0, 'g'),
(2222, 167, 0, 'g'),
(2223, 168, 0, 'h'),
(2224, 169, 0, 'f'),
(2225, 170, 0, 'b'),
(2226, 171, 0, 'e'),
(2227, 172, 0, 'c'),
(2228, 163, 0, 'd'),
(2229, 176, 0, 'i'),
(2230, 177, 0, 'i'),
(2231, 162, 1, 'c'),
(2232, 165, 1, 'g'),
(2233, 166, 1, 'g'),
(2234, 167, 1, 'b'),
(2235, 168, 1, 'b'),
(2236, 169, 1, 'f'),
(2237, 173, 1, 'e'),
(2238, 174, 1, 'h'),
(2239, 175, 1, 'a'),
(2240, 163, 1, 'i'),
(2241, 164, 1, 'd'),
(2242, 178, 1, 'i'),
(2243, 162, 2, 'a'),
(2244, 165, 2, 'f'),
(2245, 166, 2, 'b'),
(2246, 170, 2, 'b'),
(2247, 171, 2, 'e'),
(2248, 172, 2, 'h'),
(2249, 173, 2, 'g'),
(2250, 174, 2, 'g'),
(2251, 175, 2, 'c'),
(2252, 176, 2, 'i'),
(2253, 164, 2, 'd'),
(2254, 178, 2, 'i'),
(2255, 167, 3, 'f'),
(2256, 168, 3, 'h'),
(2257, 169, 3, 'b'),
(2258, 170, 3, 'e'),
(2259, 171, 3, 'g'),
(2260, 172, 3, 'c'),
(2261, 173, 3, 'a'),
(2262, 174, 3, 'g'),
(2263, 175, 3, 'b'),
(2264, 176, 3, 'i'),
(2265, 177, 3, 'd'),
(2266, 164, 3, 'i'),
(2267, 167, 4, 'a'),
(2268, 168, 4, 'c'),
(2269, 169, 4, 'g'),
(2270, 170, 4, 'e'),
(2271, 171, 4, 'b'),
(2272, 172, 4, 'h'),
(2273, 173, 4, 'f'),
(2274, 174, 4, 'g'),
(2275, 175, 4, 'b'),
(2276, 163, 4, 'i'),
(2277, 177, 4, 'd'),
(2278, 178, 4, 'i'),
(2279, 162, 5, 'b'),
(2280, 165, 5, 'g'),
(2281, 166, 5, 'e'),
(2282, 170, 5, 'h'),
(2283, 171, 5, 'b'),
(2284, 172, 5, 'c'),
(2285, 173, 5, 'a'),
(2286, 174, 5, 'g'),
(2287, 175, 5, 'f'),
(2288, 163, 5, 'i'),
(2289, 177, 5, 'd'),
(2290, 178, 5, 'i'),
(2291, 162, 6, 'g'),
(2292, 165, 6, 'e'),
(2293, 166, 6, 'g'),
(2294, 167, 6, 'a'),
(2295, 168, 6, 'b'),
(2296, 169, 6, 'c'),
(2297, 172, 6, 'h'),
(2298, 173, 6, 'b'),
(2299, 175, 6, 'f'),
(2300, 176, 6, 'i'),
(2301, 177, 6, 'i'),
(2302, 164, 6, 'd'),
(2303, 179, 1, 'y'),
(2304, 179, 2, 'y'),
(2390, 106, 0, 'h'),
(2391, 109, 0, 'b'),
(2392, 110, 0, 'c'),
(2393, 111, 0, 'g'),
(2394, 112, 0, 'g'),
(2395, 113, 0, 'f'),
(2396, 114, 0, 'b'),
(2397, 115, 0, 'a'),
(2398, 116, 0, 'e'),
(2399, 107, 0, 'd'),
(2400, 121, 0, 'i'),
(2401, 122, 0, 'i'),
(2402, 108, 0, 'z'),
(2403, 106, 1, 'a'),
(2404, 109, 1, 'g'),
(2405, 110, 1, 'c'),
(2406, 111, 1, 'b'),
(2407, 112, 1, 'e'),
(2408, 113, 1, 'f'),
(2409, 117, 1, 'h'),
(2410, 118, 1, 'g'),
(2411, 120, 1, 'b'),
(2412, 107, 1, 'i'),
(2413, 108, 1, 'd'),
(2414, 123, 1, 'i'),
(2415, 106, 2, 'e'),
(2416, 109, 2, 'c'),
(2417, 110, 2, 'h'),
(2418, 114, 2, 'g'),
(2419, 115, 2, 'b'),
(2420, 116, 2, 'b'),
(2421, 117, 2, 'g'),
(2422, 118, 2, 'f'),
(2423, 120, 2, 'a'),
(2424, 121, 2, 'i'),
(2425, 108, 2, 'i'),
(2426, 180, 2, 'd'),
(2427, 111, 3, 'h'),
(2428, 112, 3, 'f'),
(2429, 113, 3, 'b'),
(2430, 114, 3, 'g'),
(2431, 115, 3, 'b'),
(2432, 116, 3, 'a'),
(2433, 117, 3, 'c'),
(2434, 118, 3, 'e'),
(2435, 120, 3, 'g'),
(2436, 122, 3, 'i'),
(2437, 123, 3, 'i'),
(2438, 180, 3, 'd'),
(2439, 111, 4, 'e'),
(2440, 112, 4, 'f'),
(2441, 113, 4, 'b'),
(2442, 114, 4, 'b'),
(2443, 115, 4, 'g'),
(2444, 116, 4, 'c'),
(2445, 117, 4, 'g'),
(2446, 118, 4, 'a'),
(2447, 120, 4, 'h'),
(2448, 122, 4, 'i'),
(2449, 123, 4, 'i'),
(2450, 180, 4, 'd'),
(2451, 106, 5, 'g'),
(2452, 109, 5, 'g'),
(2453, 110, 5, 'f'),
(2454, 114, 5, 'b'),
(2455, 115, 5, 'e'),
(2456, 116, 5, 'h'),
(2457, 117, 5, 'b'),
(2458, 118, 5, 'a'),
(2459, 120, 5, 'c'),
(2460, 107, 5, 'i'),
(2461, 121, 5, 'i'),
(2462, 108, 5, 'd'),
(2463, 106, 6, 'b'),
(2464, 109, 6, 'h'),
(2465, 110, 6, 'g'),
(2466, 111, 6, 'f'),
(2467, 112, 6, 'b'),
(2468, 113, 6, 'e'),
(2469, 116, 6, 'c'),
(2470, 117, 6, 'a'),
(2471, 120, 6, 'g'),
(2472, 107, 6, 'i'),
(2473, 121, 6, 'i'),
(2474, 108, 6, 'd');

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

DROP TABLE IF EXISTS `planning`;
CREATE TABLE `planning` (
  `ID_PLANNING` int(11) NOT NULL,
  `ID_EMPLOYE` int(11) NOT NULL,
  `N_SEMAINE` varchar(2) DEFAULT NULL,
  `ANNEE_PLANNING` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`ID_PLANNING`, `ID_EMPLOYE`, `N_SEMAINE`, `ANNEE_PLANNING`) VALUES
(88, 1, '01', 2023),
(89, 2, '01', 2023),
(90, 3, '01', 2023),
(91, 4, '01', 2023),
(92, 5, '01', 2023),
(93, 6, '01', 2023),
(94, 7, '01', 2023),
(95, 8, '01', 2023),
(96, 9, '01', 2023),
(97, 10, '01', 2023),
(98, 11, '01', 2023),
(99, 12, '01', 2023),
(100, 13, '01', 2023),
(102, 15, '01', 2023),
(103, 16, '01', 2023),
(104, 17, '01', 2023),
(105, 18, '01', 2023),
(106, 1, '03', 2023),
(107, 2, '03', 2023),
(108, 3, '03', 2023),
(109, 4, '03', 2023),
(110, 5, '03', 2023),
(111, 6, '03', 2023),
(112, 7, '03', 2023),
(113, 8, '03', 2023),
(114, 9, '03', 2023),
(115, 10, '03', 2023),
(116, 11, '03', 2023),
(117, 12, '03', 2023),
(118, 13, '03', 2023),
(120, 15, '03', 2023),
(121, 16, '03', 2023),
(122, 17, '03', 2023),
(123, 18, '03', 2023),
(124, 1, '02', 2023),
(125, 2, '02', 2023),
(126, 3, '02', 2023),
(127, 4, '02', 2023),
(128, 5, '02', 2023),
(129, 6, '02', 2023),
(130, 7, '02', 2023),
(131, 8, '02', 2023),
(132, 9, '02', 2023),
(133, 10, '02', 2023),
(134, 11, '02', 2023),
(135, 12, '02', 2023),
(136, 13, '02', 2023),
(138, 15, '02', 2023),
(139, 16, '02', 2023),
(140, 17, '02', 2023),
(141, 18, '02', 2023),
(142, 1, '04', 2023),
(143, 2, '04', 2023),
(144, 3, '04', 2023),
(145, 4, '04', 2023),
(146, 5, '04', 2023),
(147, 6, '04', 2023),
(148, 7, '04', 2023),
(149, 8, '04', 2023),
(150, 9, '04', 2023),
(151, 10, '04', 2023),
(152, 11, '04', 2023),
(153, 12, '04', 2023),
(154, 13, '04', 2023),
(156, 15, '04', 2023),
(157, 16, '04', 2023),
(158, 17, '04', 2023),
(159, 18, '04', 2023),
(160, 3, '07', 2023),
(161, 3, '8', 2023),
(162, 1, '10', 2023),
(163, 2, '10', 2023),
(164, 3, '10', 2023),
(165, 4, '10', 2023),
(166, 5, '10', 2023),
(167, 6, '10', 2023),
(168, 7, '10', 2023),
(169, 8, '10', 2023),
(170, 9, '10', 2023),
(171, 10, '10', 2023),
(172, 11, '10', 2023),
(173, 12, '10', 2023),
(174, 13, '10', 2023),
(175, 15, '10', 2023),
(176, 16, '10', 2023),
(177, 17, '10', 2023),
(178, 18, '10', 2023),
(179, 3, '05', 2023),
(180, 22, '03', 2023);

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
(1, 2, 'Pâte à pizza', '2023-01-06 16:52:06', '11'),
(2, 1, 'Champignons', '2022-11-16 21:20:18', '49'),
(3, 3, 'Sauce tomate ', '2023-01-06 16:52:06', '32'),
(4, 1, 'Fromage', '2023-01-06 16:52:06', '18'),
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
('g', 2, '18:00:00', '22:30:00'),
('h', 1, '18:30:00', '23:00:00'),
('i', 2, '15:30:00', '23:00:00'),
('y', 0, '00:00:00', '23:59:59'),
('z', 0, '00:00:00', '23:59:59');

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
-- Index pour la table `planning`
--
ALTER TABLE `planning`
  ADD PRIMARY KEY (`ID_PLANNING`),
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
  MODIFY `ID_ABSENCE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `conge`
--
ALTER TABLE `conge`
  MODIFY `ID_DEMANDE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `echange`
--
ALTER TABLE `echange`
  MODIFY `ID_ECHANGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `ID_EMPLOYE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `ID_ETAT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jour`
--
ALTER TABLE `jour`
  MODIFY `ID_JOUR` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `ID_PLANNING` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `ID_PRODUIT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `unite`
--
ALTER TABLE `unite`
  MODIFY `ID_UNITE` int(11) NOT NULL AUTO_INCREMENT;

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
