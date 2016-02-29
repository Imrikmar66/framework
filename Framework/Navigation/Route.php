<?php

class Route {
    
    static $routes = array();
    
    protected $url;
    protected $controller;
    protected $http_code;
    protected $type;
    protected $GET_params;
    protected $POST_params;
    
    function __construct($url, $controller_name, $type = 'GET', $http_code = 200) {
        $this->url = $url;
        $this->controller = Controller::getController($controller_name, $this);
        $this->http_code = $http_code;
        $this->type = $type;
        $this->GET_params = $_GET;
        $this->POST_params = $_POST;
    }
    
    function getUrl() {
        return $this->url;
    }

    function getController() {
        return $this->controller;
    }

    function getHttp_code() {
        return $this->http_code;
    }
    
    function getType(){
        return $this->type;
    }

    function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    function setController($controller) {
        $this->controller = $controller;
        return $this;
    }

    function setHttp_code($http_code) {
        $this->http_code = $http_code;
        return $this;
    }
    
    function setType($type){
        $this->type = $type;
        return $this;
    }
    
    function GET($name){
        if(isset($this->GET_params[$name])){
            return $this->GET_params[$name];
        }
        else{
            return false;
        }
    }
    
    function POST($name){
        if(isset($this->POST_params[$name])){
            return $this->POST_params[$name];
        }
        else{
            return false;
        }
    }
    
    function is404(){
        if($this->http_code == 404)
            return true;
        else
            return false;
    }
    
    function sendHeaders(){
        if(!headers_sent())
            http_response_code($this->http_code);
    }
    
    /* --- Statics --- */
    
    public static function addRoute($url, $controller_name, $type = 'GET', $http_code = 200){
       $newRoute = new Route($url, $controller_name, $type, $http_code);
       array_push(self::$routes, $newRoute);
       return self::$routes[max(array_keys(self::$routes))];
    }
    
    public static function getRoute($url, $send_headers_now = true){
        $requestType = $_SERVER['REQUEST_METHOD'];
        foreach(self::$routes as $route){
            if($route->getUrl() == $url && $route->getType() == $requestType){
                if($send_headers_now)
                    $route->sendHeaders();
                return $route;
            }
        }
        return false;
    }
    
}