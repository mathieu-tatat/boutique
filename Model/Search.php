<?php

require_once 'Model.php';

Class Search extends Db
{

    function __construct(){}

    public function searchAll($search)
    {
        $sql = "SELECT * FROM produits WHERE INSTR( nom_produit , :search )
                OR INSTR( description_produit, :search);
                SELECT * FROM categories WHERE INSTR( nom_categorie, :search );
                SELECT * FROM sous_categories WHERE INSTR( nom_sous_categorie , :search);";

        $params = [':search' => $search];

        $result = $this->selectQuery($sql, $params);

        $search_result=$result->fetchAll();
        
        return $search_result;
    }
}
