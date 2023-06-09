<?php

require 'classes/views/json-api.php';
require 'controllers/controller.php';
require 'classes/models/product-model.php';
require 'classes/models/seller-model.php';
$pdo = require 'partials/connect.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];


$sellerModel = new SellerModel();
$productModel = new ProductModel();
$jsonApi = new JsonApi();


$controller = new Controller($jsonApi, $method);

$controller->addRoute("sellers", $sellerModel, 'getAllSellers', "GET");
$controller->addRoute("seller", $sellerModel, "getSingleSeller", "GET");
$controller->addRoute("sellers", $sellerModel, 'addSeller', "POST");

$controller->addRoute("products", $productModel, 'getAllProducts', "GET");
$controller->addRoute("product", $productModel, "getSingleProduct", "GET");
$controller->addRoute("products", $productModel, 'addProduct', "POST");
$controller->addRoute("product", $productModel, 'setProductAsSold', "PUT");


$controller->start($request);