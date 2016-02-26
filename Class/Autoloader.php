<?php

function Appli_autoload($className) { 
    $class_folders = scandir(URI_CLASS);
    foreach($class_folders as $folder){
        if (file_exists(URI_CLASS.'/'.$folder.'/'.$className . '.php')) { 
            require_once URI_CLASS.'/'.$folder.'/'.$className . '.php'; 
            return true; 
        } 
    }
    
    $controllers_folders = scandir(URI_CONTROLLERS);
    foreach($controllers_folders as $folder){
        if (file_exists(URI_CONTROLLERS.'/'.$folder.'/'.$className . '.php')) { 
            require_once URI_CONTROLLERS.'/'.$folder.'/'.$className . '.php'; 
            return true; 
        } 
    }
    
    $mods_folders = scandir(URI_MOD);
    foreach($mods_folders as $folder){
        if (file_exists(URI_MOD.'/'.$folder.'/'.$className . '.php')) { 
            require_once URI_MOD.'/'.$folder.'/'.$className . '.php'; 
            return true; 
        }
        else if (file_exists(URI_MOD.'/'.$folder.'/class/'.$className . '.php')) {
            require_once URI_MOD.'/'.$folder.'/class/'.$className . '.php'; 
            return true;
        }
        else if (file_exists(URI_MOD.'/'.$folder.'/controllers/'.$className . '.php')) {
            require_once URI_MOD.'/'.$folder.'/controllers/'.$className . '.php'; 
            return true;
        }
    }

    return false; 
} 

spl_autoload_register('Appli_autoload');