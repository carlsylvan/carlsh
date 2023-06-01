<?php

require 'classes/views/json-api.php';
require 'controllers/controller.php';
require 'classes/models/product-model.php';
require 'classes/models/seller-model.php';
$pdo = require 'partials/connect.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$jsonApi = new JsonApi();
$controller = new Controller($jsonApi);

$controller->addRoute('/sellers', new SellerModel(), 'getAllSellers');
$controller->addRoute('/sellers/', new SellerModel(), 'getSingleSeller');
$controller->addRoute('/products', new ProductModel(), 'getAllProducts');
$controller->addRoute('/products/', new ProductModel(), 'getSingleProduct');

$controller->start($method, $request);