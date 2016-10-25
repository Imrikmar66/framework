<?php

class Context{
    
    private static $module = false;
    
    static function getModule() {
        return self::$module;
    }

    static function setModule($module) {
        self::$module = $module;
    }
    
    static function resetModule() {
        self::$module = false;
    }
    
    static function objectFromClassModule($class, $module){
        if(class_exists($class, FALSE)){
            throw new Exception("Class ".$class." cannot be loaded from module ".$module.", this class was already defined or used before. For disabling modules autoload, please rewrite protected method initModule in your controller.");
        }
        Context::setModule($module);
        $object = new $class();
        Context::resetModule();
        return $object;
    }
    
    static function loadClassesFromModule($module){
        $classes = scandir($module.'/class');
        foreach($classes as $class){
            if(strpos($class, '.php') !== FALSE)
                require_once $module.'/class/'.$class;
        }
    }

}
