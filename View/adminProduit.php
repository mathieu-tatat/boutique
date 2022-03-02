<?php $soustitre = "gestion produit";
require_once('Model/Produit.php');
$produit = new Produits(); 
ob_start(); ?>

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
                <a class="alert-link" href="article.php?id=<?=$rows['id_produit']?>">Modifier</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php   $souscontenu = ob_get_clean(); ?>