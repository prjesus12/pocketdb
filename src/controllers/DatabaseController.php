<?php

namespace Controllers;
use Config\Request;
use Config\Response;
use Config\SQlite;
class DatabaseController extends Controller {
    
    function createTable() {
        $table = Request::exists("table");
        $fields = Request::exists("fields");
        
        $this->db()->createTable($table, $fields);

        return [
            "message" => "Table created"
        ];
    }

    function listTables() {
        return $this->db()->raw("SELECT name FROM sqlite_master WHERE type='table' and name != 'sqlite_sequence'");
    }
    

    function dropTable() {
        if(isset($_GET['table']) == false) return "Missing table param";
        
        $this->db()->dropTable($_GET['table']);

        return [
            "message" => "Table droped "
        ];
    }
}