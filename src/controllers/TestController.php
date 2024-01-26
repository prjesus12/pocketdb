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

        $sql->select("*", "Company_iGas");

        $f = Database::default()->first($sql->build());

        $db = Database::custom($f->Instancia, $f->Base_Datos, $f->Instancia_user, $f->Instancia_pass);

        return $db->get((new SqlBuilder())->select("Nombre", "Pueblos")->build());
    }
}