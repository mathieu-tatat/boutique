<?php $title = "cart" ?>
<?php session_start(); ?>
<?php require_once('Model/model.php'); ?>
<?php require_once('Controller/user_controller.php'); ?>
<?php require_once('Controller/commandes_controller.php'); ?>
<?php require ('Controller/search_bar_controller.php'); ?>


<?php   ob_start();  ?>
<div class="d-flex flex-row">
    <div class="navbar col-md-3 border-secondary border-1 rounded-0 px-4 mt-4">
        <div class="col  shadow-sm rounded-0">
            <div class="display-6 px-4 mt-4"><b>NAVBAR </b></div>
        </div>
    </div>
    <div class="col-md-9">
    <div class="container-xl px-4 mt-4">
        <div class="container-xl px-4 mt-4">
            <div class="shadow-sm p-3 mb-5 bg-body rounded border border-secondary border-1 px-4 mt-4">
                <div class="shadow-sm mb-1 bg-body rounded 0">
                    <div class="container-xl px-4 mt-4 mb-4">
                        <div class="h-1 px-4 mt-4 mb-4">
                            <b>Order n. <?php echo $_SESSION['commande_details']; echo ' date:'. $comm[0]['date_commande']; ?></b>
                        </div>
                        <?php if(isset($_SESSION['connected']) and isset($comm)): ?>
                            <?php $tmp=''; $tot=0; ?>
                            <?php   $tmp .= '<div class="row shadow-sm p-3 mb-5 bg-body rounded">';  ?>
                                <?php   $tmp .= '<div class="col-md-2 px-3" >Quantite</div>' ;   ?>
                                <?php   $tmp .= '<div class="col-md-2 px-3" >Image</div>' ;   ?>
                                <?php   $tmp .= '<div class="col-md-2 px-2" >Product Name</div>'; ?>
                                <?php   $tmp .= '<div class="col-md-2 px-2" >Total Price</div>'; ?>
                                <?php   $tmp .= '<div class="col-md-2 px-2" >Date</div>';  ?>
                                <?php   $tmp .= '<div class="col-md-2 px-2" >Paid with</div>';     ?>
                            <?php   $tmp .= '</div>';       ?>
                            <?php for($i=0;$i<=isset($comm[$i]);$i++): ?>
                                <?php   $tmp .= '<div class="jumbotron"><div class="row shadow-sm bg-body rounded">'; ?>
                                <?php   $tmp .= '<div class="col-md-2 mt-1 px-2 text-center" >'.$comm[$i]['quantite'].'</div>';    ?>
                                <?php   $tmp .= '<div class="col-md-2 mt-3 px-2 h-25" ><img src="'.$comm[$i]['img_url'].'" class="prodPics"></div>';    ?>
                                <?php   $tmp .= '<div class="col-md-2 mt-1 px-2 text-center" >'.$comm[$i]['nom_produit'].'</div>';    ?>
                                <?php   $tmp .= '<div class="col-md-2 mt-1 px-2 text-center" >'.$comm[$i]['price'].'</div>'; $tot+=$comm[$i]['price'];   ?>
                                <?php   $tmp .= '<div class="col-md-2 mt-1 px-2 text-justify" >'.substr($comm[$i]['date_commande'],0,16).'</div>';    ?>
                                <?php   $tmp.='</div></div>'; ?>
                            <?php endfor; ?>
                                <?php   $tmp .= '<div class="h-3 px-4 mt-4 mb-4">Order Total Price: '.$tot.'&#160;&#160;&#160;&#160;';   ?>
                                <?php   $tmp .= 'Paid with: '.$comm[0]['nom_paiement'].'</div>';   ?>
                            <?php   echo $tmp;   ?>
                        <?php else: ?>
                            <div class="row">
                                you don't have any order yet;
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php  $content=ob_get_clean(); ?>

<?php require ('header.php'); ?>


<?php require ('Elements/patron.php'); ?>
