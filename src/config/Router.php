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
            die(Response::parseResponse([
                "status" => 404,
                "message" => "Route not found"
            ]));
        }
    }

    function run() {
      
        $this->validateRoute( $_SERVER['PATH_INFO']);

        $current = $this->routes[ $_SERVER['PATH_INFO']];
        $action = $current['action'];
        $controller = new $current['controller']();
        
        return Response::parseResponse($controller->$action());
    }

}