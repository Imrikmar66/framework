<?php include 'includes/backend_home_header.php'; ?>
<?php

$MM = ModalManager::emptyModal();

if(isset($_POST['email'])){
    
    $User = new User();
    $User->getUserByEmail($_POST['email']);
    
    if(is_numeric($User->getId())){
    
        $randUrl = generateRandomString();
        $FU = new ForgetUser();
        $FU->setUser_id($User->getId());
        $FU->setToken($randUrl);
        $FU->create();
        
        $message = "
        <html>
            <head>
                <meta charset='UTF-8'>
                <title>Mot de passe oublié force de vente</title>
            </head>
            <body>
                <h2>Réinitialisation de votre mot de passe</h2>
                <p>Veuillez cliquer sur le lien suivant pour réinitialiser vos identifiants : <a href='".URL_PAGES."/password_retrieve.php?t=".$FU->getToken()."'>Réinitialiser mon mot de passe</a></p>
            </body>
        </html>
        ";
        
        $mail = new CustomMail(APP_NAME, $User->getEmail(), $message, APP_NAME." : Réinitialisation du mot de passe", array());
        $mail->buildCompleteMail();
        $mail->send();
        Navigation::navigateWithSuccessMessage(NAVIGATION_CONNEXION, SUCCESS_CODE_SENDED_MAIL);
        
    }
    else{
        $MM = new ModalManager(MODAL_ERROR, "Cet email n'est pas associé à un compte enregistré !");
    }
}

function generateRandomString($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
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
                    <span> Veuillez rentrer votre email</span>
                    <label for="email">
                        <input type="text" name="email" id="email" placeholder="utilisateur@mail.com"/>
                    </label>
                    <input type="submit" />
                </form>
            </div>
        </div>
        
<?php include 'includes/footer.php'; ?>


