-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 06 jan. 2020 à 22:47
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `creationlab`
--

-- --------------------------------------------------------

--
-- Structure de la table `post`
--

DROP TABLE IF EXISTS `post`;
CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `post_desc` text CHARACTER SET latin1 DEFAULT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL,
  `tag` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `date_post` date NOT NULL,
  PRIMARY KEY (`post_id`),
  KEY `tag` (`tag`),
  KEY `author` (`author`),
  KEY `post_name` (`post_name`),
  KEY `post_desc_2` (`post_desc`(1000)),
  KEY `upvote` (`upvote`),
  KEY `downvote` (`downvote`),
  KEY `slug` (`slug`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `post_draw`
--

DROP TABLE IF EXISTS `post_draw`;
CREATE TABLE IF NOT EXISTS `post_draw` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `post_desc` text COLLATE utf8_bin DEFAULT NULL,
  `contenue_url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `parent_node` int(11) DEFAULT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL,
  `tag` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `post_text`
--

DROP TABLE IF EXISTS `post_text`;
CREATE TABLE IF NOT EXISTS `post_text` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `post_desc` text COLLATE utf8_bin DEFAULT NULL,
  `contenue` longtext COLLATE utf8_bin DEFAULT NULL,
  `parent_node` int(11) DEFAULT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL,
  `tag` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tag_desc` tinytext CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `Uid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` char(64) CHARACTER SET latin1 NOT NULL,
  `nb_follower` int(11) DEFAULT NULL,
  `nb_sub` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `surname` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(320) CHARACTER SET latin1 DEFAULT NULL,
  `desc` tinytext CHARACTER SET latin1 DEFAULT NULL,
  `website_url` text CHARACTER SET latin1 DEFAULT NULL,
  `profil_pic` text CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`Uid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Uid`, `username`, `password`, `nb_follower`, `nb_sub`, `name`, `surname`, `email`, `desc`, `website_url`, `profil_pic`) VALUES
(1, 'zappellin', '7e513d141be4918489221d6fd0e455d7247d830b522a82701832647b10ab4bfa', NULL, NULL, NULL, NULL, 'guillaume.leon2000@gmail.com', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
