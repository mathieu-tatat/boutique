<?php require_once ('Model/Categorie.php'); ?>
<?php ob_start(); ?>

<div class="container">             
    <div class="row"> 
        <div class="d-flex flex-column col-md-12 my-5">
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group my-1">
                    <label for="img"> Rajouter une image : </label>
                    <input type="file" class="form-control-file" name="img" id="img">
                </div>
                <div class="form-group my-1">
                    <label for="nameGrp"> Nom de produit : </label>
                    <input type="text" name="nom_produit" class="form-control" id="nameGrp">
                </div>
                <div class="row my-1">
                    <div class="form-group col-md-6">
                        <label for="priceGrp"> Prix : </label>
                        <input type="text" name="unit_price" class="form-control" id="priceGrp">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="unitsGrp"> Unité en Stock : </label>
                        <input type="text" name="units_in_stock" class="form-control" id="unitsGrp">
                    </div>
                </div>
                <div class="form-group my-1">
                    <label for="descriptionGrp"> Description : </label>
                    <textarea name="description" rows="10" class="form-control" id="descriptionGrp"></textarea>
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
                                    <option value="<?= $cat['id_categorie'] ?>">
                                        <?= $cat['nom_categorie']?>
                                    </option>
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
                                    <option value="<?= $subcat['id_sous_categorie'] ?>">
                                        <?= $subcat['nom_sous_categorie']?>
                                    </option>
                            <?php endforeach;?> 
                        </select>
                    </div>
                    <div class="my-2 d-flex flex-row justify-content-center">
                        <input type="submit" name="create_prod" value="créer">
                    </div>
                    
                </div>                        
            </form>
        </div>
    </div>              
</div>
<?php  $souscontenu = ob_get_clean(); ?>