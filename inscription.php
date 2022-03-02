<?php $title = "Register" ?>
<?php session_start(); ?>
<?php require_once('Controller/user_controller.php'); ?>
<?php require ('Controller/search_bar_controller.php'); ?>



<?php   ob_start();  ?>
<div class="d-flex flex-column align-items-center">
    <div class="container-sm px-4 mt-4 mb-5 ">
        <div class="display-6 px-4 mt-4"><b>Subscribe </b></div>
        <form class="container px-4 mt-4 border border-secondary" action="inscription.php" id="signUpFrom" method="POST">
            <div class="row px-4 mt-4">
                <div class="form-group col">
                    <label for="exampleInputText1">Prénom</label>
                    <input type="text" class="form-control rounded-0" id="exampleInputText1" placeholder="Prénom" name="prenom">
                </div>
                <div class="form-group col">
                    <label for="exampleInputText1">Nom</label>
                    <input type="text" class="form-control rounded-0" id="exampleInputText1" placeholder="Nom" name="nom">
                </div>
            </div>
            <div class="row px-4 mt-4" >
                    <div class="form-group col">
                        <label for="exampleInputText1">Email</label>
                        <input type="text" class="form-control rounded-0" id="exampleInputText1" placeholder="Email" name="email">
                    </div>
                    <div class="form-group col">
                        <label for="exampleInputText1">Postal Code</label>
                        <input type="text" class="form-control rounded-0" id="exampleInputText1" placeholder="Postal Code" name="code_postal">
                    </div>
            </div>
            <div class="form-group px-4 mt-4">
                <label for="exampleInputText1">Adress</label>
                <input type="text" class="form-control rounded-0" id="exampleInputText1" placeholder="Adress" name="address">
            </div>
            <div class="d-flex flex-row justify-content-center align-items-center" >
                <div class="form-group col px-4 mt-4">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control rounded-0" id="exampleInputPassword1" placeholder="Password" name="password_1">
                </div>
                <div class="form-group col px-4 mt-4">
                    <label for="exampleInputPassword2">Password Confirmation</label>
                    <input type="password" class="form-control rounded-0" id="exampleInputPassword2" placeholder="Password Confirmation" name="password_2">
                </div>
            </div>
            <div class="d-flex flex-row justify-content-center align-items-center" >
                <button type="submit" class="btn btn-dark rounded-0 px-4 mb-4 mt-4 " name="submit_subscription">Subscribe</button>
            </div>
        </form>
        <?php if(isset($tmp)){ echo $tmp;} ?>
    </div>
</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>







