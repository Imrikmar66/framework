<?php
require_once 'config.php';
if(MODE_DEV == TRUE){ 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require_once URI_FRAMEWORK.'/Debug/Debug_autoloader.php';
}

require_once URI_FRAMEWORK.'/Context.php';
require_once URI_FRAMEWORK.'/Autoloader.php';
session_start();
require_once URI_SETTINGS.'/smarty-master/libs/Smarty.class.php';
require_once URI_SETTINGS.'/routes.php';
foreach(scandir(URI_MOD) as $mod){ 
    if(strpos($mod, '.') === FALSE){
        if(file_exists(URI_MOD.'/'.$mod.'/routes.php'))
            require_once URI_MOD.'/'.$mod.'/routes.php';
    }
}

Start::load_modules();
?>
