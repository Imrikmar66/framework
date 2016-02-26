<?php

abstract class Controller {
    
    protected $mainView = "";
    protected $tpl_vars = array();
    protected $html;
    
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
    
    protected function getView($viewName){
        return URI_TEMPLATE.'/'.$viewName.'.tpl';
    }
    
    public static function getController($name){
        $controller = ucfirst($name)."Controller";
        return new $controller();
    }
    
}
