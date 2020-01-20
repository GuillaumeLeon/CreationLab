#
# TABLE STRUCTURE FOR: comment
#

DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# TABLE STRUCTURE FOR: post_draw
#

DROP TABLE IF EXISTS `post_draw`;

CREATE TABLE `post_draw` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `post_desc` text COLLATE utf8_bin DEFAULT NULL,
  `contenue_url` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `parent_node` int(11) DEFAULT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date_post` date NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `post_draw` (`post_id`, `post_name`, `post_desc`, `contenue_url`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (1, 'test image', 'test image\r\n', './testFolder/cX3nrNq.png', NULL, 0, 0, NULL, 'zappellin', NULL, '2020-01-13');


#
# TABLE STRUCTURE FOR: post_text
#

DROP TABLE IF EXISTS `post_text`;

CREATE TABLE `post_text` (
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_name` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `post_desc` text COLLATE utf8_bin DEFAULT NULL,
  `contenue` longtext COLLATE utf8_bin DEFAULT NULL,
  `parent_node` int(11) DEFAULT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL,
  `tag` int(11) DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_bin NOT NULL,
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date_post` date NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (1, 'repellat', 'et', 'iste', 0, 50, 63, 6, 'Bianka Brakus', 'sapiente', '1997-04-24');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (2, 'et', 'labore', 'dolorem', 4, 20, 89, 0, 'Elmira Schmidt', '', '2010-10-14');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (3, 'dolor', 'explicabo', 'veniam', 0, 54, 92, 0, 'Taya Beatty', 'dolorum', '2018-11-18');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (4, 'est', 'doloremque', 'exercitationem', 7, 7, 49, 0, 'Mariam Buckridge', 'numquam', '1991-01-28');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (5, 'non', 'distinctio', 'veniam', 5, 49, 81, 1, 'Herta Daniel', 'architecto', '1992-11-23');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (6, 'qui', 'occaecati', 'aliquid', 9, 54, 2, 3, 'Georgianna Lesch', 'sapiente', '2007-04-03');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (7, 'odit', 'beatae', 'ducimus', 3, 70, 41, 9, 'Dr. Ike Johns', '', '2001-08-08');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (8, 'recusandae', 'animi', 'blanditiis', 9, 59, 47, 1, 'Ms. Kaelyn Stanton III', 'impedit', '1995-05-15');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (9, 'corporis', 'voluptate', 'et', 1, 84, 17, 9, 'Bennett Beahan', '', '2018-04-04');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (10, 'ullam', 'aliquam', 'tempore', 0, 61, 59, 7, 'Fermin Grant', 'est', '1991-10-21');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (11, 'odit', 'ut', 'porro', 2, 40, 76, 0, 'Amie Nienow', '', '2009-12-04');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (12, 'et', 'perferendis', 'aliquam', 1, 15, 68, 3, 'Prof. Alden Boyer DDS', '', '2002-08-18');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (13, 'quia', 'id', 'vel', 0, 70, 45, 0, 'Mya Collier', 'saepe', '1993-10-06');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (14, 'eveniet', 'et', 'illum', 0, 41, 47, 0, 'Susie Barton', 'omnis', '1992-05-04');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (15, 'aut', 'et', 'eveniet', 2, 33, 73, 3, 'Marilyne Baumbach', '', '1977-11-27');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (16, 'modi', 'eaque', 'ut', 0, 93, 23, 1, 'Dr. Kenny Gulgowski', '', '2009-11-05');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (17, 'eum', 'quidem', 'facilis', 0, 31, 47, 1, 'Prof. Pansy Jast DVM', 'voluptatem', '2017-04-15');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (18, 'non', 'necessitatibus', 'repellat', 0, 51, 98, 7, 'Ole Satterfield DVM', '', '2001-05-09');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (19, 'aut', 'saepe', 'accusamus', 4, 53, 29, 0, 'Myrl Padberg', 'quis', '1999-04-16');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (20, 'iusto', 'neque', 'repellendus', 4, 71, 33, 0, 'Lucinda Thompson', '', '2007-05-28');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (21, 'et', 'adipisci', 'voluptates', 3, 47, 65, 0, 'Mr. Marcos Cremin', '', '1996-03-17');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (22, 'consequatur', 'sunt', 'rerum', 1, 26, 41, 0, 'Shaina Erdman', '', '1983-03-26');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (23, 'laborum', 'doloremque', 'sunt', 0, 40, 61, 9, 'Kaya Prosacco', 'saepe', '2010-12-19');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (24, 'totam', 'earum', 'aut', 2, 1, 77, 0, 'Dante Von', '', '1999-07-08');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (25, 'deleniti', 'maxime', 'minima', 5, 22, 96, 9, 'Urban Hessel', '', '2005-07-10');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (26, 'qui', 'laudantium', 'ut', 0, 25, 58, 4, 'Judy Torp', 'repellat', '1980-05-24');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (27, 'a', 'beatae', 'quos', 7, 55, 6, 0, 'Mr. Gustave Pouros V', 'quia', '2007-11-27');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (28, 'tenetur', 'voluptates', 'numquam', 5, 56, 16, 9, 'Prof. Mike Altenwerth III', '', '2006-06-07');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (29, 'itaque', 'enim', 'recusandae', 6, 86, 90, 6, 'Myron Hessel IV', 'et', '1980-01-06');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (30, 'est', 'omnis', 'voluptates', 0, 54, 69, 6, 'Damion Halvorson', '', '2014-02-14');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (31, 'voluptatem', 'debitis', 'autem', 5, 15, 54, 0, 'Maya Fadel', '', '1974-12-26');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (32, 'autem', 'aspernatur', 'esse', 0, 99, 1, 0, 'Kenna Hahn', '', '2006-02-16');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (33, 'occaecati', 'ducimus', 'qui', 0, 1, 3, 0, 'Mrs. Melyna Little III', '', '2012-07-28');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (34, 'itaque', 'et', 'eos', 0, 91, 50, 0, 'Kelley Parker', 'autem', '1989-09-18');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (35, 'dolores', 'iure', 'ut', 0, 8, 79, 3, 'Maryam Kuvalis', 'nihil', '1991-04-19');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (36, 'alias', 'ducimus', 'et', 7, 46, 46, 0, 'Bruce Marquardt', '', '1996-02-29');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (37, 'eaque', 'ut', 'voluptatem', 0, 24, 61, 0, 'Mr. Bertha Oberbrunner', 'voluptas', '1979-02-18');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (38, 'in', 'pariatur', 'quos', 7, 35, 33, 4, 'Myra Strosin', 'corporis', '2014-11-22');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (39, 'veritatis', 'eum', 'cum', 7, 32, 86, 2, 'Camryn Macejkovic', 'quia', '1990-06-11');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (40, 'rerum', 'ut', 'rerum', 0, 2, 25, 0, 'Prof. Leda Buckridge V', '', '1998-09-18');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (41, 'qui', 'fugiat', 'omnis', 0, 17, 43, 0, 'Dr. Skye Mitchell DVM', 'unde', '1990-04-30');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (42, 'iste', 'eaque', 'ex', 8, 11, 79, 0, 'Mya Marquardt IV', '', '1995-06-01');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (43, 'dolore', 'doloremque', 'ratione', 0, 68, 85, 0, 'Mr. Dangelo Kemmer III', 'est', '2007-04-01');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (44, 'voluptas', 'qui', 'blanditiis', 0, 72, 95, 0, 'Estefania Jacobson', '', '1983-06-08');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (45, 'ipsa', 'aut', 'dolor', 0, 52, 18, 0, 'Madyson Satterfield', 'et', '2012-01-04');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (46, 'veritatis', 'sint', 'voluptates', 8, 11, 71, 0, 'Ms. Aida Daugherty', '', '1980-08-31');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (47, 'et', 'doloremque', 'ex', 0, 26, 11, 0, 'Breanne Carroll', '', '2006-02-11');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (48, 'sunt', 'exercitationem', 'vel', 0, 48, 71, 2, 'Keenan Rohan', '', '2003-12-20');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (49, 'omnis', 'maxime', 'est', 0, 42, 88, 0, 'Vicky Smitham', '', '1987-07-04');
INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `upvote`, `downvote`, `tag`, `author`, `slug`, `date_post`) VALUES (50, 'consequuntur', 'tempora', 'tempore', 0, 27, 39, 0, 'Geoffrey Nader', 'accusamus', '1972-09-22');


#
# TABLE STRUCTURE FOR: replies
#

DROP TABLE IF EXISTS `replies`;

CREATE TABLE `replies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

#
# TABLE STRUCTURE FOR: tag
#

DROP TABLE IF EXISTS `tag`;

CREATE TABLE `tag` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `tag_desc` tinytext CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `tag` (`tag_id`, `tag_name`, `slug`, `tag_desc`) VALUES (1, 'test', 'test', 'test tag');


#
# TABLE STRUCTURE FOR: users
#

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO `users` (`Uid`, `username`, `password`, `nb_follower`, `nb_sub`, `name`, `surname`, `email`, `desc`, `website_url`, `profil_pic`) VALUES (1, 'zappellin', '7e513d141be4918489221d6fd0e455d7247d830b522a82701832647b10ab4bfa', NULL, NULL, NULL, NULL, 'guillaume.leon2000@gmail.com', NULL, NULL, NULL);
INSERT INTO `users` (`Uid`, `username`, `password`, `nb_follower`, `nb_sub`, `name`, `surname`, `email`, `desc`, `website_url`, `profil_pic`) VALUES (2, 'kaokao', '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', NULL, NULL, NULL, NULL, 'kaorilee@outlook.fr', NULL, NULL, NULL);


