<?php include 'includes/backend_home_header.php'; ?>
<?php

$MM = ModalManager::emptyModal();

if(isset($_GET['t']) && isset($_POST['password']) && isset($_POST['password_check'])){
    
    $token = $_GET['t'];
    $FU = new ForgetUser();
    $FU->setToken($token);
    $FU->getObjectByToken();
    if(is_numeric($FU->getUser_id())){
        $User = new User($FU->getUser_id());
        
        if((is_numeric($User->getId()))){
            
           $User->setPassword($_POST['password']);
           $User->update();
           $FU->remove();
           Navigation::navigateWithSuccessMessage(NAVIGATION_CONNEXION, SUCCESS_CODE_UPDATED_INFO);
            
        }
        else{
            Navigation::navigateWithErrorCodeTo(NAVIGATION_CONNEXION, ERROR_CODE_ERROR_APPENED);
        }
        
    }
    else{
        Navigation::navigateWithErrorCodeTo(NAVIGATION_CONNEXION, ERROR_CODE_ERROR_APPENED);
    }
    
}
else if(isset($_GET['t'])){
    $token = $_GET['t'];
    $FU = new ForgetUser();
    $FU->setToken($token);
    $FU->getObjectByToken();
    if(is_numeric($FU->getUser_id())){
        $User = new User($FU->getUser_id());
        if((is_numeric($User->getId()))){
        }
        else{
            Navigation::navigateWithErrorCodeTo(NAVIGATION_CONNEXION, ERROR_CODE_ERROR_APPENED);
        }
    }
    else{
        Navigation::navigateWithErrorCodeTo(NAVIGATION_CONNEXION, ERROR_CODE_ERROR_APPENED);
    }
}
else{
    Navigation::navigateTo(NAVIGATION_CONNEXION);
}
?>

<!DOCTYPE html>
<html id="home_html">
    <head>
        <meta charset="UTF-8">
        <title>Suivi force de vente</title>
        <link rel="stylesheet" href="<?=URL_RESSOURCES?>/css/styles.css" type="text/css">
        <link rel="stylesheet" href="<?=URL_RESSOURCES?>/js/jquery-ui-1.11.4.custom/jquery-ui.css" type="text/css">
        <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?=URL_RESSOURCES?>/js/jquery-ui-1.11.4.custom/jquery-ui.js" ></script>
        <script src="<?=URL_RESSOURCES?>/js/jquery-ui-1.11.4.custom/jquery.ui.datepicker-fr.js" ></script>
        <script src="<?=URL_RESSOURCES?>/js/main.js" ></script>
    </head>
    <body>
        <?php $MM->display(); ?>
        <div id="forget_pw">
            <div id="logo">
                <img src="Ressources/img/Logo.png" alt="lg-logo" title="lg-logo" />
            </div>
            <div id="pw_form">
                <form method="post">
                    <span> Nouveau mot de passe :</span>
                    <label for="email">
                        <input type="password" name="password" id="email" placeholder="Mot de passe"/>
                    </label>
                     <span> Vérification mot de passe </span>
                    <label for="email">
                        <input type="password" name="password_check" id="email" placeholder="Vérifier mot de passe"/>
                    </label>
                    <input type="submit" />
                </form>
            </div>
        </div>
        
<?php include 'includes/footer.php'; ?>


