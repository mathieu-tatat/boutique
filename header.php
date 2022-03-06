<?php


require_once'Controller/header_controller.php';

ob_start();

?>
<div class="d-flex flex-row align-items-center m-xl-1">
    <div class="col-sm-1 ms-4"> <a href="index.php" class="alert-link" ><img src="Elements/logos/fox.svg" alt="cart" id="cartIcon"></a></div>
    <div class="col-sm-4">
        <form method="GET" action="shop.php">
            <div class="input-group rounded-0">
                <input type="text" class="form-control rounded-0 ms-4" placeholder=" search for a product..." aria-label="search a product" aria-describedby="basic-addon2" id="headerInputSearch"
                       name="searchBarIn">
                <div class="input-group-append ">
                    <button type="submit" class="input-group-text btn btn-dark px-1 rounded-0" id="basic-addon2">search</button>
                </div>
            </div>
        </form>
    </div><!-- 4 -->
    <div class="col-sm-1 ms-5"><a href="shop.php" class="h6"><b>Shop</b></a></div>
    <div class="col-sm-1"><a href="connexion.php" class="h6"><b>About</b></a></div>
    <div class="col-sm-1"><a href="about.php" class="h6"><b>Contacts</b></a></div>
    <?php if(isset($_SESSION['connected'])): ?>
        <?php if($_SESSION["droits"] == 1337) : ?>
            <a href="admin.php" class="h6 me-2 text-danger"><b>Admin </b></a>
        <?php endif; ?>
    <div class="col-sm-1 ms-4">
        <div class="col">
            <a href="profil.php" class="h6"><b>Profil </b></a>
        </div>
    </div><!-- 2 -->
        <div class="col-sm-1">
        <form method="POST">
            <button type="submit" class="h6 btn btn-dark rounded-0 px-1 me-2" name="disconnect">
                <b>Disconnect</b>
            </button>
        </form>
        </div><!-- 2 -->
    <div class="col-sm-1 ms-3 mt-2">
        <form method="POST">
            <button type="submit" class="h6 btn rounded-0 px-2 me-5" name="cart">
                <img src="Elements/icons/cart.svg" >
            </button>
        </form>
    </div>
    <?php else: ?>
        <div class="col-sm  ms-5 px-3" id="loglink" ><a href="connexion.php" class="alert-link" ">Log In</a></div>
        <div class="col-sm " id="signlink" ><a href="inscription.php" class="alert-link" >Sign Up</a></div>
    <?php endif; ?>
</div>


<?php

$header=ob_get_clean();










