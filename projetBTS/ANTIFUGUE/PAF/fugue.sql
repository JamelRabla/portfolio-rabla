-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 juin 2024 à 16:41
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fugue`
--

-- --------------------------------------------------------

--
-- Structure de la table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
CREATE TABLE IF NOT EXISTS `adresse` (
  `ID_BATIMENT` int NOT NULL,
  `ID_TYPE_RESIDENCE` int NOT NULL,
  `ID_PATIENT` int NOT NULL,
  PRIMARY KEY (`ID_BATIMENT`,`ID_TYPE_RESIDENCE`,`ID_PATIENT`),
  KEY `FK_ADRESSE2` (`ID_TYPE_RESIDENCE`),
  KEY `FK_ADRESSE3` (`ID_PATIENT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `adresse`
--

INSERT INTO `adresse` (`ID_BATIMENT`, `ID_TYPE_RESIDENCE`, `ID_PATIENT`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `batiment`
--

DROP TABLE IF EXISTS `batiment`;
CREATE TABLE IF NOT EXISTS `batiment` (
  `ID_BATIMENT` int NOT NULL,
  `NUMERO_CHAMBRE` int DEFAULT NULL,
  PRIMARY KEY (`ID_BATIMENT`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `batiment`
--

INSERT INTO `batiment` (`ID_BATIMENT`, `NUMERO_CHAMBRE`) VALUES
(1, 23),
(2, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `capteur`
--

DROP TABLE IF EXISTS `capteur`;
CREATE TABLE IF NOT EXISTS `capteur` (
  `ID_CAPTEUR` int NOT NULL,
  `ID_TYPE_CAPTEUR` int NOT NULL,
  `DATE_CAPTURE` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_CAPTEUR`),
  KEY `FK_ASSOCIATION_4` (`ID_TYPE_CAPTEUR`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `ID_PATIENT` int NOT NULL,
  `ID_CAPTEUR` int NOT NULL,
  `NOM_PATIENT` varchar(10) DEFAULT NULL,
  `PRENOM_PATIENT` varchar(10) DEFAULT NULL,
  `DATE_NAISSANCE` date DEFAULT NULL,
  PRIMARY KEY (`ID_PATIENT`),
  KEY `FK_ASSOCIATION_3` (`ID_CAPTEUR`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `patient`
--

INSERT INTO `patient` (`ID_PATIENT`, `ID_CAPTEUR`, `NOM_PATIENT`, `PRENOM_PATIENT`, `DATE_NAISSANCE`) VALUES
(1, 1, 'Bode', 'Florian', '1950-07-03'),
(2, 2, 'Ghesquiere', 'Enzo', '1945-06-10');

-- --------------------------------------------------------

--
-- Structure de la table `type_capteur`
--

DROP TABLE IF EXISTS `type_capteur`;
CREATE TABLE IF NOT EXISTS `type_capteur` (
  `ID_TYPE_CAPTEUR` int NOT NULL,
  `LIBELLE_CAPTEUR` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE_CAPTEUR`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_residence`
--

DROP TABLE IF EXISTS `type_residence`;
CREATE TABLE IF NOT EXISTS `type_residence` (
  `ID_TYPE_RESIDENCE` int NOT NULL,
  `LIBELLE_RESIDENCE` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE_RESIDENCE`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_residence`
--

INSERT INTO `type_residence` (`ID_TYPE_RESIDENCE`, `LIBELLE_RESIDENCE`) VALUES
(1, 'chambre'),
(2, 'maison');

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateur`
--

DROP TABLE IF EXISTS `type_utilisateur`;
CREATE TABLE IF NOT EXISTS `type_utilisateur` (
  `ID_TYPE_UTILISATEUR` int NOT NULL AUTO_INCREMENT,
  `LIBELLE_USER` char(0) DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE_UTILISATEUR`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID_UTILISATEUR` int NOT NULL AUTO_INCREMENT,
  `NOM_USER` varchar(16) DEFAULT NULL,
  `MDP` varchar(255) DEFAULT NULL,
  `PRENOM_USER` varchar(20) NOT NULL,
  `MAIL_USER` text NOT NULL,
  `TOKEN_USER` text NOT NULL,
  PRIMARY KEY (`ID_UTILISATEUR`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`ID_UTILISATEUR`, `NOM_USER`, `MDP`, `PRENOM_USER`, `MAIL_USER`, `TOKEN_USER`) VALUES
(4, 'rabla', '$2y$12$nLCJp.QRAw.xKAAlTf7nZu.tF4G0qj1OJQn3fryCfvloz8IyBSboa', 'jamel', 'jamelrabla@gmail.com', 'bc7f608d1191c43d9a7d162ec5330764c9974a4b13047775790f8b0be52de7a87df1b615d03d9d8e3741e57438cb96e9d18f1118258fa8c768585f5570ccc53f'),
(5, 'sehznea', '$2y$12$Q4DMASbLAefURYN2d4RIfOlxyRTl.1iuqf7NWZH0Xt69.ocAFUWOa', 'shenzen', 'shenzen@gmail.com', 'e501b5a5bb5f1852781cb7f6bfd050062a78bc532a153ae6406baa52326a44a4332f6c48b9e9e3708f23dbbc093db36bedfa405b8349ee49c9178fa75e0468ea'),
(6, 'LOUIS', '$2y$12$HpSr35KMGgxKZVbr4YjL8OhcTXP0AEQ7LXN1Pn5vVppo6B8V6vT3q', 'LOUIS ', 'LOUIS@LOUIS.FR', '9ba672a819d05793da65b2e376ddbfd9b001a76ea6a4106223c0d2f0dbb3c05b062e6d2559f61f8cba9afbb4d0bacefb0a341b7c6c050b1265d8d970769a60a2'),
(7, 'test', '$2y$12$vPyHVnHs4Y04xACAT2tECeBomenDF64b9qH2lbGwgtwUc7aCMgUG.', 'test', 'test@test.fr', '74f3fa3a5755d2cc19252b726e037eeb92a2927106492de77fdcae23538faf6f4493e9e2540ad6cb37a0ab2b567ff9345bc2d6d473ff5d5a0c8324fc115b3f4b');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
