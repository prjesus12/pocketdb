<?php
namespace Config;

class Sqlsrv {
    private $conn;
    public function __construct($host, $database, $user, $password) {
        $connectionInfo = array("Database" => $database, "UID" => $user, "PWD" => $password, "Encrypt" => false, "CharacterSet" => "UTF-8");
        $conn = sqlsrv_connect($host, $connectionInfo);
        if(!$conn) {
            die(Response::parseResponse(sqlsrv_errors()));
        }

        $this->conn = $conn;
        
    }

    function get($query) {
        $stmt = \sqlsrv_query($this->conn, $query);
        $data = [];
        while($row = \sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            $data[] = $row;
        }
        return $data;
    }
    function first($query) {
        $stmt = \sqlsrv_query($this->conn, $query);

        return sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    }
}