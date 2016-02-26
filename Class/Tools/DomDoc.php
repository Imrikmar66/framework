<?php

class DomDoc {
    
    public $doc;
    
    function __construct($html){
        $this->doc = new DOMDocument();
        $this->doc->loadHTML($html);  
    }
    
    public function removeElementsByTagName($tagName) {
        $nodeList = $this->doc->getElementsByTagName($tagName);
        for ($nodeIdx = $nodeList->length; --$nodeIdx >= 0; ) {
            $node = $nodeList->item($nodeIdx);
            $node->parentNode->removeChild($node);
        }
    }
    
    public function generateForMail(){
        $this->removeElementsByTagName('script');
        return $this->doc->saveHTML();
    }
    
}