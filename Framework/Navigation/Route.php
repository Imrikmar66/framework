<?php

class Route {
    
    static $routes = array();
    
    protected $url;
    protected $controller;
    protected $controller_name;
    protected $http_code;
    protected $type;
    protected $GET_params;
    protected $POST_params;
    protected $routeParameters = array();
    
    function __construct($type, $url, $controller_name, $http_code = 200, $setController = true, $GET = array(), $POST = array()) {
        $this->url = $url;
        $this->controller_name = $controller_name;
        if($setController)
            $this->controller = Controller::getController($controller_name);
        $this->http_code = $http_code;
        $this->type = $type;
        $this->GET_params = $GET;
        $this->POST_params = $POST;
        
        $this->parseUrl();
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

    function setController($controller = null) {
        if($controller != null){
            $this->controller = $controller;
        }
        else{
            $this->controller = Controller::getController($this->controller_name);
        }
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
    
    function getRouteParameters() {
        return $this->routeParameters;
    }

    function setRouteParameters($routeParameters) {
        $this->routeParameters = $routeParameters;
    }
    
    function setGET($params){
        $this->GET_params = $params;
        return $this;
    }
    
    function setPOST($params){
        $this->POST_params = $params;
        return $this;
    }
    
    function setParam($param, $filter = ''){
        array_push($this->routeParameters, new RouteParameter($str, $filter));
    }
    
    function using($name, $filter){
        if($param = $this->getParameterByName($name)){
            $param->setFilter($filter);
            return $this;
        }
        else{
            return false;
        }
    }
    
    function getParameterByName($name){
        foreach($this->routeParameters as $parameter){
            if(gettype($parameter) != "object")
                continue;
            if($parameter->getName() == $name)
                return $parameter;
        }
        return false;
    }
    
    function addGET($param){
        array_push($this->GET_params ,$param);
        return $this;
    }
    
    function addPOST($param){
        array_push($this->POST_params ,$param);
        return $this;
    }
    
    function getGET_params(){
        return $this->GET_params;
    }
    
    function getPOST_params(){
        return $this->POST_params;
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
    
    protected function parseUrl(){
        $parsed = explode('/', $this->url);
        foreach($parsed as $str){
            if(strpos($str, '@') === 0){
                array_push($this->routeParameters, new RouteParameter($str));
            }
            else{
                array_push($this->routeParameters, $str);
            }
        }
    }
    
    protected function compareRouteParametersToUrl($routeParameters){

        if(count($routeParameters) != count($this->routeParameters))
            return  false;
        
        foreach($this->routeParameters as $key => $param){
            if(gettype($param) == "string" && gettype($routeParameters[$key]) == "string"){
                if ($param != $routeParameters[$key])
                    return false;
            }
            else if(gettype($param) == "object"){
                if(!$param->test($routeParameters[$key]))
                    return false;
            }
            else
                return false;
        }
        return true;
    }
    
    /* --- Statics --- */
    
    public static function addRoute($type, $url, $controller_name, $http_code = 200){
       $newRoute = new Route($type, $url, $controller_name, $http_code, false);
       array_push(self::$routes, $newRoute);
       return self::$routes[max(array_keys(self::$routes))];
    }
    
    public static function getRoute($send_headers_now = true){
        $requestType = $_SERVER['REQUEST_METHOD'];
        if(!isset($_GET['route']))
            return false;
        
        foreach(self::$routes as $route){
            
            if(!isset($_GET['route']))
                continue;
            
            //check url
            if(!$route->compareRouteParametersToUrl(Route::parseCurrentUrl()))
                continue;
            //check method
            if($route->getType() != $_SERVER['REQUEST_METHOD'])
                continue;
            //check response type
            if($route->getHttp_code() != http_response_code())
                continue;
            //check needed parameters
            $allNeededParams = true;
            
            foreach($route->getGET_params() as $getParam){
                if(!array_key_exists($getParam, $_GET)){
                    $allNeededParams = false;
                    break;
                }     
            }
            
             /* Angular http fix */
            if($requestType == "POST"){
                foreach($_POST as $key => $value){
                    $json_key = json_decode($key);
                    if(json_last_error() == JSON_ERROR_NONE){
                        $_POST = json_decode(file_get_contents("php://input"), true);
                    }
                };
            }
            /* - */
            
            foreach($route->getPOST_params() as $postParam){
                if(!array_key_exists($postParam, $_POST)){
                    $allNeededParams = false;
                    break;
                }     
            }
            if(!$allNeededParams)
                continue;
            
            //Added with controllername variable for loading controller only if needed
            $route->setController();
            //give all routes parameters to controller
            $route->getController()->setRouteParameters($route->getRouteParameters());

            return $route;
        }
        
        return false;
    }
    
    public static function parseCurrentUrl(){
        $parsed = explode('/', $_GET['route']);
        $routeParameters = array();
        foreach($parsed as $str){
            if(strpos($str, '@') === 0){
                array_push($routeParameters, new RouteParameter($str));
            }
            else{
                array_push($routeParameters, $str);
            }
        }

        return $routeParameters;
    }
    
}