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

            $seller->addProductCount($this->getProductsCountByUser($sellerSingle["id"]));
            $seller->addSoldProductCount($this->getSoldProductsCountByUser($sellerSingle["id"]));
            $seller->addTotalSellingPrice($this->getSoldProductsTotalPriceByUser($sellerSingle["id"]));
            $seller->addProducts($this->getAllProductListByUser($sellerSingle["id"]));
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
            $statement = $this->pdo->prepare($query);
            $statement->execute([$seller->first_name, $seller->last_name, $seller->email, $seller->phone]);
            return $this->pdo->lastInsertId();  
        }
        
        public function getProductsCountByUser (int $userId) {
            $query = "SELECT COUNT(sellers.id) AS products_count FROM sellers
                        JOIN products ON products.seller_id = sellers.id
                        WHERE sellers.id = ?
                        GROUP BY sellers.id;";
            $statement = $this->pdo->prepare($query);
            $statement->execute([$userId]); 
            $array = $statement->fetchAll();
            if (count($array)== 0) return 0;
            else {
                return $array[0]['products_count'];
            }
        }
        public function getSoldProductsCountByUser (int $userId) {
            $query = "SELECT COUNT(sellers.id) AS sold_products_count FROM sellers
                        JOIN products ON products.seller_id = sellers.id
                        WHERE sellers.id = ? AND products.sold IS NOT NULL
                        GROUP BY sellers.id;";
            $statement = $this->pdo->prepare($query);
            $statement->execute([$userId]); 
            $array = $statement->fetchAll();
            if (count($array)== 0) return 0;
            else {
                return $array[0]['sold_products_count'];
            }
        }
        public function getSoldProductsTotalPriceByUser (int $userId) {
            $query = "SELECT SUM(products.price) AS sum FROM sellers
                        JOIN products ON sellers.id = products.seller_id
                        WHERE sellers.id = ? AND products.sold IS NOT NULL
                        GROUP BY sellers.id;";
            $statement = $this->pdo->prepare($query);
            $statement->execute([$userId]); 
            $array = $statement->fetchAll();
            if (count($array)== 0) return 0;
            else {
                return (int) $array[0]['sum'];
            }
        }
        public function getAllProductListByUser (int $userId) {
            $query = "SELECT products.id, products.title, sizes.title AS size, categories.title AS category, products.price, products.added, products.sold FROM sellers
                        JOIN products ON sellers.id = products.seller_id
                        JOIN sizes ON sizes.id = products.size_id
                        JOIN categories ON categories.id = products.category_id
                        WHERE sellers.id = ?;";
            $statement = $this->pdo->prepare($query);
            $statement->execute([$userId]); 
            return $statement->fetchAll();
        }
        

}