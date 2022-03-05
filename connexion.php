<?php $title = "Log In" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Search.php'); ?>

<?php require_once('Controller/user_controller.php'); // Models : User  &  Cart ?>
<?php require ('Controller/search_bar_controller.php'); // Models : Search ?>

<?php   ob_start();  ?>
    <div class="d-flex flex-column align-items-center">
        <div class="display-6 px-4 mt-4"><b>Log In </b></div>
        <div class="container-sm px-4 mt-4 mb-5 border border-secondary">
            <form class="d-flex flex-column" action="" id="signUpFrom" method="POST">
                    <div class="form-group px-4 mt-4" >
                            <label for="exampleInputText1">Email </label>
                            <input type="text" class="form-control rounded-0" id="exampleInputText1" placeholder="Email" name="email">
                    </div>
                    <div class="form-group px-4 mt-4">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Password" name="password">
                    </div>
                    <div class="form-group px-4 mt-4">
                        <button type="submit" class="btn btn-dark rounded-0 px-4 mt-4 mb-4" name="submit_connection">Log In</button>
                    </div>
            </form>
        </div>
<?php if(isset($tmp)){ echo $tmp;} ?>
    </div>

<?php  $content=ob_get_clean(); ?>

<?php require ('header.php'); ?>


<?php require ('View/Patron.php'); ?>




