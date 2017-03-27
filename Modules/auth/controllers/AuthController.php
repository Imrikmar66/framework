<?php
class AuthController extends Controller {	            

	//Override pour changer le singleton d'Authentication !
	protected function setAuthentication(){
        parent::setAuthentication();
    }

	//Override (Change les parametres d'authentication')
	protected function authenticationRequirement() {
	    return parent::authenticationRequirement();
	}

	protected function defineMainView() {
	    $this->mainView = "default";
	}

	protected function errorLoadingController() {
	    $this->mainView = "404";
	}

	public function login(){
		$this->mainView = 'login';
		parent::main();
	}

	public function actionLogin(){
		$user = SimpleUser::logIn($this->GET('username'), $this->GET('password'));
		if ($user) {
			SimpleUser::setCurrentUser($user);
			Navigation::navigateTo('dev_roles');
		}
		else {
			Navigation::navigateTo('login');}
	}

}