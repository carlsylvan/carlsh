<?php

class ProductView {

    public function renderAllBooks(array $products): void {
        echo "<h2>Produkter</h2>";
        echo "<ul>";
        foreach ($products as $product) {
            echo "<li>{$product['title']}</li>";
        }
        echo "</ul>";
    }
    
}