<?php

class ProductView {

    public function renderAllProducts(array $products): void {
        echo "<h2>Produkter</h2>";
        echo "<ul>";
        foreach ($products as $product) {
            echo "<li>{$product['title']}</li>";
            echo "<p>{$product['description']}</p>";
            echo "<p>{$product['price']} kr</p>";
        }
        echo "</ul>";
    }
    
}