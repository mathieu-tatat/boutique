<?php $title = "Register" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Search.php'); ?>

<?php require_once('Controller/user_controller.php'); // Models : User  &  Cart ?>
<?php require ('Controller/search_bar_controller.php'); // Models : Search ?>



<?php   ob_start();  ?>
<div class="d-flex align-items-center">
    <form class="px-4 p-3 mt-4 border border-ligth w-75" action="inscription.php" id="signUpFrom" method="POST">
        <div class="display-6 px-4 mt-4"><b>Inscription</b></div>
        <div class="row px-4 mt-4">
            <div class="form-group col">
                <input type="text" class="col-form p-2 px-2 rounded-2" style="border:solid 1px darkgray;" placeholder="Prénom" name="prenom">
            </div>
            <div class="form-group col">
                <input type="text" class="col-form p-2 px-2 rounded-2" style="border:solid 1px darkgray;" placeholder="Nom" name="nom">
            </div>
        </div>
        <div class="row px-4 mt-4" >
            <div class="form-group col">
                <input type="text" class="col-form p-2 px-2 rounded-2" style="border:solid 1px darkgray;" placeholder="Email" name="email">
            </div>
            <div class="form-group col">
                <input type="text" class="col-form p-2 px-2 rounded-2" style="border:solid 1px darkgray;" placeholder="Postal Code" name="code_postal">
            </div>
        </div>
        <div class="row px-4 mt-4">
            <div class="form-group row">
                <input type="text" class="col-form p-2 rounded-2" style="border:solid 1px darkgray;width:84.2%!important;" placeholder="Adress" name="address">
            </div>
        </div>
        <div class="row px-4 mt-4" >
            <div class="form-group col">
                <input type="password" class="col-form p-2 px-2 rounded-2" style="border:solid 1px darkgray;" placeholder="Password" name="password">
            </div>
            <div class="form-group col">
                <input type="password" class="col-form p-2 px-2 rounded-2" style="border:solid 1px darkgray;" placeholder="Password Confirmation" name="pass_conf">
            </div>
        </div>
        <div class="d-flex justify-content-center align-items-center" >
            <button type="submit" class="btn btn-dark rounded-0 px-4 mb-4 mt-4 " name="submit_subscription">Subscribe</button>
        </div>
    </form>
    <?php if(isset($tmp)){ echo $tmp;} ?>
</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('header.php'); ?>


<?php require ('patron.php'); ?>







