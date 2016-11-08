<?php
require_once 'Settings/header.php';
if($route = Route::getRoute()){
    $ct = $route->getController();
    $ct->beforeMain();
    $ct->callMain();
}
else if(rtrim("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", '/') == URL_FOLDER){
    Navigation::navigateTo('login');
}
else{ 
    $ct = new Controller404();
    $ct->beforeMain();
    $ct->main();
}
?>
