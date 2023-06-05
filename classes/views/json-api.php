<?php

class JsonApi {
    public function outputJson ($input) {
        if($input== "error") {
            echo "Route is not found";
        }
        else {
            $json = [            
                "result_count" => count($input),
                "result" => $input
            ];
            header("Content-Type: application/json");
            echo json_encode($json);
        }
    }
}