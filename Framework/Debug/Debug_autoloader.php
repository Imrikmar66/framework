<?php

function Debug_autoload($className) { 
    $debug_folder = scandir(URI_FRAMEWORK.'/Debug');
    foreach($debug_folder as $folder){
        if (file_exists(URI_FRAMEWORK.'/Debug/'.$folder.'/'.$className . '.php')) {
            require_once URI_FRAMEWORK.'/Debug/'.$folder.'/'.$className . '.php';
            return true; 
        } 
    }
}

spl_autoload_register('Debug_autoload');
