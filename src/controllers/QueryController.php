<?php
namespace Controllers;
use Config\Request;
use Config\SqlBuilder;
use Config\SQlite;
use Config\Response;
class QueryController {
    private $db;
    public function __construct() {
        $this->db = SQlite::getInstance();
    }
    function select() {
        $cols = Request::if_not_exist_fill("columns", "*");
        $table = Request::exists("table");
        $where = Request::if_not_exist_fill("where", "");
        $join = Request::if_not_exist_fill("join", "");
        $left_join = Request::if_not_exist_fill("left_join", "");
        $group_by = Request::if_not_exist_fill("group_by", "");

        $sq = new SqlBuilder();

        $sq->select($cols, $table);

        if($join != '') {
            $sq->append(" join " . $join);
        }
        
        if($left_join != '') {
            $sq->append(" left join " . $left_join);
        }

        if($where != '') {
            $sq->where($where);
        }
        
        if($group_by != '') {
            $sq->append(" GROUP BY ". $group_by);
        }

        return $this->db->raw($sq->build());
    }

    function update() {
        $table = Request::exists("table");
        $where = Request::exists("where");

        if(isset($_POST['where'])){
            unset($_POST['where']);
        }
        

        return $this->db->update($table, $_POST, $where);
        
    }
}