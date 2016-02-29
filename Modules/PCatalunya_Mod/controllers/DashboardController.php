<?php

class DashboardController extends Controller {
    
    function errorLoadingController() {
        $this->mainView = "index";
    }
    
    function authenticationRequirement() {
        return true;
    }
    
    protected function defineMainView() {
        $this->mainView = "dashboard";
    }

}
