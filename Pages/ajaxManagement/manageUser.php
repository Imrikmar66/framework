<?php
require_once 'ajaxHeader.php';

$PM = new PostManager();

$manageArray = array(
    "action",
    "user_id"
);

if($PM->checkParams($manageArray)){
      
    if($PM->action == "accept"){
        
        $user = new User($PM->user_id);
        if(is_numeric($user->getId()) && $user->getInWait()){
            $user->accept();
            echo '{ "status" : "success" }';
        }
        else{
            echo '{ "status" : "error" }';
        }
        
        $message = "
            <html>
            <head>
                <meta charset='UTF-8'>
                <title>Inscription force de vente</title>
            </head>
            <body>
                <h2>Inscription a l'application LG Force de vente</h2>
                <div>Un administrateur a accepté votre requête d'inscription. Vous pouvez dès à présent vous <a href='".URL_SERVOR."'> connecter à votre compte </a></div>
            </body>
            </html>
        ";
        $Mail = new CustomMail(APP_NAME, $user->getEmail(), $message, "Validation inscription", array());
        $Mail->buildCompleteMail();
        $Mail->send();
        
    }
    else if($PM->action == "refuse"){
        
        $user = new User($PM->user_id);
        if(is_numeric($user->getId()) && $user->getInWait()){
            $user->accept();
            $user->remove();
            echo '{ "status" : "success" }';
        }
        else{
            echo '{ "status" : "error" }';
        }
        
    }
    else if($PM->action == "delete_user"){

        $user = new User($PM->user_id);
        if(is_numeric($user->getId())){
            $user->remove();
            echo '{ "status" : "success" }';
        }
        else{
            echo '{ "status" : "error" }';
        }
        
    }
    else if($PM->action == "delete_seller"){

        $seller = new Seller($PM->user_id);
        if(is_numeric($seller->getId())){
            $seller->remove();
            echo '{ "status" : "success" }';
        }
        else{
            echo '{ "status" : "error" }';
        }
        
    }
    else if($PM->action == "delete_observer"){

        $observer = new Observer($PM->user_id);
        if(is_numeric($observer->getId())){
            $observer->remove();
            echo '{ "status" : "success" }';
        }
        else{
            echo '{ "status" : "error" }';
        }
        
    }
    else{
        
        echo '{ "status" : "error" }';
        
    }
        
}
else{
    
    echo '{ "status" : "error" }';
    
}