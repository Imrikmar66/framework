<?php

class LoginController extends Controller {
    
    
    public function main(){
        
        /* --- Template vars --- */
        $form_login = &$this->tpl_vars["form_login"];
        /* --------------------- */
        
        if($this->isGET()){
            $form_login = $this->makeBaseLoginForm();
        }
        else if($this->isPOST()){
            $user = new User();
            $user->getUserByEmail($this->POST('email'));
            if($user->checkAuth($this->POST('password'))){
                $token = $user->createAuthToken();
                Authentication::validAuth($token, array());
                Navigation::navigateTo('dashboard');
            }
            else
                $form_login = "failed";
        }

        parent::main();
    }
    
    protected function defineMainView() {
        $this->mainView = "login";
    }
    
    protected function authenticationRequirement() {
        false;
    }

    protected function errorLoadingController() {
         $this->mainView = "index";
    }
    
    /* --- Tools method --- */
    public function makeBaseLoginForm() {
        return "
            <form id='login-form' method='post'>
                <input type='text' name='email' /><br />
                <input type='password' name='password' /><br />
                <input type='submit'>
            </form>
        ";
    }
    
}
