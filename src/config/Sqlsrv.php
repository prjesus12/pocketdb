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
        sqlsrv_close($this->conn);
        return $data;
    }

    private function run($query){
        $result = \sqlsrv_query($this->conn, $query);
        return $result;
    }

    function create($query) {
        return $this->run($query);
    }

    function update($query) {
        return $this->run($query);
    }

    function delete($query) {
        return $this->run($query);
    }

    function first($query) {
        $stmt = $this->run($query);
       
        if ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            sqlsrv_close($this->conn);
            return (object)$row;
        } else {
            sqlsrv_close($this->conn);
            return [];
        }
        
    }
}