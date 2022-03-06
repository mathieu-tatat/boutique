<?php $title = "Register" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Search.php'); ?>

<?php require_once('Controller/user_controller.php'); // Models : User  &  Cart ?>
<?php require ('Controller/search_bar_controller.php'); // Models : Search ?>



<?php   ob_start();  ?>
<div class="container-fluid">
    <div class="d-flex flex-row justify-content-center align-items-center p-4 ms-3">
        <form class="p-2 border border-ligth rounded-2 shadow-sm mb-3" action="inscription.php"  method="POST">
            <div class=" px-4 mt-4 mb-3"><h1>Inscription</h1></div>
            <div class="row px-4 mt-2 mb-3">
                <div class=" px-2 mt-1 mb-2"><h5>Données de facturation</h5></div>
                <div class="form-group col">
                    <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="Prénom" name="prenom">
                </div>
                <div class="form-group col">
                    <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="Nom" name="nom">
                </div>
            </div>
            <div class="row px-4 mt-2 mb-3">
                <div class="form-group col">
                    <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="Adresse" name="address">
                </div>
                <div class="form-group col">
                    <input type="text" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="Code Postal" name="code_postal">
                </div>
            </div>
            <hr/>
            <div class="row px-4 mt-3" >
                <div class=" px-2 mt-1 mb-3"><h5>Contact</h5></div>
                <div class="form-group row">
                    <input type="text" class="col-form p-1 px-2 rounded-1" style="border:solid 1px darkgray;width:87.5%;" placeholder="Email" name="email">
                </div>
            </div>
            <div class="row px-4 mt-2" >
                <div class="form-group col">
                    <input type="password" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="Password" name="password">
                </div>
                <div class="form-group col">
                    <input type="password" class="col-form p-1 rounded-1" style="border:solid 1px darkgray;" placeholder="Confirmation Password" name="pass_conf">
                </div>
            </div>
            <div class="d-flex justify-content-center align-items-center" >
                <small class="text-muted me-5">Nous ne partagerons jamais vos information personnelles</small>

                <button type="submit" class="btn btn-dark rounded-2 mb-4 mt-4 p-2 shadow-sm" name="submit_subscription">S'inscrire</button>
            </div>
            <?php if(isset($tmp)){ echo $tmp;} ?>

        </form>
        <div class="px-4 mt-2 me-5">
            <img src="Elements/logos/signup.svg" style="width:70%;" class="mt-5 ms-5">
        </div>
</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('header.php'); ?>


<?php require ('patron.php'); ?>







