<?php
namespace Controllers;
use Config\Jwt;
use Config\SqlBuilder;

class TestController {
    function index() {
        $sql = new SqlBuilder();

        return [
            "select" => $sql->select("name, age", "users")->where("id = 1")->build(),
            "update" => $sql->update("user", ["name" => "Yisus"])->where("id = 1")->build(),
            "delete" => $sql->delete("user")->where("id = 1")->build(),
            "insert" => $sql->insert("user", ["name" => "Yisus"])->build(),
        ];
    }
}