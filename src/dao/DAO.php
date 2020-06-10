<?php
namespace Spac\src\dao;

use PDO;
use Exception;

abstract class DAO
{
    
    private $connection;

    private function checkConnection()
    {
        //Vérifie si la connexion est nulle sinon fait appel à getConnection()
        if($this->connection === null) {
            return $this->getConnection();
        }
        //Si la connexion existe, elle est renvoyée
        return $this->connection;
    }

    //Méthode de connexion à notre base de données
    private function getConnection()
    {
        
        try{
            $this->connection = new PDO(DB_HOST, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //On renvoie la connexion
            return $this->connection;
        }
    
        catch(Exception $errorConnection)
        {
            die ('Erreur de connection :'.$errorConnection->getMessage());
        }

    }

    protected function createQuery($sql, $parameters = null)
    {
        if($parameters)
        {
            $result = $this->checkConnection()->prepare($sql);
            $result->execute($parameters);
            return $result; 
        }
        $result = $this->checkConnection()->query($sql);
        return $result;
    }
}  