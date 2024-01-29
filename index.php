<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
use Config\Router;
require 'vendor/autoload.php';

include './scripts/readEnv.php';

$router = new Router();

$router->add("listTables", "DatabaseController", "listTables", ["auth"]);
$router->add("createTable", "DatabaseController", "createTable", ["auth"]);
$router->add("dropTable", "DatabaseController", "dropTable", ["auth"]);

$router->add("select", "QueryController", "select");
$router->add("insert", "QueryController", "insert");
$router->add("update", "QueryController", "update");

echo $router->run();