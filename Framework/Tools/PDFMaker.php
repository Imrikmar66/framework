<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PDFMaker
 *
 * @author imacagence2
 */
class PDFMaker {
    
    private $html;
    private $pdf;
    
    function __construct($html){
        $this->html = $html;
        $this->buildPDF();
    }
    
    function getHtml() {
        return $this->html;
    }

    function getPdf() {
        return $this->pdf;
    }

    function setHtml($html) {
        $this->html = $html;
    }

    function setPdf($pdf) {
        $this->pdf = $pdf;
    }
    
    function buildPDF(){
        
        $url = 'http://freehtmltopdf.com';
        $data = array(  'convert' => '', 
                        'html' => $this->html,
                        'baseurl' => URL_PAGES."/");

        // use key 'http' even if you send the request to https://...
        $options = array(
            'http' => array(
                    'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method'  => 'POST',
                    'content' => http_build_query($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        $this->pdf = $result;
        
    }
    
    function pdf(){
        // set the pdf data as download content:
        header('Content-type: application/pdf');
        header('Content-Disposition: attachment; filename="webpage.pdf"');
        echo($this->pdf);
    }
    
    function pj(){
        return $this->pdf;
    }
    
    
}
