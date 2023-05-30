<?php

require_once './classes/db.php';

class SellerModel extends DB {

    protected $table = 'sellers';

    public function getAllSellers() {
        return $this->getAll($this->table);
    }
}