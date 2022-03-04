<?php

if(isset($_GET['id'])){
    $detail = new Article();
    $id_produit = $_GET['id'];
    $article=$detail->get_article_details(intval($id_produit));
}else{
    $id = NULL;
}