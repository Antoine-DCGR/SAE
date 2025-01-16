-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 27 jan. 2023 à 11:30
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sitebde`
--

-- --------------------------------------------------------

--
-- Structure de la table `achats`
--

DROP TABLE IF EXISTS `achats`;
CREATE TABLE IF NOT EXISTS `achats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_etud` varchar(255) NOT NULL,
  `nomProduitFR` varchar(255) NOT NULL,
  `nomProduitEN` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `achats`
--

INSERT INTO `achats` (`id`, `num_etud`, `nomProduitFR`, `nomProduitEN`, `date`, `quantite`) VALUES
(1, '232323', 'coca', 'coca', '2023-01-17', 9),
(2, '12100152EDA', 'oasis tropical', 'oasis tropical', '2023-01-26', 1),
(3, '232323', 'malabar', 'malabar', '2023-01-26', 1),
(4, '232323', 'oasis tropical', 'oasis tropical', '2023-01-26', 1),
(5, '12100152EDA', 'oasis tropical', 'oasis tropical', '2023-01-27', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

DROP TABLE IF EXISTS `comptes`;
CREATE TABLE IF NOT EXISTS `comptes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_etud` varchar(12) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `motdepasse` text NOT NULL,
  `role` varchar(12) NOT NULL,
  `fidelite` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comptes`
--

INSERT INTO `comptes` (`id`, `num_etud`, `mail`, `motdepasse`, `role`, `fidelite`) VALUES
(1, '12100152EDA', 'marie@hotmail.com', 'f0fd596f396d8fc32d5e4fe4c73c61fa2ac55c70', 'client', 0),
(3, '232323', 'fathi@hotmail.com', 'f0fd596f396d8fc32d5e4fe4c73c61fa2ac55c70', 'admin', 0),


-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomProduitFR` varchar(255) NOT NULL,
  `nomProduitEN` varchar(255) NOT NULL,
  `prix` float NOT NULL,
  `quantite` int(11) NOT NULL,
  `categorie` varchar(255) NOT NULL,
  `img` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stock`
--

INSERT INTO `stock` (`id`, `nomProduitFR`, `nomProduitEN`, `prix`, `quantite`, `categorie`, `img`) VALUES
(1, 'cristaline', 'cristaline', 0.5, 6, 'boisson', 'cristalline.png'),
(2, 'capri sun', 'capri sun', 0.5, 5, 'boisson', 'caprisun.png'),
(3, 'oasis tropical', 'oasis tropical', 0.8, 3, 'boisson', 'oasistropic.png'),
(4, 'oasis pomme', 'oasis pomme', 0.8, 4, 'boisson', 'oasispomme.png'),
(5, 'lipton ice tea', 'lipton ice tea', 0.8, 4, 'boisson', 'icetea.png'),
(6, 'malabar', 'malabar', 0.1, 4, 'snacks', 'malabar.png'),
(7, 'lays nature', 'lays nature', 0.6, -1, 'snacks', 'laysnature.png'),
(8, 'lays barbecue', 'lays barbecue', 0.7, 4, 'snacks', 'laysbarbecue.png'),
(9, 'mars', 'mars', 0.7, 4, 'snacks', 'mars.png'),
(10, 'kit kat', 'kit kat', 0.7, 4, 'snacks', 'kitkat.png'),
(11, 'kinder bueno', 'kinder bueno', 0.8, 4, 'snacks', 'kinderbueno.png');
(12,'kinder bueno white','kinder bueno white',0.80,0,'snacks','kbwhite.png');


-- --------------------------------------------------------

--
-- Structure de la table `tresorerie`
--

DROP TABLE IF EXISTS `tresorerie`;
CREATE TABLE IF NOT EXISTS `tresorerie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `entrees` int(11) NOT NULL,
  `sortie` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tresorerie`
--

INSERT INTO `tresorerie` (`id`, `entrees`, `sortie`) VALUES
(1, 0, 9),
(2, 0, 5);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
