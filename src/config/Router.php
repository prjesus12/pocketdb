<?php
namespace Config;

class Router {
    private $routes = [];

    function add($path, $controller, $action) {
        $this->routes[$path] = [
            "controller" => "Controllers\\$controller",
            "action" => $action
        ];
    }

    private function validateRoute($path) {
        if(isset($this->routes[$path]) == false){
            throw new \Exception("404 missing route", 0);
        }
    }

    function run() {
        $path = $_SERVER['PATH_INFO'];

        $this->validateRoute($path);

        $current = $this->routes[$path];
        $action = $current['action'];
        $controller = new $current['controller']();
        
        return Response::parseResponse($controller->$action());
    }

}