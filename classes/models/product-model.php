<?php

require_once './classes/db.php';
require './classes/product.php';


class ProductModel extends DB {

    protected $table = 'products';

    public function getProductClass (array $productArray): array {
        $products = [];
        foreach ($productArray as $productSingle) {
            $product = new Product (
                $productSingle["title"],
                $productSingle["description"],
                $productSingle["price"],
                $productSingle["seller_id"],
                $productSingle["category_id"],
                $productSingle["size_id"],
                $productSingle["color_id"],
                $productSingle["brand_id"],
                $productSingle["added"],
                $productSingle["sold"]
            );
            $product->addId($productSingle["id"]);
            array_push($products, $product);
        }
        return $products;
    }

    public function getProducts($id) {
        if ($id == 0) {
            return $this->getAllProducts();
        } else {
            return $this->getSingleProduct($id);
        }

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

        public function addProduct (Product $product) : string {
            $query = "INSERT INTO `products`(`title`, `description`, `price`, `seller_id`, `category_id`, `size_id`, `color_id`, `brand_id`) VALUES (?,?,?,?,?,?,?,?)";
            $statement = $this->pdo->prepare($query);
            $statement->execute([$product->title, $product->description, $product->price, $product->seller_id, $product->category_id, $product->size_id, $product->color_id, $product->brand_id]);
            return $this->pdo->lastInsertId();  
        }
        
        public function setProductAsSold(int $id){
        $query = "UPDATE $this->table SET sold = NOW() WHERE id = ?";
        $statement = $this->pdo->prepare($query);
        $result = $statement->execute([$id]);

        return $result;
        }
}