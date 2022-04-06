<?php $soustitre = "Gestion produit";
require_once('Model/Produit.php');
require_once('Model/Categorie.php');
include_once ('Model/Carousel.php');
$product = new Produits();
$carousel = new Carousel();
$queryrows = $product->getAllProductWithCatAndSubCat();


ob_start(); ?>
<main class="container-fluid" style="width: 80%;">
    
    <section>
        <h4 class="m-3 text-center">Ajouter un produit</h4>
        <a class="btn btn-dark rounded-0 px-4" href="shop.php?addProduit" style="display: flex;margin: auto;width: fit-content; ">Rajouter un produit</a>   
        <form action="" method="POST" class="d-flex justify-content-center my-1" style="flex-wrap: wrap;">
            <input type="submit" name="createCategorie" 
            value="Créer une catégorie" class="btn btn-dark rounded-0 px-4">
            <input type="text" name="nomCategorie">        
        </form>
        <form action="" method="POST" class="d-flex justify-content-center my-1"style="flex-wrap: wrap;">
            <input type="submit" name="createSousCategorie" 
            value="Nouvelle catégorie" class="btn btn-dark rounded-0 px-4">
            <select name="id_categorie" id="categorie_grp">
                <?php 
                    $categories = new Categorie();
                    $catQuery = $categories->getAllCategories();
                    foreach($catQuery as $cat) : ?>
                        <option value="<?= $cat['id_categorie'] ?>">
                            <?= $cat['nom_categorie']?>
                        </option>
                <?php endforeach;?>        
            </select>
            <input type="text" name="nomSousCategorie">
        </form>
    </section>
    
    

    <h4 class="my-5 text-center">Objets mis en valeur sur la page d'accueil</h4>

    <?php for($i=1; $i<5; $i++) : ?>
        <?php $tempProduit = $carousel->getProduitIdById($i); ?>
        <form method="POST" class="my-1" style="display: flex;justify-content: center; margin-bottom:   20px !important; flex-wrap:wrap;">
            <select name="idProduit" id="idProduit">
            <?php foreach($queryrows as $produit) : ?>
                <?php if ($produit["id_produit"] == $tempProduit["id_produit"]) :?>
                    <option value="<?= $produit["id_produit"] ?>" SELECTED><?= $produit["nom_produit"] ?></option>
                <?php else :  ?>
                    <option value="<?= $produit["id_produit"] ?>"><?= $produit["nom_produit"] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
            </select>
            <input type="submit" name="objet<?= $i ?>" value="modifier" class="btn btn-dark rounded-0 px-4">
        </form>
    <?php endfor; ?>
    <h3 style="margin-bottom: 10px;">Modifications d'articles</h3>
    <?php
        foreach($queryrows as $rows) : ?>
       
    <div class="tabInfo">
        <h6 style="display:flex; justify-content:center;"><?= $rows["nom_produit"] ?>:</h6>
        <div class="artDet"> 
               
            <section>
            <div class="d-flex flex-row justify-content-center"><img src='<?= $rows["img_url"]?>' style="max-width: 50px"></div>
            </section>
            <section>
                <h6>id aricle:</h6>
                <p><?= $rows["id_produit"] ?></p>
            </section>
            <section>
                <h6>catégorie:</h6>
                <p><?= $rows["nom_categorie"] ?></p>
            </section>

            <section>
                <h6>Sous-catégorie:</h6>
                <p><?= $rows["nom_sous_categorie"] ?></p>
            </section>

            <section>
                <h6>Prix unitaire:</h6>
                    <p><?= $rows["unit_price"] ?></p>   
            </section>

            <section>
                <h6>En stock:</h6>
                <p><?= $rows["units_in_stock"] ?></p>     
            </section>
            <section>
            <a class="alert-link" style="display: flex;justify-content: center; background-color: black; padding: 4px; color: white;"href="shop.php?article_id=<?=$rows['id_produit']?>">Modifier</a>
            </section>
         </div>   
            <?php endforeach; ?>
    </div>
</main>
<?php   $souscontenu = ob_get_clean(); ?>
