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

$controller->addRoute("/sellers", $sellerModel, 'getAllSellers');
$controller->addRoute("/seller", $sellerModel, "getSingleSeller");
$controller->addRoute("/addseller", $sellerModel, 'addSeller');

$controller->addRoute("/products", $productModel, 'getAllProducts');
$controller->addRoute("/product", $productModel, "getSingleProduct");
$controller->addRoute("/addproduct", $productModel, 'addProduct');
$controller->addRoute("/sellproduct", $productModel, 'setProductAsSold');


$controller->start($request);