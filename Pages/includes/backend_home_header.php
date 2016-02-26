<?php
require_once 'config.php';
if(MODE_DEV == TRUE){ 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once URI_CONTROL.'/debug_functions.php';
}
require_once URI_CONTROL.'/functions.php';
require_once URI_CLASS.'/Autoloader.php';
session_start();

/*------ Connection -------*/
$connexionFailed = false;
$PM = new PostManager();
$_SESSION['AdminMode'] = false;
//User::setCurrentUser(new User());
if(isset($PM->identity) && isset($PM->password)){
    
    if($User = User::logIn($PM->identity, $PM->password)){
        if($User->isAdmin()){
            $_SESSION['AdminMode'] = $User;
            User::setCurrentUser($User);
            Navigation::navigateTo("dashboard_superadmin.php");
        }
        else{
            $_SESSION['User'] = $User;
            User::setCurrentUser($User);
            Navigation::navigateTo(NAVIGATION_HOME);
        }
    }
    else{
        $connexionFailed = true;
    }   
    
}
else if(isset($_SESSION['User'])){
    $currentUser = $_SESSION['User'];
    if($currentUser){
        User::setCurrentUser($currentUser);
        Navigation::navigateTo(NAVIGATION_HOME);
    }
}
else if($User = User::getOldSession()){
    $_SESSION['User'] = $User;
    User::setCurrentUser($User);
    //Navigation::navigateTo(NAVIGATION_HOME);
}
/* --------------- */

$Messages = new ModalManager(MODAL_ERROR, "Email ou mot de passe incorrect");
?>