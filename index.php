<?php
require_once 'Settings/header.php';
if($route = Route::getRoute()){
    $ct = $route->getController();  
    $ct->main();
}
else{
    $ct = new Controller404();
    $ct->main();
}
?>
