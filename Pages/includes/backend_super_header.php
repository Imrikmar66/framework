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

if(isset($_SESSION['User'])){
    $currentUser = $_SESSION['User'];
    if($currentUser){
        User::setCurrentUser($currentUser);
    }
    else{
        header('Location: index.php');
    }
}
else{
    header('Location: index.php');
}

$AdminMode = false;
$User = User::getCurrentUser();
$GM = new GetManager();
if($User->isAdmin() || (isset($_SESSION['AdminMode']) && $_SESSION['AdminMode'])){
    $AdminMode = true;
}
?>
