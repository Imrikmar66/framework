<?php


class Bdd {
    
    private $host;
    private $user;
    private $pass;
    private $name;
    private $prepared;
    private $link = null;
            
    function __construct($h = BDD_HOST, $u = BDD_USER, $p = BDD_PASS, $n = BDD_NAME) {
        $this->host = $h;
        $this->user = $u;
        $this->pass = $p;
        $this->name = $n;
        
        $this->getLink();
    }
    
    private function getLink(){
        try{
            $this->link = new mysqli($this->host , $this->user, $this->pass, $this->name);
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
    }
    
    public function getConnection(){
        return $this->link;
    }
    
    public static function connect(){
        $Bdd = new Bdd();
        return $Bdd->link; 
    }
    
    public static function insert($params){
        $sql = $params["SQL"];
        $args = $params["ARGS"];
        $types = $params["TYPES"];
        $table = $params["TABLE"];
        $parameters = array(
            "request" => "INSERT INTO ".$table." VALUES ".$sql,
            "input" => array(
                "type" => $types,
                "args" => $args
            ),
            "insert_id"=> true
        );
        return Bdd::parseRequestResults(Bdd::requestWithParams($parameters), $parameters);
    }
    
    public static function update($params){
        $sql = $params["SQL"];
        $cond = $params['COND'];
        $args = $params["ARGS"];
        $types = $params["TYPES"];
        $table = $params["TABLE"];
        $parameters = array(
            "request" => "UPDATE ".$table." SET ".$sql." WHERE ".$cond,
            "input" => array(
                "type" => $types,
                "args" => $args
            )
        );
        return Bdd::requestWithParams($parameters);
    }
    
    public static function delete($params){
        $cond = $params['COND'];
        $args = $params["ARGS"];
        $types = $params["TYPES"];
        $table = $params['TABLE'];
        $parameters = array(
            "request" => "DELETE FROM ".$table." WHERE ".$cond,
            "input" => array(
                "type" => $types,
                "args" => $args
            )
        );
        return Bdd::requestWithParams($parameters);
    }
    
    public static function select($params){

        $sql = $params["SQL"];
        $cond = $params['COND'];
        $args = $params["ARGS"];
        $types = $params["TYPES"];
        $table = $params['TABLE'];
        $output = $params['OUTPUT'];
        $parameters = array(
            "request" => "SELECT ".$sql." FROM ".$table." WHERE ".$cond,
            "input" => array(
                "type" => $types,
                "args" => $args
            ),
            "output" => $output
        );
        return Bdd::parseRequestResults(Bdd::requestWithParams($parameters), $parameters);
    }
    
    public static function requestWithParams($params){

        $Bdd = Bdd::connect();
        //Request
        if($stmt = $Bdd->prepare($params["request"])){

            if(isset($params["input"]) && $stmt->errno == 0){
                $input_params = array_merge(array($params["input"]["type"]), $params["input"]["args"]);
                call_user_func_array(array($stmt, 'bind_param'), refValues($input_params));
            }
            $stmt->execute();
            return $stmt;
            
        }
        else{
            devAff($params);
            throw new Exception("Error in Request params", 0);
        }
        
    }
    
    public static function parseRequestResults($stmt, $params){
        //Results

        if(isset($params["output"]) && $stmt->errno == 0){
            foreach($params["output"] as $key=>$output){
                $params["output"][$key] = &$$key;
            }
            call_user_func_array(array($stmt, "bind_result"), $params["output"]);
            $results_array = array();
            while($stmt->fetch()){
                $fetch_array = array();
                foreach($params["output"] as $key=>$param){
                    $fetch_array[$key] = utf8_encode($param);
                }
                array_push($results_array, $fetch_array);
            }

            return $results_array;
        }
        else if(isset($params["insert_id"]) && $stmt->errno == 0){
            return $stmt->insert_id;
        }
        else if($stmt->errno == 0){
            return true;
        }
        else{
            throw new Exception($stmt->error, $stmt->errno);
        }
    }
    
}

function refValues($arr){
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
        $refs = array();
        foreach($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}