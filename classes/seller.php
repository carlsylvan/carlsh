<?php
class Seller {
    public $id = 0;
    public string $first_name = "";
    public string $last_name = "";
    public string $email = "";
    public string $phone = "";

    public $productsCount = [];
    public $soldProductsCount = [];
    public $totalSellingPrice = [];
    public $products = [];


    function __construct(
        $first_name, 
        $last_name, 
        $email, 
        $phone, 
        ) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->phone = $phone;
    }
    public function addId(int $id) {
        $this->id = $id;
    }
    public function addProductCount (int $count) {
        $this->productsCount = $count;
    }
    public function addSoldProductCount (int $count) {
        $this->soldProductsCount = $count;
    }
    public function addTotalSellingPrice (int $totalPrice) {
        $this->totalSellingPrice = $totalPrice;
    }
    public function addProducts (array $products) {
        $this->products = $products;
    }
}