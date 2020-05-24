-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 24 mai 2020 à 14:49
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
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `downvote`
--

DROP TABLE IF EXISTS `downvote`;
CREATE TABLE IF NOT EXISTS `downvote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=205 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `tag` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_bin NOT NULL,
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date_post` date NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `post_text`
--

INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `tag`, `author`, `slug`, `date_post`) VALUES
(1, 'test', 'test', 'test', NULL, 'test', 'zappellin', 'test', '2020-05-05'),
(2, 'test', NULL, 'test', 1, NULL, 'zappellin', NULL, '2020-05-05'),
(5, 'test', NULL, 'test', 2, NULL, 'zappellin', NULL, '2020-05-05'),
(6, 'test', NULL, 'test de vÃ©riter', 5, NULL, 'zappellin', NULL, '2020-05-05'),
(7, 'normalement tout marche', 'Pas sure', 'blablabla', NULL, 'sci-fi', 'zappellin', 'normalement_tout_marche', '2020-05-07'),
(8, 'normalement tout marche', NULL, 'continuer une histoire n\'a jamais Ã©tÃ© aussi facile \r\n', 7, NULL, 'zappellin', NULL, '2020-05-07'),
(9, 'normalement tout marche', NULL, 'test', 8, NULL, 'zappellin', NULL, '2020-05-15'),
(10, 'test', 'test', 'test', NULL, 'test', 'zappellin', 'test', '2020-05-15'),
(11, 'test', NULL, 'test', 10, NULL, 'zappellin', NULL, '2020-05-15'),
(12, 'test', NULL, 'test', 11, NULL, 'zappellin', NULL, '2020-05-15'),
(13, 'test', NULL, 'test', 12, NULL, 'zappellin', NULL, '2020-05-15');

-- --------------------------------------------------------

--
-- Structure de la table `replies`
--

DROP TABLE IF EXISTS `replies`;
CREATE TABLE IF NOT EXISTS `replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `slug`, `tag_desc`) VALUES
(1, 'test', 'test', 'test tag'),
(3, 'sci-fi', 'sci-fi', 'blebleble');

-- --------------------------------------------------------

--
-- Structure de la table `upvote`
--

DROP TABLE IF EXISTS `upvote`;
CREATE TABLE IF NOT EXISTS `upvote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=182 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `upvote`
--

INSERT INTO `upvote` (`id`, `user_id`, `post_id`) VALUES
(181, 1, 1),
(180, 1, 10),
(89, 1, 8);

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`Uid`, `username`, `password`, `nb_follower`, `nb_sub`, `name`, `surname`, `email`, `desc`, `website_url`, `profil_pic`) VALUES
(1, 'zappellin', '7e513d141be4918489221d6fd0e455d7247d830b522a82701832647b10ab4bfa', 0, 0, 'Leon', 'Guillaume', 'guillaume.leon2000@gmail.com', 'je suis un passionné d\'informatique ', 'guillaumeleon.yo.fr', NULL),
(2, 'kaokao', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', NULL, NULL, NULL, NULL, 'kaorilee@outlook.fr', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
