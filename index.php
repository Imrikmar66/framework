<?php
require_once 'Settings/header.php';
if($route = Route::getRoute()){
    $ct = $route->getController();  
    $ct->main();
}
else{
    $route = 
    $ct = new Controller404();
    $ct->main();
}
?>
