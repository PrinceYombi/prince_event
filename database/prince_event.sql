-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 28 juin 2024 à 06:03
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `prince_event`
--

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `categorie` varchar(255) DEFAULT NULL,
  `date_event` date DEFAULT NULL,
  `time_event` time DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_tmp` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id`, `nom`, `description`, `categorie`, `date_event`, `time_event`, `image_name`, `image_tmp`) VALUES
(40, 'Sample Venue 2', 'Sample Address\r\nLorem Ipsum Dolor Sit Amet, Id Has Nostro Vivendo, Id Per Alii Volutpat Inciderint? Graece Ornatus Gubergren Te Quo, Qui At Oblique Accusamus, Id Pro Eros Etiam', 'Mariage', '2024-07-07', '10:30:00', '1_1602661320_1_1602661260_1_1602647100_1_1602644820_1_1602643440_1_1602643380_1_1602643320_1_1602643140_images5.jpg', '1_1602661320_1_1602661260_1_1602647100_1_1602644820_1_1602643440_1_1602643380_1_1602643320_1_1602643140_images5.jpg'),
(41, 'La Cybersécurité', 'Sample Address\r\nDuis Aute Irure Dolor In Reprehenderit In Voluptate Velit Esse Cillum Dolore Eu Fugiat Nulla Pariatur. Excepteur Sint Occaecat Cupidatat Non Proident, Sunt In Culpa Q', 'Conference', '2025-02-21', '20:30:00', '2_1602652920_2_1602647220_2_1602645600_images2.jpg', '2_1602652920_2_1602647220_2_1602645600_images2.jpg'),
(43, 'Comprendre Le Web', 'Ut Enim Ad Minim Veniam, Quis Nostrud Exercitation Ullamco Laboris Nisi Ut Aliquip Ex Ea Commodo Consequat.', 'Conference', '2024-10-31', '15:30:00', '2_1602652920_2_1602647220_2_1602645600_images3.jpg', '2_1602652920_2_1602647220_2_1602645600_images3.jpg'),
(45, 'Mariage Du Couple YOMBI', 'Ut Enim Ad Minim Veniam, Quis Nostrud Exercitation Ullamco Laboris Nisi Ut Aliquip Ex Ea Commodo Consequat.', 'Mariage', '2026-03-27', '10:30:00', '3_1602660960_images5.jpg', '3_1602660960_images5.jpg'),
(46, 'Anniversaire Espero AKPOLI', 'Ut Enim Ad Minim Veniam, Quis Nostrud Exercitation Ullamco Laboris Nisi Ut Aliquip Ex Ea Commodo Consequat.', 'Anniversaire', '2024-11-14', '17:20:00', '1_1602661320_1_1602661260_1_1602647100_1_1602644820_1_1602643440_1_1602643380_1_1602643320_1_1602643140_images.jpg', '1_1602661320_1_1602661260_1_1602647100_1_1602644820_1_1602643440_1_1602643380_1_1602643320_1_1602643140_images.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `idUser` int(11) DEFAULT NULL,
  `idEvent` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `sexe` int(11) DEFAULT NULL,
  `pseudo` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `sexe`, `pseudo`, `firstname`, `lastname`, `telephone`, `email`, `password`) VALUES
(1, NULL, 'Mr Light', '', '', '', 'lightyombi2@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(2, NULL, 'OHB', '', '', '', 'beloth@hotmail.fr', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(4, 2, 'Lonne', 'Malonne', 'OSSEBI', '069740207', 'malonne@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(5, 1, 'Flynn ryder', 'Stalonne', 'EDZOUALIKO', '069787828', 'stalonne@gmail.fr', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(8, NULL, 'Ludo', '', '', '', 'assassin@gmail.cg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(9, NULL, 'Pekolas', '', '', '', 'pea@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(11, NULL, 'Chikito', '', '', '', 'job@gmail.cg', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(16, NULL, 'Kouke', '', '', '', 'coursel@hotmail.fr', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(18, NULL, 'lebo', '', '', '', 'francis@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220'),
(22, NULL, 'PHP', '', '', '', 'php@gmail.com', '47425e4490d1548713efea3b8a6f5d778e4b1766');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idUser` (`idUser`),
  ADD KEY `idEvent` (`idEvent`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`idEvent`) REFERENCES `evenement` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
