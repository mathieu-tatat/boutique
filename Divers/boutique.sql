-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 07 avr. 2022 à 06:16
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `boutique`
--

-- --------------------------------------------------------

--
-- Structure de la table `carousel_produits`
--

DROP TABLE IF EXISTS `carousel_produits`;
CREATE TABLE IF NOT EXISTS `carousel_produits` (
  `id_produit_carousel` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_produit_carousel`),
  KEY `FK_carousel_produits_id_produit_produits` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `carousel_produits`
--

INSERT INTO `carousel_produits` (`id_produit_carousel`, `id_produit`) VALUES
(4, 6),
(1, 8),
(2, 9);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nom_categorie` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES
(1, 'stylo'),
(2, 'regle'),
(3, 'agenda');

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `date_commande` datetime DEFAULT NULL,
  `id_panier` int(11) NOT NULL,
  `id_paiement` int(11) NOT NULL,
  PRIMARY KEY (`id_commande`),
  KEY `FK_Commandes_paniers_id_panier_paniers` (`id_panier`),
  KEY `FK_Commandes_id_paiement_Paiement` (`id_paiement`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id_commande`, `date_commande`, `id_panier`, `id_paiement`) VALUES
(1, '2022-03-08 12:55:58', 2, 1),
(2, '2022-03-08 13:11:39', 3, 1),
(3, '2022-03-08 13:16:33', 4, 1),
(4, '2022-03-14 09:04:59', 7, 1),
(5, '2022-04-06 17:18:22', 13, 1),
(6, '2022-04-06 21:17:29', 6, 1),
(7, '2022-04-07 08:02:22', 14, 1),
(8, '2022-04-07 08:12:06', 17, 1);

-- --------------------------------------------------------

--
-- Structure de la table `contient`
--

DROP TABLE IF EXISTS `contient`;
CREATE TABLE IF NOT EXISTS `contient` (
  `id_produit` int(11) NOT NULL,
  `id_panier` int(11) NOT NULL,
  `quantité` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_produit`,`id_panier`),
  KEY `FK_Contient_id_panier_Paniers` (`id_panier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `contient`
--

INSERT INTO `contient` (`id_produit`, `id_panier`, `quantité`) VALUES
(1, 2, 1),
(1, 5, 1),
(1, 6, 2),
(1, 7, 9),
(2, 14, 4),
(3, 3, 1),
(3, 13, 1),
(5, 3, 10),
(7, 17, 1),
(8, 4, 12),
(8, 17, 3);

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id_droit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_droit` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_droit`)
) ENGINE=InnoDB AUTO_INCREMENT=1338 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id_droit`, `nom_droit`) VALUES
(1, 'utilisateur'),
(1337, 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
CREATE TABLE IF NOT EXISTS `paiements` (
  `id_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `nom_paiement` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_paiement`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paiements`
--

INSERT INTO `paiements` (`id_paiement`, `nom_paiement`) VALUES
(1, 'CB'),
(2, 'Stripe');

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

DROP TABLE IF EXISTS `paniers`;
CREATE TABLE IF NOT EXISTS `paniers` (
  `id_panier` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  PRIMARY KEY (`id_panier`),
  KEY `FK_Paniers_id_utilisateur_Utilisateurs` (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `paniers`
--

INSERT INTO `paniers` (`id_panier`, `id_utilisateur`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 2),
(15, 2),
(7, 3),
(8, 3),
(11, 6),
(13, 8),
(14, 8),
(16, 8),
(17, 9),
(18, 9);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

DROP TABLE IF EXISTS `produits`;
CREATE TABLE IF NOT EXISTS `produits` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `description_produit` text,
  `units_in_stock` int(11) DEFAULT NULL,
  `id_categorie` int(11) NOT NULL,
  `id_sous_categorie` int(11) NOT NULL,
  PRIMARY KEY (`id_produit`),
  KEY `FK_Produits_id_catergorie_Categories` (`id_categorie`),
  KEY `FK_Produits_id_sous_catergorie_Categories` (`id_sous_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_produit`, `nom_produit`, `img_url`, `unit_price`, `description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) VALUES
(1, '10pcs stylos à bille roulante', 'View/ProductImg/styloBilleRoulante.jpg', '10.99', 'Spécifications:\r\n10 x stylos à bille roulante\r\nTaille (environ): 13,5 cm / 5,3 pouces de longueur\r\nCouleur d\'encre: noir, vert, rose, bleu clair, bleu, rouge, violet, orange, vert clair, marron.\r\nType: roller ball\r\n\r\nCaractéristiques:\r\nSéchage rapide pour ne pas salir vos mains et votre papier.\r\nRégulateur de sortie d\'encre de précision intégré et écriture fluide.\r\nAucune fuite d\'encre.\r\nApprovisionnement en encre visible, facile à voir la quantité d\'encre restante.\r\nPointe extra fine (0,5 mm), adaptée pour une écriture précise.', 2, 1, 1),
(2, 'Stylo feutre pointe fine', 'View/ProductImg/styloFeutre.jpg', '6.99', 'Pochette de 8 stylos-feutre dont 4 stylos effaçables + 2 effaçeurs. \r\nSTABILO point 88, le stylo-feutre à pointe fine (tracé 0,4mm), pour écrire, tracer, dessiner.... \r\nCréé en 1977, sa célébrité ne doit rien au hasard : un corps hexagonal orange à rayures blanches ! \r\nUn tracé fin et précis ! Une longévité exceptionnelle avec plus de 1 000 m d’écriture ! \r\nLe stylo feutre point 88 est particulièrement recommandé pour toutes les activités créatives \r\nqui demandent de la précision (contours, pixel art, mandala, lettering, cartographie, graphiques, schémas, …) \r\nDisponible en 47 couleurs (dont 8 pastels et 6 fluos), \r\nil est le feutre d’écriture idéal des lycéens et étudiants \r\nqui veulent mettre de la couleur dans leurs fiches de révision. \r\nSTABILO point 88 il permet un tracé de précision et offre une agréable sensation de glisse sur la feuille.', 4, 1, 2),
(3, 'BIC 4 Couleurs Shine', 'View/ProductImg/styloQuatreCouleurs.jpg', '7.50', 'Classique revisité : la version 4 Couleurs Shine habille le traditionnel stylo BIC 4 Couleurs\r\n d\'un revêtement brillant, moderne et métallique. \r\n C\'est en 1970 que l\'entrepreneur français Marcel Bich lance le stylo 4 Couleurs Original, \r\n qui permet de changer de couleur en un clic sans jamais changer de stylo. \r\n Brillante idée. Incontournable à sa sortie, iconique aujourd\'hui, \r\n le stylo 4 Couleurs est utilisé depuis des décennies par les consommateurs BIC à travers le monde. \r\n Des millions de stylos BIC 4 Couleurs vendus, \r\n mais qui ont toujours une place particulière dans l\'histoire de chacun : \r\n stylo préféré de certains, instrument de travail journalier pour d\'autres, \r\n incontournable preneur de notes des écoliers et lycéens ou compagnon des créateurs. \r\n Inconique, le design du stylo BIC 4 couleurs se repère de loin : \r\n corps rond, clip pour l\'accrocher aux cahiers ou aux poches de chemise, \r\n bille percée en embout qui signe le produit. \r\n Il est fabriqué en France dans les usines de l\'entreprise BIC, \r\n grâce à un savoir-faire historique. Un BIC, un vrai.', 3, 1, 3),
(4, 'Waterman Allure stylo plume', 'View/ProductImg/styloPlume.jpg', '23.99', 'Le stylo plume Waterman Allure présente un design élégant et contemporain, \r\nidéal pour les étudiants et les professionnels. \r\nLa plume ciselée robuste et l’encre fluide garantissent une expérience d’écriture homogène et personnalisée. \r\nAvec son design moderne et assuré d’inspiration française, \r\nle stylo Waterman constitue un premier pas important dans le monde de l’écriture raffinée. \r\nReposant sur une conception Waterman classique, \r\nle corps en métal lisse du stylo Allure ainsi que ses attributs classiques \r\nviennent renforcer son design haut de gamme qui ne laisse pas indifférent, \r\naussi bien en classe que dans une salle de réunion.', 21, 1, 4),
(5, 'Nuosen Lot de 3 règles en acier inoxydable', 'View/ProductImg/regleFer.jpg', '12.99', 'Spécifications :\r\nQuantité : 3 pièces.\r\nMatériau : acier inoxydable.\r\nTaille : 15 cm, 30 cm, 40 cm\r\n\r\nCaractéristiques :\r\n1. L’orifice situé à l’extrémité vous permet d’accrocher ces règles en toute simplicité.\r\n2. Fabriquées en acier inoxydable durable, un excellent matériau pour une utilisation sur le long terme \r\n- Règle de bureau avec des marquages gravés de sorte qu\'ils ne s’effacent pas au fil du temps.\r\n3. Règles en acier inoxydable en différentes longueurs très pratiques pour une variété d\'utilisations \r\n- Utilisez-les pour le bureau, l’école, le dessin, l’ingénierie et pour d\'autres tâches.\r\n\r\nContenu :\r\n1 règle de 15 cm en acier inoxydable.\r\n1 règle de 30 cm en acier inoxydable.\r\n1 règle de 40 cm en acier inoxydable.', 5, 2, 5),
(6, '2 Règles Graduées', 'View/ProductImg/reglePlastique.jpg', '23.99', 'Set créatif composés d\'instruments de dessin, de coloriage, \r\nd\'écriture pour faire une pause au travail, seul ou en groupe: \r\nréduire le stress, se relaxer les yeux et stimuler sa créativité. \r\n5 à 10 minutes par jour suffisent pour préserver une capacité mentale optimale.', 17, 2, 6),
(7, 'POPRUN Agenda 2022', 'View/ProductImg/agendaPro.jpg', '16.95', 'Inspiré des théories modernes de la gestion du temps, \r\ncet agenda est spécialement conçu pour vous aider à démanteler des objectifs de grande à petite taille \r\net à rendre des plans exécutables au jour le jour. \r\nPlanifiez votre semaine à l\'avance en fonction d\'objectifs annuels et mensuels préalablement définis, \r\nréfléchissez à vos actions au quotidien et ajustez vos actions en conséquence. \r\nLes journaux Poprun sont et seront toujours votre compagnon fiable \r\nsur la voie d’atteindre vos objectifs les plus ambitieux.', 3, 3, 7),
(8, 'Kokonote - Agenda 2022', 'View/ProductImg/agendaEtudiant.jpg', '24.80', 'Organisez votre quotidien en toute simplicité grâce à cet élégant agenda au design unique. \r\nPensé pour être fonctionnel, pratique et joli à la fois, \r\nil vous permettra de noter toutes vos activités, rendez-vous, \r\ndevoirs ou tâches à réaliser pour que rien ne vous échappe. \r\nQue vous l\'utilisiez au travail ou chez vous, \r\nil vous accompagnera dans votre quotidien tout au long de l\'année, \r\net avec sa jolie couverture rigide, vous pouvez l\'emmener dans votre sac sans risquer de l\'abîmer. \r\nTrouvez l\'agenda qui vous correspond parmi tous nos modèles et choisissez celui qui vous ressemble.', 16, 3, 8),
(9, 'Agenda Scolaire 2021-2022: Pokémon', 'View/ProductImg/agendaEnfant.jpg', '20.99', 'Un superbe agenda pour passer une année avec tes Pokémon préférés !\r\nRetrouve tous les Pokémon de Galar dans cet agenda richement illustré et \r\npasse une année exceptionnelle ! En bonus : \r\ndes scènes de cherche-et-trouve et des infos sur les Pokémon au fil des pages.', 42, 3, 9);

-- --------------------------------------------------------

--
-- Structure de la table `sous_categories`
--

DROP TABLE IF EXISTS `sous_categories`;
CREATE TABLE IF NOT EXISTS `sous_categories` (
  `id_sous_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `id_categorie` int(11) NOT NULL,
  `nom_sous_categorie` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_sous_categorie`),
  KEY `FK_Sous_Categories_id_categorie_Categories` (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `sous_categories`
--

INSERT INTO `sous_categories` (`id_sous_categorie`, `id_categorie`, `nom_sous_categorie`) VALUES
(1, 1, 'bille'),
(2, 1, 'feutre'),
(3, 1, 'quatre couleurs'),
(4, 1, 'plume'),
(5, 2, 'fer'),
(6, 2, 'plastique'),
(7, 3, 'professionel'),
(8, 3, 'etudiant'),
(9, 3, 'enfant');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(255) DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `code_postal` int(5) DEFAULT NULL,
  `id_droit` int(11) NOT NULL,
  PRIMARY KEY (`id_utilisateur`),
  KEY `FK_Utilisateurs_id_droit_droits` (`id_droit`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `email`, `password`, `address`, `code_postal`, `id_droit`) VALUES
(1, 'gianni', 'gianni', 'gianni@gianni.io', '$2y$10$qEt5LLfUYCpvZbG6luaENOK.YD4h.aTeMengR1mqZ5R6hDNmVLkB.', 'rue bien', 13001, 1337),
(2, 'test', 'test', 'test@test.io', '$2y$10$BAUgL.Pngi3cAuvgMJqtuerYd7/d9A4HkdmZZ2D1B8JQi7zcGe3k2', 'rue bien', 13001, 1337),
(3, 'omar', 'omar', 'omar@omar.io', '$2y$10$HIOfLjwFe9Rkad9KGbynh.gsi8sTh7Ph7X9AHt1atj2ImEbbLYdOu', 'rue bien', 13001, 1),
(6, 'bubina', 'bibi', 'bubi@bubi.io', '$2y$10$2UbFAZ29MZAQGavIzeWG0O4t9t1eQhG7r1uj8Xf3CaKicQ4KGn4dW', 'rue bien', 13001, 1),
(8, 'thierry', 'thierry', 'thierry@thierry.io', '$2y$10$5mNOvkmHsNFMs96qVn4qbePp6hAM7wJ89uMQQYfiZYVXwS9Wb317G', 'rue 8', 13001, 1337),
(9, 'mat', 'mat', 'mat@mat.io', '$2y$10$R1GUMwSswasn2g4yi/6Znu1/uAIhL0ueW7Xby6fB8aCNf8WHlGPna', 'rue bien', 13001, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `carousel_produits`
--
ALTER TABLE `carousel_produits`
  ADD CONSTRAINT `FK_carousel_produits_id_produit_produits` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`);

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `FK_Commandes_id_paiement_Paiement` FOREIGN KEY (`id_paiement`) REFERENCES `paiements` (`id_paiement`),
  ADD CONSTRAINT `FK_Commandes_paniers_id_panier_paniers` FOREIGN KEY (`id_panier`) REFERENCES `paniers` (`id_panier`);

--
-- Contraintes pour la table `contient`
--
ALTER TABLE `contient`
  ADD CONSTRAINT `FK_Contient_id_panier_Paniers` FOREIGN KEY (`id_panier`) REFERENCES `paniers` (`id_panier`),
  ADD CONSTRAINT `FK_Contient_id_produit_Produits` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id_produit`);

--
-- Contraintes pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD CONSTRAINT `FK_Paniers_id_utilisateur_Utilisateurs` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id_utilisateur`);

--
-- Contraintes pour la table `produits`
--
ALTER TABLE `produits`
  ADD CONSTRAINT `FK_Produits_id_catergorie_Categories` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `FK_Produits_id_sous_catergorie_Categories` FOREIGN KEY (`id_sous_categorie`) REFERENCES `sous_categories` (`id_sous_categorie`);

--
-- Contraintes pour la table `sous_categories`
--
ALTER TABLE `sous_categories`
  ADD CONSTRAINT `FK_Sous_Categories_id_categorie_Categories` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id_categorie`);

--
-- Contraintes pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD CONSTRAINT `FK_Utilisateurs_id_droit_droits` FOREIGN KEY (`id_droit`) REFERENCES `droits` (`id_droit`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
