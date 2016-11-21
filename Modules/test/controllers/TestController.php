<?php
class TestController extends Controller {	            

	protected function authenticationRequirement() {
	    return false;
	}

	protected function defineMainView() {
	    $this->mainView = "default";
	}

	protected function errorLoadingController() {
	    $this->mainView = "404";
	}

	public function abs() {
	    parent::main();
	}

    public function therouteAction() {
        $this->mainView = 'theroute'; 
        parent::main();
    }

}