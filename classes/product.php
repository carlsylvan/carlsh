<?php

class Product
{
    public int | null $id;
    public string $title;
    public string $description;
    public int $price;
    public int $seller_id;
    public int $category_id;
    public int $size_id;
    public int $color_id;
    public int $brand_id;
    public string | null $added;
    public string | null $sold;

    public function __construct($title, $description, $price, $seller_id, $category_id, $size_id, $color_id, $brand_id, $added, $sold)
    {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->seller_id = $seller_id;
        $this->category_id = $category_id;
        $this->size_id = $size_id;
        $this->color_id = $color_id;
        $this->brand_id = $brand_id;
        $this->added = $added;
        $this->sold = $sold;
    }

    public function addId (int $id) {
        $this->id = $id;
    }
    
}