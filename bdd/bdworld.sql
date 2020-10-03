-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 03 oct. 2020 à 19:51
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdworld`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `prix` decimal(6,2) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `nom`, `type`, `prix`, `description`, `image`) VALUES
(1, 'Arte', 'manga', '7.20', 'Florence, début du 16e siècle.\r\nDans ce berceau de la Renaissance, qui vit l’art s’épanouir dans toute sa splendeur, une jeune aristocrate prénommée Arte rêve de devenir artiste peintre et aspire à entrer en apprentissage dans un des nombreux ateliers de la ville…\r\nHélas ! Cette époque de foisonnement culturel était aussi celle de la misogynie, et il n’était pas concevable qu’une jeune femme ambitionne de vivre de son art et de son travail. Les nombreux obstacles qui se dresseront sur le chemin d’Arte auront-ils raison de la folle énergie de cette aristo déjantée ?', 'arte.jpg'),
(2, 'Magus of the library', 'manga', '7.90', '“Le livre. Une source de savoir, une accumulation de signes chargés de sens, un précieux héritage qui relie passé et futur. C’est un mage qui me l’a dit un jour : protéger les livres, c’est tout simplement… protéger le monde !”\r\nPour le jeune Shio, qui passe son temps libre plongé dans les romans, les récits extraordinaires sont un refuge face à la brutalité du quotidien. Son rêve est de partir pour la capitale des livres, où sont rassemblées toutes les connaissances du monde. Un projet utopique pour un gamin sans ressources… jusqu’au jour où des envoyées de la fameuse bibliothèque centrale débarquent dans son village ! Le miracle qu’il appelle de ses vœux depuis si longtemps est-il sur le point de se réaliser ?', 'magus.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `id_avis` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`id_avis`),
  KEY `id_membre` (`id_membre`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_membre` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `date_commande` datetime NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `id_membre` (`id_membre`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

DROP TABLE IF EXISTS `membres`;
CREATE TABLE IF NOT EXISTS `membres` (
  `id_membre` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  PRIMARY KEY (`id_membre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `membres`
--

INSERT INTO `membres` (`id_membre`, `login`, `password`, `nom`, `prenom`, `mail`, `role`) VALUES
(1, 'admin', '$2y$10$mLe25nDs2rdom35WqAIW/evZOZ7.O3.cUGZAMcNiVqpdmo5pm4x46', 'admin', 'the', 'epse@epse.be', 'ROLE_ADMIN'),
(2, 'Mace', '$2y$10$j/Cb1uYmfV5YJ7xTDocoKOOBhyWK9GyiMINhVsGSxc70dBhhLPmuG', 'Pltx', 'Mandy', 'mandy@epse.be', 'ROLE_USER'),
(3, 'test', '$2y$10$k6kWPYy6xoyAh2ASo6RmVOwypg4W1sAxmF6Y1OfA9ZRO1xSBjsv4G', 'test', 'test', 'test@test.be', 'ROLE_USER');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_ibfk_1` FOREIGN KEY (`id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `avis_ibfk_2` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id_membre`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `commande_ibfk_2` FOREIGN KEY (`id_membre`) REFERENCES `membres` (`id_membre`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
