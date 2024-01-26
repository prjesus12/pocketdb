<?php
namespace Controllers;

use Config\Database;
use Config\Jwt;
use Config\Randomizer;
use Config\Response;
use Config\SqlBuilder;
use Config\Sqlsrv;

class TestController
{
    function index()
    {
        $sql = new SqlBuilder();

        $sql->select("*", "ABC_Users");

        return Database::default()->get($sql->build());
    }
}