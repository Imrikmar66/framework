<?php

abstract class ObjectModel{
    
    protected $id;
    protected $description = 
        array(
            'table' => '',
            'id' => array(
                'type' => 'i',
                'columnName' => 'id'
            )
        );
    
    function __construct($id = 0) {
        if($id != 0){
            $this->getObjectById($id);
        }
    }
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }
        
    abstract protected function getObjectById($id);
             
    protected function getDescriptionOf($element){
        if(isset($this->description[$element])){
            return $this->description[$element];
        }
        else{
            throw new Exception(get_class($this)."::".$element." n'existe pas", 1);
        }
    }
    
    protected function generateArgumentsDescriptionArray($elementArray){
        $descriptionArray = array();
        foreach($elementArray as $element){
            $descriptionArray["$element"] = $this->getDescriptionOf($element);
        }
        return $descriptionArray;
    }
    
    protected function generateConditionDescriptionArray($elementArray){
        $descriptionArray = array();
        foreach($elementArray as $key => $element){
            $descriptionArray[$element] = $this->getDescriptionOf($key);
            $descriptionArray[$element]["value"] = $element;
        }
        return $descriptionArray;
    }
    
    public function create($parameters = null){
        
        if($parameters == null){
            return false;
        }
        
        $parameters["args"] = $this->generateArgumentsDescriptionArray($parameters["args"]);
        
        $gen = $this->insert_RequestGenerate($parameters);
         
        $this->id =  Bdd::insert($gen);
    }
    
    public function update($parameters = null){
        
        if($parameters == null){
            return false;
        }

        $parameters["args"] = $this->generateArgumentsDescriptionArray($parameters["args"]);
        $parameters["condition"] = $this->generateConditionDescriptionArray($parameters["condition"]);
        
        $gen = $this->update_RequestGenerate($parameters);
        
        return Bdd::update($gen);
    }
    
    public function remove($parameters = null){
        
        if($parameters == null){
            return false;
        }
        
        $parameters["condition"] = $this->generateArgumentsDescriptionArray($parameters["condition"]);
        
        $gen = $this->delete_RequestGenerate($parameters);
        
        return Bdd::delete($gen);
    }
    
    public function select($parameters = null){
        
        if($parameters == null){
            return false;
        }
        
        $parameters["args"] = $this->generateArgumentsDescriptionArray($parameters["args"]);
        $parameters["condition"] = $this->generateConditionDescriptionArray($parameters["condition"]);
        $gen = $this->select_RequestGenerate($parameters);

        return Bdd::select($gen);
    }
    
    protected function makeObjectParametersMatchWithAssocArray($assocArray){
        foreach($assocArray as $key => $value){
            $this->$key = $value;
        }
    }
    
    protected function insert_RequestGenerate($parameters){

        $types = array();
        $args = array();
        
        //SQL
        if($parameters["AI_arg"]){
            $sql = "('', ";
        }
        else{
            $sql = "(";
        }
        
        foreach($parameters["args"] as $parameter){
            $sql .= "?, ";
        }
        $sql .= ")";
        $sql = str_replace(", )", ")", $sql);
        

        //ARGS       
        foreach($parameters["args"] as $key => $parameter){
            $val = $this->$key;
            $type = $parameter["type"];
            array_push($args, $val);
            array_push($types, $type);
        }
        
        $types = implode("", $types);

        return array(
            "SQL" => $sql,
            "ARGS" => $args,
            "TYPES" => $types,
            "TABLE" => $this->description['table']
        );
        
    }
    
    protected function update_RequestGenerate($parameters){

        $types = array();
        $args = array();
        
        //SQL   
        $sql = "";
        foreach($parameters['args'] as $parameter){
            $sql .= $parameter['columnName']."=?, ";
        }
        $sql = rtrim($sql, ", ");

        //ARGS       
        foreach($parameters["args"] as $key => $parameter){
            $val = $this->$key;
            $type = $parameter["type"];
            array_push($args, $val);
            array_push($types, $type);
        }
        
        //COND
        $cond = "";
        foreach($parameters['condition'] as $key => $condition){
            $cond .= $condition['columnName']."=?";
            array_push($args, $condition['value']);
            array_push($types, $condition['type']);
        }
        
        $types = implode("", $types);

        return array(
            "SQL" => $sql,
            "ARGS" => $args,
            "TYPES" => $types,
            "COND" => $cond,
            "TABLE" => $this->description['table']
        );
        
    }
    
    protected function delete_RequestGenerate($parameters){

        $types = array();
        $args = array();
        
        //COND
        $cond = "";
        foreach($parameters['condition'] as $key => $condition){
            $cond .= $condition['columnName']."=?";
            array_push($args, $this->$key);
            array_push($types, $condition['type']);
        }
        
        $types = implode("", $types);

        return array(
            "ARGS" => $args,
            "TYPES" => $types,
            "COND" => $cond,
            "TABLE" => $this->description['table']
        );
        
    }
    
    protected function select_RequestGenerate($parameters){

        $temp = array();
        $types = array();
        $args = array();
        $output = array();
        
        //SQL   
        $sql = "";
        foreach($parameters['args'] as $parameter){
            $sql .= $parameter['columnName'].", ";
        }
        $sql = rtrim($sql, ", ");

        //ARGS       
        foreach($parameters["args"] as $key => $parameter){
            $output[$key] = "";
        }

        //COND
        $cond = "";
        foreach($parameters['condition'] as $condition){
            $cond .= $condition['columnName']."=?";
            array_push($args, $condition['value']);
            array_push($types, $condition['type']);
        }

        $types = implode("", $types);

        return array(
            "SQL" => $sql,
            "ARGS" => $args,
            "TYPES" => $types,
            "COND" => $cond,
            "OUTPUT" => $output,
            "TABLE" => $this->description['table']
        );
        
    }
    
}
