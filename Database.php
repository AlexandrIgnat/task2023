<?php

// config of database 
require_once "config.php";

class Database
{
    public $connection;

    public function __construct($username = 'root', $password = '')
    {
        $dsn =  "mysql:" . http_build_query(DB_CONFIG['database'], '', ';');
        
        $this->connection = new PDO($dsn, $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }

    public function query($query, $params = []) 
    {

        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement;
    }
}

