<?php
// creation de mes produits
$article = new Produits();
$items = $article->get_info_produits();
$user=new User();
$id=$_SESSION['cart']->id_utilisateur;


if(isset($_POST['addToCart'])  or isset($_POST['quantity'])){     //if cart is pressed
    $id_panier=$_SESSION['cart']->id_panier;       //get my cart id
    $id_panier=intval($id_panier);
    $quantite=intval($_POST['quantity']);
    $id_produit=intval($_POST['addToCart']);
    $contient = new Contient();
    $exist=$contient->getQuantity($id_panier,$id_produit);   //check for existing contient
    var_dump($exist);
    if(empty($exist)){
        if($quantite !== 0){
            $contient->addToContient($id_panier,$quantite,$id_produit);
            $contient->addMultipleQuantityToContient($quantite,$id_panier,$id_produit);
        } else {
            $quantite=$quantite+1;
            $contient->addToContient($id_panier,$quantite,$id_produit);
        }
    } else {
        if($quantite === 0){
            $contient->deleteContientRow($id_panier,$id_produit);
        } else {
            $contient->addMultipleQuantityToContient($quantite,$id_panier,$id_produit);
        }
    }
}   /* elseif(isset($_POST['submitContientUpdate']) ){
        var_dump($_POST['quantity']);
        $id_panier=$_SESSION['cart']->id_panier;
        $id_panier=intval($id_panier);
        $details=explode(',',$_POST['quantity']);
        $quantite=$details[0];
        $quantite=intval($quantite);
        $id_produit=$details[1];
        $id_produit=intval($id_produit);
        $contient=new Contient();
        $exist=$contient->getQuantity($id_panier,$id_produit);   //check for existing contient
        if(empty($exist)){
            if($quantite !== 0){
                $contient->addToContient($id_panier,$quantite,$id_produit);
                $contient->addMultipleQuantityToContient($quantite,$id_panier,$id_produit);
            } else {
                $contient->deleteContientRow($id_panier,$id_produit);
            }
        } else {
            if($quantite === 0){
                $contient->deleteContientRow($id_panier,$id_produit);
            } else {
                $contient->addMultipleQuantityToContient($quantite,$id_panier,$id_produit);
            }
        }
}*/
?>