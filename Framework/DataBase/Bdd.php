<?php

require_once 'Medoo/medoo.php';

class Bdd {
    
    private $link;
    private static $staticbdd = false;
            
    function __construct() {
        
        $this->link = new medoo([
            'database_type' => BDD_TYPE,
            'database_name' => BDD_NAME,
            'server' => BDD_HOST,
            'username' => BDD_USER,
            'password' => BDD_PASS,
            'charset' => BDD_CHARSET,
        ]);
        
    }
    
    private function getLink() {
        return $this->link;
    }
    
    public static function getBdd(){
        if(!self::$staticbdd){
            self::$staticbdd = (new Bdd())->getLink();
        }
        return self::$staticbdd;
    }
    
}
