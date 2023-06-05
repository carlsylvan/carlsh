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
$controller->addRoute("/seller/add", $sellerModel, 'addSeller');

$controller->addRoute("/products", $productModel, 'getAllProducts');
$controller->addRoute("/product", $productModel, "getSingleProduct");
$controller->addRoute("/product/add", $productModel, 'addProduct');

$controller->start($request);