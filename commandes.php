<?php $title = "cart" ?>
<?php session_start(); ?>
<?php require_once('model.php'); ?>
<?php require_once('user_controller.php'); ?>
<?php require_once('commandes_controller.php'); ?>
<?php require ('search_bar_controller.php'); ?>


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
                        <div class="display-6 px-4 mt-4 mb-4">
                            <b>Your Orders Details</b>
                        </div>
                        <?php if(isset($_SESSION['connected']) and isset($orders)): ?>
                            <?php $tmp=''; ?>
                            <div class="row shadow-sm p-3 mb-5 bg-body rounded">
                                <!--<div class="col-md-2 mt-3 px-2" >Image</div>-->
                                <div class="col-md-2 px-3" >Order id</div>
                                <div class="col-md-2 px-2" >Total Price</div>
                                <div class="col-md-2 px-2" >Date</div>
                                <div class="col-md-2 px-2" >Paid with</div>
                                <div class="col-md-2 px-2" >Details</div>

                            </div>
                            <?php  for($i=0;$i<=isset($orders[$i]);$i++): ?>
                                <?php   $tmp .= '<div class="jumbotron"><div class="row shadow-sm bg-body rounded">'; ?>
                                <?php   //$tmp .= '<div class="col-md-2 mt-3 px-2 h-25" ><img src="'.$products_infos[$i]['img_url'].'" class="img-responsive img-thumbnail"></div>';    ?>

                                <?php   $tmp .= '<div class="col-md-2 mt-1 px-2 text-center" >'.$orders[$i]['id_commande'].'</div>';    ?>
                                <?php   $tmp .= '<div class="col-md-2 mt-1 px-2 text-center" >'.$orders[$i]['price'].'</div>';    ?>
                                <?php   $tmp .= '<div class="col-md-2 mt-1 px-2 text-justify" >'.substr($orders[$i]['date_commande'],0,16).'</div>';    ?>
                                <?php   $tmp .= '<div class="col-md-2 mt-1 px-2 text-justify" >'.$orders[$i]['nom_paiement'].'</div>';    ?>
                                <?php   $tmp .= '<div class="col-md-2 mt-1 px-1 " >
                                                             <form method="POST" action="commandes.php">
                                                                  <div class="mb-3 form-check px-4">
                                                                      <button type="submit" class="btn btn-dark px-1 rounded-0 " name="detailsCommande" value="'.$orders[$i]['id_commande'].'">details</button></form>
                                                                  </div>
                                                             </form>'; ?>
                                <?php   $tmp.='</div></div><hr>'; ?>
                            <?php endfor; echo $tmp;?>
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
