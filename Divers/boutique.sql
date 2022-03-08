CREATE SCHEMA IF NOT EXISTS `boutique` DEFAULT CHARACTER SET utf8mb4 ;

USE `boutique` ;

-- ------------------------------------
--          table droits             --
-- ------------------------------------

CREATE TABLE IF NOT EXISTS droits (
    id_droit INT AUTO_INCREMENT NOT NULL, 
    nom_droit VARCHAR(255), 
    PRIMARY KEY (id_droit)) ENGINE=InnoDB;


-- ------------------------------------
--        table utilisateurs         --
-- ------------------------------------

CREATE TABLE IF NOT EXISTS Utilisateurs (
    id_utilisateur INT AUTO_INCREMENT NOT NULL, 
    prenom VARCHAR(255), 
    nom VARCHAR(255), 
    email VARCHAR(255), 
    password VARCHAR(255), 
    address VARCHAR(255), 
    code_postal INT(5), 
    id_droit INT NOT NULL,
    PRIMARY KEY (id_utilisateur),
    CONSTRAINT FK_Utilisateurs_id_droit_droits FOREIGN KEY (id_droit) REFERENCES droits (id_droit) 
    ) ENGINE=InnoDB;  

-- ------------------------------------
--           table paiements          --
-- ------------------------------------ 
      
CREATE TABLE IF NOT EXISTS Paiements (
    id_paiement INT AUTO_INCREMENT NOT NULL, 
    nom_paiement VARCHAR(255), 
    PRIMARY KEY (id_paiement)) ENGINE=InnoDB;     
    
-- ------------------------------------
--           table paniers           --
-- ------------------------------------ 
    
CREATE TABLE IF NOT EXISTS Paniers (
    id_panier INT AUTO_INCREMENT NOT NULL, 
    id_utilisateur INT NOT NULL, 
    PRIMARY KEY (id_panier),
    CONSTRAINT FK_Paniers_id_utilisateur_Utilisateurs 
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs (id_utilisateur)
    ) ENGINE=InnoDB;  


-- ------------------------------------
--           table commandes         --
-- ------------------------------------ 
      
CREATE TABLE IF NOT EXISTS Commandes (
    id_commande INT AUTO_INCREMENT NOT NULL, 
    date_commande DATETIME, 
    id_panier INT NOT NULL, 
    id_paiement INT NOT NULL,
    CONSTRAINT FK_Commandes_paniers_id_panier_paniers 
    FOREIGN KEY (id_panier) REFERENCES Paniers (id_panier), 
    CONSTRAINT FK_Commandes_id_paiement_Paiement 
    FOREIGN KEY (id_paiement) REFERENCES Paiements (id_paiement),  
    PRIMARY KEY (id_commande)) ENGINE=InnoDB; 



-- ------------------------------------
--           table categories        --
-- ------------------------------------ 
     
CREATE TABLE IF NOT EXISTS Categories (
    id_categorie INT AUTO_INCREMENT NOT NULL, 
    nom_categorie VARCHAR(255), 
    PRIMARY KEY (id_categorie)) ENGINE=InnoDB;  


-- ------------------------------------
--      table sous categories        --
-- ------------------------------------ 
     
CREATE TABLE IF NOT EXISTS Sous_Categories (
    id_sous_categorie INT AUTO_INCREMENT NOT NULL,
    id_categorie INT NOT NULL, 
    nom_sous_categorie VARCHAR(255),
    CONSTRAINT FK_Sous_Categories_id_categorie_Categories
    FOREIGN KEY (id_categorie) REFERENCES Categories (id_categorie),
    PRIMARY KEY (id_sous_categorie)) ENGINE=InnoDB;


-- ------------------------------------
--           table produits          --
-- ------------------------------------ 
     
CREATE TABLE IF NOT EXISTS Produits (
    id_produit INT AUTO_INCREMENT NOT NULL, 
    nom_produit VARCHAR(255), 
    img_url VARCHAR(255), 
    unit_price DECIMAL (10,2), 
    description_produit TEXT, 
    units_in_stock INT,
    id_categorie INT NOT NULL,
    id_sous_categorie INT NOT NULL,
    CONSTRAINT FK_Produits_id_catergorie_Categories 
    FOREIGN KEY (id_categorie) REFERENCES Categories (id_categorie),
    CONSTRAINT FK_Produits_id_sous_catergorie_Categories 
    FOREIGN KEY (id_sous_categorie) REFERENCES Sous_Categories (id_sous_categorie),
    PRIMARY KEY (id_produit)) ENGINE=InnoDB;  

  

-- ------------------------------------
--           table contient          --
-- ------------------------------------ 
      
CREATE TABLE IF NOT EXISTS Contient (
    id_produit INT NOT NULL, 
    id_panier INT NOT NULL, 
    quantité INT(3),
    CONSTRAINT FK_Contient_id_produit_Produits 
    FOREIGN KEY (id_produit) REFERENCES Produits (id_produit),
    CONSTRAINT FK_Contient_id_panier_Paniers 
    FOREIGN KEY (id_panier) REFERENCES Paniers (id_panier),
    PRIMARY KEY (id_produit, id_panier)
    ) ENGINE=InnoDB;


-- ------------------------------------
--           table contient          --
-- ------------------------------------

CREATE TABLE IF NOT EXISTS carousel_produits(
    id_produit_carousel INT NOT NULL,
    id_produit INT NOT NULL,
    CONSTRAINT FK_carousel_produits_id_produit_produits
    FOREIGN KEY (id_produit) REFERENCES Produits (id_produit),
    PRIMARY KEY (id_produit_carousel)
    ) ENGINE=InnoDB;

-- ------------------------------------
--         Data generation           --
-- ------------------------------------

-- -------- CATEGORIES ----------------
INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES (NULL, 'stylo');
INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES (NULL, 'regle');
INSERT INTO `categories` (`id_categorie`, `nom_categorie`) VALUES (NULL, 'agenda');



-- -------- SUBCATEGORIES -------------
INSERT INTO `Sous_Categories` (`id_sous_categorie`, `id_categorie`, `nom_sous_categorie`) VALUES (NULL, 1, 'bille');
INSERT INTO `Sous_Categories` (`id_sous_categorie`, `id_categorie`, `nom_sous_categorie`) VALUES (NULL, 1, 'feutre');
INSERT INTO `Sous_Categories` (`id_sous_categorie`, `id_categorie`, `nom_sous_categorie`) VALUES (NULL, 1, 'quatre couleurs');
INSERT INTO `Sous_Categories` (`id_sous_categorie`, `id_categorie`, `nom_sous_categorie`) VALUES (NULL, 1, 'plume');
INSERT INTO `Sous_Categories` (`id_sous_categorie`, `id_categorie`, `nom_sous_categorie`) VALUES (NULL, 2, 'fer');
INSERT INTO `Sous_Categories` (`id_sous_categorie`, `id_categorie`, `nom_sous_categorie`) VALUES (NULL, 2, 'plastique');
INSERT INTO `Sous_Categories` (`id_sous_categorie`, `id_categorie`, `nom_sous_categorie`) VALUES (NULL, 3, 'professionel');
INSERT INTO `Sous_Categories` (`id_sous_categorie`, `id_categorie`, `nom_sous_categorie`) VALUES (NULL, 3, 'etudiant');
INSERT INTO `Sous_Categories` (`id_sous_categorie`, `id_categorie`, `nom_sous_categorie`) VALUES (NULL, 3, 'enfant');


-- -------- PRODUITS -------------
INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, '10pcs stylos à bille roulante', 'View/ProductImg/styloBilleRoulante.jpg', 10.99,
"Spécifications:
10 x stylos à bille roulante
Taille (environ): 13,5 cm / 5,3 pouces de longueur
Couleur d'encre: noir, vert, rose, bleu clair, bleu, rouge, violet, orange, vert clair, marron.
Type: roller ball

Caractéristiques:
Séchage rapide pour ne pas salir vos mains et votre papier.
Régulateur de sortie d'encre de précision intégré et écriture fluide.
Aucune fuite d'encre.
Approvisionnement en encre visible, facile à voir la quantité d'encre restante.
Pointe extra fine (0,5 mm), adaptée pour une écriture précise.",
14, 1, 1);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'Stylo feutre pointe fine', 'View/ProductImg/styloFeutre.jpg', 6.99,
"Pochette de 8 stylos-feutre dont 4 stylos effaçables + 2 effaçeurs. 
STABILO point 88, le stylo-feutre à pointe fine (tracé 0,4mm), pour écrire, tracer, dessiner.... 
Créé en 1977, sa célébrité ne doit rien au hasard : un corps hexagonal orange à rayures blanches ! 
Un tracé fin et précis ! Une longévité exceptionnelle avec plus de 1 000 m d’écriture ! 
Le stylo feutre point 88 est particulièrement recommandé pour toutes les activités créatives 
qui demandent de la précision (contours, pixel art, mandala, lettering, cartographie, graphiques, schémas, …) 
Disponible en 47 couleurs (dont 8 pastels et 6 fluos), 
il est le feutre d’écriture idéal des lycéens et étudiants 
qui veulent mettre de la couleur dans leurs fiches de révision. 
STABILO point 88 il permet un tracé de précision et offre une agréable sensation de glisse sur la feuille.",
8, 1, 2);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'BIC 4 Couleurs Shine', 'View/ProductImg/styloQuatreCouleurs.jpg', 7.50,
"Classique revisité : la version 4 Couleurs Shine habille le traditionnel stylo BIC 4 Couleurs
 d'un revêtement brillant, moderne et métallique. 
 C'est en 1970 que l'entrepreneur français Marcel Bich lance le stylo 4 Couleurs Original, 
 qui permet de changer de couleur en un clic sans jamais changer de stylo. 
 Brillante idée. Incontournable à sa sortie, iconique aujourd'hui, 
 le stylo 4 Couleurs est utilisé depuis des décennies par les consommateurs BIC à travers le monde. 
 Des millions de stylos BIC 4 Couleurs vendus, 
 mais qui ont toujours une place particulière dans l'histoire de chacun : 
 stylo préféré de certains, instrument de travail journalier pour d'autres, 
 incontournable preneur de notes des écoliers et lycéens ou compagnon des créateurs. 
 Inconique, le design du stylo BIC 4 couleurs se repère de loin : 
 corps rond, clip pour l'accrocher aux cahiers ou aux poches de chemise, 
 bille percée en embout qui signe le produit. 
 Il est fabriqué en France dans les usines de l'entreprise BIC, 
 grâce à un savoir-faire historique. Un BIC, un vrai.",
5, 1, 3);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'Waterman Allure stylo plume', 'View/ProductImg/styloPlume.jpg', 23.99,
"Le stylo plume Waterman Allure présente un design élégant et contemporain, 
idéal pour les étudiants et les professionnels. 
La plume ciselée robuste et l’encre fluide garantissent une expérience d’écriture homogène et personnalisée. 
Avec son design moderne et assuré d’inspiration française, 
le stylo Waterman constitue un premier pas important dans le monde de l’écriture raffinée. 
Reposant sur une conception Waterman classique, 
le corps en métal lisse du stylo Allure ainsi que ses attributs classiques 
viennent renforcer son design haut de gamme qui ne laisse pas indifférent, 
aussi bien en classe que dans une salle de réunion.",
21, 1, 4);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'Nuosen Lot de 3 règles en acier inoxydable', 'View/ProductImg/regleFer.jpg', 12.99,
"Spécifications :
Quantité : 3 pièces.
Matériau : acier inoxydable.
Taille : 15 cm, 30 cm, 40 cm

Caractéristiques :
1. L’orifice situé à l’extrémité vous permet d’accrocher ces règles en toute simplicité.
2. Fabriquées en acier inoxydable durable, un excellent matériau pour une utilisation sur le long terme 
- Règle de bureau avec des marquages gravés de sorte qu'ils ne s’effacent pas au fil du temps.
3. Règles en acier inoxydable en différentes longueurs très pratiques pour une variété d'utilisations 
- Utilisez-les pour le bureau, l’école, le dessin, l’ingénierie et pour d'autres tâches.

Contenu :
1 règle de 15 cm en acier inoxydable.
1 règle de 30 cm en acier inoxydable.
1 règle de 40 cm en acier inoxydable.",
15, 2, 5);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, '2 Règles Graduées', 'View/ProductImg/reglePlastique.jpg', 23.99,
"Set créatif composés d'instruments de dessin, de coloriage, 
d'écriture pour faire une pause au travail, seul ou en groupe: 
réduire le stress, se relaxer les yeux et stimuler sa créativité. 
5 à 10 minutes par jour suffisent pour préserver une capacité mentale optimale.",
17, 2, 6);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'POPRUN Agenda 2022', 'View/ProductImg/agendaPro.jpg', 16.95,
"Inspiré des théories modernes de la gestion du temps, 
cet agenda est spécialement conçu pour vous aider à démanteler des objectifs de grande à petite taille 
et à rendre des plans exécutables au jour le jour. 
Planifiez votre semaine à l'avance en fonction d'objectifs annuels et mensuels préalablement définis, 
réfléchissez à vos actions au quotidien et ajustez vos actions en conséquence. 
Les journaux Poprun sont et seront toujours votre compagnon fiable 
sur la voie d’atteindre vos objectifs les plus ambitieux.",
4, 3, 7);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'Kokonote - Agenda 2022', 'View/ProductImg/agendaEtudiant.jpg', 24.80,
"Organisez votre quotidien en toute simplicité grâce à cet élégant agenda au design unique. 
Pensé pour être fonctionnel, pratique et joli à la fois, 
il vous permettra de noter toutes vos activités, rendez-vous, 
devoirs ou tâches à réaliser pour que rien ne vous échappe. 
Que vous l'utilisiez au travail ou chez vous, 
il vous accompagnera dans votre quotidien tout au long de l'année, 
et avec sa jolie couverture rigide, vous pouvez l'emmener dans votre sac sans risquer de l'abîmer. 
Trouvez l'agenda qui vous correspond parmi tous nos modèles et choisissez celui qui vous ressemble.",
31, 3, 8);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'Agenda Scolaire 2021-2022: Pokémon', 'View/ProductImg/agendaEnfant.jpg', 20.99,
"Un superbe agenda pour passer une année avec tes Pokémon préférés !
Retrouve tous les Pokémon de Galar dans cet agenda richement illustré et 
passe une année exceptionnelle ! En bonus : 
des scènes de cherche-et-trouve et des infos sur les Pokémon au fil des pages.",
42, 3, 9);


-- -------- DroitS --------------------
INSERT INTO `droits` (`id_droit`, `nom_droit`) VALUES(1, 'utilisateur');
INSERT INTO `droits` (`id_droit`, `nom_droit`) VALUES(1337, 'admin');


-- ------------------------------------------------------------------------ --
-- ------------------------------------------------------------------------ --
-- ------------------------------------------------------------------------ --
-- ------------------------------------------------------------------------ --
--         CREER 3 UTILISATEURS AVANT D INSERER LES DONNEES EN DESSOUS      --  
-- ------------------------------------------------------------------------ --
-- ------------------------------------------------------------------------ --
-- ------------------------------------------------------------------------ --
-- ------------------------------------------------------------------------ --




-- -------- PAIEMENTS ---------------------
INSERT INTO `paiements` (`id_paiement`,`nom_paiement`) VALUE (NULL , 'CB');
INSERT INTO `paiements` (`id_paiement`,`nom_paiement`) VALUE (NULL , 'Stripe');



-- -------- PANIERS -----------------------
INSERT INTO `paniers` (`id_panier`,`id_utilisateur`) VALUE (NULL, 1);
INSERT INTO `paniers` (`id_panier`,`id_utilisateur`) VALUE (NULL, 2);
INSERT INTO `paniers` (`id_panier`,`id_utilisateur`) VALUE (NULL, 3);



-- -------- COMMANDES ---------------------
INSERT INTO `commandes` (`id_commande`,`date_commande`,`id_panier`,`id_paiement`)
VALUE (NULL, '2022-02-04 17:00:00', 3, 1);
INSERT INTO `commandes` (`id_commande`,`date_commande`,`id_panier`,`id_paiement`)
VALUE (NULL, '2012-02-04 17:00:00', 4, 1);
INSERT INTO `commandes` (`id_commande`,`date_commande`,`id_panier`,`id_paiement`)
VALUE (NULL, '2002-02-04 17:00:00', 5, 1);


-- --------- CONTIENT ---------------------
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantité`) VALUES (1, 3, 3);
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantité`) VALUES (2, 3, 7);
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantité`) VALUES (4, 4, 5);
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantité`) VALUES (5, 5, 7);
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantité`) VALUES (6, 5, 3);
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantité`) VALUES (8, 5, 7);