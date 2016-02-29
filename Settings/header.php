<?php
require_once 'config.php';
if(MODE_DEV == TRUE){ 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once URI_SETTINGS.'/debug_functions.php';
}
session_start();

require_once URI_FRAMEWORK.'/Autoloader.php';
require_once URI_SETTINGS.'/functions.php';
require_once URI_SETTINGS.'/smarty-master/libs/Smarty.class.php';
require_once URI_SETTINGS.'/Routes.php';

load_modules();

ACTION('backend_header');
?>
