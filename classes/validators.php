<?php

class SellerValidator
{
    public function validate($data)
    {
        $errors = [];

        $data['first_name'] = filter_var(trim($data['first_name']), FILTER_SANITIZE_SPECIAL_CHARS);
        $data['last_name'] = filter_var(trim($data['last_name']), FILTER_SANITIZE_SPECIAL_CHARS);
        $data['email'] = filter_var(trim($data['email']), FILTER_SANITIZE_EMAIL);
        $data['phone'] = filter_var(trim($data['phone']), FILTER_SANITIZE_NUMBER_INT);

        if (strlen($data['first_name']) < 3 || strlen($data['first_name']) > 50) {
            $errors['first_name'] = "First name must be between 2 and 50 characters";
        }

        if (strlen($data['last_name']) < 3 || strlen($data['last_name']) > 50) {
            $errors['last_name'] = "Last name must be between 2 and 50 characters";
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email";
        }
        
        $pattern = '/^[0-9]{10}+$/';

        if (!preg_match($pattern, $data['phone'])) {
            $errors['phone'] = "Invalid phone number";
        }

        return $errors;
    }
}

class ProductValidator
{
    public function validate($data)
    {
        $errors = [];

        $title = filter_var(trim($data['title'] ?? ''), FILTER_SANITIZE_SPECIAL_CHARS);
        $description = filter_var(trim($data['description'] ?? ''), FILTER_SANITIZE_SPECIAL_CHARS);
        $price = filter_var(trim($data['price'] ?? '0'), FILTER_SANITIZE_NUMBER_FLOAT);

        if (strlen($title) < 3 || strlen($title) > 50) {
            $errors['title'] = "Title must be between 3 and 50 characters";
        }

        if (strlen($description) < 5 || strlen($description) > 500) {
            $errors['description'] = "Description must be between 5 and 500 characters";
        }

        if (!is_numeric($price) || $price < 0) {
            $errors['price'] = "Invalid price";
        }

        return $errors;
    }
}