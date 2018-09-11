-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 11 Septembre 2017 à 12:16
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `easystockrwabcb`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `codCli` int(11) NOT NULL,
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`codCli`, `nom`, `prenom`, `adresse`, `telephone`, `email`) VALUES
(4, 'Badiane', 'Badara', 'Ngor village', '2217754656546', 'badarabadiane@gmail.com'),
(5, 'Gueye', 'Fama', 'Liberte 6 extension', '2217754656546', 'nabou@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `codeCli` int(11) NOT NULL,
  `dateCom` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `commande`
--

INSERT INTO `commande` (`id`, `codeCli`, `dateCom`) VALUES
(1, 2, '2017-06-15'),
(2, 4, '2017-06-15'),
(3, 4, '2017-06-15'),
(6, 5, '2017-06-15'),
(7, 5, '2017-06-15'),
(8, 5, '2017-06-16'),
(9, 5, '2017-06-16'),
(12, 4, '2017-06-17'),
(13, 4, '2017-07-04');

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `codFour` int(11) NOT NULL,
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`codFour`, `nom`, `prenom`, `adresse`, `telephone`, `email`) VALUES
(1, 'Ndiaye', 'Samba', 'Mermoz pres du pont cheikh anta diop', '221778596412', 'ndiaye@gmail.com'),
(2, 'Sane', 'Cheikh', 'Sicap baobab', '221784592564', 'abbasane@gmail.com'),
(3, 'Badiane', 'Badara', 'Ngor village', '2217754656546', 'badarabadzo@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `id` int(11) NOT NULL,
  `codCom` int(11) NOT NULL,
  `codProd` int(11) NOT NULL,
  `qteCom` int(11) NOT NULL,
  `prix_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`id`, `codCom`, `codProd`, `qteCom`, `prix_total`) VALUES
(12, 12, 1, 45, 4500),
(13, 12, 3, 48, 19200),
(14, 13, 1, 45, 4500),
(15, 13, 3, 14, 5600);

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

CREATE TABLE `livraison` (
  `codeli` int(11) NOT NULL,
  `codCom` int(11) NOT NULL,
  `dateLivraison` date NOT NULL,
  `status` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `livraison`
--

INSERT INTO `livraison` (`codeli`, `codCom`, `dateLivraison`, `status`) VALUES
(1, 11, '2017-06-17', 'En cours'),
(2, 11, '2017-06-17', 'En cours'),
(3, 12, '2017-07-05', 'En cours'),
(4, 12, '2017-07-08', 'Annuler');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

CREATE TABLE `panier` (
  `id` int(11) NOT NULL,
  `codProd` int(11) NOT NULL,
  `QteCom` int(11) NOT NULL,
  `prix_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `codProd` int(11) NOT NULL,
  `designation` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `unite` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `prixUnitaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `produit`
--

INSERT INTO `produit` (`codProd`, `designation`, `quantite`, `unite`, `prixUnitaire`) VALUES
(1, 'Lait sachet 25 gr', 15, 'sachet', 100),
(3, 'Pomme de terre', 40, 'kg', 400),
(4, 'Halib Lait 400gr', 500, 'kg', 1600);

-- --------------------------------------------------------

--
-- Structure de la table `type_unite_produit`
--

CREATE TABLE `type_unite_produit` (
  `id` int(11) NOT NULL,
  `type` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `type_unite_produit`
--

INSERT INTO `type_unite_produit` (`id`, `type`) VALUES
(1, 'kg'),
(2, 'pot'),
(3, 'sachet'),
(4, 'paquet');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `pin` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `adresse` text COLLATE utf8_unicode_ci NOT NULL,
  `date_inscription` date NOT NULL,
  `type_groupe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `pin`, `email`, `nom`, `prenom`, `adresse`, `date_inscription`, `type_groupe`) VALUES
(1, 'badara', '81bce1f3bf343c464685d875c626820cdb58e309', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'badara@gmail.com', 'badiane', 'charles', 'Ngor village', '2017-05-30', 1),
(8, 'zeyna', '81bce1f3bf343c464685d875c626820cdb58e309', '8cb2237d0679ca88db6464eac60da96345513964', 'nabou@gmail.com', 'Gueye', 'Seynabou', 'Liberte 6 extension', '2017-06-06', 2),
(9, 'dark', 'ea365d3beaaa0fd92a061c7475b388d0ee6bf65d', '8cb2237d0679ca88db6464eac60da96345513964', 'dark@hotmail.fr', 'asdarw', 'dasd', 'wegtfertfa', '2017-06-30', 2),
(10, 'dark2', '81bce1f3bf343c464685d875c626820cdb58e309', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'amidou98@hotmail.fr', 'asdarw', 'dasd', 'wegtfertfa', '2017-06-30', 2);

-- --------------------------------------------------------

--
-- Structure de la table `user_groupe`
--

CREATE TABLE `user_groupe` (
  `id` int(11) NOT NULL,
  `groupe` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `user_groupe`
--

INSERT INTO `user_groupe` (`id`, `groupe`) VALUES
(1, 'administrateur'),
(2, 'utilisateur');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`codCli`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`codFour`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`codeli`);

--
-- Index pour la table `panier`
--
ALTER TABLE `panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`codProd`);

--
-- Index pour la table `type_unite_produit`
--
ALTER TABLE `type_unite_produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user_groupe`
--
ALTER TABLE `user_groupe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `codCli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `codFour` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `codeli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `panier`
--
ALTER TABLE `panier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `codProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `type_unite_produit`
--
ALTER TABLE `type_unite_produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `user_groupe`
--
ALTER TABLE `user_groupe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
