<?php

class Controller {
    private $routes = [];
    private $view = null;

    public function __construct($view) {
        $this->view = $view;
    }

    public function addRoute($route, $model, $method) {
        $this->routes[$route] = ['model' => $model, 'method' => $method];
    }

    public function start($method, $request) {
        $url = parse_url($request, PHP_URL_PATH);
        foreach ($this->routes as $route => $action) {
            
            if (strpos($url, $route) === 7) {
        
                $params = trim(substr($url, strlen($route)), '/');
                $paramsArray = explode('/', $params);
    
                $model = $action['model'];
                $method = $action['method'];
    
                $this->handleRoute($model, $method, $paramsArray);
                return;
            }
        }
        $this->view->outputJson('error', 'Route not found');
    }

    private function handleRoute($model, $method, $paramsArray) {
        if (count($paramsArray) === 1) {
            $this->view->outputJson($model, $model->$method(0));
        } elseif (count($paramsArray) === 2 && (int)$paramsArray[1] != 0) {
            $this->view->outputJson($model, $model->$method((int)$paramsArray[1]));
        } else {
            $this->view->outputJson('error', 'Invalid route');
        }
    }
}
