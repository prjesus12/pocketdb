<?php
namespace Config;

class Response {
    static function json($data) {
        header("Content-Type: application/json");
        return json_encode($data, JSON_PRETTY_PRINT);
    }
}