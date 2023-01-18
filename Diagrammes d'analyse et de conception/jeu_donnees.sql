-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 18 jan. 2023 à 17:55
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
-- Base de données : `jeu_reduit_yanis`
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
(29, 14, '2022-12-31 03:00:00', '2022-12-31 20:00:00'),
(31, 13, '2023-01-18 00:00:00', '2023-01-18 18:00:00'),
(32, 13, '2023-01-20 08:00:00', '2023-01-20 18:00:00'),
(33, 14, '2023-01-24 08:00:00', '2023-01-24 22:55:00'),
(34, 15, '2023-01-20 08:00:00', '2023-01-20 22:55:00'),
(35, 15, '2023-01-27 08:00:00', '2023-01-27 22:56:00'),
(36, 16, '2023-01-25 08:00:00', '2023-01-25 22:58:00'),
(37, 5, '2023-01-30 10:00:00', '2023-01-30 18:00:00');

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
(37, 3, 12, '2023-02-01', '2023-02-03', '2023-01-15'),
(38, 3, 4, '2023-03-06', '2023-03-12', '2023-01-18'),
(39, 4, 5, '2023-03-27', '2023-04-02', '2023-01-18'),
(40, 3, 5, '2023-07-03', '2023-07-16', '2023-01-18');

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
(25, 4, 688, 5, 687, 4, '2023-01-18'),
(27, 3, 700, 4, 701, 5, '2023-01-18');

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
CREATE TABLE `etat` (
  `ID_ETAT` int(11) NOT NULL,
  `NOM_ETAT` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`ID_ETAT`, `NOM_ETAT`) VALUES
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
(604, 87, 0, 'b'),
(605, 88, 0, 'g'),
(606, 89, 0, 'g'),
(607, 90, 0, 'h'),
(608, 91, 0, 'e'),
(609, 92, 0, 'b'),
(610, 93, 0, 'c'),
(611, 94, 0, 'f'),
(612, 95, 0, 'a'),
(613, 96, 0, 'g'),
(614, 81, 0, 'd'),
(615, 82, 0, 'i'),
(616, 83, 0, 'i'),
(617, 87, 1, 'y'),
(618, 88, 1, 'c'),
(619, 89, 1, 'g'),
(620, 90, 1, 'f'),
(621, 91, 1, 'y'),
(622, 92, 1, 'a'),
(623, 94, 1, 'e'),
(624, 97, 1, 'b'),
(625, 98, 1, 'b'),
(626, 99, 1, 'g'),
(627, 100, 1, 'g'),
(628, 101, 1, 'h'),
(629, 81, 1, 'i'),
(630, 84, 1, 'd'),
(631, 85, 1, 'i'),
(632, 87, 2, 'y'),
(633, 88, 2, 'b'),
(634, 89, 2, 'g'),
(635, 91, 2, 'y'),
(636, 93, 2, 'h'),
(637, 95, 2, 'b'),
(638, 96, 2, 'f'),
(639, 97, 2, 'e'),
(640, 98, 2, 'a'),
(641, 99, 2, 'g'),
(642, 100, 2, 'g'),
(643, 101, 2, 'c'),
(644, 84, 2, 'i'),
(645, 85, 2, 'i'),
(646, 86, 2, 'd'),
(647, 87, 3, 'b'),
(648, 88, 3, 'y'),
(649, 90, 3, 'g'),
(650, 91, 3, 'f'),
(651, 95, 3, 'h'),
(652, 96, 3, 'e'),
(653, 97, 3, 'a'),
(654, 98, 3, 'c'),
(655, 99, 3, 'b'),
(656, 100, 3, 'g'),
(657, 101, 3, 'g'),
(658, 82, 3, 'i'),
(659, 83, 3, 'i'),
(660, 86, 3, 'd'),
(661, 87, 4, 'g'),
(662, 88, 4, 'y'),
(663, 91, 4, 'e'),
(664, 92, 4, 'g'),
(665, 93, 4, 'h'),
(666, 94, 4, 'f'),
(667, 95, 4, 'z'),
(668, 97, 4, 'c'),
(669, 98, 4, 'b'),
(670, 99, 4, 'g'),
(671, 100, 4, 'a'),
(672, 101, 4, 'b'),
(673, 82, 4, 'i'),
(674, 83, 4, 'i'),
(675, 86, 4, 'd'),
(676, 87, 5, 'c'),
(677, 88, 5, 'b'),
(678, 89, 5, 'a'),
(679, 90, 5, 'e'),
(680, 91, 5, 'g'),
(681, 92, 5, 'b'),
(682, 93, 5, 'f'),
(683, 94, 5, 'g'),
(684, 95, 5, 'h'),
(685, 96, 5, 'g'),
(686, 81, 5, 'i'),
(687, 84, 5, 'i'),
(688, 85, 5, 'd'),
(689, 87, 6, 'e'),
(690, 88, 6, 'g'),
(691, 89, 6, 'c'),
(692, 90, 6, 'b'),
(693, 91, 6, 'a'),
(694, 92, 6, 'f'),
(695, 93, 6, 'g'),
(696, 94, 6, 'g'),
(697, 95, 6, 'h'),
(698, 96, 6, 'b'),
(699, 81, 6, 'i'),
(700, 84, 6, 'd'),
(701, 85, 6, 'i'),
(702, 108, 0, 'e'),
(703, 109, 0, 'a'),
(704, 110, 0, 'g'),
(705, 111, 0, 'b'),
(706, 112, 0, 'b'),
(707, 113, 0, 'g'),
(708, 114, 0, 'f'),
(709, 115, 0, 'h'),
(710, 116, 0, 'g'),
(711, 117, 0, 'c'),
(712, 102, 0, 'd'),
(713, 103, 0, 'i'),
(714, 104, 0, 'y'),
(715, 105, 0, 'i'),
(716, 108, 1, 'b'),
(717, 109, 1, 'g'),
(718, 110, 1, 'g'),
(719, 111, 1, 'c'),
(720, 112, 1, 'b'),
(721, 118, 1, 'g'),
(722, 119, 1, 'h'),
(723, 120, 1, 'e'),
(724, 121, 1, 'f'),
(725, 122, 1, 'a'),
(726, 102, 1, 'i'),
(727, 104, 1, 'd'),
(728, 106, 1, 'i'),
(729, 113, 2, 'c'),
(730, 114, 2, 'g'),
(731, 115, 2, 'g'),
(732, 116, 2, 'e'),
(733, 117, 2, 'b'),
(734, 118, 2, 'h'),
(735, 119, 2, 'f'),
(736, 120, 2, 'b'),
(737, 121, 2, 'g'),
(738, 122, 2, 'a'),
(739, 104, 2, 'i'),
(740, 106, 2, 'i'),
(741, 107, 2, 'd'),
(742, 113, 3, 'b'),
(743, 114, 3, 'a'),
(744, 115, 3, 'b'),
(745, 116, 3, 'e'),
(746, 117, 3, 'h'),
(747, 118, 3, 'g'),
(748, 119, 3, 'g'),
(749, 120, 3, 'c'),
(750, 121, 3, 'f'),
(751, 122, 3, 'g'),
(752, 103, 3, 'i'),
(753, 105, 3, 'i'),
(754, 107, 3, 'd'),
(755, 108, 4, 'g'),
(756, 109, 4, 'a'),
(757, 110, 4, 'g'),
(758, 111, 4, 'b'),
(759, 112, 4, 'g'),
(760, 118, 4, 'b'),
(761, 119, 4, 'c'),
(762, 120, 4, 'e'),
(763, 121, 4, 'h'),
(764, 122, 4, 'f'),
(765, 103, 4, 'i'),
(766, 105, 4, 'i'),
(767, 107, 4, 'd'),
(768, 108, 5, 'f'),
(769, 109, 5, 'g'),
(770, 110, 5, 'g'),
(771, 111, 5, 'c'),
(772, 112, 5, 'b'),
(773, 113, 5, 'h'),
(774, 114, 5, 'a'),
(775, 115, 5, 'g'),
(776, 116, 5, 'e'),
(777, 117, 5, 'b'),
(778, 102, 5, 'i'),
(779, 104, 5, 'd'),
(780, 106, 5, 'i'),
(781, 108, 6, 'g'),
(782, 109, 6, 'a'),
(783, 110, 6, 'e'),
(784, 111, 6, 'g'),
(785, 112, 6, 'g'),
(786, 113, 6, 'f'),
(787, 114, 6, 'c'),
(788, 115, 6, 'b'),
(789, 116, 6, 'h'),
(790, 117, 6, 'b'),
(791, 102, 6, 'i'),
(792, 104, 6, 'd'),
(793, 106, 6, 'i'),
(794, 129, 0, 'h'),
(795, 130, 0, 'g'),
(796, 131, 0, 'b'),
(797, 132, 0, 'c'),
(798, 133, 0, 'g'),
(799, 134, 0, 'e'),
(800, 135, 0, 'f'),
(801, 136, 0, 'g'),
(802, 137, 0, 'a'),
(803, 138, 0, 'b'),
(804, 123, 0, 'd'),
(805, 124, 0, 'i'),
(806, 125, 0, 'y'),
(807, 126, 0, 'i'),
(808, 129, 1, 'e'),
(809, 130, 1, 'g'),
(810, 131, 1, 'g'),
(811, 132, 1, 'a'),
(812, 133, 1, 'b'),
(813, 139, 1, 'c'),
(814, 140, 1, 'g'),
(815, 141, 1, 'h'),
(816, 142, 1, 'f'),
(817, 143, 1, 'b'),
(818, 123, 1, 'i'),
(819, 125, 1, 'y'),
(820, 127, 1, 'd'),
(821, 128, 1, 'i'),
(822, 134, 2, 'f'),
(823, 135, 2, 'b'),
(824, 136, 2, 'a'),
(825, 137, 2, 'e'),
(826, 138, 2, 'b'),
(827, 139, 2, 'c'),
(828, 140, 2, 'h'),
(829, 141, 2, 'g'),
(830, 142, 2, 'g'),
(831, 143, 2, 'g'),
(832, 124, 2, 'i'),
(833, 125, 2, 'y'),
(834, 127, 2, 'd'),
(835, 128, 2, 'i'),
(836, 134, 3, 'g'),
(837, 135, 3, 'a'),
(838, 136, 3, 'e'),
(839, 137, 3, 'h'),
(840, 138, 3, 'g'),
(841, 139, 3, 'b'),
(842, 140, 3, 'c'),
(843, 141, 3, 'g'),
(844, 142, 3, 'f'),
(845, 143, 3, 'b'),
(846, 124, 3, 'i'),
(847, 125, 3, 'y'),
(848, 126, 3, 'd'),
(849, 127, 3, 'i'),
(850, 129, 4, 'g'),
(851, 130, 4, 'c'),
(852, 131, 4, 'g'),
(853, 132, 4, 'e'),
(854, 133, 4, 'f'),
(855, 139, 4, 'g'),
(856, 140, 4, 'b'),
(857, 141, 4, 'h'),
(858, 142, 4, 'b'),
(859, 143, 4, 'a'),
(860, 123, 4, 'i'),
(861, 125, 4, 'y'),
(862, 126, 4, 'd'),
(863, 128, 4, 'i'),
(864, 129, 5, 'a'),
(865, 130, 5, 'h'),
(866, 131, 5, 'g'),
(867, 132, 5, 'c'),
(868, 133, 5, 'f'),
(869, 134, 5, 'g'),
(870, 135, 5, 'e'),
(871, 136, 5, 'g'),
(872, 137, 5, 'b'),
(873, 138, 5, 'b'),
(874, 123, 5, 'i'),
(875, 125, 5, 'y'),
(876, 126, 5, 'd'),
(877, 128, 5, 'i'),
(878, 129, 6, 'b'),
(879, 130, 6, 'c'),
(880, 131, 6, 'a'),
(881, 132, 6, 'h'),
(882, 133, 6, 'f'),
(883, 134, 6, 'b'),
(884, 135, 6, 'g'),
(885, 136, 6, 'g'),
(886, 137, 6, 'e'),
(887, 138, 6, 'g'),
(888, 124, 6, 'i'),
(889, 125, 6, 'y'),
(890, 126, 6, 'i'),
(891, 127, 6, 'd'),
(892, 150, 0, 'e'),
(893, 151, 0, 'g'),
(894, 152, 0, 'f'),
(895, 153, 0, 'b'),
(896, 154, 0, 'c'),
(897, 155, 0, 'a'),
(898, 156, 0, 'g'),
(899, 157, 0, 'h'),
(900, 158, 0, 'b'),
(901, 159, 0, 'g'),
(902, 144, 0, 'd'),
(903, 145, 0, 'i'),
(904, 146, 0, 'i'),
(905, 150, 1, 'g'),
(906, 151, 1, 'g'),
(907, 152, 1, 'a'),
(908, 153, 1, 'e'),
(909, 154, 1, 'f'),
(910, 157, 1, 'z'),
(911, 160, 1, 'h'),
(912, 161, 1, 'b'),
(913, 162, 1, 'b'),
(914, 163, 1, 'c'),
(915, 164, 1, 'g'),
(916, 144, 1, 'i'),
(917, 147, 1, 'd'),
(918, 148, 1, 'i'),
(919, 150, 2, 'c'),
(920, 155, 2, 'g'),
(921, 156, 2, 'a'),
(922, 157, 2, 'b'),
(923, 158, 2, 'g'),
(924, 159, 2, 'z'),
(925, 160, 2, 'g'),
(926, 161, 2, 'h'),
(927, 162, 2, 'e'),
(928, 163, 2, 'b'),
(929, 164, 2, 'f'),
(930, 147, 2, 'i'),
(931, 148, 2, 'i'),
(932, 149, 2, 'd'),
(933, 152, 3, 'y'),
(934, 155, 3, 'f'),
(935, 156, 3, 'b'),
(936, 157, 3, 'a'),
(937, 158, 3, 'g'),
(938, 159, 3, 'g'),
(939, 160, 3, 'e'),
(940, 161, 3, 'b'),
(941, 162, 3, 'h'),
(942, 163, 3, 'c'),
(943, 164, 3, 'g'),
(944, 145, 3, 'i'),
(945, 146, 3, 'i'),
(946, 149, 3, 'd'),
(947, 151, 4, 'g'),
(948, 152, 4, 'y'),
(949, 153, 4, 'a'),
(950, 154, 4, 'g'),
(951, 155, 4, 'g'),
(952, 158, 4, 'z'),
(953, 159, 4, 'b'),
(954, 160, 4, 'c'),
(955, 161, 4, 'b'),
(956, 162, 4, 'h'),
(957, 163, 4, 'e'),
(958, 164, 4, 'f'),
(959, 145, 4, 'i'),
(960, 146, 4, 'i'),
(961, 149, 4, 'd'),
(962, 150, 5, 'g'),
(963, 151, 5, 'c'),
(964, 152, 5, 'a'),
(965, 153, 5, 'f'),
(966, 154, 5, 'g'),
(967, 156, 5, 'g'),
(968, 157, 5, 'h'),
(969, 158, 5, 'b'),
(970, 159, 5, 'e'),
(971, 160, 5, 'b'),
(972, 144, 5, 'i'),
(973, 147, 5, 'd'),
(974, 148, 5, 'i'),
(975, 150, 6, 'b'),
(976, 151, 6, 'e'),
(977, 152, 6, 'h'),
(978, 153, 6, 'c'),
(979, 154, 6, 'g'),
(980, 156, 6, 'f'),
(981, 157, 6, 'g'),
(982, 158, 6, 'a'),
(983, 159, 6, 'g'),
(984, 161, 6, 'b'),
(985, 144, 6, 'i'),
(986, 147, 6, 'd'),
(987, 148, 6, 'i'),
(988, 165, 1, 'y'),
(989, 165, 2, 'y'),
(990, 165, 3, 'y'),
(991, 165, 4, 'y'),
(992, 165, 5, 'y'),
(993, 165, 6, 'y'),
(994, 165, 7, 'y');

-- --------------------------------------------------------

--
-- Structure de la table `planning`
--

DROP TABLE IF EXISTS `planning`;
CREATE TABLE `planning` (
  `ID_PLANNING` int(11) NOT NULL,
  `ID_EMPLOYE` int(11) NOT NULL,
  `N_SEMAINE` varchar(3) DEFAULT NULL,
  `ANNEE_PLANNING` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `planning`
--

INSERT INTO `planning` (`ID_PLANNING`, `ID_EMPLOYE`, `N_SEMAINE`, `ANNEE_PLANNING`) VALUES
(81, 1, '03', 2023),
(82, 2, '03', 2023),
(83, 3, '03', 2023),
(84, 4, '03', 2023),
(85, 5, '03', 2023),
(86, 6, '03', 2023),
(87, 7, '03', 2023),
(88, 8, '03', 2023),
(89, 9, '03', 2023),
(90, 10, '03', 2023),
(91, 11, '03', 2023),
(92, 12, '03', 2023),
(93, 13, '03', 2023),
(94, 14, '03', 2023),
(95, 15, '03', 2023),
(96, 16, '03', 2023),
(97, 17, '03', 2023),
(98, 18, '03', 2023),
(99, 19, '03', 2023),
(100, 20, '03', 2023),
(101, 21, '03', 2023),
(102, 1, '02', 2023),
(103, 2, '02', 2023),
(104, 3, '02', 2023),
(105, 4, '02', 2023),
(106, 5, '02', 2023),
(107, 6, '02', 2023),
(108, 7, '02', 2023),
(109, 8, '02', 2023),
(110, 9, '02', 2023),
(111, 10, '02', 2023),
(112, 11, '02', 2023),
(113, 12, '02', 2023),
(114, 13, '02', 2023),
(115, 14, '02', 2023),
(116, 15, '02', 2023),
(117, 16, '02', 2023),
(118, 17, '02', 2023),
(119, 18, '02', 2023),
(120, 19, '02', 2023),
(121, 20, '02', 2023),
(122, 21, '02', 2023),
(123, 1, '01', 2023),
(124, 2, '01', 2023),
(125, 3, '01', 2023),
(126, 4, '01', 2023),
(127, 5, '01', 2023),
(128, 6, '01', 2023),
(129, 7, '01', 2023),
(130, 8, '01', 2023),
(131, 9, '01', 2023),
(132, 10, '01', 2023),
(133, 11, '01', 2023),
(134, 12, '01', 2023),
(135, 13, '01', 2023),
(136, 14, '01', 2023),
(137, 15, '01', 2023),
(138, 16, '01', 2023),
(139, 17, '01', 2023),
(140, 18, '01', 2023),
(141, 19, '01', 2023),
(142, 20, '01', 2023),
(143, 21, '01', 2023),
(144, 1, '04', 2023),
(145, 2, '04', 2023),
(146, 3, '04', 2023),
(147, 4, '04', 2023),
(148, 5, '04', 2023),
(149, 6, '04', 2023),
(150, 7, '04', 2023),
(151, 8, '04', 2023),
(152, 9, '04', 2023),
(153, 10, '04', 2023),
(154, 11, '04', 2023),
(155, 12, '04', 2023),
(156, 13, '04', 2023),
(157, 14, '04', 2023),
(158, 15, '04', 2023),
(159, 16, '04', 2023),
(160, 17, '04', 2023),
(161, 18, '04', 2023),
(162, 19, '04', 2023),
(163, 20, '04', 2023),
(164, 21, '04', 2023),
(165, 5, '13', 2023);

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
  MODIFY `ID_ABSENCE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT pour la table `conge`
--
ALTER TABLE `conge`
  MODIFY `ID_DEMANDE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT pour la table `echange`
--
ALTER TABLE `echange`
  MODIFY `ID_ECHANGE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `ID_EMPLOYE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `ID_ETAT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `jour`
--
ALTER TABLE `jour`
  MODIFY `ID_JOUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=995;

--
-- AUTO_INCREMENT pour la table `planning`
--
ALTER TABLE `planning`
  MODIFY `ID_PLANNING` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

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
