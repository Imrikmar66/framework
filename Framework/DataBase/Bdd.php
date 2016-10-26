<?php

require_once 'Medoo/medoo.php';

class Bdd {
    
    private $link;
    private $medooConstructorArray;
    private static $staticbdd = false;
            
    function __construct() {
        
        $this->medooConstructorArray =
        [
            'database_type' => BDD_TYPE,
            'database_name' => BDD_NAME,
            'server' => BDD_HOST,
            'username' => BDD_USER,
            'password' => BDD_PASS,
            'charset' => BDD_CHARSET,
        ];
        
    }
    
    private function getLink() {
        $this->link = new Medoo($this->medooConstructorArray);
        return $this->link;
    }
    
    public static function getBdd(){
        if(!self::$staticbdd){
            self::$staticbdd = new Bdd();
        }
        return self::$staticbdd->getLink();
    }

    // Pour préciser un port, à faire avant le getConnection()
    public function setPort($port){
        $this->medooConstructorArray['port'] = $port;
    }

    // Préciser un préfixe
    public function setPrefix($prefix){
        $this->medooConstructorArray['prefix'] = $prefix;
    }
    
}
