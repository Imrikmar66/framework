<?php

class Start {
    
    public static function load_modules(){
    
        $mods = Tools::remove_dots(scandir(URI_MOD));

        foreach($mods as $mod){
            // Pour ne pas scanner le fichier .gitignore
            if($mod == '.gitkeep'){ continue; }
            
            $mod_files = Tools::remove_dots(scandir(URI_MOD.'/'.$mod));
            foreach($mod_files as $file){ 
                if(preg_match("(.php)", $file)){
                    require_once URI_MOD.'/'.$mod.'/'.$file;
                }
            }
        }
    }
    
}
