<?php

use Config\Router;
require 'vendor/autoload.php';

include './scripts/readEnv.php';

$router = new Router();

echo $router->run();