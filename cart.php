<?php $title = "cart" ?>
<?php session_start(); ?>
<?php require_once('model.php'); ?>
<?php require_once('user_controller.php'); ?>
<?php require_once('cart_controller.php'); ?>

<?php   ob_start();  ?>
<div class="container-xl px-4 mt-4">
    <div class="container-xl px-4 mt-4">
        <div class="shadow-sm p-3 mb-5 bg-body rounded border border-secondary border-1 px-4 mt-4">
            <div class="shadow-sm mb-1 bg-body rounded 0">
                <div class="display-6 px-4 mt-4 mb-4">
                    <b>Your Cart </b>
                </div>
                <?php if(isset($_SESSION['connected']) and isset($products_infos) and isset($quantity) ): ?>
                    <?php $tmp=''; ?>
                    <div class="row shadow-sm p-3 mb-5 bg-body rounded">
                        <div class="col-md-3 px-2" >Image</div>
                        <div class="col-md-1 px-1" >Quantity</div>
                        <div class="col-md-1 px-2" >Unit Price</div>
                        <div class="col-md-3 px-3" >Description</div>
                        <div class="col-md-2 px-2" >Product Name</div>
                        <div class="col-md-1 px-3" >Edit</div>
                    </div>
                    <?php  for($i=0;$i<=isset($products_infos[$i]);$i++): ?>
                        <?php   $tmp .= '<div class="shadow-sm"><div class="d-flex flex-row  align-items-center ">'; ?>
                        <?php   $tmp .= '<div class=" d-flex flex-row align-items-center mt-1 mb-1 border border-secondary border-1 ">'; ?>
                        <?php   $tmp .= '<div class="col-md-3 mt-3 mb-3 px-2 text-center" ><img src="'.$products_infos[$i]['img_url'].'" class="cartPics"></div>';    ?>
                        <?php   $tmp .= '<div class="col-md-2 mt-3 mb-3 px-2 text-center" >'.$quantity[$i].'</div>';    ?>
                        <?php   $tmp .= '<div class="col-md-1 mt-3 mb-3 px-1 text-justify" >'.$products_infos[$i]['unit_price'].'</div>';    ?>
                        <?php   $tmp .= '<div class="col-md-3 mt-3 mb-3 px-2 text-justify" >'.substr($products_infos[$i]['description_produit'],0,22).'...</div>';    ?>
                        <?php   $tmp .= '<div class="col-md-2 mt-3 mb-3 px-1 text-justify" >'.$products_infos[$i]['nom_produit'].'</div>';    ?>
                        <?php   $tmp .= '<div class="col-md-1 mt-3 mb-3 " >
                                                         <form method="POST">
                                                              <div class="mb-3 form-check px-4">
                                                                  <button type="submit" class="btn btn-dark rounded-0" name="submitProductDelete">delete</button></form>
                                                              </div>
                                                         </form>'; ?>
                        <?php   $tmp .= '</div>'; ?>
                        <?php $tmp.='</div></div>'; ?>
                    <?php endfor; echo $tmp;?>
                <?php else: ?>
                <div class="row">
                    <div class="display-5 border border-secondary rounded-0 px-4 mb-2 mt-2 ml-2 text-center"">
                    <b>your cart is still empty </b>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</div>
<div class="container-xl px-4 mt-4 mb-4">
    <div class=" border border-secondary border-1 px-4 mt-4">
        <div class="display-6 px-4 mt-4"><b>Ask for Help</b></div>
    </div>
</div>
<?php  $content=ob_get_clean(); ?>

<?php require ('header.php'); ?>


<?php require ('Elements/patron.php'); ?>
