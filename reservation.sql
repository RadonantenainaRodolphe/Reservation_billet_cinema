-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 05 Juillet 2023 à 21:34
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `reservation`
--
CREATE DATABASE IF NOT EXISTS `reservation` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `reservation`;

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

CREATE TABLE IF NOT EXISTS `acteur` (
  `acteur_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`acteur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `billets`
--

CREATE TABLE IF NOT EXISTS `billets` (
  `billet_id` int(11) NOT NULL AUTO_INCREMENT,
  `utilisateur_id` int(11) DEFAULT NULL,
  `seance_id` int(11) DEFAULT NULL,
  `numero_siege` varchar(10) DEFAULT NULL,
  `prix` decimal(10,0) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`billet_id`),
  KEY `fk_utilisateur` (`utilisateur_id`),
  KEY `fk_seance` (`seance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE IF NOT EXISTS `films` (
  `film_id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) NOT NULL,
  `description` text,
  `affiche` varchar(255) DEFAULT NULL,
  `realisateur_id` int(11) DEFAULT NULL,
  `genre_id` int(11) DEFAULT NULL,
  `acteur_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`film_id`),
  KEY `fk_genre` (`genre_id`),
  KEY `fk_realisateur` (`realisateur_id`),
  KEY `fk_acteur` (`acteur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE IF NOT EXISTS `genre` (
  `genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  PRIMARY KEY (`genre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `realisateur`
--

CREATE TABLE IF NOT EXISTS `realisateur` (
  `realisateur_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`realisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `salles`
--

CREATE TABLE IF NOT EXISTS `salles` (
  `salle_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `capacite` int(11) DEFAULT NULL,
  `equipements` text,
  PRIMARY KEY (`salle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `seances`
--

CREATE TABLE IF NOT EXISTS `seances` (
  `seance_id` int(11) NOT NULL AUTO_INCREMENT,
  `film_id` int(11) DEFAULT NULL,
  `salle_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `prix` decimal(10,0) DEFAULT NULL,
  `place_restantes` int(11) DEFAULT NULL,
  PRIMARY KEY (`seance_id`),
  KEY `fk_film` (`film_id`),
  KEY `fk_salle` (`salle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `utilisateur_id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `telephone` bigint(20) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`utilisateur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `billets`
--
ALTER TABLE `billets`
  ADD CONSTRAINT `fk_utilisateur` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`utilisateur_id`),
  ADD CONSTRAINT `fk_seance` FOREIGN KEY (`seance_id`) REFERENCES `seances` (`seance_id`);

--
-- Contraintes pour la table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `fk_genre` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`genre_id`),
  ADD CONSTRAINT `fk_realisateur` FOREIGN KEY (`realisateur_id`) REFERENCES `realisateur` (`realisateur_id`),
  ADD CONSTRAINT `fk_acteur` FOREIGN KEY (`acteur_id`) REFERENCES `acteur` (`acteur_id`);

--
-- Contraintes pour la table `seances`
--
ALTER TABLE `seances`
  ADD CONSTRAINT `fk_film` FOREIGN KEY (`film_id`) REFERENCES `films` (`film_id`),
  ADD CONSTRAINT `fk_salle` FOREIGN KEY (`salle_id`) REFERENCES `salles` (`salle_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
