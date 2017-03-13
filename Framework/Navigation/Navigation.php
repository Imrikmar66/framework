<?php

define('NAVIGATION_HOME', 'dashboard.php');
define('NAVIGATION_CONNEXION', 'index.php');

class Navigation {
    
    public static function navigateTo($location, $isAlias = true, $absolute = true){
        if($isAlias){
            $location = RoutesManager::getRoutesManager()->pathOfRoute($location);
        }

        // Afin de gérer si location est absolue ou relative
        if($absolute){
            header('Location: ' . $location); exit();
        }

        header('Location: '.URL_FOLDER.'/'.$location);
        exit();
    }
    
    public static function navigateWithErrorCodeTo($location, $errorCode){
        header('Location: '.URL_FOLDER.'/'.$location.'?error_statut='.$errorCode);
        exit();
    }
    
    public static function navigateWithSuccessMessage($location, $successCode){
        header('Location: '.$location.'?success_statut='.$successCode);
        exit();
    }
    
    public static function navigateWithParameters($location, $params){
        
        $strLoc = 'Location: '.$location.'?';
        
        foreach($params as $key => $value){
            $strLoc.= $key.'='.$value.'&';
        }
        
        $strLoc = rtrim($strLoc, "&");
        
        header($strLoc);
        exit();
    }

    // Redirige les utilisateurs non admins vers la route d'alias donné
    public static function redirectIfNotAdmin($alias){
        if(!Authentication::getInstance()->isSuperAdmin()){
            self::navigateTo($alias);
        }
    }


    // Vérifie les droits demandés, si ils sont accordés et redirige ou execute un callback
    // On n'est pas obligé de spécifier l'alias de la route, mettant le callback en second argument
    //
    // return true si l'utilisateur a les droits
    public static function redirectIfNotAllowedTo($rightsArray, $alias = null, Callable $callback = null){

        if(!Authentication::isAllowedTo($rightsArray)){   
            // Si le second argument est bien une alias
            if(is_string($alias)){
                if($callback){
                    call_user_func($callback);
                }
                if($alias != null){
                    self::navigateTo($alias, true, true);
                }
            }
            // Si on n'a pas spécifié de alias et juste mit le callback
            elseif (is_callable($alias)) {
                call_user_func($alias);
            }
        }
        // Si l'user a bien les droits
        else{ return 1; }
    }


    // Redirige vers la page d'erreurs, et affiche le titre et le message correspondant sur la page
    public static function redirectWithErrors($title = 'Erreur', $message = 'Il y a eu une erreur'){
        
        self::navigateTo('error');

    }
}
