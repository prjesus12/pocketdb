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
        // return Response::parseResponse( $_SERVER);
        $api = explode("api",$_SERVER['REDIRECT_URL']);
        
        $path = $api[1];
        $this->validateRoute($path);

        $current = $this->routes[$path];
        $action = $current['action'];
        $controller = new $current['controller']();
        
        return Response::parseResponse($controller->$action());
    }

}