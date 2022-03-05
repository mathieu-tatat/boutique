<?php session_start(); ?>
<?php $title = "Accueil" ?>

<?php ob_start(); ?>
    <main class="d-flex flex-column justify-items-center">
        <h1 class="text-center"> YOUPI </h1>
        <a href="admin.php" class="btn btn-info">admin</a>
    </main>
<?php $content = ob_get_clean(); ?>
<?php require_once('header.php'); ?>
<?php require ('View/patron.php'); ?>