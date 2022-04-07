<?php require_once ('Model/Categorie.php'); ?>
<?php require_once('Model/Produit.php') ?>
<?php ob_start(); ?>
<div class="container">               
    <div class="row">  
        <div  class="col-md-3">
            <img class="image" src="<?= $produit->getImgById($_GET['article_id'])?>">
        </div>
            
        <div class="d-flex flex-column col-md-9 my-5">
            <form action="#" method="POST" class="my-2" enctype="multipart/form-data">
                    <input type="hidden" value="<?= $_GET['article_id'] ?>" name ="id_produit" >
                    <?php $tempProduct = new Produits();
                    $tempInfosProduct = $tempProduct->getProduitsFromId($_GET['article_id']);                    
                    ?>
                    <input type="hidden" name="nom_produit" value="<?= $tempInfosProduct["nom_produit"]?>">
                    <div class="form-group my-1">
                        <label for="img" class="alert-link text-danger"> Changer l'image : </label><br>
                        <input type="file" class="form-control-file" name="img" id="img">
                        <input type="submit" name="chg_img" value="Changer l'image">
                    </div>                
            </form>
            <form action="#" method="POST">
            <input type="hidden" value="<?= $_GET['article_id'] ?>" name="id_produit" >
                <div class="form-group my-1">
                    <label for="nameGrp"> Nom de produit : </label>
                    <input type="text" name="nom_produit" class="form-control" id="nameGrp" value="<?= $produit->getNomById($_GET['article_id']) ?>">
                </div>
                <div class="row my-1">
                    <div class="form-group col-md-6">
                        <label for="priceGrp"> Prix : </label>
                        <input type="text" name="unit_price" class="form-control" id="priceGrp" value="<?= $produit->getUnitPriceById($_GET['article_id']) ?>">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="unitsGrp"> Unité en Stock : </label>
                        <input type="text" name="units_in_stock" class="form-control" id="unitsGrp" value="<?= $produit->getUnitsInStockById($_GET['article_id']) ?>">
                    </div>
                </div>
                <div class="form-group my-1">
                    <label for="descriptionGrp"> Description : </label>
                    <textarea name="description" rows="10" class="form-control" id="descriptionGrp"><?= $produit->getDescriptionById($_GET['article_id']) ?></textarea>
                </div>
                <div class="row my-2 w-100">
                    <!-- POST NOM CATEGORIE -->
                    <div class="form-group col-md-6 d-flex flex-row justify-content-center">
                        <label for="categorie_grp" class="me-1"> Catégorie : </label>
                        <select name="id_categorie" id="categorie_grp">
                            <?php 
                                $categories = new Categorie();
                                $catQuery = $categories->getAllCategories();
                                foreach($catQuery as $cat) : ?>
                                    <?php if($cat['id_categorie'] == $produit->getCategorieById($_GET['article_id'])) :?>
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
                                $souscategories = new SousCategorie();
                                $subcatQuery = $souscategories->getAllSubCat();
                                foreach($subcatQuery as $subcat) : ?>
                                    <?php if($subcat['id_sous_categorie'] == $produit->getSousCategorieById($_GET['article_id'])) :?>
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
                    <div class="my-2 d-flex flex-row justify-content-center">
                        <input type="submit" name="update_prod" value="modifier">
                    </div>
                    
                </div>                        
            </form>
        </div>
    </div>              
</div>
<?php  $souscontenu = ob_get_clean(); ?>