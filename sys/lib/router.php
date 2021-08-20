<?php

namespace sys\lib;

require_once('sys/config/segments.php');

class Router {

    private $controllerName;
    private $actionName;
    private $paramValue;

    public function __construct() {
        $this->controllerName = 'home';
        $this->actionName = 'index';
        $this->paramValue = '';
        //echo('<h3>Router - OK!</h3>');
        $this->parse_uri();
    }

    private function parse_uri() {
        $uri = $_SERVER['REQUEST_URI'];
        $uriParts = explode('/', $uri);
        $corr = ADDITIONAL_SEGMENTS;
        //
        if ($uriParts[2 + $corr] !== '') {
            $this->controllerName = $uriParts[2 + $corr];
        }
        //
        if (count($uriParts) > 3 + $corr) {
            $this->actionName = $uriParts[3 + $corr];
        }
        //
        if (count($uriParts) > 4 + $corr) {
            $this->paramValue = $uriParts[4 + $corr];
        }
        //
        /*
        echo("<h3>uri: $uri</h3>");
        echo('<pre>');
        print_r($uriParts);
        echo('</pre>');

        echo("<br>controllerName = $this->controllerName");
        echo("<br>actionName = $this->actionName");
        echo("<br>paramValue = $this->paramValue");
        */
    }

    private function define_controller_class() {
        return 'app\\controllers\\'.ucfirst($this->controllerName);
    }

    private function call_page_404() {
        $this->controllerName = 'errors';
        $controllerClass = $this->define_controller_class();
        $controller = new $controllerClass;
        $controller->notfound();
    }

    public function run() {
        //echo('<h3>run - OK!</h3>');
        $controllerClass = $this->define_controller_class();
        //echo("<h3>controllerClass - $controllerClass</h3>");
        //
        if (!class_exists($controllerClass)) {
            $this->call_page_404();
        } else {
            //
            $controller = new $controllerClass;
            if (!method_exists($controller, $this->actionName)) {
                $this->call_page_404();
            } else {
                //
                $action = $this->actionName;
                if ($this->paramValue !== '') {
                    $param = $this->paramValue;
                    $controller->$action($param);
                } else {
                    $controller->$action();
                }
            }
        }
    }
}