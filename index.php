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

$sellerController = new Controller($sellerModel, $jsonApi, "sellers");
$productController = new Controller($productModel, $jsonApi, "products");
$sellerController->start($method, $request);
$productController->start($method, $request);