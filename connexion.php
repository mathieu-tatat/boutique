<?php $title = "Log In" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Search.php'); ?>

<?php require_once('Controller/user_controller.php'); // Models : User  &  Cart ?>

<?php   ob_start();  ?>

<div class="container-fluid mt-3">

            <!-- form -->
            <div class="d-flex flex-column align-items-center">
                <div class="rounded-2 shadow-sm border border-ligth p-3 w-50">

                    <form action="" method="POST">

                        <div class="py-2 p-2">
                            <label for="email" class="h6 py-1 text-muted px-2 fw-light"><i>Insert your email</i></label>
                            <input type="text" class="form-control p-1 px-2 rounded-1" style="border:solid 1px darkgray;" id="exampleInputText1" placeholder="Email" name="email">
                        </div>

                        <div class="py-2 p-2">
                            <label for="password" class="h6 py-1 text-muted px-2 fw-light"><i>Insert your password</i></label>
                            <input type="password" class="form-control p-1 px-2 rounded-1" style="border:solid 1px darkgray;" id="exampleInputPassword1" placeholder="Password" name="password">
                        </div>

                        <div class="py-2 p-2">
                            <button type="submit" class="btn btn-dark rounded-2 mb-4 mt-3 p-2 shadow-sm" name="submit_connection">Se connecter</button>
                        </div>

                        <div class="py-2">
                            <p>Vous avez pas de compte? <a href="inscription.php" class=""> Inscrivez vous </a></p>
                        </div>

                    </form>
                </div>
            </div>
    <!-- image
-->


</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('View/Patron.php'); ?>




