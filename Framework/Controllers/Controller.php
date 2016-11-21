<?php

abstract class Controller {
    
    protected $mainView = "";
    protected $tpl_vars = array();
    protected $html;
    protected $GET_params;
    protected $POST_params;
    protected $responseType;
    protected $responseCode;
    protected $responseContentType;
    protected $main;
    
    function __construct() {
        $this->GET_params = $_GET;
        $this->POST_params = $_POST;
        $this->responseType = $_SERVER['REQUEST_METHOD'];
        $this->responseCode = $this->initResponseCode();
        $this->responseContentType = $this->initResponseContentType();

        $this->initModule();
        
        $this->defineMainView();
        
    }
    
    /* ---- Protected ---- */
    protected function getView($viewName){
        //Get view from module caller
        $reflector = new ReflectionClass(get_class($this));
        $path = dirname(dirname($reflector->getFileName()));
        $view =  $path.'/view/'.$viewName.'.tpl';
        if(file_exists($view))
            return $view;
        else
            return URI_TEMPLATE.'/'.$viewName.'.tpl';
    }
    
    protected function GET($name){
        if(isset($this->GET_params[$name])){
            return $this->GET_params[$name];
        }
        else{
            return false;
        }
    }
    
    protected function POST($name){
        if(isset($this->POST_params[$name])){
            return $this->POST_params[$name];
        }
        else{
            return false;
        }
    }
    
    protected function isGET(){
        return $this->responseType == 'GET' ? true : false;
    }
    
    protected function isPOST(){
        return $this->responseType == 'POST' ? true : false;
    }
    
    protected function isPUT(){
        return $this->responseType == 'PUT' ? true : false;
    }
    
    protected function isDELETE(){
        return $this->responseType == 'DELETE' ? true : false;
    }
    
    protected function initResponseCode(){
        return 200;
    }
    
    protected function initResponseContentType(){
        return "text/html";
    }
    
    protected function setResponseCode($code){
        $this->responseCode = $code;
    }
    
    protected function setResponseContentType($contentType){
        $this->responseContentType = $contentType;
    }
    
    public function setRouteParameters($params){
        $parsed = explode('/', $_GET['route']);
        foreach($params as $key => $param){
            if(gettype($param) == 'object'){
                $name = $param->getName();
                $this->$name = $parsed[$key];
            }
        }
    }
    
    protected function getRouteParam($name){
        if(isset($this->$name))
            return $this->$name;
        else
            return false;
    }
    
    protected function tplVar($name, $value){
        $this->tpl_vars[$name] = $value;
    }
    
    protected function arrTplVar($array){
        $this->tpl_vars = array_merge($this->tpl_vars, $array);
    }
    
    protected function sendHeaders(){
        if(!headers_sent()){
            http_response_code($this->responseCode);
            header("Content-Type: ".$this->responseContentType);
        }
    }
    
    //Autoload classes of controller module - rewrite for custom classes loading
    protected function initModule(){
        $reflector = new ReflectionClass(get_class($this));
        $path = dirname(dirname($reflector->getFileName()));
        if(strpos($path, 'Modules') !== FALSE)
            Context::loadClassesFromModule($path);
    }
    
    protected function getModulePath() {
        $reflector = new ReflectionClass(get_class($this));
        $path = dirname(dirname($reflector->getFileName()));
        if(strpos($path, 'Modules') !== FALSE)
            return $path;
        else
            return false;
    }
    
    protected function getModuleUrl() {
        $reflector = new ReflectionClass(get_class($this));
        $path = dirname(dirname($reflector->getFileName()));
        if(strpos($path, 'Modules') !== FALSE)
            return URL_MOD.'/'.basename($path);
        else
            return false;
    }
    
    abstract protected function defineMainView();
    abstract protected function authenticationRequirement();
    abstract protected function errorLoadingController();

    /* ---- Public ---- */
    public function callMain(){
        $main = $this->main;
        $this->$main();
    }
    public function beforeMain(){
        if($this->authenticationRequirement()){
            if(!Authentication::isAuthentified()){
                $this->errorLoadingController();}
        }
        //send headers response
        $this->sendHeaders();
    }
    public function main(){
        //send globals uri for internal loadings
        $assets = $this->getModulePath();
        if($assets){
            $assets .= '/assets';
            if(file_exists($assets))
                $assets = $this->getModuleUrl().'/assets';
            else
                $assets = URL_RESSOURCES;
        }
        else
            $assets = URL_RESSOURCES;
        
        $this->arrTplVar(
            array(
                'URL_RESSOURCES' => URL_RESSOURCES,
                'URL_FOLDER' => URL_FOLDER,
                'Routes' => RoutesManager::getRoutesManager()
                'URL_ASSETS' => $assets
            )
        );
        
        //display mainView
        $this->displayView();
    }
    
    public function loadView($view){
        $smarty = new Smarty();
        $template = $this->getView($view);
        $smarty->assign($this->tpl_vars);
        $this->html = $smarty->fetch($template);  
    }
    
    public function displayView($view = null){
        if($view === null)
            $view = $this->mainView;
       
        $this->loadView($view);
        echo $this->html;
    }
    
    /* --- static ---- */
    public static function getController($name){
        $controller_parts = explode('::', $name);
        if(count($controller_parts) > 2){
            throw new Exception("Incorrect number of function defined in controller ".$name);
            return;
        }
        else if(count($controller_parts) > 1){
            $controller_call = $controller_parts[1];
        }
        else{
            $controller_call = "main";
        }
        $controller_name = $controller_parts[0];
        
        
        $controller = ucfirst($controller_name)."Controller";
        if(class_exists($controller)){
            $the_controller = new $controller();
            if(method_exists($the_controller, $controller_call))
                $the_controller->main = $controller_call;
            else{
                $the_controller->main = "main";
                if(MODE_DEV){
                    trigger_error("Method ".$controller_call." does not exist in controller ".$controller.". Method is replaced by main() method");
                }
            }
            return $the_controller;
        }
        else{
            if(MODE_DEV){    
                throw new Exception("Controller ".$controller." does not exist");
            }
            else{
                return new Controller404();
            }
        }
    }
    
    
}
