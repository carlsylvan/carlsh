<?php

class Product
{
    // Add the new properties
    public int | null $id;
    public $title;
    public $description;
    public $price;
    public $seller_id;
    public $category_id;
    public $size_id;
    public $color_id;
    public $brand_id;
    public $added;
    public $sold;

    public function __construct($title, $description, $price, $seller_id, $category_id, $size_id, $color_id, $brand_id)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->seller_id = $seller_id;
        $this->category_id = $category_id;
        $this->size_id = $size_id;
        $this->color_id = $color_id;
        $this->brand_id = $brand_id;
        $this->added = null; // Will be auto-generated in MySQL
        $this->sold = null; // Defaults to null
    }

    public function addId (int $id) {
        $this->id = $id;
    }
    
}