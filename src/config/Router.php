<?php
namespace Config;

class Router
{

    private $routes = [];

    function add($path, $controller, $action) {
        $this->routes[$path] = [
            "_c" => $controller,
            "_a" => $action
        ];
    }

    private function validateController()
    {
        $route = Request::exists("route");
        if(isset($this->routes[$route]) == false){
            die("route not found");
        }
    }
    
    function run()
    {
        $this->validateController();

        $route = Request::exists("route");

        $current = $this->routes[$route];

        $_c = "Controllers\\$current[_c]";
        $action = $current['_a'];
        $controller = new $_c;

        return Response::parseResponse($controller->$action());
    }

}