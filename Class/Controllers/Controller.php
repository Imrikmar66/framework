<?php

abstract class Controller {
    
    protected $mainView = "";
    protected $tpl_vars = array();
    protected $html;
    
    function __construct() {
        if($this->authenticationRequirement()){
            if(Authentication::isAuthentified())
                return true;
            else
                $this->errorLoadingController("Not authentified");
        }
    }
    
    /* ---- Protected ---- */
    protected function getView($viewName){
        return URI_TEMPLATE.'/'.$viewName.'.tpl';
    }
    
    abstract protected function authenticationRequirement();
    abstract protected function errorLoadingController();

    /* ---- Public ---- */
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
        $controller = ucfirst($name)."Controller";
        return new $controller();
    }
    
}
