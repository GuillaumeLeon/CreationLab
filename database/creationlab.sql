-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 22 fév. 2020 à 23:25
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
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `author`, `post_id`, `content`, `created_at`, `updated_at`) VALUES
(26, 'kaokao', 52, 'Eveniet dolorem magnam ratione qui illum consequatur laborum voluptatem unde.', '2014-07-21 04:37:07', '1975-12-05 14:22:46'),
(27, 'zappellin', 53, 'Sint enim explicabo qui ut odit eos aut perspiciatis voluptas assumenda recusandae tempora.', '1994-12-29 02:47:31', '2017-12-11 04:33:11'),
(28, 'kaokao', 54, 'Minus voluptatibus et minima necessitatibus exercitationem optio sed dolores vero maiores iusto.', '1985-01-24 21:05:33', '1977-09-19 23:49:43'),
(29, 'zappellin', 55, 'Corrupti illo blanditiis et illo at dolorum consequuntur est possimus ut a aut.', '1992-04-22 17:34:11', '1997-12-10 14:43:14'),
(30, 'kaokao', 56, 'Eius possimus dolore mollitia quia quia id ad.', '1984-02-18 11:57:57', '1988-06-04 15:57:35'),
(31, 'zappellin', 57, 'Quia quis et sit eius quas nesciunt ducimus.', '1976-02-04 06:58:16', '1997-03-17 20:15:28'),
(32, 'kaokao', 58, 'Quibusdam itaque consectetur vel tenetur sit consequatur at similique a.', '2001-10-07 06:17:16', '1972-12-08 07:51:53'),
(33, 'zappellin', 59, 'Molestiae sint ducimus sequi et soluta laborum similique delectus quia exercitationem porro.', '2013-05-02 19:16:28', '1973-09-06 20:42:54'),
(34, 'kaokao', 60, 'Autem at ut recusandae libero velit rerum dolore id in.', '2008-06-12 09:10:59', '2000-09-12 01:47:31'),
(35, 'zappellin', 61, 'Sunt ducimus praesentium soluta expedita atque repellendus et quasi porro corrupti.', '1986-05-16 18:47:12', '2009-01-23 12:07:13'),
(36, 'zappellin', 52, 'comment test', '2020-02-14 09:09:41', '0000-00-00 00:00:00'),
(38, 'zappellin', 77, 'test', '2020-02-13 23:00:00', '0000-00-00 00:00:00'),
(39, 'zappellin', 77, 'test', '2020-02-13 23:00:00', '0000-00-00 00:00:00'),
(40, 'zappellin', 77, 'awewaeawea', '2020-02-14 23:00:00', '0000-00-00 00:00:00'),
(41, 'zappellin', 77, 'aweaw', '2020-02-15 04:27:20', '0000-00-00 00:00:00'),
(42, 'zappellin', 53, 'qewwe', '2020-02-15 04:30:28', '0000-00-00 00:00:00'),
(43, 'zappellin', 61, 'wefefsef', '2020-02-15 06:44:15', '0000-00-00 00:00:00'),
(44, 'zappellin', 61, 'awkejrh qjawhrfj hakjfhnaljkhnf jkahkjgfhajk hfgkjhhjkgajhiksdgjhkhasdifjhasijdfhasjkdhfkjasdhfjkahsdfijkhasdhkjfsakdjhfkjasdhfkjashdfkjhsadklfjhasdk', '2020-02-15 09:28:52', '0000-00-00 00:00:00');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `tag` int(11) DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_bin NOT NULL,
  `slug` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date_post` date NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `post_text`
--

INSERT INTO `post_text` (`post_id`, `post_name`, `post_desc`, `contenue`, `parent_node`, `tag`, `author`, `slug`, `date_post`) VALUES
(52, 'Est nesciunt.', 'Tempora officiis nostrum amet error. Qui nobis voluptatibus eum animi recusandae ad sed. Deleniti quo temporibus quas recusandae praesentium. Id porro dignissimos quidem non. Mollitia vel accusantium aut corrupti qui placeat recusandae omnis. Ut nam sit odio ipsum aut officiis dolores. Et accusamus ullam accusantium provident et id tenetur ea. Dolorem minus soluta doloremque vero est magni quia incidunt. Sequi sunt magni quibusdam quo ut non.', 'MYSELF, I\'m afraid, sir\' said Alice, surprised at this, she was now, and she drew herself up on tiptoe, and peeped over the fire, and at once set to work throwing everything within her reach at the flowers and the bright flower-beds and the pool of tears which she concluded that it led into the loveliest garden you ever saw. How she longed to get through was more hopeless than ever: she sat on,.', NULL, NULL, 'iusto', NULL, '2016-05-17'),
(53, 'Adipisci eum.', 'Quisquam totam blanditiis est sequi consequatur consectetur. Hic earum quia iusto sit dolor quis omnis. Cum culpa omnis perspiciatis in officia numquam. Saepe blanditiis non omnis dolorem. Ab ut maxime sit in maxime reiciendis sit. Dolorem quo et et ut dolores qui. Beatae quo ullam cumque iusto. Distinctio exercitationem in sit consequatur tempora magni. Cum aliquid recusandae magnam velit. Iure perspiciatis suscipit consequatur voluptatem sit occaecati. Omnis deserunt modi quas est sit omnis soluta. Blanditiis et repudiandae facere ut autem fugiat veniam. Voluptas soluta exercitationem atque minus dignissimos.', 'Stigand, the patriotic archbishop of Canterbury, found it very hard indeed to make personal remarks,\' Alice said nothing; she had asked it aloud; and in another moment, splash! she was near enough to get rather sleepy, and went by without noticing her. Then followed the Knave of Hearts, he stole those tarts, And took them quite away!\' \'Consider your verdict,\' he said in a low voice. \'Not at.', NULL, NULL, 'recusandae', NULL, '1975-01-12'),
(54, 'Voluptate velit.', 'Omnis non consectetur dolorem eos omnis repudiandae in. Et officiis nulla voluptate culpa quidem voluptatem dolore non. Consequatur temporibus ab dicta incidunt laboriosam et sunt. Aut doloremque cupiditate temporibus cum. Voluptate incidunt nulla facilis corrupti. Sint fuga illo minus et. Ut possimus excepturi voluptas explicabo perferendis impedit quos quas. Quo quibusdam aliquam rerum atque ut ipsa.', 'Was kindly permitted to pocket the spoon: While the Panther received knife and fork with a trumpet in one hand, and made believe to worry it; then Alice, thinking it was over at last, and managed to put down her anger as well look and see after some executions I have none, Why, I wouldn\'t say anything about it, and yet it was a general chorus of \'There goes Bill!\' then the different branches of.', NULL, NULL, 'et', NULL, '1970-09-26'),
(55, 'Commodi non.', 'Nihil esse doloremque totam quia neque. Tempora facilis iste unde eos odit eos neque. Minima qui quod consectetur quod. Tenetur consequatur ut vel. Reiciendis et a laboriosam soluta. Eligendi vitae velit ratione dolorem. Ipsam praesentium sunt a quo dolore ut debitis nulla. Quia commodi harum et quo. Quibusdam cum et velit voluptatem. Dolorum sint autem alias harum. Sed mollitia enim corrupti ea dolorem quos architecto. Sit nobis et vel. Sit qui impedit enim fuga blanditiis rerum accusantium.', 'The executioner\'s argument was, that if something wasn\'t done about it while the rest of the baby, and not to be trampled under its feet, ran round the neck of the e--e--evening, Beautiful, beautiful Soup! Beau--ootiful Soo--oop! Soo--oop of the gloves, and was going to shrink any further: she felt a little anxiously. \'Yes,\' said Alice, who felt very curious thing, and she could not think of any.', NULL, NULL, 'commodi', NULL, '1970-11-13'),
(56, 'Veniam a.', 'Aut tempore dolorum non aperiam. Delectus voluptas adipisci dolores repudiandae qui ut sapiente. Ut et aut amet omnis quisquam voluptatem expedita consequatur. Aperiam cupiditate officiis autem placeat voluptatem illo omnis. Accusantium eius sit et eum quia ut. Voluptatibus officia impedit recusandae modi consequatur et deserunt. Odit odit consequuntur facilis dignissimos provident delectus. Optio molestias quia et quisquam ut eaque ipsa corporis. Cum dolores nihil pariatur quo beatae qui quaerat. Magni adipisci animi quidem ad voluptate. Vel a et in aut. Minus nam qui nesciunt nulla.', 'At last the Caterpillar contemptuously. \'Who are YOU?\' said the Hatter. \'I deny it!\' said the Gryphon. \'We can do no more, whatever happens. What WILL become of you? I gave her answer. \'They\'re done with blacking, I believe.\' \'Boots and shoes under the table: she opened the door that led into the teapot. \'At any rate I\'ll never go THERE again!\' said Alice more boldly: \'you know you\'re growing.', NULL, NULL, 'alias', NULL, '1970-03-30'),
(57, 'Et et qui.', 'Sit qui pariatur laborum. Quaerat voluptatem nesciunt dolorem quae ex et blanditiis. Pariatur velit aspernatur numquam repellat qui explicabo eos. Cupiditate est nam expedita eum voluptatem. Laudantium accusamus dolorem nemo repellendus soluta. Quisquam perspiciatis quis voluptatem aspernatur blanditiis dolor distinctio. Mollitia harum officiis ipsam et. Quo doloremque veniam porro blanditiis. Vel optio accusamus tenetur fugiat. Voluptatem atque praesentium qui voluptates libero.', 'Gryphon. \'Of course,\' the Mock Turtle. \'Certainly not!\' said Alice to find that she began thinking over all she could not swim. He sent them word I had our Dinah here, I know is, something comes at me like a wild beast, screamed \'Off with her head!\' Alice glanced rather anxiously at the other players, and shouting \'Off with her head pressing against the roof of the gloves, and she sat still just.', NULL, NULL, 'doloremque', NULL, '1976-10-28'),
(58, 'Explicabo aut.', 'Dolorem quaerat rerum deleniti expedita vel rerum magni. Nihil dicta explicabo error nihil necessitatibus enim. Quos laboriosam aliquid autem et. Qui blanditiis quia voluptas ut. Qui illum esse qui qui maxime. Magni perferendis quidem suscipit nam excepturi. Qui nobis sed magnam et et tempora. Nihil dignissimos rerum ipsum ullam dignissimos culpa eos dolor. Occaecati labore a quia doloribus earum modi. Et quia est minima ducimus est nihil quo. Aut temporibus asperiores omnis. Dolores cumque incidunt dolores magni.', 'English!\' said the King said, for about the crumbs,\' said the King replied. Here the Dormouse said--\' the Hatter grumbled: \'you shouldn\'t have put it right; \'not that it might appear to others that what you were down here till I\'m somebody else\"--but, oh dear!\' cried Alice in a shrill, loud voice, and the happy summer days. THE.', NULL, NULL, 'omnis', NULL, '1998-11-17'),
(59, 'Accusamus laborum repellendus.', 'Molestiae ea temporibus autem ex. Atque accusantium dignissimos illo nemo. Et hic non nihil quam sint dolorem hic. Nihil voluptatem autem similique est non autem. Repellendus voluptatum ut quas et illo et. Quas corporis quis dolores voluptatibus. Enim accusantium consequatur delectus aut porro amet. Delectus sed et nihil.', 'Queen. \'Never!\' said the Caterpillar; and it set to work very carefully, with one finger, as he spoke, and added with a table in the direction in which you usually see Shakespeare, in the chimney as she could, for her neck would bend about easily in any direction, like a serpent. She had quite forgotten the little magic bottle had now had its full effect, and she said to the little golden key,.', NULL, NULL, 'et', NULL, '2010-09-29'),
(60, 'Quam adipisci.', 'Sint quasi magnam soluta repellat deleniti et praesentium consequuntur. Laudantium repudiandae totam delectus ducimus eligendi. Assumenda corrupti harum amet totam quibusdam harum voluptatum. Beatae corporis dolores et voluptas praesentium. Ipsa delectus asperiores autem saepe qui mollitia. Aliquam iste dolores commodi a exercitationem. Autem non saepe culpa qui reprehenderit est magnam.', 'Alice looked down at her rather inquisitively, and seemed not to be seen--everything seemed to Alice a little door was shut again, and Alice looked round, eager to see its meaning. \'And just as well say this), \'to go on till you come to an end! \'I wonder what Latitude was, or Longitude either, but thought they were trying which word sounded best. Some of the day; and this time the Mouse was.', NULL, NULL, 'libero', NULL, '2004-12-14'),
(61, 'Quo quaerat accusantium.', 'Esse dolore vero id autem. Dolores qui omnis culpa culpa quidem nulla. Voluptates consectetur modi aut ut sit aliquam rem et. Quo commodi sit sapiente blanditiis dolore aut. Consequatur culpa officiis corporis iure qui ut eos. Explicabo possimus omnis quos quia reprehenderit. Nulla et quis nobis ut sunt. Velit id sed in id. Qui minus consequatur aliquam. Rerum non tempore recusandae.', 'Alice replied in an offended tone, \'so I can\'t be civil, you\'d better ask HER about it.\' (The jury all wrote down on their slates, and she felt that this could not make out exactly what they said. The executioner\'s argument was, that her neck kept getting entangled among the people near the door, and the three gardeners instantly threw themselves flat upon their faces, so that it was perfectly.', NULL, NULL, 'id', NULL, '1989-06-12'),
(62, 'Voluptatibus qui.', 'Nulla sit officiis rerum voluptatem dolorem quisquam voluptatem. Corrupti atque et dicta ut aliquid sed. Porro delectus reiciendis nostrum dolor. Et reiciendis non quasi ut. Consequatur est cupiditate cum tenetur voluptatibus. Non perferendis et odio non accusantium. Dolorem qui modi tempore. Qui molestias porro eum rerum non ut. Nisi autem necessitatibus libero repellat eius placeat voluptas. Incidunt et iusto enim atque reiciendis numquam dicta. Voluptatibus eum et laudantium et. Beatae optio illum saepe id veritatis nemo.', 'Alice hastily replied; \'at least--at least I mean what I should think it would be quite absurd for her neck from being broken. She hastily put down her anger as well be at school at once.\' However, she did so, very carefully, nibbling first at one end of every line: \'Speak roughly to your little boy, And beat him when he finds out who was passing at the Caterpillar\'s making such a thing before,.', NULL, NULL, 'numquam', NULL, '1986-05-31'),
(63, 'Consequatur voluptas placeat.', 'Dolorem aut non laborum id. Esse sint ullam soluta neque omnis. Quis in porro maiores corporis ab doloribus voluptatem ut. Velit vel quia et ab mollitia fugiat ut laborum. Laudantium animi in aut magnam. Provident eum modi quidem aut. Qui aut aut voluptas dicta iure quam explicabo.', 'Rabbit\'s--\'Pat! Pat! Where are you?\' said Alice, timidly; \'some of the shelves as she came upon a Gryphon, lying fast asleep in the same thing with you,\' said the King, the Queen, and in his turn; and both creatures hid their faces in their paws. \'And how did you manage on the back. At last the Dodo had paused as if he would not stoop? Soup of the door and went on all the same, shedding gallons.', NULL, NULL, 'accusantium', NULL, '1996-05-27'),
(64, 'Iste necessitatibus dolorem.', 'Quo dicta non est ut. Iusto eius soluta facilis ipsam ipsam. Fugiat aut iste molestias quas et quia omnis quia. Voluptatem sunt harum cumque officia. A voluptatibus quo veniam quia non omnis. Ea quis sed repudiandae ea. Minus et facere repellendus sed nihil porro impedit.', 'Alice severely. \'What are you getting on?\' said the Caterpillar. \'Well, perhaps you were or might have been was not otherwise than what it meant till now.\' \'If that\'s all you know about this business?\' the King was the BEST butter,\' the March Hare, who had followed him into the roof bear?--Mind that loose slate--Oh, it\'s coming down! Heads below!\' (a loud crash)--\'Now, who did that?--It was.', NULL, NULL, 'omnis', NULL, '2001-03-11'),
(65, 'Fugit fuga ut.', 'Sit placeat ullam expedita cupiditate perspiciatis asperiores. Aut architecto est dolorum fugiat. Iure non iste et unde dolore fugit qui at. Assumenda soluta quia repudiandae. Sit ad laboriosam rem nihil neque. Saepe et eos in voluptates voluptatum. Et veritatis ut rerum iusto vel. Iusto dolores fuga reiciendis dolores. Velit consequatur ipsam porro rerum voluptas recusandae. Ut voluptatibus assumenda voluptas nam vero. Consequatur mollitia qui autem quod ipsa nemo. Dignissimos dolor fuga temporibus.', 'Caterpillar. Alice thought the poor little thing was waving its right paw round, \'lives a Hatter: and in THAT direction,\' waving the other side of the soldiers did. After these came the royal children, and everybody else. \'Leave off that!\' screamed the Gryphon. \'Well, I shan\'t grow any more--As it is, I suppose?\' \'Yes,\' said Alice, (she had grown to her great disappointment it was certainly not.', NULL, NULL, 'at', NULL, '1978-11-23'),
(66, 'Aliquam fuga quia.', 'Maxime esse quia excepturi rerum eos. Ut similique consequatur eaque. Nulla eveniet et tenetur necessitatibus. Cumque nesciunt debitis id deserunt. Mollitia repudiandae numquam quia modi officiis maxime similique. Eum molestias harum veniam deleniti repudiandae. Ipsa ipsum voluptatum dicta. Minima in labore excepturi velit doloremque doloremque nisi.', 'I shall never get to the door, staring stupidly up into the wood for fear of their hearing her; and when she had been looking at everything about her, to pass away the moment they saw the White Rabbit, trotting slowly back again, and said, very gravely, \'I think, you ought to be an advantage,\' said Alice, \'and if it had fallen into a tree. By the use of a treacle-well--eh, stupid?\' \'But they.', NULL, NULL, 'hic', NULL, '1996-12-25'),
(67, 'Nihil repellat inventore.', 'Pariatur aut eum voluptatibus et est perspiciatis. Id tempore reiciendis sequi totam quia accusamus. Non commodi voluptas ut. Ab iure quia dolores facere. Earum nostrum architecto reiciendis sunt. Quis quos eaque molestias velit. Quasi unde et error voluptates voluptate qui assumenda. Odit ea porro omnis doloremque quae. Et ratione adipisci eos illum. Necessitatibus eos ad et porro et assumenda. Aut qui architecto voluptatem dolore. In atque inventore pariatur autem sequi iste aut. Eveniet suscipit ut perferendis tempora. Labore beatae commodi vero sunt est.', 'She got up in a mournful tone, \'he won\'t do a thing as \"I get what I was a very fine day!\' said a timid and tremulous sound.] \'That\'s different from what I like\"!\' \'You might just as well wait, as she was now more than three.\' \'Your hair wants cutting,\' said the Duchess, \'as pigs have to go down--Here, Bill! the master says you\'re to go on. \'And so these three weeks!\' \'I\'m very sorry you\'ve been.', NULL, NULL, 'et', NULL, '1970-11-24'),
(68, 'Voluptatem vero.', 'Ullam eos voluptatem qui pariatur. Ut aliquam voluptas alias fugiat laudantium itaque. In excepturi in harum sunt. Qui sed nisi veniam deserunt architecto eaque. Quibusdam hic dolorem qui sit velit est quia. Quia aut est culpa dolorem. Aut nihil aut quia corporis cumque. Illo rerum consequatur sit minima voluptate voluptate exercitationem. Accusantium omnis optio ut omnis. Qui ut quia maxime fuga est. Dolor est est deleniti quis aperiam est. Ipsa deserunt et iusto.', 'Majesty,\' the Hatter were having tea at it: a Dormouse was sitting on the door began sneezing all at once. The Dormouse again took a minute or two. \'They couldn\'t have done that, you know,\' the Hatter said, turning to the heads of the words all coming different, and then all the unjust things--\' when his eye chanced to fall upon Alice, as she listened, or seemed to be treated with respect..', NULL, NULL, 'aspernatur', NULL, '1987-04-26'),
(69, 'Quia voluptatibus.', 'Sapiente voluptatem vel non rerum soluta. Aut dolores molestias nobis aut eos dolore necessitatibus. Omnis non perferendis voluptas. Blanditiis nam veniam est corporis. Reiciendis minus quos quis omnis voluptatum vel nostrum reprehenderit. Est illum aliquid perspiciatis recusandae ab consequuntur. Quos ex minima in tempora. Aperiam dolor est dolorem quod autem fugiat sapiente.', 'Number One,\' said Alice. \'You did,\' said the Hatter, and, just as I\'d taken the highest tree in the direction in which case it would be quite as much right,\' said the Cat, \'if you only kept on puzzling about it just grazed his nose, you know?\' \'It\'s the thing at all. \'But perhaps he can\'t help it,\' said the Mouse, who was reading the list of the court, without even looking round. \'I\'ll fetch the.', NULL, NULL, 'ea', NULL, '1970-07-06'),
(70, 'Aliquid quibusdam.', 'Veniam in qui impedit non aspernatur. Et et praesentium distinctio accusantium aliquam quod qui. Eos natus similique velit quasi sit. Sed illo vel excepturi impedit maiores. Velit est deserunt et sunt sapiente sit. Sequi adipisci cum ad et. Doloremque sint cupiditate labore occaecati totam. Voluptatem ea hic ut nesciunt aut porro quisquam. Eum voluptatem dignissimos ullam repudiandae temporibus ducimus quia.', 'Alice ventured to remark. \'Tut, tut, child!\' said the Caterpillar; and it set to work, and very angrily. \'A knot!\' said Alice, in a very decided tone: \'tell her something worth hearing. For some minutes the whole party look so grave that she remained the same side of the house of the pack, she could not join the dance. Will you, won\'t you, will you join the dance? Will you, won\'t you, won\'t you,.', NULL, NULL, 'repellat', NULL, '2016-12-05'),
(71, 'Natus illo quo.', 'Quo iusto aspernatur eligendi distinctio. Deleniti inventore autem aspernatur repellendus qui aspernatur maxime similique. At eveniet autem eveniet cupiditate tempore odio. Eveniet quia culpa aut a corporis debitis. Vitae eos ea aut sit. Eum et cumque eos temporibus. Saepe quia explicabo distinctio molestiae fuga hic dolore cum. Vel accusamus aperiam consectetur pariatur. Quis veniam temporibus ut sed veritatis ut quaerat. Aliquid rerum quasi et saepe aspernatur vel soluta. Facilis aliquam mollitia maxime voluptatem. Ut explicabo sint laboriosam libero odio et sint. Doloremque rerum doloribus tempore est porro provident est.', 'Rabbit just under the window, I only wish it was,\' the March Hare was said to Alice, and tried to speak, and no room at all comfortable, and it was certainly English. \'I don\'t believe it,\' said the last few minutes it seemed quite dull and stupid for life to go near the centre of the Rabbit\'s voice; and Alice could speak again. The rabbit-hole went straight on like a telescope.\' And so she went.', NULL, NULL, 'enim', NULL, '2003-06-25'),
(72, 'Vero et.', 'Est libero quisquam error est quia libero voluptatem. Repellat iste beatae amet quo nisi aut. Natus similique dolores et nulla praesentium id et iure. Numquam laudantium velit id occaecati quas repellendus. Nisi iste beatae ut dolorum voluptatibus quis. Distinctio impedit unde occaecati omnis. Voluptatibus omnis eos et tenetur. Dolorem voluptas nulla mollitia voluptate. Nemo et rem quia nisi.', 'Why, I haven\'t been invited yet.\' \'You\'ll see me there,\' said the Duchess: \'and the moral of that is--\"The more there is of mine, the less there is of mine, the less there is of yours.\"\' \'Oh, I beg your acceptance of this rope--Will the roof of the window, I only wish it was,\' said the Hatter. \'You might just as she tucked it away under her arm, that it was over at last: \'and I wish you wouldn\'t.', NULL, NULL, 'reprehenderit', NULL, '1979-03-27'),
(73, 'Fugiat qui.', 'Quam quia saepe nisi facere voluptatem qui. Suscipit est quis nisi voluptas sunt ullam. In porro consequuntur voluptatum natus quidem aut qui. Qui inventore quisquam recusandae aut. Aut tempora nihil nisi quasi nobis. Molestias natus nulla et omnis fugit. Et voluptatem commodi in quos itaque at nostrum. Omnis harum est sed. Mollitia iure quis nemo ut labore iste. Qui libero ducimus earum ipsa placeat provident. Soluta est maxime voluptas libero ratione enim. Ut doloremque voluptas omnis. Ut dolor nemo quos et cum ratione dolores debitis. Necessitatibus nostrum sit sunt perferendis.', 'I can\'t quite follow it as you are; secondly, because she was about a whiting before.\' \'I can hardly breathe.\' \'I can\'t remember half of fright and half believed herself in the long hall, and wander about among those beds of bright flowers and those cool fountains, but she gained courage as she could not possibly reach it: she could remember about ravens and writing-desks, which wasn\'t much. The.', NULL, NULL, 'vitae', NULL, '1981-05-02'),
(74, 'Aut odio.', 'Est reiciendis suscipit aliquam quae voluptatum corporis amet enim. Velit deleniti molestias eligendi eum fuga beatae praesentium maiores. Doloribus quae unde illo nemo. Repellendus est consequatur non voluptas aut amet. Et et facilis expedita molestias modi. Libero eveniet eaque error sunt. Quidem at illo quos. Et sequi neque sunt. Quo quasi atque eveniet quaerat. Quidem aut numquam voluptates mollitia. Sunt commodi cumque veniam est aut in et. Reprehenderit sunt est doloremque recusandae qui doloribus. Libero et est qui delectus.', 'So they had to leave off this minute!\' She generally gave herself very good advice, (though she very soon came upon a little timidly: \'but it\'s no use speaking to it,\' she said to herself, rather sharply; \'I advise you to learn?\' \'Well, there was silence for some minutes. Alice thought decidedly uncivil. \'But perhaps he can\'t help it,\' said the Queen, \'and he shall tell you my.', NULL, NULL, 'vitae', NULL, '2012-12-07'),
(75, 'Qui minima dolorem.', 'Labore quos et quos est saepe quisquam aut. Distinctio dolor est esse. Tempora soluta alias cumque voluptas blanditiis. Aut distinctio nam repellendus atque eveniet quas. Quia iusto eius rerum possimus sed et necessitatibus. Quaerat ullam tenetur doloribus in non dolorem tenetur. Perferendis vero vero natus dolorem officiis. Non sed quae rerum voluptatem pariatur ipsum. Deleniti expedita doloribus facilis deleniti doloribus commodi. Necessitatibus eos ex itaque cumque. Ipsum et neque aut.', 'She was a body to cut it off from: that he had come back in their mouths. So they went up to the end of the lefthand bit of stick, and tumbled head over heels in its sleep \'Twinkle, twinkle, twinkle, twinkle--\' and went down to nine inches high. CHAPTER VI. Pig and Pepper For a minute or two, and the sounds will take care of the leaves: \'I should like to be treated with respect. \'Cheshire Puss,\'.', NULL, NULL, 'rerum', NULL, '1994-08-20'),
(76, 'Laborum dignissimos.', 'Soluta perferendis voluptas commodi sint id nostrum enim. Neque ut inventore iure est quos sunt. Incidunt eveniet quia aut. Maxime sequi est in rerum in minima ad. Ut dicta blanditiis magnam voluptatem. Quis sapiente similique optio nam. Voluptas dolore ut laudantium vel. Dolorum pariatur est excepturi quibusdam.', 'Cat. \'I don\'t know of any that do,\' Alice said to herself, rather sharply; \'I advise you to leave off this minute!\' She generally gave herself very good advice, (though she very good-naturedly began hunting about for a great thistle, to keep back the wandering hair that WOULD always get into the sky. Alice went timidly up to the cur, \"Such a trial, dear Sir, With no jury or judge, would be so.', NULL, NULL, 'vero', NULL, '1997-05-15'),
(77, 'test', 'ceci est un test a la con ', 'la lalalalalala', NULL, NULL, 'zappellin', NULL, '2020-02-13');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`tag_id`, `tag_name`, `slug`, `tag_desc`) VALUES
(1, 'test', 'test', 'test tag');

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
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `upvote`
--

INSERT INTO `upvote` (`id`, `user_id`, `post_id`) VALUES
(18, 1, 52),
(17, 1, 53),
(16, 1, 61);

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
