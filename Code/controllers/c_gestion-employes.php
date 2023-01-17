<!-- Contrôleur page de gestion des employés -->
<?php
// Vérification des autorisations
if ($_SESSION['compte']->getPosition() != 'MANA') {
    header("Location: index.php");
    exit;
}

// Générer un mot de passe (création compte ou réinitialisation mot de passe)
function randomPassword() {

    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) { // mot de passe de 8 caractères
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); // tableau -> chaîne de caractères

}

// Génération du mot de passe quand nécessaire
if (isset($_POST['modifierMDP']) || isset($_POST['ajoutValider'])){
    $newMDP = randomPassword();
}

require_once(PATH_MODELS.$page.'.php'); 
require_once(PATH_VIEWS.$page.'.php'); 