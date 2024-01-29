<?php
namespace Config;

class Router
{

    private $routes = [];

    function add($path, $controller, $action, $middleware = null)
    {
        $this->routes[$path] = [
            "_c" => $controller,
            "_a" => $action,
            "middleware" => $middleware
        ];
    }

    private function validateController()
    {
        $route = Request::exists("route");
        if (isset($this->routes[$route]) == false) {
            die("route not found");
        }
    }

    private function middleware($route)
    {
        if (is_string($route['middleware'])) {

            $r = "
                use Config\Middleware;
                Middleware::$route[middleware]();
            ";

            eval($r);
        }
        if (is_array($route['middleware'])) {

            foreach ($route['middleware'] as $key => $value) {
                $r = "
                    use Config\Middleware;
                    Middleware::$value();
                ";

                eval($r);
            }
        }
    }

    function run()
    {
        $this->validateController();

        $route = Request::exists("route");

        $current = $this->routes[$route];

        $this->middleware($current);

        $_c = "Controllers\\$current[_c]";
        $action = $current['_a'];
        $controller = new $_c;

        return Response::parseResponse($controller->$action());
    }

}