<?php

require 'classes/models/product-model.php';
require 'classes/views/product-view.php';

require 'classes/models/seller-model.php';
require 'classes/views/seller-view.php';

$pdo = require 'partials/connect.php';



$productModel = new ProductModel($pdo);
$productView = new ProductView();

$sellerModel = new SellerModel($pdo);
$sellerView = new SellerView();

$productView->renderAllProducts($productModel->getAllProducts());

$sellerView->renderAllSellers($sellerModel->getAllSellers());