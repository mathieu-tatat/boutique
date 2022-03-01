<?php $title = 'Admin Space' ?>
<?php session_start(); ?>

<?php
    //bdd
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'boutique';
    $pdo = new PDO("mysql:host=$servername;dbname=$db", $username, $password,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

    //controller sur l'update de produit
    if(isset($_POST['update_prod']))
    {
        
        $sql5 = "UPDATE produits 
                SET nom_produit = ?,
                unit_price = ?, units_in_stock = ?,
                description_produit = ?,
                id_categorie = ?, id_sous_categorie = ?                    
                WHERE `id_produit` = ?";

        $params = array($_POST["nom_produit"],
                        $_POST["unit_price"], $_POST["units_in_stock"], 
                        $_POST["description_produit"],
                        $_POST["id_categorie"], $_POST["id_sous_categorie"],
                        $_POST["id_produit"]);

        $updateQuery = $pdo->prepare($sql5);
        $updateQuery->execute($params);

        $_POST['gestion_produit'] = "";
    }

    //user
    $sql="SELECT * FROM utilisateurs ORDER BY `id_droit` DESC";    
    $query = $pdo->query($sql); 
    $queryRows = $query->fetchAll(PDO::FETCH_ASSOC);

    //product
    $sql2="SELECT produits.*, categories.nom_categorie, sous_categories.nom_sous_categorie
    FROM produits
    INNER JOIN categories       ON produits.id_categorie = categories.id_categorie
    INNER JOIN sous_categories    ON produits.id_sous_categorie = sous_categories.id_sous_categorie";
    $query2 = $pdo->query($sql2);
    $queryrows2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    
    //order
    $sqlOrder ="SELECT commandes.id_commande, commandes.date_commande,
    paiements.nom_paiement,
    SUM(produits.unit_price*contient.quantité) AS total_price,
    utilisateurs.prenom, utilisateurs.nom, utilisateurs.email
    FROM commandes
    INNER JOIN paiements        ON commandes.id_paiement = paiements.id_paiement
    INNER JOIN paniers          ON commandes.id_panier = paniers.id_panier
    INNER JOIN contient         ON paniers.id_panier = contient.id_panier
    INNER JOIN produits         ON contient.id_produit = produits.id_produit
    INNER JOIN categories       ON produits.id_categorie = categories.id_categorie
    INNER JOIN sous_categories  ON produits.id_sous_categorie = sous_categories.id_sous_categorie
    INNER JOIN utilisateurs     ON paniers.id_utilisateur = utilisateurs.id_utilisateur
    GROUP BY commandes.id_commande;";
    $queryOrder =  $pdo->query($sqlOrder);
    $queryOrderRows = $queryOrder->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- affichage user -->
<?php   if(isset($_POST["gestion_user"])) : $soustitre = "Gestion utilisateur"; ob_start(); ?>
        <table class="table table-hover w-90 my-1">
            <thead class="my-1">
                <tr>
                    <th>id</th>
                    <th>prenom</th>
                    <th>nom</th>
                    <th>email</th>
                    <th>address</th>
                    <th>code postal</th>
                    <th>droits</th>
                </tr>
            </thead>

            <tbody class="my-1">
            <?php   foreach ($queryRows as $row) :?>
                <tr>
                    <td><?= $row['id_utilisateur']?></td>
                    <td><?= $row['prenom']?></td>
                    <td><?= $row['nom']?></td>
                    <td><?= $row['email']?></td>
                    <td><?= $row['address']?></td>
                    <td><?= $row['code_postal']?></td>
                    <td>
                        <form method="POST" >
                            <select name="id_droit" class="rounded-pill">
                            <?php if ($row['id_droit'] == 1337) : ?>
                                <option value="1337" selected>Admin</option>
                                <option value="1">Utilisateur</option>
                            <?php else : ?>
                                <option value="1337">Admin</option>
                                <option value="1" selected>Utilisateur</option>
                            <?php endif; ?>
                            </select>
                            <input type="submit" name="chg_right" value="modifier" class="btn btn-dark rounded-pill px-1">
                        </form>        
                    </td>
                </tr>
            <?php   endforeach; ?>
            </tbody>
        </table>
<?php   $souscontenu = ob_get_clean(); ?>


<!-- affichage produit -->
<?php   elseif (isset($_POST["gestion_produit"])) : $soustitre = "gestion produit"; ob_start(); ?>
            <?php /* foreach($queryrows2 as $rows) : ?>
                <div class="container-fluid my-3 ">               
                    <div class="row">
                        <div class="col-md-4 d-flex flex-row justify-content-center align-items-center">
                            <div class="w-50">
                            <img src="<?= $rows["img_url"] ?>" class="m-2 img-thumbnail">
                            </div>
                        </div>
                        <div class="col-md-8 d-flex flex-row justify-content-center">
                            <form method="POST" class="d-flex flex-column justify-content-center align-items-center w-100 my-2">
                               
                                <!-- POST ID PRODUIT -->
                                <input name="id_produit" type="hidden" value="<?= $rows['id_produit']?>">

                                <!-- POST NOM PRODUIT -->
                                <div class="form-group col-md-10 my-2">
                                    <label for="nom_produit_grp"> Nom produit : </label>
                                    <input type="text" name="nom_produit" class="form-control" 
                                    id="nom_produit_grp" value="<?= $rows["nom_produit"] ?>">
                                </div>

                                <div class="row d-flex flex-row justify-content-between my-2">
                                    <!-- POST UNITS IN STOCK -->
                                    <div class="form-group col-md-5">
                                        <label for="units_in_stock_grp"> Unité en stock : </label>
                                        <input type="text" name="units_in_stock" class="form-control"
                                        id="units_in_stock_grp"value='<?= $rows["units_in_stock"] ?>'>
                                    </div>
                                    <!-- POST UNIT PRICE -->
                                    <div class="form-group col-md-5">
                                        <label for="unit_price_grp"> Prix Unitaire : </label>
                                        <input type="text" name="unit_price" class="form-control" 
                                        id="unit_price_grp" value='<?= $rows["unit_price"]  ?>'>
                                    </div>
                                </div>

                                <!-- POST DESCRIPTION PRODUIT -->
                                <div class="form-group my-2 col-md-10">
                                    <label for="description_product_grp"> Description produit : </label>
                                    <textarea name="description_produit" name="description_produit" class="form-control"
                                    id="description_product_grp" rows="5"><?= $rows["description_produit"] ?></textarea>
                                </div>

                                
                                <div class="row my-2 w-100">
                                    <!-- POST NOM CATEGORIE -->
                                    <div class="form-group col-md-6 d-flex flex-row justify-content-center">
                                        <label for="categorie_grp" class="me-1"> Catégorie : </label>
                                        <select name="id_categorie" id="categorie_grp">
                                            <?php 
                                                $sql3 = "SELECT * FROM categories";
                                                $catQuery = $pdo->query($sql3)->fetchAll(PDO::FETCH_ASSOC);
                                                foreach($catQuery as $cat) : ?>
                                                    <?php if($cat['id_categorie'] == $rows['id_categorie']) :?>
                                                        <option value="<?= $cat['id_categorie'] ?>" SELECTED>
                                                            <?= $cat['nom_categorie']?>
                                                        </option>
                                                    <?php else : ?>
                                                        <option value="<?= $cat['id_categorie'] ?>">
                                                            <?= $cat['nom_categorie']?>
                                                        </option>
                                                    <?php endif; ?>
                                            <?php endforeach;?>        
                                        </select>
                                    </div>
                                    <!-- POST NOM SOUS CATEGORIE -->
                                    <div class="form-group col-md-6 d-flex flex-row justify-content-center">
                                        <label for="units_in_stock_grp" class="me-1"> Sous-catégorie : </label>
                                        <select name="id_sous_categorie" id="nom_sous_categorie">
                                            <?php 
                                                $sql4 = "SELECT * FROM sous_categories";
                                                $subcatQuery = $pdo->query($sql4)->fetchAll(PDO::FETCH_ASSOC);
                                                foreach($subcatQuery as $subcat) : ?>
                                                    <?php if($subcat['id_sous_categorie'] == $rows['id_sous_categorie']) :?>
                                                        <option value="<?= $subcat['id_sous_categorie'] ?>" SELECTED>
                                                            <?= $subcat['nom_sous_categorie']?>
                                                        </option>
                                                    <?php else : ?>
                                                        <option value="<?= $subcat['id_sous_categorie'] ?>">
                                                            <?= $subcat['nom_sous_categorie']?>
                                                        </option>
                                                    <?php endif; ?>
                                            <?php endforeach;?> 
                                        </select>
                                    </div>
                                </div>
                                
                                <input type="submit" name="update_prod" value="modifier">
                            </form>
                        </div>
                    </div>
                </div> 
            <?php endforeach; */ ?>
            <table class="table table-hover w-90 my-1">
                <thead class="my-1">
                    <tr class="text-center align-middle">
                        <th>Photo produit</th>
                        <th>id produit</th>
                        <th>nom de produit</th>                        
                        <th>categorie</th>
                        <th>sous categorie</th>  
                        <th>prix unitaire</th>
                        <th>unités en stock</th>
                        <th></th>                     
                    </tr>
                </thead>

                <tbody class="my-1">
                <?php foreach($queryrows2 as $rows) : ?>
                    <tr class="text-center align-middle">
                        <td><div style="nowrap !important" class="d-flex flex-row justify-content-center"><img src='<?= $rows["img_url"]?>' style="max-width: 50px"></div></td>
                        <td><?= $rows["id_produit"] ?></td>
                        <td><?= $rows["nom_produit"] ?></td>
                        <td><?= $rows["nom_categorie"] ?></td>
                        <td><?= $rows["nom_sous_categorie"] ?></td>
                        <td><?= $rows["unit_price"] ?></td>
                        <td><?= $rows["units_in_stock"] ?></td>
                        <td>
                            <form method="POST">
                                <input name="id_produit" type="hidden" value="<?= $rows['id_produit']?>">
                                <input type="submit" name="update_prod" value="modifier">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
<?php   $souscontenu = ob_get_clean(); ?>


<!-- affichage commande -->
<?php   elseif (isset($_POST["gestion_commande"])) : $soustitre = "gestion commande"; ob_start(); ?>
            <table class="table table-hover w-90 my-1">
                <thead class="my-1">
                    <tr>
                        <th>Id</th>
                        <th>Date commande</th>
                        <th>Payé en</th>                        
                        <th>Payé par</th>
                        <th>E-mail</th>
                        <th>Prix total</th>
                    </tr>
                </thead>
                <tbody class="my-1">
                <?php   foreach( $queryOrderRows as $row) :?>
                                     
                        <tr>
                            <td><?= $row['id_commande']?></td>
                            <td><?= $row['date_commande']?></td>
                            <td><?= $row['nom_paiement']?></td>                            
                            <td><?= $row['nom']?> <?= $row['prenom']?></td>
                            <td><?= $row['email']?></td>
                            <td><?= $row['total_price']?></td>
                        </tr>                    
                <?php   endforeach; ?>
                </tbody>
            </table>
<?php   $souscontenu = ob_get_clean(); ?>


<!-- affichage accueil admin -->
<?php   else : $soustitre = "Bienvenu sur la page admin"; ob_start(); ?>
        <pre><?= (isset($_POST)) ? var_dump($_POST) : "PAS DE POST"; ?></pre>
        <h4 class="text-center">Veuillez choisir</h4>
<?php   $souscontenu = ob_get_clean(); ?>
    
<?php   endif; ?>

<?php ob_start(); ?>
    <main class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-flex flex-column align-items-center justify-content-start mt-5 pageContent">
                <form method="POST" class="w-25 my-3">
                    <button type="submit" name="gestion_user" class="btn btn-default">
                        <img src="Elements/Media/users.svg">
                    </button>
                </form>
                <form method="POST" class="w-25 my-3">
                    <button type="submit" name="gestion_produit" class="btn btn-default">
                        <img src="Elements/Media/products.svg">
                    </button>
                </form>
                <form method="POST" class="w-25 my-3">
                    <button type="submit" name="gestion_commande" class="btn btn-default">
                        <img src="Elements/Media/orders.svg">
                    </button>
                </form>
                
            </nav>
            <section class="col-md-9 mx-1 pageContent d-flex flex-column align-items-start">
                <h2 class="text-center my-2"><?= $soustitre ?></h2>
                <?= $souscontenu ?>
            </section>
        </div>
    </main>
<?php $content = ob_get_clean();?>

<?php require ('Elements/patron.php'); ?>