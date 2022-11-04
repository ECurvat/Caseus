<?php
if (isset($_POST['mail']) && isset($_POST['mdp'])) {
    $mail = htmlspecialchars($_POST['mail']);
    $mdp = htmlspecialchars($_POST['mdp']);
    require_once(PATH_MODELS.$page.'.php'); 
    if (!is_null($employe) && password_verify($mdp, $employe->getMdp())) {
        $_SESSION['logged'] = true;
        $_SESSION['compte'] = $employe;
        header('Location: index.php');
        exit();
    } else {
        $alert = choixAlert('connexion');
    }
}
require_once(PATH_VIEWS.$page.'.php'); 