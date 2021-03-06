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
    quantit?? INT(3),
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
VALUES (NULL, '10pcs stylos ?? bille roulante', 'View/ProductImg/styloBilleRoulante.jpg', 10.99,
"Sp??cifications:
10 x stylos ?? bille roulante
Taille (environ): 13,5 cm / 5,3 pouces de longueur
Couleur d'encre: noir, vert, rose, bleu clair, bleu, rouge, violet, orange, vert clair, marron.
Type: roller ball

Caract??ristiques:
S??chage rapide pour ne pas salir vos mains et votre papier.
R??gulateur de sortie d'encre de pr??cision int??gr?? et ??criture fluide.
Aucune fuite d'encre.
Approvisionnement en encre visible, facile ?? voir la quantit?? d'encre restante.
Pointe extra fine (0,5 mm), adapt??e pour une ??criture pr??cise.",
14, 1, 1);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'Stylo feutre pointe fine', 'View/ProductImg/styloFeutre.jpg', 6.99,
"Pochette de 8 stylos-feutre dont 4 stylos effa??ables + 2 effa??eurs. 
STABILO point 88, le stylo-feutre ?? pointe fine (trac?? 0,4mm), pour ??crire, tracer, dessiner.... 
Cr???? en 1977, sa c??l??brit?? ne doit rien au hasard : un corps hexagonal orange ?? rayures blanches ! 
Un trac?? fin et pr??cis ! Une long??vit?? exceptionnelle avec plus de 1 000 m d?????criture ! 
Le stylo feutre point 88 est particuli??rement recommand?? pour toutes les activit??s cr??atives 
qui demandent de la pr??cision (contours, pixel art, mandala, lettering, cartographie, graphiques, sch??mas, ???) 
Disponible en 47 couleurs (dont 8 pastels et 6 fluos), 
il est le feutre d?????criture id??al des lyc??ens et ??tudiants 
qui veulent mettre de la couleur dans leurs fiches de r??vision. 
STABILO point 88 il permet un trac?? de pr??cision et offre une agr??able sensation de glisse sur la feuille.",
8, 1, 2);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'BIC 4 Couleurs Shine', 'View/ProductImg/styloQuatreCouleurs.jpg', 7.50,
"Classique revisit?? : la version 4 Couleurs Shine habille le traditionnel stylo BIC 4 Couleurs
 d'un rev??tement brillant, moderne et m??tallique. 
 C'est en 1970 que l'entrepreneur fran??ais Marcel Bich lance le stylo 4 Couleurs Original, 
 qui permet de changer de couleur en un clic sans jamais changer de stylo. 
 Brillante id??e. Incontournable ?? sa sortie, iconique aujourd'hui, 
 le stylo 4 Couleurs est utilis?? depuis des d??cennies par les consommateurs BIC ?? travers le monde. 
 Des millions de stylos BIC 4 Couleurs vendus, 
 mais qui ont toujours une place particuli??re dans l'histoire de chacun : 
 stylo pr??f??r?? de certains, instrument de travail journalier pour d'autres, 
 incontournable preneur de notes des ??coliers et lyc??ens ou compagnon des cr??ateurs. 
 Inconique, le design du stylo BIC 4 couleurs se rep??re de loin : 
 corps rond, clip pour l'accrocher aux cahiers ou aux poches de chemise, 
 bille perc??e en embout qui signe le produit. 
 Il est fabriqu?? en France dans les usines de l'entreprise BIC, 
 gr??ce ?? un savoir-faire historique. Un BIC, un vrai.",
5, 1, 3);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'Waterman Allure stylo plume', 'View/ProductImg/styloPlume.jpg', 23.99,
"Le stylo plume Waterman Allure pr??sente un design ??l??gant et contemporain, 
id??al pour les ??tudiants et les professionnels. 
La plume cisel??e robuste et l???encre fluide garantissent une exp??rience d?????criture homog??ne et personnalis??e. 
Avec son design moderne et assur?? d???inspiration fran??aise, 
le stylo Waterman constitue un premier pas important dans le monde de l?????criture raffin??e. 
Reposant sur une conception Waterman classique, 
le corps en m??tal lisse du stylo Allure ainsi que ses attributs classiques 
viennent renforcer son design haut de gamme qui ne laisse pas indiff??rent, 
aussi bien en classe que dans une salle de r??union.",
21, 1, 4);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'Nuosen Lot de 3 r??gles en acier inoxydable', 'View/ProductImg/regleFer.jpg', 12.99,
"Sp??cifications :
Quantit?? : 3 pi??ces.
Mat??riau : acier inoxydable.
Taille : 15 cm, 30 cm, 40 cm

Caract??ristiques :
1. L???orifice situ?? ?? l???extr??mit?? vous permet d???accrocher ces r??gles en toute simplicit??.
2. Fabriqu??es en acier inoxydable durable, un excellent mat??riau pour une utilisation sur le long terme 
- R??gle de bureau avec des marquages grav??s de sorte qu'ils ne s???effacent pas au fil du temps.
3. R??gles en acier inoxydable en diff??rentes longueurs tr??s pratiques pour une vari??t?? d'utilisations 
- Utilisez-les pour le bureau, l?????cole, le dessin, l???ing??nierie et pour d'autres t??ches.

Contenu :
1 r??gle de 15 cm en acier inoxydable.
1 r??gle de 30 cm en acier inoxydable.
1 r??gle de 40 cm en acier inoxydable.",
15, 2, 5);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, '2 R??gles Gradu??es', 'View/ProductImg/reglePlastique.jpg', 23.99,
"Set cr??atif compos??s d'instruments de dessin, de coloriage, 
d'??criture pour faire une pause au travail, seul ou en groupe: 
r??duire le stress, se relaxer les yeux et stimuler sa cr??ativit??. 
5 ?? 10 minutes par jour suffisent pour pr??server une capacit?? mentale optimale.",
17, 2, 6);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'POPRUN Agenda 2022', 'View/ProductImg/agendaPro.jpg', 16.95,
"Inspir?? des th??ories modernes de la gestion du temps, 
cet agenda est sp??cialement con??u pour vous aider ?? d??manteler des objectifs de grande ?? petite taille 
et ?? rendre des plans ex??cutables au jour le jour. 
Planifiez votre semaine ?? l'avance en fonction d'objectifs annuels et mensuels pr??alablement d??finis, 
r??fl??chissez ?? vos actions au quotidien et ajustez vos actions en cons??quence. 
Les journaux Poprun sont et seront toujours votre compagnon fiable 
sur la voie d???atteindre vos objectifs les plus ambitieux.",
4, 3, 7);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'Kokonote - Agenda 2022', 'View/ProductImg/agendaEtudiant.jpg', 24.80,
"Organisez votre quotidien en toute simplicit?? gr??ce ?? cet ??l??gant agenda au design unique. 
Pens?? pour ??tre fonctionnel, pratique et joli ?? la fois, 
il vous permettra de noter toutes vos activit??s, rendez-vous, 
devoirs ou t??ches ?? r??aliser pour que rien ne vous ??chappe. 
Que vous l'utilisiez au travail ou chez vous, 
il vous accompagnera dans votre quotidien tout au long de l'ann??e, 
et avec sa jolie couverture rigide, vous pouvez l'emmener dans votre sac sans risquer de l'ab??mer. 
Trouvez l'agenda qui vous correspond parmi tous nos mod??les et choisissez celui qui vous ressemble.",
31, 3, 8);

INSERT INTO `produits` 
(`id_produit`, `nom_produit`, `img_url`, `unit_price`, 
`description_produit`, `units_in_stock`, `id_categorie`, `id_sous_categorie`) 
VALUES (NULL, 'Agenda Scolaire 2021-2022: Pok??mon', 'View/ProductImg/agendaEnfant.jpg', 20.99,
"Un superbe agenda pour passer une ann??e avec tes Pok??mon pr??f??r??s !
Retrouve tous les Pok??mon de Galar dans cet agenda richement illustr?? et 
passe une ann??e exceptionnelle ! En bonus : 
des sc??nes de cherche-et-trouve et des infos sur les Pok??mon au fil des pages.",
42, 3, 9);


-- -------- DroitS --------------------
INSERT INTO `droits` (`id_droit`, `nom_droit`) VALUES(1, 'utilisateur');
INSERT INTO `droits` (`id_droit`, `nom_droit`) VALUES(1337, 'admin');

-- -------- Carousel ------------------
INSERT INTO `carousel_produits` (`id_produit_carousel`, `id_produit`) VALUES(2, 3),(3, 4),(1, 5),(4, 9);



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
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantit??`) VALUES (1, 3, 3);
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantit??`) VALUES (2, 3, 7);
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantit??`) VALUES (4, 4, 5);
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantit??`) VALUES (5, 5, 7);
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantit??`) VALUES (6, 5, 3);
INSERT INTO `contient` (`id_produit`, `id_panier`, `quantit??`) VALUES (8, 5, 7);