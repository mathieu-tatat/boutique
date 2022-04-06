<?php $title = "Connexion" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Search.php'); ?>

<?php require_once('Controller/user_controller.php'); // Models : User  &  Cart ?>

<?php   ob_start();  ?>

<div class="container-fluid mt-3 mb-3">

            <!-- form -->
            <div class="d-flex flex-row align-items-center justify-content-center mb-3">
                <div class="row rounded-2 d-flex align-items-center justify-content-center shadow-sm border border-ligth p-3 w-100">

                    <div class="col-lg">

                        <div class="px-4 mt-2 me-5 subsPic w-50">
                            <img src="View/logos/signup.svg"  class=" mt-5 ms-5">
                        </div>

                    </div>

                    <div class="col-lg">

                        <form action="" method="POST">

                            <div class="py-2 p-2">
                                <label for="email" class="h6 py-1 text-muted px-2 fw-light"><i>Entrer votre email</i></label><br>
                                <input type="text" class="p-1 px-2 rounded-1 w-75" id="inputEmail" placeholder="Email" name="email">
                            </div>

                            <div class="py-2 p-2">
                                <label for="password" class="h6 py-1 text-muted px-2 fw-light"><i>Entrer votre mot de passe</i></label><br>
                                <input type="password" class="p-1 px-2 rounded-1 w-75" id="inputPassword" placeholder="Password" name="password">
                            </div>

                            <div class="py-2 p-2">
                                <button type="submit" class="btn btn-dark rounded-2 mb-4 mt-3 p-2 shadow-sm w-50" name="submit_connection">Se connecter</button>
                            </div>

                            <div class="py-2">
                                <p>Vous n'avez pas de compte? &#160; <a href="inscription.php" class="link-info">S'inscrire</a></p>
                            </div>

                        </form>

                    </div>
                </div>

            </div>

    <!-- image
-->


</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('View/Patron.php'); ?>




