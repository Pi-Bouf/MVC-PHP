-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 28 Décembre 2016 à 13:07
-- Version du serveur :  10.1.13-MariaDB
-- Version de PHP :  5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `newsite`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `contenu`, `id_user`, `datetime`) VALUES
(71, 'TEST', 'On sait depuis longtemps que travailler avec du texte lisible et contenant du sens est source de distractions, et empêche de se concentrer sur la mise en page elle-même. L''avantage du Lorem Ipsum sur un texte générique comme ''Du texte. Du texte. Du texte.'' est qu''il possède une distribution de lettres plus ou moins normale, et en tout cas comparable avec celle du français standard. De nombreuses suites logicielles de mise en page ou éditeurs de sites Web ont fait du Lorem Ipsum leur faux texte par défaut, et une recherche pour ''Lorem Ipsum'' vous conduira vers de nombreux sites qui n''en sont encore qu''à leur phase de construction. Plusieurs versions sont apparues avec le temps, parfois par accident, souvent intentionnellement (histoire d''y rajouter de petits clins d''oeil, voire des phrases embarassantes).', 6, '2016-12-27 21:26:06'),
(72, 'Ccoucou', 'C''es moi :D', 1, '2016-12-27 12:26:06'),
(73, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(74, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(75, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(76, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(77, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(78, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(79, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(80, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(81, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(82, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(83, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(53, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(54, 'OK', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(55, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(56, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(57, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(58, 'Zoube', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(59, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(60, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(61, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(62, 'Teston', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(63, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(64, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(65, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(66, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(67, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(68, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06'),
(69, 'Ccoucou', 'C''es moi :D', 6, '2016-12-27 12:26:06');

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `contenu` text NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_article` int(11) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `commentaire`
--

INSERT INTO `commentaire` (`id`, `titre`, `contenu`, `id_user`, `id_article`, `datetime`) VALUES
(41, 'Bonjour', 'HEY', 1, 53, '2016-12-27 20:17:34'),
(42, 'fdgfg', 'dfdfgdfg', 1, 53, '2016-12-27 20:18:47'),
(43, 'fdgfg', 'dfdfgdfg', 6, 53, '2016-12-27 20:19:01'),
(44, 'COUCOU', 'okok', 6, 71, '2016-12-27 20:22:51'),
(45, 'COUCOU', 'okok', 6, 71, '2016-12-27 20:30:10'),
(46, 'Merde', 'OK', 6, 71, '2016-12-27 20:31:01'),
(47, 'Merde', 'OKq', 6, 71, '2016-12-27 20:31:20'),
(48, 'Merde', 'OKq', 6, 71, '2016-12-27 20:31:44'),
(49, 'qsd', 'qsd', 6, 71, '2016-12-27 20:32:06'),
(50, 'qsd', 'qsdqsd', 6, 71, '2016-12-27 20:32:26'),
(51, 'Petit commentaire', 'OOOK !', 6, 71, '2016-12-27 20:32:36'),
(52, 'HEY ! :D', 'qsdsqd', 6, 71, '2016-12-27 20:32:59'),
(53, 'qsdqsdsqd', 'fdgdfg', 1, 56, '2016-12-27 21:12:56'),
(54, 'qsdqsd', 'qsdsqdqsd', 1, 56, '2016-12-27 21:27:11'),
(55, 'HEY ! :D', 'COUCOU', 1, 53, '2016-12-28 13:04:44'),
(40, 'sqdqsd', 'gfdfgdfgdfg', 1, 53, '2016-12-27 20:16:59');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(75) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `actif`, `admin`) VALUES
(1, 'Pierre', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 1, 1),
(6, 'Zorro', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 1),
(7, 'zqdd', 'pierre.bouffier05@gmail.com', '4cc250c23c885cdfd10603bfde782534be29a4e474829234b69929526138fc26', 1, 1),
(8, 'Boule', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 1, 1),
(9, 'qsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(10, 'qsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(11, 'sqdsqd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(12, 'sdfsdf', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(13, 'sqdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(14, 'sqdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(15, 'sqdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(16, 'qsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(17, 'qsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(18, 'qsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(19, 'qsdsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(20, 'qsdsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(21, 'qsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(22, 'sqdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(23, 'sqdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(24, 'qsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(25, 'sqdsqd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(26, 'sqdsqd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(27, 'sqdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(28, 'sqdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(29, 'sqdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(30, 'sqdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(31, 'sqdqsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(32, 'sqdqsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(33, 'sqdqsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(34, 'dqsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0),
(36, 'qsdqsd', 'pierre.bouffier05@gmail.com', 'bcb15f821479b4d5772bd0ca866c00ad5f926e3580720659cc80d39c9d09802a', 0, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
