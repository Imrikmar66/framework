<?php
require_once 'Settings/header.php';
if(isset($_GET['R'])){
    if($route = Route::getRoute($_GET['R'])){
        $ct = $route->getController();
        if($route->is404()){
            $ct->set404();
        }
        $ct->main();
    }
}
?>
