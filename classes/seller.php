<?php

class Seller {
    public int $id = 0;
    public string $first_name = "";
    public string $last_name = "";
    public string $phone = "";
    public string $email = "";

    function __construct($id, $first_name, $last_name, $phone, $email) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->phone = $phone;
        $this->email = $email;
    }
}