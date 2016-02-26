<?php
require_once 'includes/backend_header.php';
$controller = $_GET['C'];
$ct = Controller::getController($controller);
$ct->displayView();
?>
