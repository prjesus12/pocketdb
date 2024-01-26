<?php
namespace Config;

class Router {
    
   

    private function validateController() {
        if(isset($_GET['_c']) == false){
            die("Mising _c parameter");
        }
    }
    private function validateAction() {
        if(isset($_GET['_a']) == false){
            die("Mising _a parameter");
        }
    }

    private function verifyController($class){
        if(class_exists("Controllers\\$class") == false){
            die("Mising controller");
        }
    }
    private function verifyMethod($class, $method){
        if(method_exists("Controllers\\$class", $method) == false){
            die("Mising method");
        }
    }
  

    function run() {
        $this->validateController();
        $this->validateAction();

        $this->verifyController($_GET["_c"]);
        $this->verifyMethod($_GET["_c"], $_GET["_a"]);

        $_c = "Controllers\\$_GET[_c]";
        $action = $_GET['_a'];
        $controller = new $_c;
        
        return Response::parseResponse($controller->$action());
    }

}