<?php
namespace Config;

class Response {
    static function json($data) {
        header("Content-Type: application/json");
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    static function parseResponse($response) {
        if(is_object($response) || is_array($response)) return self::json($response);

        return $response;

    }
}