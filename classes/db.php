<?php
// class DB {

//     protected $pdo;

//     public function __construct(PDO $pdo) {
//         $this->pdo = $pdo;
//     }

//     public function getAll($table) {
//         $query = "SELECT * FROM $table";
//         $statement = $this->pdo->prepare($query);
//         $statement->execute();
//         return $statement->fetchAll(PDO::FETCH_ASSOC);
//     }
// }

class DB
{
    protected $pdo;
    
    function __construct() {
        $host = "localhost";
        $db = "carlsh";
        $user = "carlsh";
        $password = "carlsh123";
        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
        $pdo = new PDO($dsn, $user, $password, $options);
        $this->pdo = $pdo;

    }  
    public function getAll($table) : array
    {
        $query = "SELECT * FROM $table";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();   
    }
}