<?php
namespace Controllers;
use Config\Jwt;

class TestController {
    function index() {
        $data = ["name" => "Jesus Torres Torres"];
        $token = new Jwt(7391);
        $enc = $token->withPayload($data)->withExpirationTime(1)->encode();

        $dec = $token->verify($enc);
        return [
            "encoded" => $enc,
            "decoded" => $dec
        ];
    }
}