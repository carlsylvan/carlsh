<?php

require_once './classes/db.php';
require './classes/seller.php';


class SellerModel extends DB {

    protected $table = 'sellers';

    public function getSellerClass (array $sellerArray): array {
        $sellers = [];
        foreach ($sellerArray as $sellerSingle) {
            $product = new Product (
                $sellerSingle["id"],
                $sellerSingle["first_name"],
                $sellerSingle["last_name"],
                $sellerSingle["phone"],
                $sellerSingle["email"],
            );
            array_push($sellers, $seller);
        }
        return $sellers;
    }

    public function getAllSellers(): array {
        return $this->getSellerClass($this->getAll($this->table));
    }
}