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

    public function start($request) {
        $urlExplode = explode("/", $request);
            $end = $urlExplode[2];
            foreach ($this->routes as $route => $action) {
            if($this->method == "GET" && trim($route, "/") == $urlExplode[2]) {
                $model = $action['model'];
                $method = $action['method'];
                $this->handleGetRoute($model, $method, $urlExplode);
            }
            else if($this->method == "POST" && trim($route, "/") == $urlExplode[2]) {
                $model = $action['model'];
                $method = $action['method']; 
                $this->handlePostRoute($model, $method, $urlExplode);
            }
            else if($this->method == "PUT" && trim($route, "/") == $urlExplode[2] . "/" . $urlExplode[3]) {
                $model = $action['model'];
                $method = $action['method'];
                $this->handlePutRoute($model, $method, $urlExplode[4]);
            }
        }
        
        // $this->view->outputJson("error");
    }
    
    private function handleGetRoute($model, $method, $urlExplode) {
        $id = null;
        if (isset($urlExplode[3])) {
            $id = (int) $urlExplode[3];
        }
    
        if ($id) {
            $this->view->outputJson($model->$method($id));
        } else {
            $this->view->outputJson($model->$method());
        }
    }
    private function handlePostRoute($model, $method, $element)
    {
        $requestData = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

        if (isset(
            $_POST["first_name"],
            $_POST["last_name"],
            $_POST["email"],
            $_POST["phone"]
        ) || isset(
            $_POST["title"],
            $_POST["description"],
            $_POST["price"],
            $_POST["seller_id"],
            $_POST["category_id"],
            $_POST["size_id"],
            $_POST["color_id"],
            $_POST["brand_id"]
        )) {
            switch ($element) {
                case ("seller"):
                    $first_name = $requestData["first_name"];
                    $last_name = $requestData["last_name"];
                    $email = filter_var($requestData["email"], FILTER_VALIDATE_EMAIL);
                    $phone = filter_var($requestData["phone"], FILTER_SANITIZE_NUMBER_INT);
                    $seller = new Seller($first_name, $last_name, $email, $phone);
                    $id = $model->$method($seller);
                    break;
                    case ("product"):
                        $title = $requestData["title"];
                        $description = $requestData["description"];
                        $price = filter_var($requestData["price"], FILTER_VALIDATE_INT);
                        $seller_id = filter_var($requestData["seller_id"], FILTER_VALIDATE_INT);
                        $category_id = filter_var($requestData["category_id"], FILTER_VALIDATE_INT);
                        $size_id = filter_var($requestData["size_id"], FILTER_VALIDATE_INT);
                        $color_id = filter_var($requestData["color_id"], FILTER_VALIDATE_INT);
                        $brand_id = filter_var($requestData["brand_id"], FILTER_VALIDATE_INT);
                        $product = new Product($title, $description, $price, $seller_id, $category_id, $size_id, $color_id, $brand_id);
                        $id = $model->$method($product);
                        break;
                }
            http_response_code(201);
            echo json_encode([
                "message" => "Added",
                "id" => $id
            ]);
        }
    }
    private function handlePutRoute ($model, $method, ? int $id){
        if($id) {
            $model->$method($id);
        }
    }
}