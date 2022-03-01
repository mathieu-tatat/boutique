<?php $title = "accueil" ?>
<?php session_start(); ?>
<?php ob_start(); ?>
<h1 class="text-center"> YOUPI </h1>
<?php $content = ob_get_clean(); ?>
<?php require ('search_bar_controller.php'); ?>

<?php require ('header.php'); ?>

<?php require ('Elements/patron.php'); ?>