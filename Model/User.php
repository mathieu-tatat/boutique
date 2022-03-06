<?php

require_once('Model.php');

Class User extends Db
{
    public $prenom, $nom, $email, $password, $address, $code_postal, $id_droit;

    function __construct()
    {
    }

    public function getAllUsersIdDroit(){
        $sql="SELECT * FROM utilisateurs ORDER BY `id_droit` DESC";
        $result = $this->selectQuery($sql);
        $queryRows = $result->fetchAll(PDO::FETCH_ASSOC);
        return $queryRows;
    }

    public function checkExists($email)
    {
        $sql = " SELECT * FROM utilisateurs WHERE email=:email ;";
        $params = [':email' => $email];
        $result = $this->selectQuery($sql, $params);
        $result = $result->fetch();
        return $result;
    }



    public function subscribeUser($prenom, $nom, $email, $password, $address, $code_postal, $id_droit)
    {
        $sql = " INSERT INTO utilisateurs(prenom,nom,email,password,address,code_postal,id_droit) 
                         VALUES (:prenom,:nom,:email,:password,:address,:code_postal,:id_droit) ";
        $params = ([':prenom' => $prenom, ':nom' => $nom, ':email' => $email, ':password' => $password,
            ':address' => $address, ':code_postal' => $code_postal, ':id_droit' => $id_droit]);
        $this->selectQuery($sql, $params);
    }

    public function getHash($email)
    {
        $sql = " SELECT password FROM utilisateurs WHERE email = :email ";
        $params = [':email' => $email ];
        $result = $this->selectQuery($sql,$params);
        $result = $result->fetch();
        return $result;
    }
    public function getUserInfos($id)
    {
        $sql = " SELECT * FROM utilisateurs WHERE id_utilisateur = :id_utilisateur ";
        $params = [':id_utilisateur' => $id ];
        $result = $this->selectQuery($sql, $params);
        $info=$result->fetch();
        return $info;
    }
    public function getAllUserInfos($email)
    {
        $sql = " SELECT * FROM utilisateurs WHERE email = :email ";
        $params = [':email' => $email ];
        $result = $this->selectQuery($sql, $params);
        $result=$result->fetch();
        return $result;
    }

    public function getId($email)
    {
        $sql = " SELECT id_utilisateur FROM utilisateurs WHERE email=:email ";
        $params = [':email' => $email];
        $result = $this->selectQuery($sql, $params);
        $id=$result->fetch();
        return $id;
    }

    public function validateUserConnection($email, $password){
        $sql = " SELECT COUNT(*) as count FROM utilisateurs WHERE email = :email AND password = :password ";
        $params = [':email' => $email, ':password' => $password];
        $result = $this->selectQuery($sql, $params);
        $result = $result->fetch();
        return $result;
    }

    public function userUpdate( $prenom,$nom,$email,$password,$address,$code_postal,$id_droit,$id_utilisateur){
        $sql = " UPDATE utilisateurs SET  prenom = :prenom, nom = :nom , password = :password , email = :email ,
                         address = :address, code_postal = :code_postal, id_droit = :id_droit  WHERE id_utilisateur = :id_utilisateur ";
        $params=([':prenom' => $prenom, ':nom' => $nom, ':email' => $email, ':password' => $password, ':address' => $address,
            ':code_postal' => $code_postal, ':id_droit' => $id_droit, ':id_utilisateur' => $id_utilisateur]);
        $this->selectQuery($sql, $params);
    }
    public function getAllOrders( $id_utilisateurs){
        $sql = "SELECT paniers.id_utilisateur, paniers.id_panier,
                        commandes.id_commande,commandes.date_commande,commandes.id_panier, commandes.id_paiement,
                        contient.id_produit, contient.quantite, 
                        produits.id_produit, produits.nom_produit, produits.description_produit, produits.unit_price,
                        paiements.id_paiement, paiements.nom_paiement,
                SUM(contient.quantite*produits.unit_price) AS price 
				FROM paniers
			    JOIN commandes
				ON paniers.id_panier = commandes.id_panier
                JOIN contient
                ON paniers.id_panier = contient.id_panier
                JOIN produits
                ON contient.id_produit = produits.id_produit
				JOIN paiements
                ON paiements.id_paiement = commandes.id_paiement
                 WHERE paniers.id_utilisateur = :id_utilisateur GROUP BY commandes.id_commande ORDER BY commandes.date_commande DESC ";
        $params = [':id_utilisateur' => intval($id_utilisateurs) ];
        $result = $this->selectQuery($sql, $params);
        $commandes=$result->fetchAll();
        return $commandes;
    }
    public function getAllUserOrderedById()
    {
        $sql="SELECT * FROM utilisateurs ORDER BY `id_droit` DESC";

        $result = $this->selectQuery($sql)->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function updateDroit($id_utilisateur, $id_droit)
    {
        $sql="UPDATE utilisateurs 
                SET id_droit = ?
                WHERE id_utilisateur = ?";
        $params = array($id_droit, $id_utilisateur);
        $this->selectQuery($sql, $params);
    }

    //USER Cart & Contient functions________________

    function updateContientFromUser($quantite, $id_panier, $id_produit){
        $sql = " UPDATE contient SET quantite = :quantite WHERE id_panier = :id_panier AND id_produit = :id_produit ";
        $params=([':quantite' => $quantite, ':id_panier' => $id_panier, ':id_produit' => $id_produit]);
        $this->selectQuery($sql, $params);
    }
    function getCartId($id_utilisateur){
        $sql = " SELECT id_panier FROM paniers WHERE id_utilisateur=:id_utilisateur ";
        $params = [':id_utilisateur' => $id_utilisateur];
        $result = $this->selectQuery($sql, $params);
        $result->setFetchMode(PDO::FETCH_CLASS, 'CartContientSession');
        $my_new_cart = $result->fetch();
        return $my_new_cart;
    }
    function createContent($id_produit){
        $sql = " SELECT * FROM produits WHERE id_produit=:id_produit ";
        $params = [':id_produit' => $id_produit];
        $result = $this->selectQuery($sql, $params);
        $result->setFetchMode(PDO::FETCH_CLASS, 'currentProduct');
        $my_products = $result->fetch();
        return $my_products;
    }

}
