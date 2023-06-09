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
            
            switch ($element) {
                case ("sellers"):
                    $first_name = $requestData["first_name"];
                    $last_name = $requestData["last_name"];
                    $email = filter_var($requestData["email"], FILTER_VALIDATE_EMAIL);
                    $phone = filter_var($requestData["phone"], FILTER_SANITIZE_NUMBER_INT);
                    $seller = new Seller($first_name, $last_name, $email, $phone);
                    $id = $model->$method($seller);
                    break;
                    case ("products"):
                        $title = $requestData["title"];
                        $description = $requestData["description"];
                        $price = filter_var($requestData["price"], FILTER_VALIDATE_INT);
                        $seller_id = filter_var($requestData["seller_id"], FILTER_VALIDATE_INT);
                        $category_id = filter_var($requestData["category_id"], FILTER_VALIDATE_INT);
                        $size_id = filter_var($requestData["size_id"], FILTER_VALIDATE_INT);
                        $color_id = filter_var($requestData["color_id"], FILTER_VALIDATE_INT);
                        $brand_id = filter_var($requestData["brand_id"], FILTER_VALIDATE_INT);
                        $added = null;
                        $sold = null;
                        $product = new Product($title, $description, $price, $seller_id, $category_id, $size_id, $color_id, $brand_id, $added, $sold);
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