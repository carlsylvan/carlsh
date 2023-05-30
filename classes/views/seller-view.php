<?php

class SellerView {

    public function renderAllSellers(array $sellers): void {
        echo "<h2>Säljare</h2>";
        echo "<ul>";
        foreach ($sellers as $seller) {
            echo "<li>{$seller['first_name']} {$seller['last_name']} ({$seller['email']}, {$seller['phone']})</li>";
        }
        echo "</ul>";
    }
    
}