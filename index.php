<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
use Config\Router;
require 'vendor/autoload.php';

include './scripts/readEnv.php';

$router = new Router();

$router->add("listTables", "DatabaseController", "listTables");
$router->add("createTable", "DatabaseController", "createTable");
$router->add("dropTable", "DatabaseController", "dropTable");

$router->add("select", "QueryController", "select");
$router->add("insert", "QueryController", "insert");
$router->add("update", "QueryController", "update");

echo $router->run();