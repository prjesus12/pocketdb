<?php
namespace Config;

class Database {
    static function default():Sqlsrv {
        return new Sqlsrv($_ENV['DB_HOST'], $_ENV['DB_NAME'] , $_ENV['DB_USER'], $_ENV['DB_PASSWORD']);
    }

    function custom($host, $database, $user, $password):Sqlsrv {
        return new Sqlsrv($host, $database , $user, $password);
    }
}