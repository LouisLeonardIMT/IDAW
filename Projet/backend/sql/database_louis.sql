-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 07 avr. 2023 à 15:01
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `database_louis`
--

-- --------------------------------------------------------

--
-- Structure de la table `aliments`
--

DROP TABLE IF EXISTS `aliments`;
CREATE TABLE IF NOT EXISTS `aliments` (
  `id_aliment` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `id_type_aliment` int NOT NULL,
  `calories` int DEFAULT NULL,
  `glucides` float DEFAULT NULL,
  `sucres` float DEFAULT NULL,
  `lipides` float DEFAULT NULL,
  `acides_gras` float DEFAULT NULL,
  `proteines` float DEFAULT NULL,
  `sel` float DEFAULT NULL,
  PRIMARY KEY (`id_aliment`),
  KEY `id_type_aliment` (`id_type_aliment`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `aliments`
--

INSERT INTO `aliments` (`id_aliment`, `nom`, `id_type_aliment`, `calories`, `glucides`, `sucres`, `lipides`, `acides_gras`, `proteines`, `sel`) VALUES
(1, 'Pain de mie', 1, 219, 40, 6.1, 3.6, 0.3, 5.5, 0.87),
(2, 'Cacao en poudre', 8, 151, 20.6, 20.1, 3.7, 2.3, 7.5, 0.3),
(3, 'Céréales Lion', 8, 123, 22.2, 7.5, 2.3, 1, 2.4, 0.15),
(4, 'Gaufre industrielles', 8, 199, 25, 13, 10, 4.7, 2.3, 0.27),
(5, 'Lait', 7, 117, 12, 12, 4, 2.5, 8.3, 0.25),
(6, 'Beignets de poulet', 4, 211, 15, 0.6, 11, 2.1, 12, 1.1),
(7, 'Pancake', 8, 139, 16, 9.8, 5.6, 0.6, 2, 0.51),
(8, 'Frites', 1, 149, 25.5, 0.5, 12, 2.3, 2.5, 0.4),
(9, 'Curly', 11, 138, 16, 0.45, 6, 0.87, 4.2, 0.45),
(10, 'Tomate', 3, 20, 3.59, 2.8, 0.4, 0, 0.5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `composition`
--

DROP TABLE IF EXISTS `composition`;
CREATE TABLE IF NOT EXISTS `composition` (
  `id_compo` int NOT NULL AUTO_INCREMENT,
  `id_plat` int NOT NULL,
  `id_ingredient` int NOT NULL,
  `pourcentage_ingredient` int NOT NULL,
  PRIMARY KEY (`id_compo`),
  KEY `id_plat` (`id_plat`),
  KEY `id_ingredient` (`id_ingredient`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `composition`
--

INSERT INTO `composition` (`id_compo`, `id_plat`, `id_ingredient`, `pourcentage_ingredient`) VALUES
(1, 11, 10, 16),
(2, 12, 10, 7);

-- --------------------------------------------------------

--
-- Structure de la table `profils_sportifs`
--

DROP TABLE IF EXISTS `profils_sportifs`;
CREATE TABLE IF NOT EXISTS `profils_sportifs` (
  `id_profil` int NOT NULL AUTO_INCREMENT,
  `nom_profil` varchar(30) NOT NULL,
  `description` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `profils_sportifs`
--

INSERT INTO `profils_sportifs` (`id_profil`, `nom_profil`, `description`) VALUES
(1, 'Sédentaire', 'Une activité sportive peu intense par semaine ou moins'),
(2, 'Actif', 'Entre une et trois activités sportives par semaine'),
(3, 'Très actif', 'Entre trois et six activités sportives soutenues par semaine'),
(4, 'Athlète', 'Activités sportives quotidiennes ou très soutenues');

-- --------------------------------------------------------

--
-- Structure de la table `repas`
--

DROP TABLE IF EXISTS `repas`;
CREATE TABLE IF NOT EXISTS `repas` (
  `id_repas` int NOT NULL AUTO_INCREMENT,
  `id_mangeur` varchar(50) NOT NULL,
  `id_aliment_mange` int NOT NULL,
  `qte` float NOT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id_repas`),
  KEY `id_mangeur` (`id_mangeur`),
  KEY `id_aliment_mange` (`id_aliment_mange`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `repas`
--

INSERT INTO `repas` (`id_repas`, `id_mangeur`, `id_aliment_mange`, `qte`, `date`) VALUES
(1, 'harry.potter', 9, 2, '2023-03-13'),
(2, 'louise.dupont', 5, 1, '2023-03-19'),
(3, 'louise.dupont', 5, 1, '2023-03-18'),
(4, 'nathan.simon', 8, 3, '2023-03-16'),
(5, 'kim.luxembourger', 7, 2, '2023-03-15'),
(6, 'louis.leonard', 1, 2, '2023-03-17'),
(7, 'louise.dupont', 5, 1, '2023-03-20'),
(8, 'mamie.jacques', 11, 2, '2023-03-19'),
(9, 'dan.du.35', 6, 4, '2023-03-12');

-- --------------------------------------------------------

--
-- Structure de la table `sexe`
--

DROP TABLE IF EXISTS `sexe`;
CREATE TABLE IF NOT EXISTS `sexe` (
  `id_sexe` int NOT NULL AUTO_INCREMENT,
  `nom_sexe` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_sexe`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `sexe`
--

INSERT INTO `sexe` (`id_sexe`, `nom_sexe`) VALUES
(1, 'F'),
(2, 'H'),
(3, 'X');

-- --------------------------------------------------------

--
-- Structure de la table `types_aliments`
--

DROP TABLE IF EXISTS `types_aliments`;
CREATE TABLE IF NOT EXISTS `types_aliments` (
  `id_type` int NOT NULL AUTO_INCREMENT,
  `nom_type` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `types_aliments`
--

INSERT INTO `types_aliments` (`id_type`, `nom_type`) VALUES
(1, 'Féculent'),
(2, 'Fruit'),
(3, 'Légume'),
(4, 'Viande'),
(5, 'Poisson'),
(6, 'Protéine autre'),
(7, 'Laitage'),
(8, 'Sucreries'),
(9, 'Dessert'),
(10, 'Plats composés'),
(11, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `login` varchar(50) NOT NULL,
  `password` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nom` varchar(50) NOT NULL,
  `age` int NOT NULL,
  `sexe` int DEFAULT NULL,
  `taille` float NOT NULL,
  `poids` float NOT NULL,
  `profil` int DEFAULT NULL,
  `besoins_jour` int DEFAULT NULL,
  PRIMARY KEY (`login`),
  KEY `sexe` (`sexe`),
  KEY `profil` (`profil`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`login`, `password`, `nom`, `age`, `sexe`, `taille`, `poids`, `profil`, `besoins_jour`) VALUES
('anaelle.ana', NULL, 'Anna', 17, 1, 1.77, 69, 4, NULL),
('dan.du.35', NULL, 'Daniel', 33, 2, 1.89, 94, 3, NULL),
('harry.potter', NULL, 'Henri', 37, 2, 1.74, 78, 3, NULL),
('kim.luxembourger', NULL, 'Kim', 21, 1, 1.58, 52, 1, NULL),
('louis.leonard', NULL, 'Louis', 22, 2, 1.75, 70, 2, NULL),
('lola.leonard', NULL, 'Lola', 25, 1, 1.61, 50, 2, NULL),
('louise.dupont', NULL, 'Louise', 54, 1, 1.49, 42, 4, NULL),
('mamie.jacques', NULL, 'Jacqueline', 78, 1, 1.47, 43, 1, NULL),
('nathan.simon', NULL, 'Nathan', 21, 2, 1.78, 73, 1, NULL);
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `aliments`
--
ALTER TABLE `aliments`
  ADD CONSTRAINT `aliments_ibfk_1` FOREIGN KEY (`id_type_aliment`) REFERENCES `types_aliments` (`id_type`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `composition`
--
ALTER TABLE `composition`
  ADD CONSTRAINT `composition_ibfk_1` FOREIGN KEY (`id_plat`) REFERENCES `aliments` (`id_aliment`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `composition_ibfk_2` FOREIGN KEY (`id_ingredient`) REFERENCES `aliments` (`id_aliment`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `repas`
--
ALTER TABLE `repas`
  ADD CONSTRAINT `repas_ibfk_1` FOREIGN KEY (`id_mangeur`) REFERENCES `utilisateurs` (`login`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `repas_ibfk_2` FOREIGN KEY (`id_aliment_mange`) REFERENCES `aliments` (`id_aliment`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`sexe`) REFERENCES `sexe` (`id_sexe`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `utilisateurs_ibfk_2` FOREIGN KEY (`profil`) REFERENCES `profils_sportifs` (`id_profil`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;