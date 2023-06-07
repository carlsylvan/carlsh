<?php


class Controller {
    private $routes = [];
    private $view = null;
    private $method = "";

    public function __construct($view, $method) {
        $this->view = $view;
        $this->method = $method;
    }

    public function addRoute($route, $model, $method) {
        $this->routes[$route] = ['model' => $model, 'method' => $method];
    }

    public function start($request):void {
        $parts = explode("/", $request);
            foreach ($this->routes as $route => $action) {
            if($this->method == "GET" && trim($route, "/") == $parts[2]) {
                $id = $parts[3] ?? null;
                $model = $action['model'];
                $method = $action['method'];
                $this->handleGetRoute($model, $method, $id);
            }
            else if($this->method == "POST" && trim($route, "/") == $parts[2]) {
                $model = $action['model'];
                $method = $action['method']; 
                var_dump($parts[2]);
                $this->handlePostRoute($model, $method, $parts[2]);
            }
            else if ($this->method == "PUT" && trim($route, "/") == $parts[2]) {
                $id = $parts[3] ?? null;
                $model = $action['model'];
                $method = $action['method'];
                $this->handlePutRoute($model, $method, $id);
            }
        }
        
        // $this->view->outputJson("error");
        // http_response_code(404);
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
        // var_dump($requestData);
            
            switch ($element) {
                case ("addseller"):
                    $first_name = $requestData["first_name"];
                    $last_name = $requestData["last_name"];
                    $email = filter_var($requestData["email"], FILTER_VALIDATE_EMAIL);
                    $phone = filter_var($requestData["phone"], FILTER_SANITIZE_NUMBER_INT);
                    $seller = new Seller($first_name, $last_name, $email, $phone);
                    $id = $model->$method($seller);
                    break;
                    case ("addproduct"):
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
    }
}