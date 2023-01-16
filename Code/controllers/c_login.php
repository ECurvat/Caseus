<!-- Contrôleur page login -->
<?php
// Vérification des champs
if (isset($_POST['mail']) && isset($_POST['mdp'])) {
    $mail = htmlspecialchars($_POST['mail']);
    $mdp = htmlspecialchars($_POST['mdp']);

    require_once(PATH_MODELS.$page.'.php');

    // Vérification des identifiants (l'employé existe-il ? le mot de passe correspond-il ?)
    if (!is_null($employe) && password_verify($mdp, $employe->getMdp())) {
        // Connexion réussie : initialisation d'une session avec les informations de l'employé et redirection vcer l'accueil
        $_SESSION['logged'] = true;
        $_SESSION['compte'] = $employe;
        header('Location: index.php');
        exit();
    } else {
        // Problème : l'adresse mail entrée ne correspond à aucun compte ou le mot de passe entré est erroné
        // On affiche le même message d'alerte pour les 2 cas pour éviter de donner des informations sur les comptes existants
        $alert = choixAlert('connexion');
    }
}

require_once(PATH_VIEWS.$page.'.php'); 