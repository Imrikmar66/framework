<?php

class AjaxController extends Controller {
    
    protected $jsonData;
    private $enabledJsonP = false;
    
    function getJsonData() {
        return $this->jsonData;
    }

    function setJsonData($jsonData) {
        $this->jsonData = $jsonData;
    }

    function enableJsonP(){
        $this->enabledJsonP = true;
    }

    public function main(){

        $jsonEncoded = json_encode($this->jsonData);

        if( $this->enabledJsonP && ($cb = $this->POST("callback")) ){
            echo $cb . "(" .  $jsonEncoded . ")";
        }
        else
            echo $jsonEncoded;
    }
    
    protected function sendHeaders(){
        if(!headers_sent()){
            http_response_code($this->responseCode);
            header('Access-Control-Allow-Origin: *');  
            header("Content-Type: ".$this->responseContentType);
        }
    }

    protected function defineMainView() {
        $this->mainView = "index";
    }

    protected function errorLoadingController() {
        $this->setResponseCode(404);
        $this->mainView = "404";
        $this->jsonData = json_encode(['Error' => '404 not allowed']);
    }

    protected function initResponseContentType() {
        return "application/json";
    }
    
}
