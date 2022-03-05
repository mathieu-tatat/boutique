<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Elements/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Elements/css/style.css">
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

    <?php require_once('View/Error.php')?>

    <main>
        <?= $content ?>
    </main>

    <footer >
        <nav class="d-flex flex-column align-items-center myFooter">
            <div class="d-flex justify-content-around align-items-start" id="bottomLinks">
                <a href="" class="d-flex justify-content-center align-items-center mx-2 textBox"><div class="text-center footerText">Produits</div></a>
                <a href="" class="d-flex justify-content-center align-items-center mx-2 textBox"><div class="text-center footerText">Profil</div></a>
                <a href="" class="d-flex justify-content-center align-items-center mx-4 my-0 textBox"><div class="text-center" id="footerCenterText">Trade</div></a>
                <a href="" class="d-flex justify-content-center align-items-center mx-2 textBox "><div class="text-center footerText">About us</div></a>
                <a href="" class="d-flex justify-content-center align-items-center mx-2 textBox "><div class="text-center footerText">Contact</div></a>
            </div>
            <div class="border-top border-secondary line"></div>
            <div class="d-flex flex-row justify-content-center my-2">
                <div class="border border-secondary pills mx-3"></div>
                <div class="border border-secondary pills mx-2"></div>
                <div class="border border-secondary pills mx-4"></div>
                <div class="border border-secondary pills mx-2"></div>
                <div class="border border-secondary pills mx-3"></div>
            </div>
            <div class="text-center ms-1">© 2022 - MGF</div>
        </nav>
    </footer>
    
</body>
</html>