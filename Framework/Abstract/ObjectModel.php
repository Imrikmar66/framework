<?php

abstract class ObjectModel {
    
    protected $id;
    private $finded;
    
    function __construct($id = 0) {
        $this->finded = false;
        if($id != 0){
            $this->id = $id;
            $this->read(); 
        } 
    }
    
    function getId() {
        return $this->id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function exist(){
        return $this->finded;
    }
         
    abstract protected function getBddDescription();
    
    private function getTable(){
        return $this->getBddDescription()['table'];
    }
    
    private function getParameters(){
        return $this->getBddDescription()['parameters'];
    }
    
    private function getDataArray($array = false){
        $dataArray = [];
        if($array === false)
            $array = $this->getParameters();
        
        foreach($array as $key => $value){
            $method = 'get'.ucfirst($key);
            if(method_exists($this, $method)){
                $dataArray[$value] = $this->$method();
            }
        }
        
        return $dataArray;
    }
    
    //Convert oject parameter to bdd usable tables
    private function optionsArrayConvertKey($optionArray){
        $description = $this->getParameters();
        
        if(!is_array($optionArray)){
            return $optionArray;
        }
        foreach($optionArray as $okey => $option){
            foreach ($description as $dkey => $param){
                if(is_numeric($okey)){
                    if($option == $dkey){
                        $method = 'get'.ucfirst($option);
                        if(method_exists($this, $method)){
                            $optionArray[$param] = $this->$method();
                            unset($optionArray[$okey]);
                        }
                        else{
                            throw new Exception("Error parameter ".$option." have no setter");
                        }
                    }
                }
                else{
                    if($okey == $dkey){
                        $optionArray[$param] = $option;
                        unset($optionArray[$okey]);
                    }
                }
            }
        }

        return $optionArray;
    }
    
    //Argument can be set as array of data
    public function create($array = false){
        
        if($array == false){
            $datas = $this->getDataArray();
        }
        else{
            $datas = optionsArrayConvertKey($array);
        }
        
        $bdd = Bdd::getBdd();
        $insert_id = $bdd->insert(
            $this->getTable(),
            $datas
        );

        $this->setId($insert_id);
         
    }
    
    public function read($array = false){
        
        if($array == false){
            $datas  = "*";
            $condition = [
                "id" => $this->id
            ];
        }
        else{
            $datas  = $array['data'];
            $condition = $this->optionsArrayConvertKey($array['condition']);
        }

        $bdd = Bdd::getBdd();
        $readed = $bdd->get(
            $this->getTable(), 
            $datas, 
            $condition
        );

        if ($readed){
            $this->finded = true;
            $this->hydrate($readed);
        }
        else
            return false;

    }
    
    //Argument can be set as array('data' => arrayOfDataToUpgrade, 'condition' => arrayOfCondition)
    public function update($array=false){
        
        if($array == false){
            $datas  = $this->getDataArray();
            $condition = [
                "id" => $this->id
            ];
        }
        else{
            $datas  = $this->optionsArrayConvertKey($array['data']);
            $condition = $this->optionsArrayConvertKey($array['condition']);
        }
        
        $bdd = Bdd::getBdd();
        $bdd->update(
            $this->getTable(), 
            $datas,
            $condition
        );
        
    }
    
    //Argument can be set as array(arrayOfCondition)
    public function delete($array=false){
        
        if($array == false){
            $condition = [
                "id" => $this->id
            ];
        }
        else{
            $condition = $this->optionsArrayConvertKey($array);
        }
        
        $bdd = Bdd::getBdd();
        $bdd->delete(
            $this->getTable(), 
            [
                "AND" => $condition
            ]
        );
        
    }
    
    protected function hydrate(array $data){
        $description = $this->getParameters();
        
        if($data['id'])
            $this->setId($data['id']);
        
        foreach($description as $key => $element){
            $method = 'set'.ucfirst($key);
            if(method_exists($this, $method) && isset($data[$element])){
                $this->$method($data[$element]);
            }
                
        }

    }
    
    public static function getAllObjectFromClass($className, $use_constructor=false, $condition=false){
        
        if($condition === false){
            $condition = array();
        }
        $Objects = array();
        
        $table = (new $className())->getTable();
        
        $bdd = Bdd::getBdd();
        $results = $bdd->select($table, "*", $condition);
        
        foreach($results as $result){
            if($use_constructor){
                $Object = new $className($result['id']);
            }
            else{
                $Object = new $className();
                $Object->hydrate($result);
            }
            array_push($Objects, $Object);
        }
        return $Objects;
    }
    
    
}
