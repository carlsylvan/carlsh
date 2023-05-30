<?php

require_once './classes/db.php';

class ProductModel extends DB {

    protected $table = 'sellers';

    public function getAllSellers() {
        return $this->getAll($this->table);
    }
}