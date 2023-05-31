<?php

class Product {
    public int $id = 0;
    public string $title = "";
    public string $description = "";
    public int $price = 0;
    public int $seller_id = 0;
    public int $category_id = 0;
    public int $size_id = 0;
    public string $added = "";
    public string | null $sold = "";
    public int $color_id = 0;
    public int $brand_id = 0;

    function __construct($id, $title, $description, $price, $seller_id, $category_id, $size_id, $added, $sold, $color_id, $brand_id) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->seller_id = $seller_id;
        $this->category_id = $category_id;
        $this->size_id = $size_id;
        $this->added = $added;
        $this->sold = $sold;
        $this->color_id = $color_id;
        $this->brand_id = $brand_id;
    }
}