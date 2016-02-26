<?php

class DashboardController extends Controller {
   
    function __construct() {
        $this->mainView = "dashboard";
        parent::__construct();
    }
    
    function errorLoadingController() {
        $this->mainView = "index";
    }
    
    function authenticationRequirement() {
        return true;
    }
    
}
