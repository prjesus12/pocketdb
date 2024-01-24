<?php
namespace Controllers;
use Config\Jwt;
use Config\Randomizer;
use Config\SqlBuilder;

class TestController {
    function index() {
        return $_ENV;
    }
}