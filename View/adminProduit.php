<?php $soustitre = "gestion produit";
require_once('Model/Produit.php');
require_once('Model/Categorie.php');
$produit = new Produits(); 
ob_start(); ?>

    <a class="btn btn-dark rounded-0 px-4" href="shop.php?addProduit" >Ajouter un produit</a>
    <form action="" method="POST" class="d-flex justify-content-center my-1">
        <input type="submit" name="createCategorie" 
        value="Créer une catégorie" class="btn btn-dark rounded-0 px-4">
        <input type="text" name="nomCategorie">        
    </form>
    <form action="" method="POST" class="d-flex justify-content-center my-1">
        <input type="submit" name="createSousCategorie" 
        value="Créer une sous-catégorie" class="btn btn-dark rounded-0 px-4">
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
    <?php 
        $queryrows2 = $produit->getAllProductWithCatAndSubCat();
        foreach($queryrows2 as $rows) : ?>
        <tr class="text-center align-middle">
            <td><div style="nowrap !important" class="d-flex flex-row justify-content-center"><img src='<?= $rows["img_url"]?>' style="max-width: 50px"></div></td>
            <td><?= $rows["id_produit"] ?></td>
            <td><?= $rows["nom_produit"] ?></td>
            <td><?= $rows["nom_categorie"] ?></td>
            <td><?= $rows["nom_sous_categorie"] ?></td>
            <td><?= $rows["unit_price"] ?></td>
            <td><?= $rows["units_in_stock"] ?></td>
            <td>
                <a class="alert-link" href="shop.php?article_id=<?=$rows['id_produit']?>">Modifier</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php   $souscontenu = ob_get_clean(); ?>