-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  Dim 28 jan. 2018 à 16:21
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `balancetonsport`
--

-- --------------------------------------------------------

--
-- Structure de la table `sport`
--

CREATE TABLE `sport` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `sport`
--

INSERT INTO `sport` (`id`, `nom`) VALUES
(1, 'football'),
(2, 'rugby'),
(3, 'handball'),
(4, 'basketball'),
(5, 'tennis'),
(6, 'tennis de table'),
(7, 'badminton'),
(8, 'course à pied'),
(9, 'cyclisme'),
(10, 'randonnée'),
(11, 'escalade'),
(12, 'skate'),
(13, 'roller'),
(14, 'bmx'),
(15, 'natation'),
(16, 'plongée'),
(17, 'kayak'),
(18, 'pétanque'),
(19, 'kyte surf'),
(20, 'circuit auto'),
(21, 'circuit moto'),
(22, 'offroad'),
(23, 'football'),
(24, 'rugby'),
(25, 'handball'),
(26, 'basketball'),
(27, 'tennis'),
(28, 'tennis de table'),
(29, 'badminton'),
(30, 'course à pied'),
(31, 'cyclisme'),
(32, 'randonnée'),
(33, 'escalade'),
(34, 'skate'),
(35, 'roller'),
(36, 'bmx'),
(37, 'natation'),
(38, 'plongée'),
(39, 'kayak'),
(40, 'pétanque'),
(41, 'kyte surf'),
(42, 'circuit auto'),
(43, 'circuit moto'),
(44, 'offroad');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `sport`
--
ALTER TABLE `sport`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `sport`
--
ALTER TABLE `sport`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;