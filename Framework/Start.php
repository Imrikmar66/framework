<?php

class Start {
    
    public static function load_modules(){
    
        $mods = Tools::remove_dots(scandir(URI_MOD));

        foreach($mods as $mod){
            // Pour ne pas scanner le fichier .gitignore
            if($mod == '.gitkeep' || ( !MODE_DEV && $mod=="dev" )){ continue; }

            if(file_exists( URI_MOD.'/'.$mod.'/routes.php'))
                require_once URI_MOD.'/'.$mod.'/routes.php';
        }
    }
    
}
