<?php
require_once __DIR__.'/../../Control/config.php';
if(MODE_DEV == TRUE){ 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once URI_CONTROL.'/debug_functions.php';
}
require_once URI_CONTROL.'/functions.php';
require_once URI_CONTROL.'/smarty-master/libs/Smarty.class.php';
require_once URI_CLASS.'/Autoloader.php';
session_start();

load_modules();

ACTION('backend_header');
?>
