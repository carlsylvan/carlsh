<?php

class Seller {
    public $id = 0;
    public string $first_name = "";
    public string $last_name = "";
    public string $email = "";
    public string $phone = "";

    public  $productsCount = [];
    public  $soldProductsCount = [];
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
}