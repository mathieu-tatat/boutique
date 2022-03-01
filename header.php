<?php


require_once'header_controller.php';

ob_start();

?>
<div class="d-flex flex-row align-items-center">
    <div class="col-sm-1"><a href="index.php" class="text-center" id="headerLogo" >Ori*</a></div>
    <div class="col-sm-1"><a href="shop.php" class="alert-link">Shop</a></div>
    <div class="col-sm-1"><a href="connexion.php" class="alert-link">About</a></div>
    <div class="col-sm-1"><a href="about.php" class="alert-link">Contacts</a></div>
    <div class="col-sm-4">
        <form method="GET" action="shop.php">
            <div class="input-group rounded-0">
                <input type="text" class="form-control rounded-0 " placeholder=" search for a product..." aria-label="search a product" aria-describedby="basic-addon2" id="headerInputSearch"
                       name="searchBarIn">
                <div class="input-group-append ">
                    <button type="submit" class="input-group-text btn btn-dark px-1 rounded-0" id="basic-addon2">search</button>
                </div>
            </div>
        </form>
    </div><!-- 4 -->
    <?php if(isset($_SESSION['connected'])): ?>
    <div class="col-sm-1 ms-4">
        <div class="col" id="headerHelpLink">
            <a href="profil.php" class="alert-link">Profil </a>
        </div>
    </div><!-- 2 -->
        <div class="col-sm-1">
        <form method="POST">
            <button type="submit" class="btn btn-dark rounded-0 px-1 me-5 ml-2" name="disconnect">
                Disconnect
            </button>
        </form>
        </div><!-- 2 -->
    <div class="col-sm-1">
        <form method="POST">
            <button type="submit" class="btn rounded-0 px-2 me-5" name="cart">
                <img src="Elements/icons/cart.svg" >
            </button>
        </form>
    </div>
    <?php else: ?>
        <div class="col-sm px-5" id="loglink" ><a href="connexion.php" class="alert-link" ">Log In</a></div>
        <div class="col-sm px-2" id="signlink" ><a href="inscription.php" class="alert-link" >Sign Up</a></div>
        <div class="col-sm px-4">
            <a href="connexion.php" class="alert-link" > <img src="Elements/icons/cart.svg" alt="cart" id="cartIcon"></a>
        </div>
    <?php endif; ?>
</div>


<?php

$header=ob_get_clean();










