<?php

class jsonApi {
    public function outputJson(string $single, array $array) {
        $json = [
            "result_count" => count($array),
            "result" => $array
        ];
        header("Content-Type: application/json");
        echo json_encode($json);
    }
}