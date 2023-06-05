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

$controller->addRoute('/sellers', new SellerModel(), 'getSellers', 'GET');
$controller->addRoute('/products', new ProductModel(), 'getProducts', 'GET');

$controller->addRoute('/sellers', new SellerModel(), 'addSeller', 'POST');



$controller->start($method, $request);