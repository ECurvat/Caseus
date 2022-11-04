<?php
if (isset($_POST['mois']) && 
    is_numeric($_POST['mois']) && 
    isset($_POST['annee']) && 
    is_numeric($_POST['annee']) &&
    $_POST['mois'] > 0 &&
    $_POST['mois'] < 13) {
    //Semaine choisie par l'utilisateur
    $mois = htmlspecialchars($_POST['mois']);
    $annee = htmlspecialchars($_POST['annee']);
} else {
    //Semaine choisie automatiquement en fonction du jour
    $mois = date("m");
    $annee = date("Y");
}

require_once(PATH_MODELS.$page.'.php'); 
require_once(PATH_VIEWS.$page.'.php'); 