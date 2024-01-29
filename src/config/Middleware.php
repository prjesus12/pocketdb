<?php

namespace Config;

class Middleware {

  
    static function auth() {
        $t = Request::exists("token");
        if($t != $_ENV['ACCESS_TOKEN']){
            die("Invalid token");
        }
    }

    static function test() {
        echo 'test';
    }
}