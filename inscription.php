<?php $title = "Register" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Model/Cart.php'); ?>
<?php require_once('Model/Search.php'); ?>

<?php require_once('Controller/user_controller.php'); // Models : User  &  Cart ?>


<?php   ob_start();  ?>
    <div class="d-flex flex-row justify-content-center align-items-center my-3">
        
        <div class="rounded-2 shadow-sm border border-light " style="width:80%" >

            <form action="inscription.php"  method="POST">
              <div style="width:20%; transform: rotateY(180deg);">
                <img src="View/logos/login.svg" >
              </div>
                <!-- Prenom nom -->
                <div class="row">
                    <div class="form-group col">
                        <label for="prenom">Prénom</label>
                        <input type="text" class="form-control rounded-0" id="prenom" name="prenom">
                    </div>
                    <div class="form-group col">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control rounded-0" id="nom" name="nom">
                    </div>
                </div>

                <!-- Email -->
                <div class="row" >
                    <div class="form-group col">
                        <label for="email">Email</label>
                        <input type="text" class="form-control rounded-0" id="email" name="email">
                    </div>                    
                </div>

                <!-- Password -->
                <div class="row" >
                    <div class="form-group col">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control rounded-0" id="exampleInputPassword1" name="password_1">
                    </div>
                    <div class="form-group col">
                        <label for="exampleInputPassword2">Confirmation</label>
                        <input type="password" class="form-control rounded-0" id="exampleInputPassword2" name="password_2">
                    </div>
                </div>

                <!-- Address postal code -->
                <div class="row d-flex" >
                    <div class="form-group">
                        <label for="address">Adress</label>
                        <input type="text" class="form-control rounded-0" id="address" name="address">
                    </div>
                    <div class="form-group col">
                        <label for="code_postal">Postal Code</label>
                        <input type="text" class="form-control rounded-0" id="code_postal" name="code_postal">
                    </div>
                </div>


                <p class="text-muted text-center">Nous ne partagerons jamais vos information personnelles</p>

                <!-- Submit -->
                <div class="d-flex justify-content-center align-items-center" >                
                    <button type="submit" class="btn btn-dark rounded-2 mb-4 mt-4 p-2 shadow-sm" name="submit_subscription">S'inscrire</button>
                </div>

            </form>

        </div>



    </div>
<?php  $content=ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>







