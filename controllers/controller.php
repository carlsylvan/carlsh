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
    private function handlePostRoute ($model, $method, $element){
        $requestData = $_POST;
            if($element == "seller") {
                $seller = new Seller (
                    filter_var($requestData["first_name"],FILTER_SANITIZE_SPECIAL_CHARS),
                    filter_var($requestData["last_name"],FILTER_SANITIZE_SPECIAL_CHARS),
                    filter_var(filter_var($requestData["epost"],FILTER_SANITIZE_EMAIL),FILTER_VALIDATE_EMAIL),
                    filter_var($requestData["mobile"],FILTER_SANITIZE_NUMBER_INT)
                );
                $model->$method($seller);
                
            }
            // else if($element == "product") {
            //     $product = new Product (
            //         filter_var($requestData["name"],FILTER_SANITIZE_SPECIAL_CHARS),
            //         filter_var(filter_var($requestData["size_id"],FILTER_SANITIZE_NUMBER_INT),FILTER_VALIDATE_INT),
            //         filter_var(filter_var($requestData["category_id"],FILTER_SANITIZE_NUMBER_INT),FILTER_VALIDATE_INT),
            //         filter_var(filter_var($requestData["price"],FILTER_SANITIZE_NUMBER_INT),FILTER_VALIDATE_INT),
            //         filter_var(filter_var($requestData["seller_id"],FILTER_SANITIZE_NUMBER_INT),FILTER_VALIDATE_INT)
            //     );
            //     $model->$method($product);
            // }
    }
    private function handlePutRoute ($model, $method, ? int $id){
        if($id) {
            $model->$method($id);
        }
    }
}