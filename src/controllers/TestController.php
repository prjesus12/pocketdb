<?php
namespace Controllers;

use Config\Jwt;
use Config\Randomizer;
use Config\Response;
use Config\SqlBuilder;

class TestController
{
    function index()
    {
        $connectionInfo = array("Database" => "ABC_DATOS", "UID" => "abc", "PWD" => "1234@sqltest", "Encrypt" => false);
        $conn = sqlsrv_connect("74.213.107.126,49164", $connectionInfo);
        
        if(!$conn) {
            die(Response::parseResponse(sqlsrv_errors()));
        }

        $stmt = \sqlsrv_query($conn, "SELECT Nombre FROM ABC_Users");
        $data = [];
        while($row = \sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        if ($conn === false) {
            echo "failed connection";
        }
        return $data;
    }
}