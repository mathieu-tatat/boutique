<?php require_once 'Controller/user_controller.php'; ?>
<div class="d-flex flex-row justify-content-between align-items-center">

    
    <a href="index.php" class="alert-link"><img src="View/logos/fox.svg"></a>
    
    <!-- Search Bar -->
    <form method="GET" action="shop.php" class="w-40">
        <div class="input-group rounded-0">
            <input type="text" class="form-control rounded-0 " placeholder=" search for a product..." aria-label="search a product" aria-describedby="basic-addon2" id="headerInputSearch"
                    name="searchBarIn">
            <div class="input-group-append ">
                <button type="submit" class="input-group-text btn btn-dark px-1 rounded-0" id="basic-addon2">search</button>
            </div>
        </div>
    </form>
    
    <!-- Liens -->
    <div class="d-flex flew-row justify-content-between align-items-between">

        <a href="shop.php" class="alert-link mx-2">Shop</a>
        <a href="contact.php" class="alert-link mx-2">Contact</a> 

        <?php if(isset($_SESSION['connected'])): ?>

            <?php if($_SESSION["droits"] == 1337) : ?>
                <a href="admin.php" class="alert-link mx-2 text-danger">Admin </a> 
            <?php endif; ?>

            <a href="profil.php" class="alert-link mx-2">Profil </a>

            <form method="POST">
                <button type="submit" name="deconnexion" class="alert-link mx-2 menuTxt text-center" id="decoBtn">Déconnexion
                </button>
            </form>
            
            <!-- cart -->
            <form method="POST">
                <button type="submit" class="btn mx-2 d-flex flew-row justify-content-center align-items-center" name="cart">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </button>
            </form>

        <?php else: ?>

            <a href="connexion.php" class="alert-link mx-2" >connexion</a>
            <a href="inscription.php" class="alert-link mx-2" >inscription</a>   

        <?php endif; ?>
    </div>

    <a href="profil.php" class="alert-link" ><img src="View/logos/man.svg" alt="cart"></a>
</div>










