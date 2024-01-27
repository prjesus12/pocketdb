<?php
namespace Controllers;
use Config\SQlite;

class Controller {
    protected $db;

    public function __construct() {
        $this->db = SQlite::getInstance();
    }

    function db() : SQlite {
        return $this->db;
    }
}