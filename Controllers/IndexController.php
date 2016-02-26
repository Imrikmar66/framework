<?php

class IndexController extends Controller {
   
    function __construct() {
        $this->mainView = "index";
        parent::__construct();
    }
    
    function errorLoadingController() {
        $this->mainView = "index";
    }
    
    function authenticationRequirement() {
        return false;
    }
      
}
