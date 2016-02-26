<?php
date_default_timezone_set('Europe/Paris');
//#!/usr/local/bin/php
//Display errors
error_reporting(-1);
ini_set("display_errors", 1);
//Includes
require_once 'class/server/FTPConnect.php';
require_once 'ajaxManager/class/Bdd.php';

function getLastUpdateDate(){
    
    $date = false;
    $bdd = (new Bdd())->getlink();
    $sql = "SELECT date FROM updates ORDER BY ID DESC LIMIT 1";
    $prepared = $bdd->prepare($sql);
    $prepared->execute();
    $prepared->bind_result($date);
    $prepared->fetch();
    return $date;
    
}

function updateDate(){
    
    $date = date('Y-m-d H:i:s');
    $bdd = (new Bdd())->getlink();
    $sql = "INSERT INTO updates VALUES('', ?) ";
    $prepared = $bdd->prepare($sql);
    $prepared->bind_param('s', $date);
    return $prepared->execute();
    
}

function getHour($date){

    return intval(substr($date, 11, 2));
    
}

function getDay($date){

    return intval(substr($date, 8, 2));
    
}

$last_upd = getLastUpdateDate();
$now = date('Y-m-d H:i:s');
$date1 = new DateTime($now);
$date2 = new DateTime($last_upd);

if($date1 > $date2 && getDay($now) != getDay($last_upd) && getHour($now) >= 8){
    

    //Download WinTeam datas file
    FTPConnect::WIN_TEAM_downloadFile('yam66_winteam.txt', 'datas/yam66_winteam.txt');

    //set date in bdd
    updateDate();
    
}