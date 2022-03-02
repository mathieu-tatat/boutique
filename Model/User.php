<?php

require_once 'Model/Model.php';

Class User extends Model
{
    public  $prenom, 
            $nom, 
            $email, 
            $password, 
            $address, 
            $code_postal, 
            $id_droit;

    function __construct(){}

    public function chkExists($email)
    {
        $params = array($email);

        $sql = "SELECT * FROM `utilisateurs` 
                        WHERE `email` LIKE ?";

        $checkQuery = $this->selectQuery($sql,$params);
                
        $infos = $checkQuery->fetch(PDO::FETCH_ASSOC);

        $count = $checkQuery->rowCount();

        if ($count > 0)
        {
            return $infos;
        }
        else
        {
            return false;
        }
        
    }

    public function getAllInfs($email)
    {
        $params = array($email);

        $sql = "SELECT * FROM `utilisateurs` WHERE `email` = ?";
        
        $selectQuery = $this->selectQuery($sql, $params);
        
        return $selectQuery;
    }


    public function checkExistsForUpdate($email)
    {
        $sql = " SELECT COUNT(*) as count FROM utilisateurs WHERE email=:email ";
        $params = ([':email' => $email]);
        $result = $this->selectQuery($sql, $params);
        $result = $result->fetch();
        return $result;
    }


    public function subscribeUser($prenom, $nom, $email, $password, $address, $code_postal)
    {
        $sql = "INSERT INTO utilisateurs (prenom, nom, email,
                                            password, address,
                                            code_postal, id_droit) 
                        VALUES (:prenom, :nom, :email,
                                :password, :address,
                                :code_postal, :id_droit)";
        $params = ([':prenom' => $prenom, ':nom' => $nom, ':email' => $email, 
                    ':password' => password_hash($password, PASSWORD_DEFAULT), ':address' => $address, 
                    ':code_postal' => $code_postal, ':id_droit' => 1]);
        $this->selectQuery($sql, $params);
    }

    public function getAllInfos()
    {
        $sql = "SELECT * FROM utilisateurs ";
        $result = $this->selectQuery($sql);
        $result = $result->fetchAll();
        return $result;
    }


    public function getUserInfos($id)
    {
        $sql = "SELECT * FROM utilisateurs WHERE id_utilisateur = :id_utilisateur";
        $params = [':id_utilisateur' => $id ];
        $result = $this->selectQuery($sql, $params);
        $info=$result->fetch();
        return $info;
    }


    public function getId($email)
    {
        $sql = " SELECT id_utilisateur FROM utilisateurs WHERE email=:email ";
        $params = [':email' => $email];
        $result = $this->selectQuery($sql, $params);
        $id=$result->fetch();
        return $id;
    }


    public function validateUserConnection($email, $password)
    {
        $sql = " SELECT COUNT(*) as count FROM utilisateurs WHERE email = :email AND password = :password ";
        $params = [':email' => $email, ':password' => $password];
        $result = $this->selectQuery($sql, $params);
        $result = $result->fetch();
        return $result;
    }


    public function userUpdate( $prenom,$nom,$email,$password,$address,$code_postal,$id_droit,$id_utilisateur)
    {
        $sql = " UPDATE utilisateurs SET  prenom = :prenom, nom = :nom , password = :password , email = :email ,
                         address = :address, code_postal = :code_postal, id_droit = :id_droit  WHERE id_utilisateur = :id_utilisateur ";
        $params=([':prenom' => $prenom, ':nom' => $nom, ':email' => $email, ':password' => $password, ':address' => $address,
            ':code_postal' => $code_postal, ':id_droit' => $id_droit, ':id_utilisateur' => $id_utilisateur]);
        $this->selectQuery($sql, $params);
    }


    public function getAllOrders( $id_utilisateurs)
    {
        $sql = "SELECT paniers.id_utilisateur, paniers.id_panier,
                        commandes.id_commande,commandes.date_commande,commandes.id_panier, commandes.id_paiement,
                        contient.id_produit, contient.quantité, 
                        produits.id_produit, produits.nom_produit, produits.description_produit, produits.unit_price,
                        paiements.id_paiement, paiements.nom_paiement,
                SUM(contient.quantité*produits.unit_price) AS price 
				FROM paniers
			    JOIN commandes ON paniers.id_panier = commandes.id_panier
                JOIN contient  ON paniers.id_panier = contient.id_panier
                JOIN produits  ON contient.id_produit = produits.id_produit
				JOIN paiements ON paiements.id_paiement = commandes.id_paiement
                WHERE paniers.id_utilisateur = :id_utilisateur 
                GROUP BY commandes.id_commande 
                ORDER BY commandes.date_commande DESC ";
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
    

}