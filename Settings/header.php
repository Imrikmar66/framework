<?php
require_once 'config.php';
if(MODE_DEV == TRUE){ 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once URI_FOLDER.'/Debug/Debug_lib.php';
}

require_once URI_FRAMEWORK.'/Context.php';
require_once URI_FRAMEWORK.'/Autoloader.php';
session_start();
require_once URI_SETTINGS.'/smarty-master/libs/Smarty.class.php';
require_once URI_SETTINGS.'/routes.php';

Install::load_modules();

Install::ACTION('backend_header');
?>
