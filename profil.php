<?php $title = "Profil" ?>
<?php session_start(); ?>
<?php require_once('Model/User.php'); ?>
<?php require_once('Controller/user_controller.php'); ?>
<?php require_once('Controller/profil_controller.php'); ?>


<?php   ob_start();  ?>
    <div class="d-flex flex-column justify-content-center align-items-center">

        <!-- User Setting -->
        <div class="container-xl px-4 my-4 border border-secondary border-1">
                <div class="display-6 px-4 mt-4"><b>Settings </b></div>
                <form class="px-4 mt-4" id="updateUserForm" method="POST">
                    <div class=" px-2">
                        <label for="exampleInputEmail1" class="form-label"><span class="h6">Email address</span></label>
                        <input type="email" class="form-control rounded-0" name="email" id="exampleInputEmail1" 
                        aria-describedby="emailHelp" value="<?= $_SESSION["email"]?>">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class=" px-2">
                        <label for="exampleInputText1" class="form-label"><span class="h6">Prenom</span></label>
                        <input type="text" class="form-control rounded-0" name="prenom" id="exampleInputText1" 
                        aria-describedby="textHelp" value="<?= $_SESSION["prenom"]?>">
                    </div>
                    <div class=" px-2">
                        <label for="exampleInputText1" class="form-label"><span class="h6">Nom</span></label>
                        <input type="text" class="form-control rounded-0" name="nom" id="exampleInputText1" 
                        aria-describedby="textHelp" value="<?= $_SESSION["nom"]?>">
                    </div>
                    <div class=" px-2">
                        <label for="exampleInputText1" class="form-label"><span class="h6">Address</span></label>
                        <input type="text" class="form-control rounded-0" name="address" id="exampleInputText1" 
                        aria-describedby="textHelp" value="<?= $_SESSION["address"]?>">
                    </div>
                    <div class=" px-2">
                        <label for="exampleInputText1" class="form-label"><span class="h6">Code Postal</span></label>
                        <input type="text" class="form-control rounded-0" name="code_postal" id="exampleInputText1" 
                        aria-describedby="textHelp" value="<?= $_SESSION["zipCode"]?>">
                    </div>
                    <div class="mb-5 px-2">
                        <label for="exampleInputPassword1" class="form-label"><span class="h6">Password</span></label>
                        <input type="password" class="form-control rounded-0" name="password" id="exampleInputPassword1">
                    </div>
                    <div id="emailHelp" class="form-text small px-4 mb-2">Update your personal informations</div>
                    <div class="d-flex flex-row">
                        <div class="mb-3 form-check px-4">
                            <button type="submit" class="btn btn-dark px-5 rounded-0" name="submitUserUpdate">update</button>
                        </div>
                        <div class="mb-3 form-check px-4">
                            <button type="submit" class="btn btn-dark px-5 rounded-0" name="deleteUser">Delete your account</button>
                        </div>
                    </div>
                </form>
        </div>

        <!-- Commandes passées -->
        <div class="container-xl px-4 my-4 border border-secondary border-1">
            
            <?php if(isset($_SESSION['connected']) && !empty($orders)): ?>
                <div class="display-6 px-1 mt-4 mb-4">
                    <b>Your Orders </b>
                </div>
                <?php $tmp=''; ?>
                <div class="row shadow-sm p-3 mb-3 bg-body rounded">
                    <div class="col-sm px-2" >Order id</div>
                    <div class="col-sm px-2" >Total Price</div>
                    <div class="col-sm " >Date</div>
                    <div class="col-sm " >Paid with</div>
                    <div class="col-sm " >User details</div>
                    <div class="col-sm px-1" >Email</div>
                    <div class="col-sm px-1" >Details</div>
                </div>

                <?php  for($i=0;$i<=isset($orders[$i]);$i++): ?>
                    <?php   $tmp = '<div class="jumbotron"><div class="row shadow-sm rounded-0">'; ?>
                    
                    <?php   $tmp .= '<div class="col-sm mt-2 text-center" >'.$orders[$i]['id_commande'].'</div>';    ?>
                    <?php   $tmp .= '<div class="col-sm mt-2 px-1 text-center" >'.$orders[$i]['price'].'</div>';    ?>
                    <?php   $tmp .= '<div class="col-sm mt-2 px-1 text-justify" >'.substr($orders[$i]['date_commande'],0,16).'</div>';    ?>
                    <?php   $tmp .= '<div class="col-sm mt-2 text-center" >'.$orders[$i]['nom_paiement'].'</div>';    ?>
                    <?php   $tmp .= '<div class="col-sm mt-2 px-1 text-justify" >'.$user_infos['nom'].' '.$user_infos['prenom'].'</div>';    ?>
                    <?php   $tmp .= '<div class="col-sm mt-2 px-1 text-justify" >'.$user_infos['email'].'</div>';    ?>
                    <?php   $tmp .= '<div class="col-sm mt-2 " >
                                                <form method="POST" action="commandes.php">
                                                    <div class="mb-3 form-check px-4">
                                                        <button type="submit" class="btn btn-dark px-1 rounded-0 " name="detailsCommande" value="'.$orders[$i]['id_commande'].'">details</button></form>
                                                    </div>
                                                </form>'; ?>
                    <?php   $tmp.='</div></div>'; ?>
                <?php endfor; echo $tmp;?>
            <?php else: ?>
                <div class="display-6 px-1 mt-4 mb-4">
                    <p class="text-center h5">you don't have any order yet</p>
                </div>
            <?php endif; ?>
        </div>

    </div>
<?php  $content = ob_get_clean(); ?>


<?php require ('View/patron.php'); ?>




