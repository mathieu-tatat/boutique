<?php

abstract Class Model {

    private $conn;

    private function getConn()
    {
        $server="localhost";
        $username="root";
        $password="";
        $database="boutique";

        $dsn = "mysql:host=$server;dbname=$database;charset=UTF8";
        $this->conn = new PDO($dsn, $username, $password);
        return $this->conn;
    }

    public function selectQuery($sql,$params=null)
    {
        if($params===null)
        {
            $result = $this->getConn()->query($sql);
        } 
        else 
        {
            $result = $this->getConn()->prepare($sql);
            $result->execute($params);
        }
        return $result;
    }
}
