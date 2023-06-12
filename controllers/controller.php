<?php

class Controller
{
    private $routes = [];
    private $view = null;
    private $method = "";

    public function __construct($view, $method)
    {
        $this->view = $view;
        $this->method = $method;
    }

    public function addRoute($route, $model, $method, $requestType)
    {
        if (!isset($this->routes[$route])) {
            $this->routes[$route] = [];
        }
        $this->routes[$route][$requestType] = ['model' => $model, 'method' => $method];
    }

    public function start($request): void
    {
        $parts = explode("/", $request);
        $matchedRoute = null;
        $routeKey = trim($parts[2], "/");
        if (isset($this->routes[$routeKey]) && isset($this->routes[$routeKey][$this->method])) {
            $matchedRoute = $this->routes[$routeKey][$this->method];
        }

        if ($matchedRoute) {
            $id = $parts[3] ?? null;
            $model = $matchedRoute['model'];
            $method = $matchedRoute['method'];

            switch ($this->method) {
                case 'GET':
                    $this->handleGetRoute($model, $method, $id);
                    break;
                case 'POST':
                    $this->handlePostRoute($model, $method, $parts[2]);
                    break;
                case 'PUT':
                    $this->handlePutRoute($model, $method, $id);
                    break;
                default:
                    http_response_code(405);
                    $this->view->outputJson(['error' => 'Method not allowed']);
                    break;
            }
        } else {
            http_response_code(404);
            $this->view->outputJson(['error' => 'Route not found']);
        }
    }
    
    private function handleGetRoute($model, $method, ? int $id) {
        if ( $id) {
            $this->view->outputJson($model->$method($id));
        } else {
            $this->view->outputJson($model->$method());
        } 
    }
    private function handlePostRoute($model, $method, $element) {
        $data = file_get_contents('php://input');
        $requestData = json_decode($data, true);
        $id = null;
    
        $sellerValidator = new SellerValidator();
        $productValidator = new ProductValidator();
    
        switch ($element) {
            case ("sellers"):
                $sellerData = [
                    'name' => $requestData['first_name'] . ' ' . $requestData['last_name'],
                    'email' => $requestData['email'],
                    'phone' => $requestData['phone'],
                ];
    
                $validationResult = $sellerValidator->validate($sellerData);
    
                if (is_array($validationResult)) {
                    http_response_code(400);
                    echo json_encode(['errors' => $validationResult]);
                    return;
                }
    
                $seller = new Seller($requestData["first_name"], $requestData["last_name"], $requestData["email"], $requestData["phone"]);
                $id = $model->$method($seller);
                break;
    
            case ("products"):
                $productData = [
                    'name' => $requestData['title'],
                    'description' => $requestData['description'],
                    'price' => $requestData['price'],
                ];
    
                $validationResult = $productValidator->validate($productData);
    
                if (is_array($validationResult)) {
                    http_response_code(400);
                    echo json_encode(['errors' => $validationResult]);
                    return;
                }
    
                $product = new Product($requestData["title"], $requestData["description"], $requestData["price"], $requestData["seller_id"], $requestData["category_id"], $requestData["size_id"], $requestData["color_id"], $requestData["brand_id"], null, null);
                $id = $model->$method($product);
                break;
        }
    
        http_response_code(201);
        echo json_encode([
            "message" => "New data has been added",
            "id" => $id
        ]);
    }
    private function handlePutRoute ($model, $method, ? int $id){
        if($id) {
            $model->$method($id);
        }
        echo json_encode([
            "message" => "Product set as sold",
            "id" => $id
        ]);
    }
}