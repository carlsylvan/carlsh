<?php

require_once "./classes/db.php";
require "./classes/seller.php";
class SellerModel extends DB {
    protected $table = "sellers";
    public function convertToSellerClass (array $sellerArray) : array {
        $sellers = [];
        foreach ($sellerArray as $sellerSingle) {
            $seller = new Seller (
                $sellerSingle["first_name"], 
                $sellerSingle["last_name"], 
                $sellerSingle["email"],
                $sellerSingle["phone"],
            );
            $seller->addId($sellerSingle["id"]);
            array_push($sellers, $seller);
        }
        return $sellers;
    }
    public function getAllSellers () : array {
        $query = "SELECT * FROM $this->table ORDER BY $this->table.last_name ASC ";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $this->convertToSellerClass($statement->fetchAll()) ;   
    }
    public function getSingleSeller (int $id) : array {
        $query = "SELECT * FROM $this->table WHERE $this->table.id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$id]);
        return $this->convertToSellerClass($statement->fetchAll()) ;   
        }

        public function addSeller (Seller $seller) : string {
            $query = "INSERT INTO `sellers`(`first_name`, `last_name`, `email`, `phone`) VALUES (?,?,?,?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$seller->first_name, $seller->last_name, $seller->email, $seller->phone]);
            return $this->pdo->lastInsertId();  
        }

}