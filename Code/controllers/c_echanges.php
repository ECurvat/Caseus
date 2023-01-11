<?php
if (isset($_POST['choixJour'])) {
    // on cherche la semaine pour vérifier s'il y a un planning
    $semaine = date("W", strtotime($_POST['choixJour']));
    $annee = date("Y", strtotime($_POST['choixJour']));
}

if (isset($_POST['anneeEnvoi'])) {
    if(is_numeric($_POST['anneeEnvoi']) && $_POST['anneeEnvoi']) {
        $anneeEnvoi = $_POST['anneeEnvoi'];
    }
} else {
    $anneeEnvoi = date("Y");
}

if (isset($_POST['anneeRecep'])) {
    if(is_numeric($_POST['anneeRecep']) && $_POST['anneeRecep']) {
        $anneeRecep = $_POST['anneeRecep'];
    }
} else {
    $anneeRecep = date("Y");
}

require_once(PATH_MODELS.$page.'.php');

require_once(PATH_VIEWS.$page.'.php'); 