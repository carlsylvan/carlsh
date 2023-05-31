<?php

require 'classes/views/json-api.php';
require './controllers/controller.php';

require 'classes/models/product-model.php';
// require 'classes/views/product-view.php';

require 'classes/models/seller-model.php';
// require 'classes/views/seller-view.php';

$pdo = require 'partials/connect.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$sellerModel = new SellerModel();
// $productModel = new ProuctModel();

$jsonApi = new JsonApi();

$sellerController = new Controller($sellerModel, $jsonApi, "sellers");
$sellerController->start($method, $request);



// $productModel = new ProductModel($pdo);
// $productView = new ProductView();

// $sellerModel = new SellerModel($pdo);
// $sellerView = new SellerView();

// $productView->renderAllProducts($productModel->getAllProducts());

// $sellerView->renderAllSellers($sellerModel->getAllSellers());