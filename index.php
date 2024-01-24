<?php
use Config\Response;
use Config\Router;
require 'vendor/autoload.php';

include './scripts/readEnv.php';

$router = new Router();

$router->add("/test", "TestController", "index");

echo $router->run();