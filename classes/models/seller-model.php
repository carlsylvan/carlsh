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
            // $seller->addCreatingDate($element["creating_date"]);
            // $seller->addProductCount($this->getProductsCountByUser($element['id']));
            // $seller->addSoldProductCount($this->getSoldProductsCountByUser($element['id']));
            // $seller->addTotalSellingPrice($this->getSoldProductsTotalPriceByUser($element['id']));
            // $seller->addProducts($this->getAllProductListByUser($element['id']));
            array_push($sellers, $seller);
        }
        return $sellers;
    }
    public function getAllSellers () : array {
        $query = "SELECT * FROM $this->table ORDER BY $this->table.last_name ASC ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $this->convertToSellerClass($stmt->fetchAll()) ;   
    }
    public function getSingleSeller (int $id) : array {
        $query = "SELECT * FROM $this->table WHERE $this->table.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $this->convertToSellerClass($stmt->fetchAll()) ;   
        }
    // public function addSeller ($fn, $ln, $epost, $mobile) : void {
    //     $query = "INSERT INTO `sellers`(`first_name`, `last_name`, `epost`, `mobile`, `creating_date`) VALUES (?,?,?,?, CURRENT_DATE())";
    //     $stmt = $this->pdo->prepare($query);
    //     $stmt->execute([$fn, $ln, $epost, $mobile]);   
    // }
    public function addSeller (Seller $seller) : void {
        $query = "INSERT INTO `sellers`(`first_name`, `last_name`, `epost`, `mobile') VALUES (?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$seller->first_name, $seller->last_name, $seller->email, $seller->phone]);  
    }
    public function getProductsCountByUser (int $userId) {
        $query = "SELECT COUNT(s.id) AS products_count FROM sellers AS s
                    JOIN products AS p ON p.seller_id = s.id
                    WHERE s.id = ?
                    GROUP BY s.id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$userId]); 
        $array = $stmt->fetchAll();
        if (count($array)== 0) return 0;
        else {
            return $array[0]['products_count'];
        }
    }
    public function getSoldProductsCountByUser (int $userId) {
        $query = "SELECT COUNT(s.id) AS sold_products_count FROM sellers AS s
                    JOIN products AS p ON p.seller_id = s.id
                    WHERE s.id = ? AND p.selling_date IS NOT NULL
                    GROUP BY s.id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$userId]); 
        $array = $stmt->fetchAll();
        if (count($array)== 0) return 0;
        else {
            return $array[0]['sold_products_count'];
        }
    }
    public function getSoldProductsTotalPriceByUser (int $userId) {
        $query = "SELECT SUM(products.price) AS total_price FROM sellers
                    JOIN products ON sellers.id = products.seller_id
                    WHERE sellers.id = ? AND products.selling_date IS NOT NULL
                    GROUP BY sellers.id;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$userId]); 
        $array = $stmt->fetchAll();
        if (count($array)== 0) return 0;
        else {
            return (int) $array[0]['total_price'];
        }
    }
    public function getAllProductListByUser (int $userId) {
        $query = "SELECT products.id, products.name, sizes.name AS size, categories.name AS category, products.price, products.creating_date, products.selling_date FROM sellers
                    JOIN products ON sellers.id = products.seller_id
                    JOIN sizes ON sizes.id = products.size_id
                    JOIN categories ON categories.id = products.category_id
                    WHERE sellers.id = ?;";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$userId]); 
        return $stmt->fetchAll();
    }
}