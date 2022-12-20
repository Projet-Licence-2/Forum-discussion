-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 30 juin 2022 à 14:19
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `descript` text NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `nom`, `descript`) VALUES
(7, 'DEVELOPEMENT WEB', 'On se retrouve dans le developpement web pour la creation des sites dynamique'),
(6, 'BASE DE DONNE', 'Parlons un peu des BD'),
(5, 'PROGRAMMATION', 'Bienvenu dans le monde de la programmation'),
(8, 'MAINTENANCE', 'Actu c\'est la maintenance informatique qui paye beaucoup');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `titre_message` varchar(50) NOT NULL,
  `texte_message` text NOT NULL,
  `date_create` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_sujet` int(11) NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `id_user` (`id_user`),
  KEY `id_sujet` (`id_sujet`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `message_user`
--

DROP TABLE IF EXISTS `message_user`;
CREATE TABLE IF NOT EXISTS `message_user` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `titre_message` varchar(50) NOT NULL,
  `texte_message` text NOT NULL,
  `date_create` datetime NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_sujet` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_message`),
  KEY `id_user` (`id_user`),
  KEY `id_sujet` (`id_sujet`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `message_user`
--

INSERT INTO `message_user` (`id_message`, `titre_message`, `texte_message`, `date_create`, `id_user`, `id_sujet`) VALUES
(25, 'repose', 'c\'est un lagage', '2022-06-30 12:53:05', 11, 43);

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

DROP TABLE IF EXISTS `sujet`;
CREATE TABLE IF NOT EXISTS `sujet` (
  `id_sujet` int(11) NOT NULL AUTO_INCREMENT,
  `titre_sujet` varchar(50) NOT NULL,
  `date_creation` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `nbr_reponse` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_sujet`),
  KEY `id_user` (`id_user`),
  KEY `id_categorie` (`id_categorie`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sujet`
--

INSERT INTO `sujet` (`id_sujet`, `titre_sujet`, `date_creation`, `id_user`, `id_categorie`, `nbr_reponse`) VALUES
(43, 'c\'est quoi bd?', '2022-06-30 12:52:33', 11, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(60) NOT NULL,
  `nom` varchar(60) NOT NULL,
  `email` varchar(80) NOT NULL,
  `mdp_user` varchar(100) NOT NULL,
  `photo` text NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `prenom`, `nom`, `email`, `mdp_user`, `photo`) VALUES
(3, 'Ayouba', 'Diakite', 'ayouba@gmail.com', '$2y$10$pbQHd7mvbCiiFSl1l.r7JeJI9bFoGCehW3aOA6/nLhPr8MZVNA2ja', ''),
(12, 'Camara', 'Abdoulaye', 'abdoulaye@gmail.com', '$2y$10$TPzMAaWdnYkfes6Wv33t9e2DuJ017VyWdpwJ8YFrNtiGu1syeovMG', 'slide-img.jpg'),
(11, 'macka', 'Diallo', 'macka@gmail.com', '$2y$10$gogmT/RyvB/7bRG/XrjjrOK/SZU/gSD5q81k4/cza7ejBnlQ/PAcG', 'chairs-g5182b3bba_1920.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
