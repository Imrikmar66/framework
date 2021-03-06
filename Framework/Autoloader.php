<?php

function Appli_autoload($className) { 
    
    if(Context::getModule()){
        if(file_exists(URI_MOD.'/'.Context::getModule().'/class/'.$className . '.php')){
            include URI_MOD.'/'.Context::getModule().'/class/'.$className . '.php';
            return true;
        }
    }
        
    //Overwritten classes
    $class_rewrite_folders = scandir(URI_OVERRIDES);
    foreach($class_rewrite_folders as $folder){
        if (file_exists(URI_OVERRIDES.'/'.$folder.'/'.$className . '.php')) { 
            require_once URI_OVERRIDES.'/'.$folder.'/'.$className . '.php'; 
            return true; 
        } 
    }
    
    //Basic classes
    $class_folders = scandir(URI_FRAMEWORK);
    foreach($class_folders as $folder){
        if (file_exists(URI_FRAMEWORK.'/'.$folder.'/'.$className . '.php')) { 
            require_once URI_FRAMEWORK.'/'.$folder.'/'.$className . '.php'; 
            return true; 
        } 
    }
    
    //Controller classes
    $controllers_folders = scandir(URI_CONTROLLERS);
    foreach($controllers_folders as $folder){
        if (file_exists(URI_CONTROLLERS.'/'.$folder.'/'.$className . '.php')) { 
            require_once URI_CONTROLLERS.'/'.$folder.'/'.$className . '.php'; 
            return true; 
        } 
    }
    
    //Ajax classes
    $ajax_folders = scandir(URI_AJAX);
    foreach($ajax_folders as $folder){
        if (file_exists(URI_AJAX.'/'.$folder.'/'.$className . '.php')) { 
            require_once URI_AJAX.'/'.$folder.'/'.$className . '.php'; 
            return true; 
        } 
    }
    
    //Mods classes
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

        // Classes in a Modules/???/class/ subfolder
        else if(is_dir(URI_MOD.'/'.$folder . '/class/') && $folder != '.' && $folder != '..') {
            $mods_subfolders = scandir(URI_MOD.'/'.$folder.'/class/');
            foreach ($mods_subfolders as $subfolder) {
                if(file_exists(URI_MOD.'/'.$folder.'/class/' . $subfolder . '/' .$className . '.php')){
                    require_once URI_MOD.'/'.$folder.'/class/' . $subfolder . '/' .$className . '.php';
                    return true;
                }
                // 2deep4u
                elseif(is_dir(URI_MOD.'/'.$folder . '/class/' . $subfolder) && $subfolder != '.' && $subfolder != '..'){
                    $mods_sub_subfolders = scandir(URI_MOD.'/'.$folder . '/class/' . $subfolder);
                    foreach ($mods_sub_subfolders as $sub_subfolder) {
                        if(file_exists(URI_MOD.'/'.$folder.'/class/' . $subfolder . '/' . $sub_subfolder . '/' . $className . '.php')){
                            require_once URI_MOD.'/'.$folder.'/class/' . $subfolder . '/' . $sub_subfolder . '/' . $className . '.php';
                            return true;
                        }
                    }
                }
            }
        }
    }

    return false; 
} 

spl_autoload_register('Appli_autoload');
class_alias('RoutesManager', 'R');