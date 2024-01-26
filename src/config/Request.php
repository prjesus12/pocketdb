<?php
namespace Config;

class Request {
    static function exists($key) {
        return $_POST[$key] ?? $_GET[$key] ?? die("Missing $key");
    }

    static function if_not_exist_fill($key, $value) {
        return $_POST[$key] ?? $_GET[$key] ?? $value;
    }
}