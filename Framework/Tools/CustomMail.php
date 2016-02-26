<?php
require_once URI_FRAMEWORK."/Tools/PHPMailer/PHPMailerAutoload.php";

class CustomMail implements JsonSerializable {
    
    private $subject;
    private $message;
    private $from;
    private $to;
    private $header;
    private $fileHeaders = "";
    private $files;
    private $encodedFile;
    private $boundary;
    private $mail;
    private $tempFile;
    
    function getSubject() {
        return $this->subject;
    }

    function getMessage() {
        return $this->message;
    }

    function getFrom() {
        return $this->from;
    }

    function getTo() {
        return $this->to;
    }

    function getHeader() {
        return $this->header;
    }

    function getFileHeaders() {
        return $this->fileHeaders;
    }

    function getFiles() {
        return $this->files;
    }

    function getEncodedFile() {
        return $this->encodedFile;
    }

    function getBoundary() {
        return $this->boundary;
    }

    function getMail() {
        return $this->mail;
    }

    function setSubject($subject) {
        $this->subject = $subject;
    }

    function setMessage($message) {
        $this->message = $message;
    }

    function setFrom($from) {
        $this->from = $from;
    }

    function setTo($to) {
        $this->to = $to;
    }

    function setHeader($header) {
        $this->header = $header;
    }

    function setFileHeaders($fileHeaders) {
        $this->fileHeaders = $fileHeaders;
    }

    function setFiles($files) {
        $this->files = $files;
    }

    function setEncodedFile($encodedFile) {
        $this->encodedFile = $encodedFile;
    }

    function setBoundary($boundary) {
        $this->boundary = $boundary;
    }

    function setMail($mail) {
        $this->mail = $mail;
    }

        
    function __construct($from, $to, $message, $subject, $files) {
        $this->from = $from."<groupe@lg-automobiles.com>";
        $this->to = $to;
        $this->message .= utf8_decode($message);
        $this->subject = $subject;
        $this->files = $files;
    }
    
    function buildCompleteMail(){
        
        $mailName = substr($this->from,  0, strpos($this->from, '<'));
        $mailFrom = $this->get_string_between($this->from, '<', '>');
        //Create a new PHPMailer instance
        $mail = new PHPMailer();
        $mail->setFrom($mailFrom, $mailName);
		$mail->addAddress($this->to);
        $mail->addAddress($this->to);
        $mail->Subject = $this->subject;
        $mail->msgHTML($this->message);
        $mail->AltBody = 'Mail from lg_force_vente.fr';
        foreach($this->files as $file){
            //move_uploaded_file($file["tmp_name"],"temp/". $file["name"]);
            //$mail->addAttachment("temp/". $file["name"]);
            //$this->tempFile = "temp/". $file["name"];
            $mail->addAttachment($file);
        }
        $this->mail = $mail;
        
    }
    
    function get_string_between($string, $start, $end){
        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        return substr($string, $ini, $len);
    }
    
    public function send(){
        if (!$this->mail->send()) {
            return false;
        } else {
            return true;
        }
        unlink($this->tempFile);
    }
    
    public function jsonSerialize() {
        $jsonArray = array(
            "subject" => $this->subject,
            "message" => $this->message,
            "from" => $this->from,
            "to" => $this->to,
            "header" => $this->header,
            "fileHeaders" => $this->fileHeaders,
            "file" => $this->files,
            "encodedFile" => $this->encodedFile,
            "boundary" =>$this->boundary
        );
        
        return $jsonArray;
    }
    
}