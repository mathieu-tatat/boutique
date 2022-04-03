<?php $title = 'Admin Space' ?>
<?php session_start(); ?>

<?php require_once('Controller/admin_controller.php'); ?>

<?php ob_start(); ?>

<div class="d-flex flex-column justify-content-center align-items-center my-3">
    <h2 class="text-center my-3"><?= $soustitre ?></h2> 
            
    <nav class="d-flex flex-row justify-content-center m-1">

        <form method="POST" class="my-3 d-flex justify-content-center">
            <button type="submit" name="gestion_user" class="adminOption btn btn-default">
                <img src="View/Media/users.png">           
            </button>
        </form>

        <form method="POST" class="my-3 d-flex justify-content-center">
            <button type="submit" name="gestion_produit" class="adminOption btn btn-default">
                <img src="View/Media/products.png">
            </button>
        </form>
        
        <form method="POST" class="my-3 d-flex justify-content-center">
            <button type="submit" name="gestion_commande" class="adminOption btn btn-default">
                <img src="View/Media/orders.png">
            </button>
        </form>
        
    </nav>

    <?= $souscontenu ?>
<div> 

<?php $content = ob_get_clean();?>

<?php require ('View/patron.php'); ?>
