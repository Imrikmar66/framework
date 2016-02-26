<?php

class DashboardController extends Controller {
   
    private $mainView = "dashboard";
    
    public function loadView($view = null){
        if($view === null){
            parent::loadView($this->mainView);
        }
    }
    
}
