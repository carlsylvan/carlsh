<?php

class Controller {
    private $routes = [];
    private $view = null;

    public function __construct($view) {
        $this->view = $view;
    }

public function addRoute($route, $model, $method, $requestMethod) {
    $this->routes[$route] = [
        'model' => $model,
        'method' => $method,
        'requestMethod' => $requestMethod
    ];
}

    public function start($requestMethod, $request) {
        $url = parse_url($request, PHP_URL_PATH);
        
        foreach ($this->routes as $route => $action) {
            if (strpos($url, $route) === 7 && $action['requestMethod'] === $requestMethod) {
                $params = trim(substr($url, strlen($route)), '/');
                $paramsArray = explode('/', $params);

                $model = $action['model'];
                $method = $action['method'];

                if ($requestMethod === 'GET') {
                    $this->handleGetRoute($model, $method, $paramsArray);
                } elseif ($requestMethod === 'POST') {
                    $this->handlePostRoute($model, $method, $_POST);
                }

                return;
            }
        }

        $this->view->outputJson('error', 'Route not found');
    }

    private function handleGetRoute($model, $method, $paramsArray) {
        if (count($paramsArray) === 1) {
            $this->view->outputJson($model, $model->$method(0));
        } elseif (count($paramsArray) === 2 && (int)$paramsArray[1] != 0) {
            $this->view->outputJson($model, $model->$method((int)$paramsArray[1]));
        } else {
            $this->view->outputJson('error', 'Invalid route');
        }
    }

    private function handlePostRoute($model, $method, $requestData) {
        $this->view->outputJson($model, $model->$method($requestData));
    }
    
    
}
