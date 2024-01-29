<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
use Config\Router;
require 'vendor/autoload.php';

include './scripts/readEnv.php';

$router = new Router();

echo $router->run();