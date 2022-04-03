<?php $title = "Contact" ?>
<?php session_start(); ?>
<?php require_once('Controller/user_controller.php'); ?>

<?php   ob_start();  ?>

<div class="d-flex flex-column justify-content-center align-items-center my-3">
    <h3 class="mb-5 mx-5"> Qui sommes-nous ?</h3>
    <div class="mx-5 h-10 d-flex flex-row justify-content-end"><a href="mailto:fauxmail@serveur.com" class="me-2"><img src="View/icons/email2.svg" class="contact-us" ></a> <span><a href="mailto:fauxmail@serveur.com" class="me-2"> Nous contacter</a></span> </div>
    <p class="p_contact">
    ici, une librairie indépendante, vraiment indépendante.
    Après 20 ans passés dans le monde de l’édition et du commerce du livre, Delphine Bouétard et Anne Laure Vial ont décidé de créer une librairie indépendante, 
    axée sur l’humain, libérée de tout algorithme, présente sur internet, et surtout ancrée au cœur de Paris, 
    sur les grands boulevards, avec une offre très large dans tous les domaines et par-dessus tout, une capacité de conseils, 
    de découvertes, d’évènements, de plaisir et de convivialité pour tous ceux, de tous âges, qui aiment vivre pleinement ici.<br>

    ici, une librairie d’ultra-passionnés.
    A quoi bon offrir sur 500 m2 et deux étages plus de 75 000 livres en littérature, jeunesse, bande dessinée,
    sciences humaines, beaux-arts, vie pratique, entreprise, tourisme, parascolaire, VO… si on ne les connaît pas, 
    si on ne les aime pas et si on n’a pas envie de vous les faire découvrir ?<br>

    Nos libraires sont des passionnés, leurs coups de cœur sont communicatifs et leur sens de l’écoute n’a d’égal que leur capacité à trouver
    le livre que vous cherchez ou celui dont la découverte illuminera votre journée ou peut-être même changera votre vie. <br>

    ici, un état d’esprit qui rend votre expérience unique.
    Nos livres sont au même prix qu’ailleurs puisque le prix du livre est fixé par l’éditeur dans notre pays depuis la loi Lang de 1981. 
    Vous ne trouverez donc pas d’écart de prix entre une librairie indépendante, internet ou une grande surface.<br>

    En revanche la différence ici, c’est de pouvoir flâner dans le lieu, boire un des meilleurs cafés de Paris ou déjeuner, 
    feuilleter avec votre enfant son nouveau livre dans un cocon de lecture douillet ou réserver 
    sur internet et passer en coup de vent récupérer votre achat dans les 2 heures, 
    échanger dans l’amphithéâtre avec votre auteur préféré et puis, car vous êtes d’ici, 
    profiter de toutes les petites attentions qui font les bons voisins… les surprises et le plaisir de se retrouver.
    </p>
</div>

<?php  $content=ob_get_clean(); ?>

<?php require ('View/patron.php'); ?>

