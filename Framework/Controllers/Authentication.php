<?php

class Authentication {
    
    // Constantes roles
    const AUTH_SUPERADMIN   = 0;
    const AUTH_ADMIN        = 1;
    const AUTH_EDITOR       = 2;

    // Constantes droits
    const CREATE_FORM       = 'CREATE_FORM';
    const DELETE_FORM       = 'DELETE_FORM';
    const MODIFY_FORM       = 'MODIFY_FORM';
    const CREATE_USER       = 'CREATE_USER';
    const SUBMIT_FORM       = 'SUBMIT_FORM';

    public static function getToken(){
        if(isset($_SESSION['token'])){
            return $_SESSION['token'];
        }
        else{
            return false;
        }
    }
    
    public static function isAuthentified(){
        if($token = self::getToken())
            return $token;
        else
            return false;
    }

    public static function validAuth($token, $parameters){
        $_SESSION['token'] = $token;
        foreach ($parameters as $key => $value){
            $_SESSION[$key] = $value;
        }
        return true;
    }
    
    public static function refuseAuth(){
        unset($_SESSION['token']);
        return true;
    }
    
    public static function createAuthToken($id){
        return hash('sha256', HASH_ADDITIONAL_VALUE."http://".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"].$_SERVER['HTTP_USER_AGENT']).time()."-".$id;
    }
    
    public static function get($param){
        if(isset($_SESSION[$param]))
            return $_SESSION[$param];
        else
            return false;
    }


    /*----------  Fonctions customs non présentes de base que c'est moi qui ai codé hihi  ----------*/

    
    // Plutôt explicite oh
    // Retourne le token si superAdmin
    public static function isSuperAdmin(){
        if(isset($_SESSION['role'])){
            if( $_SESSION['role'] == self::AUTH_SUPERADMIN){
                return self::getToken();
            }
        }
        return false;
    }

  

    // Retourne true si l'utilisateur connecté a le droit de réaliser les actions dans l'array donné
    // ex: isAllowedTo([Authentication::CREATE_FORM, Authentication::DELETE_FORM, Authentication::MODIFY_FORM])
    public static function isAllowedTo($droitsDemandes){
        $data = Bdd::getBdd()->select('roles_rights', 
            [ // SELECT
                'name_right'    
            ],
            [ // WHERE
                'id_role' => $_SESSION['role']
            ]);

        // Doit etre egale à la taille du tableau envoyé pour returner true
        $ok = 0;

        // Pour chaque droit demandé
        foreach ($droitsDemandes as $droit){
            // On vérifie dans le tableau de droits récupéré
            foreach ($data as $value){
                // Si l'utilisateur a bien le droit, on incremente ok et on continue au prochain droit demandé
                if($droit == $value['name_right']){ $ok +=1; }
            }
        }

        // Si tout les droits demandés sont accordés
        if($ok == count($droitsDemandes)){
            return true;
        }
        else{
            return false;
        }
    }
    
}
