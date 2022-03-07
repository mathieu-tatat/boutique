<style>
.fromage{
    background-image:url("Elements/media/banner.jpg");
    display:flex;
    justify-content:space-around;
}
.footStyle{
    display:flex;
    justify-content:space-around;
    width:175%;
    margin-left: -120px;

}

.linkFoot{
    color:white;
}
.ml{
    margin-left:-15px;
}
.logoFoot{
    gap:50px;
}

.copyright{
    color:white;
    margin-left:0;
}


</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Elements/CSS/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Elements/CSS/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3987504e8f.js" crossorigin="anonymous"></script>
    <title><?= $title ?></title>
</head>
<body>

        <header class="container-fluid">
            <?= $header  ?>
        </header>

    <main>
        <?= $content ?>
    </main>
    <footer class="fromage">
        <nav class="d-flex flex-column align-items-center ">
            <div class= "footStyle">
                <a href="index.php" class="alert-link"><img src="Elements/logos/foxwhite.png"></a>
                <div class="d-flex align-items-center justify-content-around myFooter">
                <a class="linkFoot" href="shop.php" ><div class="text-center footerText">Produits</div></a>
                <a class="linkFoot" href="profil.php" ><div class="text-center footerText">Profil</div></a>
                <a class="linkFoot" href="contact.php" ><div class="text-center footerText">Contact</div></a>
                </div>
            </div>
            <div class="border-top border-secondary line ml"></div>
            <div class="d-flex flex-row justify-content- my-2 logoFoot">
                <div class="linkFoot"><a href="https://github.com/mathieu-tatat/boutique"><img src="Elements/logos/github.png"></a></div>
                <div class="linkFoot"><a href="https://www.linkedin.com"><img src="Elements/logos/linkedin.png"></a></div>
                <div class="linkFoot"><a href="https://www.facebook.com/"><img src="Elements/logos/facebook.png"></a></div>
                <div class="linkFoot"><a href="https://www.instagram.com/"><img src="Elements/logos/insta.png"></a></div>
                <div class="linkFoot"><a href="https://twitter.com/?lang=fr"><img src="Elements/logos/twitter.png"></a></div>
            </div>
            <div class="text-center ms-20 copyright">Trade © 2022 - MGF</div>
        </nav>
    </footer>
    
</body>
</html>
