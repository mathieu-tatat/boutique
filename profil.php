<?php $title = "profil" ?>
<?php session_start(); ?>
<?php require_once('model.php'); ?>
<?php require_once('user_controller.php'); ?>
<?php require_once('profil_controller.php'); ?>
<?php require_once ('search_bar_controller.php'); ?>
<?php require_once ('quantity.php'); ?>



<?php   ob_start();  ?>
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="container-xl px-4 mt-4">
                <div class=" border border-secondary border-1 px-4 mt-4 mb-2">
                    <div class="display-6 px-4 mt-4"><b>Settings </b></div>
                    <form class="px-4 mt-4" id="updateUserForm" method="POST">
                        <div class=" px-2">
                            <label for="exampleInputEmail1" class="form-label"><span class="h6">Email address</span></label>
                            <input type="email" class="form-control rounded-0" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="<?php echo $user_infos['email']; ?>">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class=" px-2">
                            <label for="exampleInputText1" class="form-label"><span class="h6">Prenom</span></label>
                            <input type="text" class="form-control rounded-0" name="prenom" id="exampleInputText1" aria-describedby="textHelp" placeholder="<?php echo $user_infos['prenom']; ?>">
                        </div>
                        <div class=" px-2">
                            <label for="exampleInputText1" class="form-label"><span class="h6">Nom</span></label>
                            <input type="text" class="form-control rounded-0" name="nom" id="exampleInputText1" aria-describedby="textHelp" placeholder="<?php echo $user_infos['nom']; ?>">
                        </div>
                        <div class=" px-2">
                            <label for="exampleInputText1" class="form-label"><span class="h6">Address</span></label>
                            <input type="text" class="form-control rounded-0" name="address" id="exampleInputText1" aria-describedby="textHelp" placeholder="<?php echo $user_infos['address']; ?>">
                        </div>
                        <div class=" px-2">
                            <label for="exampleInputText1" class="form-label"><span class="h6">Code Postal</span></label>
                            <input type="text" class="form-control rounded-0" name="code_postal" id="exampleInputText1" aria-describedby="textHelp" placeholder="<?php echo $user_infos['code_postal']; ?>">
                        </div>
                        <div class="mb-5 px-2">
                            <label for="exampleInputPassword1" class="form-label"><span class="h6">Password</span></label>
                            <input type="password" class="form-control rounded-0" name="password" id="exampleInputPassword1">
                        </div>
                        <div id="emailHelp" class="form-text small px-4 mb-2">Update your personal informations</div>
                        <div class="d-flex flex-row">
                            <div class="mb-3 form-check px-4">
                                <button type="submit" class="btn btn-dark px-5 rounded-0" name="submitUserUpdate"> Update </button>
                            </div>
                            <div class="mb-3 form-check px-4">
                                <button type="submit" class="btn btn-dark px-5 rounded-0" name="deleteUser">Delete your account</button>
                            </div>
                        </div>
                        <?php if(isset($tmp)){ echo $tmp;} ?>
                    </form>
                </div>
            </div>
            <div class="container-xl px-4 mt-4 mb-4">
                        <div class="p-3 mb-5 rounded-0 border border-secondary border-1 px-4 mt-4">
                            <div class="shadow-sm mb-1">
                                <div class="display-6 px-4 mt-4 mb-4">
                                    <b>Your Cart </b>
                                </div>
                                <?php if(isset($_SESSION['connected']) and isset($products_infos) and isset($quantity) and isset($id_cart) ): ?>
                                <?php $tmp=''; ?>
                                <div class="row shadow-sm align-items-center p-3 mb-3 bg-body rounded-0">
                                            <!--<div class="col-md-2 mt-3 px-2" >Image</div>-->
                                    <div class="col-md px-2" >Prod Img</div>
                                    <div class="col-md " >Quantity</div>
                                    <div class="col-md " >Unit Price</div>
                                    <div class="col-md " >Product Name</div>
                                    <div class="col-md-3 px-2" >Description</div>
                                    <div class="col-md px-2" >Edit</div>

                                </div>
                                    <?php for($i=0;$i<=isset($products_infos[$i]);$i++): ?>
                                        <?php   $tmp .= '<div class="jumbotron"><div class="d-flex flex-row align-items-center shadow-sm rounded-0">'; ?>
                                        <?php   $tmp .= '<div class="col-md-2 mt-3 px-2 h-25" ><img src="'.$products_infos[$i]['img_url'].'" class="prodPics"></div>';    ?>

                                        <?php   $tmp .= '<div class="col-md mt-1 text-justify" ><form method="POST" >';    ?>
                                        <?php   $tmp .= '<div class="row">'; ?>
                                        <?php   $tmp .= '<select class="form-select form-select-sm px-3" aria-label=".form-select-sm example" name="quantity">'; ?>
                                                         <?php $tmp .= '<option selected>'.$quantity[$i].'</option>'; ?>
                                                        <?php   for($j=1;$j<=$products_infos[$i]['units_in_stock'];$j++): //if units in stock = to false units in stock equal to 0    ?>
                                                        <?php $tmp .= '<option value="'.$j.','.$products_infos[$i]['id_produit'].','.$id_cart['id_panier'].'">'.$j.' </option>';   ?>
                                                        <?php endfor;  ?>
                                        <?php   $tmp .=  '</select><input class="btn btn-dark rounded-0 small" type="submit" name="submitContientUpdate" value="update️️"/>';
                                                $tmp .= '</div></form></div>';
                                        ?>

                                        <?php   $tmp .= '<div class="col-md mt-1 px-5 text-justify" >'.$products_infos[$i]['unit_price'].'</div>';    ?>
                                        <?php   $tmp .= '<div class="col-md-2 mt-1 px-2 text-justify small" >'.$products_infos[$i]['nom_produit'].'</div>';    ?>
                                        <?php   $tmp .= '<div class="col-md-3 mt-1 px-2 text-justify small" >'.substr($products_infos[$i]['description_produit'],0,120).'...</div>';    ?>
                                        <?php   $tmp .= '<div class="col-md mt-1 px-5" >
                                                             <form method="POST">
                                                                  <div class="mb-3 form-check px-4 mb-2">
                                                                      <button type="submit" class="btn btn-dark rounded-0" name="submitProductDelete">delete</button></form>
                                                                  </div>
                                                             </form>'; ?>
                                        <?php $tmp.='</div></div>'; ?>
                                        <?php endfor; echo $tmp;?>
                                <?php else: ?>
                                    <div class="row">
                                        <div class="h-3 border border-secondary rounded-0 px-4 mb-2 mt-2 ml-2 text-center"">
                                            <b>your cart is still empty </b>
                                        </div>
                                    </div>
                                <?php endif; ?>
                             </div>
                        </div>
            </div>
            <div class="container-xl px-4 mt-4 mb-4 border border-secondary border-1">
                            <div class="display-6 px-1 mt-4 mb-4">
                                <b>Your Orders </b>
                            </div>
                            <?php if(isset($_SESSION['connected']) and isset($orders)): ?>
                                <?php $tmp=''; ?>
                                <div class="row shadow-sm border border-secondary border-1 p-3 mb-3 bg-body rounded-0">
                                    <!--<div class="col-md-2 mt-3 px-2" >Image</div>-->
                                    <div class="col-sm px-2" >Order id</div>
                                    <div class="col-sm px-2" >Total Price</div>
                                    <div class="col-sm " >Date</div>
                                    <div class="col-sm " >Paid with</div>
                                    <div class="col-sm " >User details</div>
                                    <div class="col-sm px-1" >Email</div>
                                    <div class="col-sm px-1" >Details</div>

                                </div>
                                <?php if(!empty($orders)): for($i=0;$i<=isset($orders[$i]);$i++): ?>
                                    <?php   $tmp .= '<div class="jumbotron"><div class="row shadow-sm rounded-0">'; ?>
                                    <?php   //$tmp .= '<div class="col-md-2 mt-3 px-2 h-25" ><img src="'.$products_infos[$i]['img_url'].'" class="img-responsive img-thumbnail"></div>';    ?>

                                    <?php   $tmp .= '<div class="col-sm mt-2 text-center" >'.$orders[$i]['id_commande'].'</div>';    ?>
                                    <?php   $tmp .= '<div class="col-sm mt-2 px-1 text-center" >'.$orders[$i]['price'].'</div>';    ?>
                                    <?php   $tmp .= '<div class="col-sm mt-2 px-1 text-justify" >'.substr($orders[$i]['date_commande'],0,16).'</div>';    ?>
                                    <?php   $tmp .= '<div class="col-sm mt-2 text-center" >'.$orders[$i]['nom_paiement'].'</div>';    ?>
                                    <?php   $tmp .= '<div class="col-sm mt-2 px-1 text-justify" >'.$user_infos['nom'].' '.$user_infos['prenom'].'</div>';    ?>
                                    <?php   $tmp .= '<div class="col-sm mt-2 px-1 text-justify" >'.$user_infos['email'].'</div>';    ?>
                                    <?php   $tmp .= '<div class="col-sm mt-2 " >
                                                             <form method="POST" action="">
                                                                  <div class="mb-3 form-check px-4">
                                                                      <button type="submit" class="btn btn-dark px-1 rounded-0 " name="detailsCommande" value="'.$orders[$i]['id_commande'].'">details</button>
                                                                  </div>
                                                             </form>'; ?>
                                    <?php   $tmp.='</div></div>'; ?>
                                <?php endfor; echo $tmp;?>
                                 <?php else: ?>
                                    <div class="row">
                                        you don't have any order yet;
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>

                            <?php endif; ?>
            </div>
        </div>


<?php  $content=ob_get_clean(); ?>

<?php require ('header.php'); ?>


<?php require ('Elements/patron.php'); ?>




