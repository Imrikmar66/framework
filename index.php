<?php
require_once 'Settings/header.php';
$controller = $_GET['C'];
$ct = Controller::getController($controller);
$ct->displayView();
?>
