<?php

class Controller {
    private $model = null;
    private $view = null;

    private $table = "";

    public function __construct($model, $view, $table) {
        $this->model = $model;
        $this->view = $view;
        $this->table = $table;
    }
    private function checkUrl ($request) {
        return explode("/", $request);
    }
    public function start($method, $request)
    {   
        $urlArray = $this->checkUrl($request);
        switch ($request) {
            case ($urlArray[2]==$this->table && count($urlArray)==3):
                if($this->table == "sellers") {
                    $this->view->outputJson($this->table,$this->model->getAllSellers());
                }
                break;
            // case ($urlArray[3] && count($urlArray)==4):
            //     $this->view->outputAll($this->table,$this->model->getOneSeller((int)$urlArray[3]));
            //     break;
        }
    }
}