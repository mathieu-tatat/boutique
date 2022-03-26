<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="View/CSS/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="View/CSS/style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/37338f1a7b.js" crossorigin="anonymous"></script>
    <script src="View/CSS/script.js"></script>
    <title><?= $title ?></title>
</head>
<body>

    <header >
        <?php require_once ('View/header.php') ?>
    </header>
    
    <h1 class="text-center text-light py-2" style="background-color:#201E1F"><?= $title ?></h1>

    <?php require_once('View/Error.php')?>
    
    <main>
        <?= $content ?>
    </main>

    <footer>
        <?php require_once ('View/footer.php') ?>   
    </footer>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

</html>

