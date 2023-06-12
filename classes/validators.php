<?php

class SellerValidator
{
    public function validate($data)
    {
        $errors = [];

        $first_name = trim($data['first_name']);
        $last_name = trim($data['last']);
        $email = trim($data['email']);
        $phone = trim($data['phone']);

        if (strlen($first_name) < 3 || strlen($first_name) > 50) {
            $errors['first_name'] = "First must be between 2 and 50 characters";
        }

        if (strlen($last_name) < 3 || strlen($last_name) > 50) {
            $errors['last_name'] = "Last name must be between 2 and 50 characters";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email";
        }

        if (!preg_match('/^\d{10}$/', $phone)) {
            $errors['phone'] = "Invalid phone number";
        }

        if (!empty($errors)) {
            return $errors;
        }

        $data['first_name'] = $first_name;
        $data['last_name'] = $last_name;
        $data['email'] = $email;
        $data['phone'] = $phone;

        return $data;
    }
}

class ProductValidator
{
    public function validate($data)
    {
        $errors = [];

        $title = trim($data['title']);
        $description = trim($data['description']);
        $price = trim($data['price']);

        if (strlen($title) < 3 || strlen($title) > 50) {
            $errors['title'] = "Title must be between 3 and 50 characters";
        }

        if (strlen($description) < 5 || strlen($description) > 500) {
            $errors['description'] = "Description must be between 5 and 500 characters";
        }

        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = "Invalid price";
        }

        if (!empty($errors)) {
            return $errors;
        }

        $data['title'] = $title;
        $data['description'] = $description;
        $data['price'] = $price;

        return $data;
    }
}