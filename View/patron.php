<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="View/CSS/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="View/CSS/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/37338f1a7b.js" crossorigin="anonymous"></script>
    <script src="View/CSS/script.js"></script>
    <title><?= $title ?></title>
</head>
<body>

    <header >
        <?php require_once ('View/header.php') ?>
    </header>
    
    <h1 class="text-center bg-dark text-white py-2" ><?= $title ?></h1>

    <?php require_once('View/Error.php')?>
    
    <main>
        <?= $content ?>
    </main>

    <footer>
        <?php require_once ('View/footer.php') ?>   
    </footer>

</html>

