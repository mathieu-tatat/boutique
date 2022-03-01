<?php

abstract Class Db {

    private $conn;

    private function getConn(){
        $server="localhost";
        $username="root";
        $password="";
        $database="boutique";

        $dsn = "mysql:host=$server;dbname=$database;charset=UTF8";
        $this->conn = new PDO($dsn, $username, $password);
        return $this->conn;
    }

    public function selectQuery($sql,$params=null){
        if($params===null){
            $result = $this->getConn()->query($sql);
        } else {
            $result = $this->getConn()->prepare($sql);
            $result->execute($params);
        }
        return $result;
    }
}

Class User extends Db
{
    public $prenom, $nom, $email, $password, $address, $code_postal, $id_droit;

    function __construct()
    {
    }

    public function checkExists($prenom, $email)
    {
        $sql = " SELECT COUNT(*) as count FROM utilisateurs WHERE prenom=:prenom AND email=:email ";
        $params = ([':prenom' => $prenom, ':email' => $email]);
        $result = $this->selectQuery($sql, $params);
        $result = $result->fetch();
        return $result;
    }
    public function checkExistsForUpdate($email)
    {
        $sql = " SELECT COUNT(*) as count FROM utilisateurs WHERE email=:email ";
        $params = ([':email' => $email]);
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
    //user
    function getUsersAdmin(){
        $sql="SELECT * FROM utilisateurs ORDER BY `id_droit` DESC";
        $query = $pdo->query($sql);
        $queryRows = $query->fetchAll(PDO::FETCH_ASSOC);
    }


}

Class Cart extends Db
{
    public $id_panier, $id_utilisateur;

    function __construct()
    {
    }

    public function getCart($id_utilisateur){
            $sql = " SELECT id_panier FROM paniers WHERE id_utilisateur=:id_utilisateur ";
            $params = [':id_utilisateur' => $id_utilisateur];
            $result = $this->selectQuery($sql, $params);
            $id_panier=$result->fetch();
            return $id_panier;
    }
}

Class Contient extends Db
{
    public $id_produit, $id_panier, $quantite;

    function __construct()
    {
    }

    public function getContient($id_panier){
        $sql = " SELECT * FROM contient WHERE id_panier=:id_panier ";
        $params = ['id_panier' => $id_panier];
        $result = $this->selectQuery($sql, $params);
        $contient=$result->fetchAll();
        return $contient;
    }
}
Class Commande extends Db
{
    public $id_panier, $id_utilisateur;

    function __construct()
    {
    }
    public function getCommande($id_panier){
        $sql = " SELECT * FROM commandes WHERE id_panier=:id_panier ";
        $params = ['id_panier' => $id_panier];
        $result = $this->selectQuery($sql, $params);
        $contient=$result->fetchAll();
        return $contient;
    }
}

Class Paiement extends Db
{
    public $id_panier, $id_utilisateur;

    function __construct()
    {
    }
}

Class Produits extends Db
{
    public $id_produit, $nom_produit, $img_url , $unit_price, $description_produit, $units_in_stock,
            $id_categorie, $id_sous_categorie;

    function __construct()
    {
    }

    public function getProduitsFromId($id_produit){
        $sql = " SELECT * FROM produits WHERE id_produit=:id_produit ";
        $params = ['id_produit' => $id_produit];
        $result = $this->selectQuery($sql, $params);
        $contient=$result->fetch();
        return $contient;
    }
    public function getQuantityFromId($id_produit){
        $sql = " SELECT quantite FROM produits WHERE id_produit=:id_produit ";
        $params = [':id_produit' => $id_produit];
        $result = $this->selectQuery($sql, $params);
        $contient=$result->fetch();
        return $contient;
    }
    // Méthodes

    public function get_info_produits(){
        // prepare la recuperation des infos de tout les produits
        $sql = "SELECT * FROM Produits order by id_produit DESC";
        $result = $this->selectQuery($sql);
        $produits = $result->fetchAll();

        return $produits;

    }

    public function updateProduct($id_produit, $nom_produit, $img_url , $unit_price, $description_produit, $units_in_stock, $id_categorie, $id_sous_categorie){
        $sql = "UPDATE produits 
                SET nom_produit = ?,
                unit_price = ?, units_in_stock = ?,
                description_produit = ?,
                id_categorie = ?, id_sous_categorie = ?                    
                WHERE `id_produit` = ?";
        $params = [] ;
        $updateQuery = $this->selectQuery($sql,$params);
    }

}

Class Categories extends Db
{
    public $id_categorie, $nom_categorie;

    function __construct()
    {
    }
}

Class Search extends Db
{

    function __construct()
    {
    }

    public function searchAll($search){
        $sql = "SELECT * FROM produits WHERE INSTR(* , :search )";
        $params = [':search' => $search];
        $result = $this->selectQuery($sql, $params);
        $search_result=$result->fetchAll();
        return $search_result;
    }
}

