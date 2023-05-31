<?php

require_once './classes/db.php';
require './classes/product.php';


class ProductModel extends DB {

    protected $table = 'products';

    public function getProductClass (array $productArray): array {
        $products = [];
        foreach ($productArray as $productSingle) {
            $product = new Product (
                $productSingle["id"],
                $productSingle["title"],
                $productSingle["description"],
                $productSingle["price"],
                $productSingle["seller_id"],
                $productSingle["category_id"],
                $productSingle["size_id"],
                $productSingle["added"],
                $productSingle["sold"],
                $productSingle["color_id"],
                $productSingle["brand_id"]
            );
            array_push($products, $product);
        }
        return $products;
    }

    public function getAllProducts(): array {
        $query = "SELECT * FROM $this->table ORDER BY $this->table.id ASC ";
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        return $this->getProductClass($statement->fetchAll()) ;   
    }
    public function getSingleProduct(int $id): array {
        $query = "SELECT * FROM $this->table WHERE $this->table.id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->execute([$id]);
        return $this->getProductClass($statement->fetchAll()) ;   
        }
}