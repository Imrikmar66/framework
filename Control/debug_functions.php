<?php

function devAff($param){
    $type = gettype($param);
    if($type == 'array' || $type == 'object'){
        echo '<pre>';
        print_r($param);
        echo '</pre>';
    }
    else {
        echo '<br />';
        echo $param;
        echo '<br />';
    }
}

