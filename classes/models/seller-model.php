<?php

require './classes/seller.php';

class SellerModel extends DB {
    protected $table = 'sellers';

    public function getSellerClass(array $sellerArray): array {
        $sellers = [];
        foreach ($sellerArray as $sellerSingle) {
            $seller = new Seller(
                $sellerSingle["id"],
                $sellerSingle["first_name"],
                $sellerSingle["last_name"],
                $sellerSingle["phone"],
                $sellerSingle["email"]
            );
            array_push($sellers, $seller);
        }
        return $sellers;
    }

    public function getSellers($id) {
        if ($id == 0) {
            return $this->getAllSellers();
        } else {
            return $this->getSingleSeller($id);
        }

    }

    public function getAllSellers(): array {
        $query = "SELECT * FROM $this->table ORDER BY $this->table.id ASC";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $this->getSellerClass($statement->fetchAll());
    }

    public function getSingleSeller(int $id): array {
        $query = "SELECT * FROM $this->table WHERE $this->table.id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$id]);
        return $this->getSellerClass($statement->fetchAll());
    }
    
}