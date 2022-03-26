<?php $title = 'Admin Space' ?>
<?php session_start(); ?>

<?php require_once('Controller/admin_controller.php'); ?>

<?php ob_start(); ?>
        <h2 class="text-center my-4"><?= $soustitre ?></h2>
        <?= $souscontenu ?>
    <main class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-flex flex-column align-items-center justify-content-start mt-5 pageContent">
                <form method="POST" class="w-25 my-3">
                    <button type="submit" name="gestion_user" class="adminOption btn btn-default">
                        <img src="View/Media/users.png">
                    </button>
                </form>
                <form method="POST" class="w-25 my-3">
                    <button type="submit" name="gestion_produit" class="adminOption btn btn-default btnAdmin">
                        <img src="View/Media/products.png">
                    </button>
                </form>
                <form method="POST" class="w-25 my-3">
                    <button type="submit" name="gestion_commande" class="adminOption btn btn-default btnAdmin">
                        <img src="View/Media/orders.png">
                    </button>
                </form>
                
            </nav>

        </div>
    </main>
<?php $content = ob_get_clean();?>

<?php require ('View/patron.php'); ?>
