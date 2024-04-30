-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 30 avr. 2024 à 12:24
-- Version du serveur : 8.0.34
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `mercury_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `delegates`
--

DROP TABLE IF EXISTS `delegates`;
CREATE TABLE IF NOT EXISTS `delegates` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `priority_level`
--

DROP TABLE IF EXISTS `priority_level`;
CREATE TABLE IF NOT EXISTS `priority_level` (
  `id` int NOT NULL AUTO_INCREMENT,
  `level` text NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `priority_level`
--

INSERT INTO `priority_level` (`id`, `level`, `name`) VALUES
(1, 'IMURG', 'IMPORTANT URGENT'),
(2, 'IMNOTURG', 'IMPORTANT NOT URGENT'),
(3, 'URGNOTIM', 'URGENT NOT IMPORTANT'),
(4, 'NOTIMNOTURG', 'NOT IMPORTANT NOT URGENT');

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tiltle` varchar(255) DEFAULT NULL,
  `desciption` varchar(255) DEFAULT NULL,
  `type_id` int NOT NULL,
  `done` tinyint(1) DEFAULT NULL,
  `delegate_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_constraint` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `fk_constraint` FOREIGN KEY (`type_id`) REFERENCES `priority_level` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
