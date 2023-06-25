-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 02 juin 2023 à 20:03
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
-- Base de données : `user_vendor`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int NOT NULL,
  `nom` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `nbtotalsales` int NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `externe` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `password`, `mail`, `nbtotalsales`, `adresse`, `externe`) VALUES
(19042003, 'Vendor', '1234', 'tess.czaplinski@gmail.com', 148, '11 Avenue Aristide Maillol', 148);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `id` varchar(500) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `datesignup` datetime NOT NULL,
  `contrat` tinyint(1) NOT NULL,
  `endcontrat` date NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `is_seller` tinyint(1) NOT NULL,
  `nbproduct` int NOT NULL,
  `histocommand` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `password`, `mail`, `datesignup`, `contrat`, `endcontrat`, `adresse`, `is_admin`, `is_seller`, `nbproduct`, `histocommand`) VALUES
('641c608e42992', 'kevskobean', 'tess', 'rahmani.kevin9@gmail.com', '2023-03-23 14:22:06', 1, '2027-03-26', '13 avenue aristide maillol', 0, 0, 61, '<br>2023-03-24 15:06:08 : Renault Clio V<br>Quantite : 2<br>2023-03-24 15:06:10 : Toyota GR Supra<br>Quantite : 1<br>2023-03-24 15:11:18 : Volkswagen Polo GTI<br>Quantite : 2<br><br>2023-03-27 15:00:10 : Volkswagen Polo GTI<br>Quantite : 2<br><br>2023-05-31 17:08:10 : Tineco Aspirateur<br>Quantite : 2<br><br>2023-05-31 17:30:09 : Yonex Raquette Badminton<br>Quantite : 2<br><br>2023-05-31 17:30:10 : Aquarellum Peinture<br>Quantite : 2<br><br>2023-05-31 17:30:11 : Roundnet Jeu Extérieur<br>Quantite : 2<br><br>2023-05-31 17:30:12 : Beaux-Arts Set de pinceaux<br>Quantite : 2<br><br>2023-05-31 17:49:23 : Renault Clio V<br>Quantite : 3<br><br>2023-05-31 17:53:46 : Renault Clio V<br>Quantite : 3<br><br>2023-05-31 17:54:04 : Toyota GR Supra<br>Quantite : 2<br><br>2023-06-01 08:56:44 : Gallimard Harry Potter et les Reliques de la Mort<br>Quantite : 27<br><br>2023-06-02 14:25:27 : Glénat One piece tome 1<br>Quantite : 2<br><br>2023-06-02 14:26:25 : Peugeot 208<br>Quantite : 2<br><br>2023-06-02 14:29:42 : Peugeot 208<br>Quantite : 2<br><br>2023-06-02 14:33:27 : Renault Clio V<br>Quantite : 2<br><br>2023-06-02 14:44:15 : Renault Clio V<br>Quantite : 2<br><br>2023-06-02 14:48:44 : Renault Clio V<br>Quantite : 2'),
('641c8fba1d92f', 'tess', 'kevin', 'tess.czaplinski@gmail.com', '2023-03-23 17:43:22', 0, '0000-00-00', '25 rue des Marjoberts Cergy', 0, 0, 4, '<br><br>2023-06-02 14:51:02 : Renault Clio V<br>Quantite : 2<br><br>2023-06-02 14:59:19 : Renault Clio V<br>Quantite : 2'),
('641c92a7904d4', 'marwane', 'kevin', 'marwane.laghzaoui@gmail.com', '2023-03-23 17:55:51', 0, '0000-00-00', '11 A vfdqvfdqvqfd', 0, 0, 0, ''),
('642707efb55ac', 'mouad ', 'test', 'lapog81939@fectode.com', '2023-03-31 18:18:55', 1, '2024-03-31', 'test1', 0, 0, 5, '<br><br>2023-03-31 18:33:27 : Apple Iphone 14 Pro Max 128 Go<br>Quantite : 1<br><br>2023-04-04 22:28:33 : Google Google pixel 7 pro<br>Quantite : 1<br><br>2023-04-08 17:01:04 : Apple Iphone 14 Pro Max<br>Quantite : 1<br><br>2023-04-08 20:06:10 : Apple Iphone 14 Pro Max<br>Quantite : 1<br><br>2023-04-11 19:30:02 : Apple Iphone 14 Pro Max<br>Quantite : 1'),
('647263f6d74f5', 'kevin', 'boubou', 'rahmani.kevin8@gmail.com', '2023-05-27 20:11:34', 1, '2025-05-27', '11 avenue aristide maillol', 0, 0, 18, '<br><br>2023-05-31 17:08:10 : Tineco Aspirateur<br>Quantite : 2<br><br>2023-05-31 17:30:09 : Yonex Raquette Badminton<br>Quantite : 2<br><br>2023-05-31 17:30:10 : Aquarellum Peinture<br>Quantite : 2<br><br>2023-05-31 17:30:11 : Roundnet Jeu Extérieur<br>Quantite : 2<br><br>2023-05-31 17:30:12 : Beaux-Arts Set de pinceaux<br>Quantite : 2<br><br>2023-05-31 17:49:23 : Renault Clio V<br>Quantite : 3<br><br>2023-05-31 17:53:46 : Renault Clio V<br>Quantite : 3<br><br>2023-05-31 17:54:04 : Toyota GR Supra<br>Quantite : 2'),
('64789690b0fe7', 'david', 'kevin', 'david.kusmider2@gmail.com', '2023-06-01 13:01:04', 1, '2024-06-01', '100 rue de Vaucelles Taverny', 0, 0, 1, '<br><br>2023-06-01 13:02:12 : Ferrari SF90 Spider<br>Quantite : 1');

-- --------------------------------------------------------

--
-- Structure de la table `livreur`
--

DROP TABLE IF EXISTS `livreur`;
CREATE TABLE IF NOT EXISTS `livreur` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `datesignup` date NOT NULL,
  `societe` varchar(100) NOT NULL,
  `contrat` int NOT NULL,
  `nbColis` int NOT NULL DEFAULT '0',
  `type_permis` char(2) NOT NULL,
  `nbLivraison` int NOT NULL DEFAULT '0',
  `adresse` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=648794177 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `livreur`
--

INSERT INTO `livreur` (`id`, `nom`, `password`, `mail`, `datesignup`, `societe`, `contrat`, `nbColis`, `type_permis`, `nbLivraison`, `adresse`) VALUES
(648794165, 'rigo', '123456', 'laghzaoui@cy-tech.fr', '2023-04-03', 'MondialRelay', 1, 7, 'b', 0, '2 Avenue du Parc Cergy'),
(648794166, 'mozart', '123456', 'mozart.lecharo@gmail.com', '2023-04-03', 'Chronopost', 1, 8, 'c', 0, '2 Avenue du Parc Cergy'),
(648794167, 'mateo', '123456789', 'mater.apcher@gmail.com', '2023-04-03', 'Colissimo', 1, 12, 'b', 0, '2 Avenue du Parc Cergy'),
(648794168, 'Jacques', '123456789', 'jacques.livreur@gmail.com', '2023-04-21', 'Colissimo', 1, 0, 'c', 0, '2 Avenue du Parc Cergy'),
(648794169, 'Charles', '123456789', 'charles.livreur@gmail.com', '2023-04-21', 'Chronopost', 1, 0, 'b', 0, '2 Avenue du Parc Cergy'),
(648794170, 'Gabriel', '123456789', 'gabriel.livreur@gmail.com', '2023-04-21', 'MondialRelay', 1, 0, 'c', 0, '2 Avenue du Parc Cergy'),
(648794171, 'Raphael', '123456789', 'raphael.livreur@gmail.com', '2023-04-21', 'Chronopost', 1, 0, 'c', 0, '2 Avenue du Parc Cergy'),
(648794172, 'Claude', '123456789', 'claude.livreur@gmail.com', '2023-04-21', 'Chronopost', 1, 2, 'b', 0, '2 Avenue du Parc Cergy'),
(648794173, 'Pierre', '123456789', 'pierre.livreur@gmail.com', '2023-04-03', 'Colissimo', 1, 12, 'b', 0, '2 Avenue du Parc Cergy'),
(648794174, 'Paul', '123456789', 'paul.livreur@gmail.com', '2023-04-21', 'Colissimo', 1, 3, 'c', 0, '2 Avenue du Parc Cergy'),
(648794175, 'Matthieu', '123456789', 'matthieu.livreur@cy-tech.fr', '2023-04-03', 'MondialRelay', 1, 0, 'b', 0, '2 Avenue du Parc Cergy'),
(648794176, 'Alexis', '123456789', 'alexis.livreur@gmail.com', '2023-04-21', 'MondialRelay', 1, 3, 'c', 0, '2 Avenue du Parc Cergy');

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `id` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `categorie` varchar(50) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `contrat` tinyint(1) NOT NULL,
  `datesignup` date NOT NULL,
  `endcontrat` date NOT NULL,
  `nbtotalsales` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`id`, `nom`, `password`, `mail`, `categorie`, `adresse`, `contrat`, `datesignup`, `endcontrat`, `nbtotalsales`) VALUES
('642aae51346f0', 'Renault', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 33820),
('642aae299b308', 'Aramisauto', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 43),
('642aae5830a27', 'Toyota', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aae5d122a8', 'Brice JM', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aae655050a', 'Volskwagen', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aae6a38af5', 'Audi', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aae6e6f532', 'Spoticar', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aae75dfbcc', 'Peugeot', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aae7c83da0', 'Ferrari', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aae84822ff', 'Fiat', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aae8c2f47b', 'Autosphere', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aae934bb96', 'Dacia', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aae99def05', 'Elite Auto', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaea0ba2b9', 'Aston Martin', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaea7b119d', 'Citroen', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaeaf1d832', 'Bymycar', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaeb8424fc', 'Alfa Romeo', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaebdb3e62', 'Seat', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaec2e74e7', 'Abarth', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaec67b0ce', 'Cupra', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaecfa56cc', 'La Centrale', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaed71e10c', 'Renew', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaedb1ef9e', 'Nissan', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaede90fba', 'Opel', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaee3d767d', 'Infiniti', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaee9b8656', 'CarsAndCars', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaeef9bb2c', 'Mazda', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaefde4011', 'Mistsubishi Motors', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaf0ae924a', 'Maserati', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaf0f0871f', 'MINI', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaf17030a7', 'Volvo', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaf1d55053', 'Bentley', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaf2c5fd95', 'BMW', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaf34d7305', 'Mercedes-Benz', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaf3e93ff9', 'Suzuki', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaf4331c60', 'Tesla', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaf5396140', 'Porsche', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaf56eb0d4', 'Ford', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaf5e6bbd6', 'Lamborghini', 'gfdfd', 'esfs@gmail.com', 'automobile', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aafdcee863', 'Truffaut', 'gfdfd', 'esfs@gmail.com', 'bricolage, jardin et animalerie', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aafd750c53', 'Brico Depot', 'gfdfd', 'esfs@gmail.com', 'bricolage, jardin et animalerie', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aafcced5c0', 'Weldom', 'gfdfd', 'esfs@gmail.com', 'bricolage, jardin et animalerie', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aafc857f37', 'Castorama', 'gfdfd', 'esfs@gmail.com', 'bricolage, jardin et animalerie', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642aaffc031ec', 'L\'entrepot du bricolage', 'gfdfd', 'esfs@gmail.com', 'bricolage, jardin et animalerie', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab00885ce5', 'Mr Bricolage', 'gfdfd', 'esfs@gmail.com', 'bricolage, jardin et animalerie', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0101729a', 'Gamm Vert', 'gfdfd', 'esfs@gmail.com', 'bricolage, jardin et animalerie', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab01bda601', 'Leroy Merlin', 'gfdfd', 'esfs@gmail.com', 'bricolage, jardin et animalerie', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0216983c', 'Animalis', 'gfdfd', 'esfs@gmail.com', 'bricolage, jardin et animalerie', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0265868a', 'Maxi Zoo', 'gfdfd', 'esfs@gmail.com', 'bricolage, jardin et animalerie', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab03269d65', 'The Gazon Synthetique', 'gfdfd', 'esfs@gmail.com', 'bricolage, jardin et animalerie', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab045dbdc0', 'NinjaFoodi', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab04d1b88f', 'Tineco', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0553c089', 'Swiffer', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab05aad8a2', 'Brita', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab060ef4e7', 'Karcher', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0672821c', 'Philips', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab06d57dca', 'UHU', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0766859d', 'Sweet Night', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab07ae3241', 'Calgon', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab08141c4e', 'Vileda', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab085d51f1', 'Utopia', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab08c44f32', 'Homerokk', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0901178b', 'Sundis', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab095adb9f', 'Cecotec', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0a10d76c', 'Liwqolx', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0a59c7a2', 'Boulanger', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0ac60375', 'Bialetti', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0b3adbcf', 'Scrub Mommy', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0b73cd82', 'Smeg', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0bcd63b7', 'Tefal', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0c4b8cf0', 'FISHTEC', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0c96141c', 'SOLIDEE', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0ce29c32', 'Elica', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0d6ee104', 'Lisa Design', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0dca31fa', 'YINAMA', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0e05cb83', 'Songmics', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0e99546c', 'Yaheetech', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0f087135', 'Suright', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0fa5b506', 'Woltu', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab0ff445de', 'vidaXL', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1076f768', 'Mon Mobilier Design', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab10d93d6d', 'Bosch', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab11551c28', 'Relaxdays', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1237a2a3', 'Russell Hobbs', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab12d8e58e', 'Iztoss', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab137d6afd', 'Hlfurnieu', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab14901ff8', 'Heimlich', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab14f78e43', 'Lou Laguiole', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab154c1522', 'Cisay', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1599949f', 'Homcom', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab15ee01c8', 'Outsunny', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab16480719', 'Larhn', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1694e6b0', 'Home Glow', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab173342b9', 'TecTake', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab17b3e088', 'Ddmine', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab18679309', 'Dongtata', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab18aa0a88', 'Asobeage', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab192164cc', 'KingBar', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab196664c7', 'Sukeen', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab19f2a84c', 'Hlx', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1a578c5f', 'Gifi', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1b77d882', 'Slfyee', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1be2bfc5', 'Deconovo', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1c3d61c8', 'Mexerris', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1c99931c', 'Ittaho', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1d1d54f7', 'Empire Art', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1d931160', 'Vasagle', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1ee5b06a', 'Iris Ohyama', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab1ff6de98', 'Acezanble', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab20566c5b', 'Vileda Colors', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab211debee', 'Yifaa', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab21985991', 'Samsung', 'gfdfd', 'esfs@gmail.com', 'cuisine et maison', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab22329669', 'Apple', 'gfdfd', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 2811),
('642ab24b00d11', 'Imou', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab250442ce', 'Tapo', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab255b2959', 'INIU', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab25b5e9ed', 'Samsung', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab25f62803', 'HP', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab26382835', 'JBL', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2689a272', 'Spigen', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab26e10684', 'Google', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab27e35174', 'IHOXTX', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab282edf49', 'DJI', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab28c2a21e', 'Xiaomi', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab291a618b', 'Kindle', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab296480b2', 'Boulanger', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab299cee8e', 'Fnac', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2a09504b', 'WiMiUS', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2ab8a3f2', 'RIENOK', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2b15878f', 'Creative', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2b5e31f7', 'Panasonic', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2bdc2565', 'Antteq', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2c1131ee', 'Govee', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2c9d1fba', 'GaWear', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2cf70a69', 'Honor', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2d4d75a9', 'Otterbox', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2dbd47fb', 'Alcatel', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2dedffa1', 'LG', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2e72e77e', 'Qasyfanc', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2ed1cec5', 'PilePow', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab2fb7b3e7', 'Sakahyro', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab302dc78a', 'Toshiba', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab30bc5b74', 'Pxwaxpy', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab3140f604', 'Asus', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab31de6e00', 'UBeesize', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab32698d35', 'Razer Blade', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab33031ff4', 'Philips', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab33a048cd', 'SanDisk', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab341089ff', 'Biesvoy', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab3450c0da', 'United', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab34ac6746', 'LENCENT', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab34f8b73c', 'Jabra', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab356c2d06', 'Withings Body', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab35b62a7e', 'Fnac', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab364896dc', 'Sonos', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab36cdb233', 'TopTro', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab376b8536', 'Sony', 'hfj', 'esfs@gmail.com', 'high-tech', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab38402ae7', 'Disney DVD', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab39d9fe5e', 'Blu-ray Disc', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab3aa5883b', 'Tot ou tard', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab3afd9a13', 'Warner Special Marketing', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab3b5dd5fd', 'Columbia', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab3bcbcc4c', 'Mercury Records', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab3c90f849', 'Metropolitan Ultra HD', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab3d17bb9d', 'Warner Music', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab3d88ea6d', 'Aparte', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab3fa5f073', 'Cultura', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab403ba2ea', 'Universal Music', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab40b3069f', 'Harmonia Mundi', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab42b148d8', 'Warner Bros', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab46e49fd5', 'Decathlon', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab43ce48bf', 'Chateau de Versailles Spectacles', 'oiho', 'esfs@gmail.com', 'musique, dvd et blu-ray', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab47498e92', 'Yonex', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab47959ca4', 'Cultura', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab47df1c8c', 'GoSport', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab48419192', 'Riverside', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab488b9561', 'Inesis', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab496f335f', 'Number Kubb', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab49ede2c5', 'Shiver', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab4a8d5655', 'Kipsta', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab4ae4eb40', 'La maison du billard', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab4b50cd63', 'Yamaha', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab4bd50f42', 'Adidas', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab4ca7cbce', 'Salomon', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab4d1a8b19', 'Akai', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab4d8dfd83', 'Molten', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab4e26d25f', 'Rockrider', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab4eb45326', 'Puma', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab50ae13c2', 'Pioneer', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab510b70e3', 'Wilson', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab51936495', 'Corength', 'gfdgdg', 'esfs@gmail.com', 'sports et loisirs', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab525805a7', 'Zara', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab52c12479', 'Hugo Boss', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab533aecfc', 'Bershka', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab538452fa', 'Uniqlo', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5403ce40', 'The North Face', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab556bcfc1', 'Carhartt', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab560f26bf', 'Adidas', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5698bba8', 'Citadium', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab57003b25', 'Timberland', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab57888fca', 'Wrangler', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab58056107', 'Dr. Martens', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5879aefe', 'Minimum', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab58befb78', 'Wasted', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab59b48bf9', 'Tommy Hilfiger', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5a59d201', 'Etudes', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5ab13ef9', 'EvenAndOdd', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5b0edcc6', 'Stradivarius', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5b74bb37', 'Uniqlo', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5bfc9897', 'PullAndBear', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5ca79085', 'Anna Field', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5ceae476', 'Vans', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5d4dfb02', 'Grace et Mila', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5de407ad', 'Noisy May', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5e42959f', 'Obey', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5f0af5bd', 'ONLY', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab5f514742', 'PierOne', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab6028c59d', 'Wood Wood', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab608bc9de', 'Jacker', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab60d811e0', 'Farah', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab611d361d', 'Nike', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab66a5b035', 'Vero Moda', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab67413b9b', 'Morgan', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab679eaef5', 'Only Petite', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab67f741d3', 'New Look', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab683bbb05', 'Only Tall', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab6883e865', 'Lacoste', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab68cde47b', 'Reebok', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab69201215', 'Only Shoes', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab69624c71', 'OXXO', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab69bef048', 'Bugatti', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab6a2782df', 'Tommy Jeans', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642ab6b270426', 'OnlySons', 'fdsf', 'esfs@gmail.com', 'vetements', 'gd', 1, '2023-04-03', '2028-04-03', 0),
('642dded042aa8', 'Cultura', 'erssr', 'eres@gmail.com', 'livre', 'fgdfg', 1, '2023-04-05', '2028-04-03', 0),
('642ddee5e8d82', 'Fnac', 'erssr', 'eres@gmail.com', 'livre', 'fgdfg', 1, '2023-04-05', '2028-04-03', 0),
('642ddef8600e7', 'La Bourse aux Livres', 'erssr', 'eres@gmail.com', 'livre', 'fgdfg', 1, '2023-04-05', '2028-04-03', 0),
('642ddefe0639b', 'Le Grand Cercle', 'erssr', 'eres@gmail.com', 'livre', 'fgdfg', 1, '2023-04-05', '2028-04-03', 0),
('642ddf064a2cf', 'Lettre et Merveilles', 'erssr', 'eres@gmail.com', 'livre', 'fgdfg', 1, '2023-04-05', '2028-04-03', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
