<?php
require_once 'includes/config.php';
if(MODE_DEV == TRUE){ 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once URI_CONTROL.'/debug_functions.php';
}
require_once URI_CONTROL.'/functions.php';
require_once URI_CLASS.'/Autoloader.php';
session_start();
unset($_SESSION['User']);
session_unset();
session_destroy();
User::destroyOldSession();
Navigation::navigateTo(NAVIGATION_CONNEXION);
