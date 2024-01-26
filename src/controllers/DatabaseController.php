<?php

namespace Controllers;
use Config\Request;
use Config\Response;
use Config\SQlite;
class DatabaseController {
    private Sqlite $db;
    
    public function __construct() {
        $token = Request::exists("token");
        if($token != $_ENV['ACCESS_TOKEN']){
            die("Invalid Token");
        }
        $this->db = SQlite::getInstance();
    }


    function createTable() {
        $table = Request::exists("table");
        $fields = Request::exists("fields");
        
        $this->db->createTable($table, $fields);

        return [
            "message" => "Table created"
        ];
    }
    

    function dropTable() {
        if(isset($_GET['table']) == false) return "Missing table param";
        
        $this->db->dropTable($_GET['table']);

        return [
            "message" => "Table droped "
        ];
    }
}