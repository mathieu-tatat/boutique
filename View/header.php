<div class="header" style="background-image: url('View/Media/banner2.jpg')">
    
    <a href="index.php" class="alert-link"><img src="View/logos/foxwhite.png"></a>
    
    <!-- Search Bar -->
    <form method="GET" action="shop.php" class="w-40">
        <div class="input-group rounded-0">
            <input type="text" class="form-control rounded-0 " placeholder=" Search..." aria-label="search a product" aria-describedby="basic-addon2" id="headerInputSearch"
                    name="searchBarIn">
            <div class="input-group-append ">
                <button type="submit" class="input-group-text btn  btnLoupe rounded-0 " id="basic-addon2" style="margin-right: 20px;""><img class="loupe "src="View/logos/loupewhite.svg"></button>
            </div>
        </div>
    </form>
    
    <!-- Liens -->

    <nav class="header__nav">
            <div class="header__nav__close" onclick="closeMenuMobile()">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <ul class="header__nav__menu">
                <li class="header__nav__menu__link">
                     <a href="shop.php" class="alert-link mx-2">Shop</a>
                </li>
                <li class="header__nav__menu__link">
                    <a href="contact.php" class="alert-link mx-2">Contact</a>
                </li>
                <li class="header__nav__menu__link adminStyle">
                    <?php if(isset($_SESSION['connected'])): ?>

                    <?php if($_SESSION["droits"] == 1337) : ?>
                        <a href="admin.php" class="alert-link mx-2 text-danger ">Admin </a>
                    <?php endif; ?>
                </li>
                <li class="header__nav__menu__link">
                     <a href="profil.php" class="alert-link mx-2 ">Profil </a>
                </li>
                <li class="header__nav__menu__link">
                    <form method="POST">
                      <button type="submit" name="deconnexion" class="header__nav__menu__link" id="decoBtn">Déconnexion
                      </button>
                    </form>
                </li>
                <li class="header__nav__menu__link">
                    <a href="cart.php" class="alert-link" ><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                </li>
                <?php else: ?>
                <li class="header__nav__menu__link">
                  <a href="connexion.php" class="alert-link mx-2" >connexion</a>
                </li>
                <li class="header__nav__menu__link">
                    <a href="inscription.php" class="alert-link mx-2" >inscription</a>
                </li>
                <li class="header__nav__menu__link">
                    <?php endif; ?>
                </li>
                <li>
                    <a href="profil.php" class="alert-link hidden" ><img src="View/logos/man.svg" alt="cart"></a>
                </li>

            </ul>
        </nav>
        <div class="header__burger" onclick="openMenuMobile()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </div>


</div>


 <script>
        function openMenuMobile() {
            document.querySelector('.header__nav').classList.add('open');
            document.querySelector('.overlay-menu-mobile').classList.add('open');
        }

        function closeMenuMobile() {
            document.querySelector('.header__nav').classList.remove('open');
            document.querySelector('.overlay-menu-mobile').classList.remove('open');
        }
    </script>







