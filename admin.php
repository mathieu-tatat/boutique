<?php $title = 'Admin Space' ?>
<?php session_start(); ?>

<?php require_once('Controller/admin_controller.php'); ?>

<?php ob_start(); ?>
    <main class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-flex flex-column align-items-center justify-content-start mt-5 pageContent">
                <form method="POST" class="w-25 my-3">
                    <button type="submit" name="gestion_user" class="btn btn-default">
                        <img src="View/Media/users.svg">
                    </button>
                </form>
                <form method="POST" class="w-25 my-3">
                    <button type="submit" name="gestion_produit" class="btn btn-default">
                        <img src="View/Media/products.svg">
                    </button>
                </form>
                <form method="POST" class="w-25 my-3">
                    <button type="submit" name="gestion_commande" class="btn btn-default">
                        <img src="View/Media/orders.svg">
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

<?php require ('View/patron.php'); ?>