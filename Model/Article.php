<?php

require_once 'Model/Model.php';

class Article extends Model 
{
    public function __construct() { }
    
    public function get_article_details($id)
    {    
        $params = array($id);

        $sql = "SELECT * from Produits  WHERE id_produit = ?";

        $checkQuery = $this->selectQuery($sql,$params);
                
        $infos = $checkQuery->fetchAll(PDO::FETCH_ASSOC);

        return $infos;
    }

}