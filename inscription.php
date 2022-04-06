<?php $title = "Inscription" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Search.php'); ?>

<?php require_once('Controller/user_controller.php'); // Models : User  &  Cart ?>


<?php   ob_start();  ?>

<div class="d-flex flex-row align-items-center justify-content-center">
        <div class="d-flex flex-column justify-content-center align-items-center border border-ligth w-75 rounded-2 shadow-sm mb-3 no-row-media">
            <form action="inscription.php" method="POST">
                    <div class="px-2 p-3 mt-1 mb-2">
                        <h5>Données de facturation</h5>
                    </div>

                    <div class="py-1">
                        <label for="code_postal" class="h6 py-1 text-muted px-2 fw-light "><i>Insérer votre prénom</i></label><br>
                        <input type="text" class="p-1 rounded-1 w-100" placeholder="Prénom" name="prenom">
                    </div>

                    <div class="py-1">
                        <label for="code_postal" class="h6 py-1 text-muted px-2 fw-light "><i>Insérer votre nom</i></label><br>
                        <input type="text" class="p-1 rounded-1 w-100"  placeholder="Nom" name="nom">
                    </div>

                    <div class="py-1">
                        <label for="code_postal" class="h6 py-1 text-muted px-2 fw-light"><i>Insérer votre adresse</i></label><br>
                        <input type="text" class="p-1 rounded-1 w-100"  placeholder="Adresse" name="address">
                    </div>

                    <div class="py-1">
                        <label for="code_postal" class="h6 py-1 text-muted px-2 fw-light"><i>Insérer votre code postal</i></label><br>
                        <input type="text" class=" p-1 rounded-1 w-100"  placeholder="Code Postal" name="code_postal">
                    </div>

                    <div class="px-2 mt-3 mb-1 h5">
                        Contact
                    </div>

                    <div class="py-1">
                        <label for="email" class="h6 py-1 text-muted px-2 fw-light"><i>Insérer votre email</i></label><br>
                        <input type="text" class="p-1 rounded-1 w-100" placeholder="Email" name="email">
                    </div>

                    <div class="py-1">
                        <label for="password" class="h6 py-1 text-muted px-2 fw-light"><i>Insérer un mot de passe d'au moins 8 caractères</i></label><br>
                        <input type="password" class="p-1 rounded-1 w-100"  placeholder="Password" name="password_1">
                    </div>

                    <div class="py-1">
                        <label for="password" class="h6 py-1 text-muted px-2 fw-light"><i>Confirmer votre mot de passe</i></label><br>
                        <input type="password" class="p-1 rounded-1 w-100"  placeholder="Confirmation Password" name="password_2">
                    </div>

                    <div class="py-1">
                        <button type="submit" class="btn btn-dark rounded-2 mb-4 mt-4 p-2 shadow-sm" name="submit_subscription">S'inscrire</button>
                    </div>

                <div class="py-2">
                    <p>Êtes-vous déjà inscrit.e?<a href="connexion.php" class="link-info">&#160; Se connecter </a></p>
                </div>

            </form>
        </div>
</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>







