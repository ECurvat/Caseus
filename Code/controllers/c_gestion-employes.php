<?php


// pas encore utilisé : à voir en séance SAÉ
function randomPassword() {

    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 8; $i++) { // mot de passe de 8 caractères
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); // array -> string

}

if ($_SESSION['compte']->getPosition() != 'MANA') {

    header("Location: index.php");
    exit;

}
require_once(PATH_MODELS.$page.'.php'); 

require_once(PATH_VIEWS.$page.'.php'); 