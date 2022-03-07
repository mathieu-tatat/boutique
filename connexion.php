<?php $title = "Log In" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Search.php'); ?>

<?php require_once('Controller/user_controller.php'); // Models : User  &  Cart ?>
<?php require ('Controller/search_bar_controller.php'); // Models : Search ?>

<?php   ob_start();  ?>
    <div class="d-flex flex-row justify-content-center align-items-center">
        <div class="px-4 mt-2 me-5" style="width:30%">
            <img src="Elements/logos/login.svg" class="mt-5 ms-5">
        </div>
        <div class="container-md me-5 mt-4 mb-5 rounded-2 shadow-sm border border-ligth p-3 w-50">
            <div class="display-6 px-4 mt-4 mb-3"><b>Connection</b></div>
            <form class="d-flex flex-column" action="" id="signUpFrom" method="POST">
                    <div class="form-group px-4 mt-4" >
                            <input type="text" class="form-control p-1 px-2 rounded-1" style="border:solid 1px darkgray;" id="exampleInputText1" placeholder="Email" name="email">
                    </div>
                    <div class="form-group px-4 mt-4">
                        <input type="password" class="form-control p-1 px-2 rounded-1" style="border:solid 1px darkgray;" id="exampleInputPassword1" placeholder="Password" name="password">
                    </div>
                    <div class="form-group px-4 mt-4">
                        <button type="submit" class="btn btn-dark rounded-2 mb-4 mt-4 p-2 shadow-sm" name="submit_connection">Se connecter</button>
                    </div>
                <?php if(isset($tmp)){ echo $tmp;} ?>
            </form>
        </div>
    </div>


<?php  $content=ob_get_clean(); ?>

<?php require ('header.php'); ?>


<?php require ('View/Patron.php'); ?>




