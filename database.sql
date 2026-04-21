-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 19 avr. 2026 à 12:55
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `vite_gourmand3`
--

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `themes` varchar(255) DEFAULT NULL,
  `allergie` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`id`, `name`, `description`, `price`, `themes`, `allergie`, `created_at`, `image`) VALUES
(1, 'Pitta', 'Délicieux pitta avec viande et crudités', 7.50, 'classique', 'gluten', '2026-04-16 10:32:25', 'pitta.jpg'),
(2, 'Burger', 'Burger maison avec steak, fromage et sauce', 9.90, 'fast-food', 'gluten,lactose', '2026-04-16 10:32:25', 'burger.jpg'),
(3, 'Pizza', 'Pizza mozzarella tomate et basilic', 11.50, 'italien', 'gluten,lactose', '2026-04-16 10:32:25', 'pizza.jpg'),
(4, 'Sportifs', 'Menu riche en protéines pour sportifs', 12.90, 'healthy', 'aucun', '2026-04-16 10:32:25', 'sportif.jpg'),
(5, 'Étudiants', 'Menu pas cher pour étudiants', 6.50, 'budget', 'gluten', '2026-04-16 10:32:25', 'etudiants.jpg'),
(7, 'Mezze', 'Assortiment de spécialités orientales à partager', 10.90, 'oriental', 'gluten,sesame', '2026-04-16 10:35:51', 'mezze.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `livraison_time` datetime DEFAULT NULL,
  `delivery_price` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'en cours',
  `cancel_reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `menu_id`, `adresse`, `livraison_time`, `delivery_price`, `status`, `cancel_reason`, `created_at`) VALUES
(1, 4, 5, '5 rue du tets', '2026-04-20 15:53:00', 5.00, 'livré', NULL, '2026-04-16 10:50:21'),
(2, 4, 1, '5 rue de test', '2026-04-22 20:00:00', 6.18, 'livré', NULL, '2026-04-16 14:55:54'),
(3, 4, 4, '5 rue de la livraison ', '2026-04-22 17:02:00', 5.00, 'livré', NULL, '2026-04-16 15:02:22'),
(4, 4, 1, 'f', '2026-04-16 20:12:00', 5.00, 'en cours', NULL, '2026-04-16 15:06:06'),
(5, 4, 1, 'rue de livraisons ', '2026-04-24 23:12:00', 10.31, 'en cours', NULL, '2026-04-16 15:06:25'),
(6, 4, 1, 'rue du camion', '2026-04-25 21:12:00', 5.00, 'en cours', NULL, '2026-04-16 15:06:54');

-- --------------------------------------------------------

--
-- Structure de la table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `reviews`
--

INSERT INTO `reviews` (`id`, `order_id`, `user_id`, `rating`, `comment`, `status`, `created_at`) VALUES
(1, 1, 4, 5, 'salade tres copieuse , service rapide merci ', 'approved', '2026-04-16 10:51:32'),
(2, 2, 4, 5, 'je me suis regaler merci pour le service ', 'approved', '2026-04-16 14:58:35'),
(3, 3, 4, 4, 'Super site pour commander et la nourriture rien a dire ', 'approved', '2026-04-16 15:03:40');

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `opening_time` varchar(5) DEFAULT NULL,
  `closing_time` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `settings`
--

INSERT INTO `settings` (`id`, `opening_time`, `closing_time`) VALUES
(1, '10.00', '23.00');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `prenom` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `adresse` text DEFAULT NULL,
  `gsm` varchar(20) DEFAULT NULL,
  `role` varchar(50) DEFAULT 'user',
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `email`, `password`, `adresse`, `gsm`, `role`, `active`, `created_at`) VALUES
(1, 'admin', 'ad', 'admin@gmail.com', '$2y$10$c4kY6c5OcXrVwiYPzQvNqO2DkEF6qNuyYxjeFqiA8vBK/HzTZowyK', '', '', 'admin', 1, '2026-04-16 10:37:19'),
(2, 'employe', 'employe', 'employe@gmail.com', '$2y$10$YNlBON3T78hIJrwKvewQ0.EV1H7SYFQKY6jPSPwV.wxgOSTdIdaFO', '', '', 'employe', 1, '2026-04-16 10:38:01'),
(3, 'employe2', 'employe2', 'employe2@gmail.com', '$2y$10$Z23Ay1A5stBbVySVHIO.fOZm6Oip.P5a.4ELnlCmPl2fcUuCs.YoC', NULL, NULL, 'employe', 1, '2026-04-16 10:40:07'),
(4, 'test', 'test', 'test@gmail.com', '$2y$10$ZTkedS3KKVYbixDS3RdKF.Bm178VYeIx8T4.0MwFBLas2lngw2HDq', '', '', 'user', 1, '2026-04-16 10:49:48');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Index pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
