<?php
require_once 'Settings/header.php';
if(isset($_GET['route'])){
    if($route = Route::getRoute($_GET['route'])){
        $ct = $route->getController();
        if($route->is404()){
            $ct->set404();
        }
        $ct->main();
    }
}
?>
