

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


--
-- Database: `evente`
--

-- --------------------------------------------------------

--
-- Structure de la table `alerte`
--

DROP TABLE IF EXISTS `alerte`;
CREATE TABLE IF NOT EXISTS `alerte` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DateAlerte` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `alerte__produit`
--

DROP TABLE IF EXISTS `alerte__produit`;
CREATE TABLE IF NOT EXISTS `alerte__produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `DateAlerte` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BD82471FF347EFB` (`produit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LibelleCategorie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `LibelleCategorie`) VALUES
(1, 'Riz'),
(2, 'Cube'),
(3, 'Spaghetti'),
(4, 'Vin');

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

DROP TABLE IF EXISTS `facture`;
CREATE TABLE IF NOT EXISTS `facture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etat` int(11) NOT NULL,
  `Date` date NOT NULL,
  `MontantEncaisse` decimal(10,2) NOT NULL,
  `MonnaieRendue` decimal(10,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `Remise` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FE866410A76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `facture`
--



-- --------------------------------------------------------

--
-- Structure de la table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'eventeadmin', 'eventeadmin', 'eventeadmin@evente.com', 'eventeadmin@evente.com', 1, NULL, '$2y$13$8OFO008AkYdFPbIknKTx3Oq9xN30FrX1Ic7pzOoPsDSovm1MvnLOy', '2019-05-15 21:41:58', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(2, 'eventeutilisateur', 'eventeutilisateur', 'eventeutilisateur@evente.com', 'eventeutilisateur@evente.com', 1, NULL, '$2y$13$rkBou3fMNIKZHXX1/qiTGe7wU/myGvXi/nN8E1GhIGSAWHd/XQfIa', '2019-05-15 21:43:15', NULL, NULL, 'a:0:{}');
COMMIT;
-- --------------------------------------------------------

--
-- Structure de la table `operation`
--

DROP TABLE IF EXISTS `operation`;
CREATE TABLE IF NOT EXISTS `operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `typeoperation_id` int(11) DEFAULT NULL,
  `Date` date NOT NULL,
  `Montant` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9B7024CEED5CA9E6` (`service_id`),
  KEY `IDX_9B7024CE510850EC` (`typeoperation_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categorie_id` int(11) DEFAULT NULL,
  `nomProduit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `QuantiteProduit` int(11) NOT NULL,
  `PrixAchat` decimal(10,2) NOT NULL,
  `PrixVente` decimal(10,2) NOT NULL,
  `StockMinimum` int(11) NOT NULL,
  `nomProduitPrixVente` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04ADBCF5E72D` (`categorie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `product`
--

INSERT INTO `product` (`id`, `categorie_id`, `nomProduit`, `QuantiteProduit`, `PrixAchat`, `PrixVente`, `StockMinimum`, `nomProduitPrixVente`) VALUES
(4, 3, 'Maman-Gros grain', 89, '1200.00', '1300.00', 50, 'Spaghetti  -  Maman-Gros grain');

-- --------------------------------------------------------

--
-- Structure de la table `r_a_v_i_t_a_l_l_e_m_e_n_t`
--

DROP TABLE IF EXISTS `r_a_v_i_t_a_l_l_e_m_e_n_t`;
CREATE TABLE IF NOT EXISTS `r_a_v_i_t_a_l_l_e_m_e_n_t` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `Quantite` int(11) NOT NULL,
  `Date` date NOT NULL,
  `QuantiteAvant` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6778CE394584665A` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

DROP TABLE IF EXISTS `service`;
CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id`, `Nom`) VALUES
(14, 'Tmoney'),
(17, 'Flooz');

-- --------------------------------------------------------

--
-- Structure de la table `statistique`
--

DROP TABLE IF EXISTS `statistique`;
CREATE TABLE IF NOT EXISTS `statistique` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date NOT NULL,
  `Gain` decimal(10,2) NOT NULL,
  `TotalVente` decimal(10,2) NOT NULL,
  `Caisse` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `statistique`
--


-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `typeoperation`
--

DROP TABLE IF EXISTS `typeoperation`;
CREATE TABLE IF NOT EXISTS `typeoperation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `typeoperation`
--

INSERT INTO `typeoperation` (`id`, `Nom`) VALUES
(8, 'Depot'),
(11, 'Retrait'),
(12, 'Achat');

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produit_id` int(11) DEFAULT NULL,
  `Quantite` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Gain` decimal(10,2) NOT NULL,
  `Total` decimal(10,2) NOT NULL,
  `facture_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_888A2A4CF347EFB` (`produit_id`),
  KEY `IDX_888A2A4C7F2DEE08` (`facture_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `vente`
--



--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `alerte__produit`
--
ALTER TABLE `alerte__produit`
  ADD CONSTRAINT `FK_BD82471FF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `FK_FE866410A76ED395` FOREIGN KEY (`user_id`) REFERENCES `fos_user` (`id`);

--
-- Contraintes pour la table `operation`
--
ALTER TABLE `operation`
  ADD CONSTRAINT `FK_9B7024CE510850EC` FOREIGN KEY (`typeoperation_id`) REFERENCES `typeoperation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9B7024CEED5CA9E6` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04ADBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `r_a_v_i_t_a_l_l_e_m_e_n_t`
--
ALTER TABLE `r_a_v_i_t_a_l_l_e_m_e_n_t`
  ADD CONSTRAINT `FK_6778CE394584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Contraintes pour la table `vente`
--
ALTER TABLE `vente`
  ADD CONSTRAINT `FK_888A2A4C7F2DEE08` FOREIGN KEY (`facture_id`) REFERENCES `facture` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_888A2A4CF347EFB` FOREIGN KEY (`produit_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
