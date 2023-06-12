<?php

class JsonApi {
    public function outputJson($input)
    {
        if ($input == "error") {
            http_response_code(404);
            echo json_encode(["error" => "Route not found"]);
        } else {
            http_response_code(200);
            $json = [
                "result_count" => count($input),
                "result" => $input
            ];
            header("Content-Type: application/json");
            echo json_encode($json);
        }
    }
}