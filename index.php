<?php

require 'classes/models/product-model.php';
require 'classes/views/product-view.php';
$pdo = require 'partials/connect.php';



$productModel = new ProductModel($pdo);
$productView = new ProductView();

$productView->renderAllProducts($productModel->getAllProducts());