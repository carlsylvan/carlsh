<?php

require_once './classes/db.php';

class ProductModel extends DB {

    protected $table = 'products';

    public function getAllProducts() {
        return $this->getAll($this->table);
    }
}