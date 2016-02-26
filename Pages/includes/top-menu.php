<?php
/* Messages */
$success = array(
    0 => "Document créé avec succès",
    1 => "Document édité avec succès",
    2 => "Vendeur créé avec succès",
    3 => "Observateur créé avec succès",
    4 => "Les informations ont bien été mises à jour",
    5 => "Un email de confirmation vous a été envoyé",
    6 => "L'utilisateur a bien été enregistré",
    7 => "Succès ! En attente de validation par un administrateur"
);
$error = array(
    0 => "Vous n'êtes pas autorisé à accéder à cette page",
    1 => "Vous n'êtes pas autorisé à accéder à ce vendeur",
    2 => "Erreur : Ce vendeur n'existe pas ou n'existe plus",
    3 => "Erreur : des paramètres sont manquants",
    4 => "Erreur : Ce document n'existe pas ou n'existe plus",
    5 => "Sélectionnez un responsable ventes pour commencer",
    6 => "Une erreur est survenue"
);
$today_date = new DateFr(date('l j F'));
$today_date->convertDate();

$Success_Error_Message = ModalManager::emptyModal();
if(isset($GM->success_statut)){
    $Success_Error_Message = new ModalManager(MODAL_SUCCESS, $success[$GM->success_statut]);
}
else if(isset($GM->error_statut)){
    $Success_Error_Message = new ModalManager(MODAL_ERROR, $error[$GM->error_statut]);
}

if($AdminMode){
    $user_desc = "SA - ".User::getCurrentUser()->getLastname();
}
else{
    $user_desc = User::getCurrentUser()->getLastname().' '.User::getCurrentUser()->getFirstname();
}
?>
<div id="top-menu">
    <?php 
    if($AdminMode){ 
    ?>
    <a href="dashboard_superadmin.php?reset=1" class="blocs logo">
        <img src="Ressources/img/Logo_borderless.png" alt="logo" title="logo"/>
    </a>
    <?php
    }
    else{
    ?>
    <a href="dashboard.php" class="blocs logo">
        <img src="Ressources/img/Logo_borderless.png" alt="logo" title="logo"/>
    </a>
    <?php 
    }
    ?>
    <div class="blocs date">
        <p><?= $today_date->displayDate(); ?></p>
    </div>
    <a href="profil.php<?php if($AdminMode){ ?>?admin=1<?php } ?>" class="blocs profil">
        <div class="inBlM icon">
             <img src="Ressources/img/avatar.png" alt="avatar" title="avatar"/>
        </div>
        <div class="inBlM type">
            <p><?= $user_desc ?></p>
        </div>
    </a>
    <a href="disconnect.php" class="blocs deconnexion">
        <div class="inBlM icon_deconnect">
            <img src="Ressources/img/deconnexion.png" alt="deconnection button" title="deconnection button" />
        </div>
    </a>
</div>
<?php
$Success_Error_Message->display();
?>
