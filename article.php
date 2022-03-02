<?php $title = "Détail article" ?>
<?php 
    session_start();
    require_once 'Model/Article.php';
    require_once 'Model/Categorie.php';
    require_once 'Model/SousCategorie.php';
    $detail = new Article();
    $article = $detail->get_article_details($_GET['id']);
    
?> 
<?php ob_start() ?>
<main>
    <div class= "content">
        <div class="card shadow-sm navCat">

            <!-- nav bar categorie  -->
            <h3>Categories</h3></br>
            <h4 class="pad">Stylo</h4>
                <ul class="pad">bille</ul>
                <ul class="pad">feutre</ul>
                <ul class="pad">4 couleurs</ul>
                <ul class="pad">plume</ul>
            <h4 class="pad">Regle</h4>
                <ul class="pad">fer</ul>
                <ul class="pad">plastique</ul>
            <h4 class="pad">Agenda</h4>
                <ul class="pad">professionnel</ul>
                <ul class="pad">etudiant</ul>
                <ul class="pad">enfant</ul>
        </div>

        <div>            
            <!-- genere le detail des produits en fonction de leurs id   -->
            <div class="container">                
                <div class="row">  
                    <div  class="col-md-3">
                        <img src="<?= $article[0]['img_url']?>">
                    </div>
                        
                    <div class="d-flex flex-column col-md-9 my-5">
                        <?php if(isset($_SESSION["droits"]) && $_SESSION["droits"] == 1337) : ?>
                            <form action="#" method="POST">
                                <div class="form-group my-1">
                                    <label for="nameGrp"> Nom de produit : </label>
                                    <input type="text" name="nom_produit" class="form-control" id="nameGrp" value="<?= $article[0]['nom_produit'] ?>">
                                </div>
                                <div class="row my-1">
                                    <div class="form-group col-md-6">
                                        <label for="nameGrp"> Prix : </label>
                                        <input type="text" name="nom_produit" class="form-control" id="nameGrp" value="<?= $article[0]['unit_price'] ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="unitsGrp"> Unité en Stock : </label>
                                        <input type="text" name="units_in_stock" class="form-control" id="unitsGrp" value="<?= $article[0]['units_in_stock'] ?>">
                                    </div>
                                </div>
                                <div class="form-group my-1">
                                    <label for="descriptionGrp"> Description : </label>
                                    <textarea name="description" rows="10" class="form-control" id="descriptionGrp"><?= $article[0]['description_produit'] ?></textarea>
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
                                                    <?php if($cat['id_categorie'] == $article[0]["id_categorie"]) :?>
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
                                                    <?php if($subcat['id_sous_categorie'] == $article[0]["id_sous_categorie"]) :?>
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
                        <?php else : ?>
                            <h4><?= $article[0]['nom_produit']?></h4>
                            <div>       
                                <small><?= $article[0]['units_in_stock']." en stock"?></small>
                                <small><?= $article[0]['unit_price'] ." €"?></small>   
                            </div>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-secondary"><img src="View/logos/cart.svg"></button>
                            </div>
                            
                            <p class="p-5 my-2"><?= $article[0]['description_produit'] ?></p>
                        <?php endif; ?> 
                    </div>
                </div>              
            </div>
                       
        </div> 
    </div>

</main>
<?php  $content=ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>
    