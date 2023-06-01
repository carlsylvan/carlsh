<?php

class JsonApi {
    public function outputJson($model, $method) {
        $json = [
            "result_count" => count($method),
            "result" => $method
        ];
        header("Content-Type: application/json");
        echo json_encode($json);
    }
}