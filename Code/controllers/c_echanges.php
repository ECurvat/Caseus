<!-- Contrôleur page d'échanges -->
<?php

// Initiation d'une demande d'échange
if (isset($_POST['choixJour'])) {
    // L'utilisateur cherche à afficher les échanges qu'il peut réaliser à une date précise
    $semaine = date("W", strtotime($_POST['choixJour']));
    $annee = date("Y", strtotime($_POST['choixJour']));
}

// Gestion des échanges envoyés par l'utilisateur
if (isset($_POST['anneeEnvoi'])) {
    // L'utilisateur cherche une année pécise : on vérifie le bon format
    if(is_numeric($_POST['anneeEnvoi']) && $_POST['anneeEnvoi']) {
        $anneeEnvoi = $_POST['anneeEnvoi'];
    }
} else {
    // L'utilisateur n'a pas entré d'année : on prend l'année courante
    $anneeEnvoi = date("Y");
}

// Gestion des échanges reçus par l'utilisateur
if (isset($_POST['anneeRecep'])) {
    // L'utilisateur cherche une année pécise : on vérifie le bon format
    if(is_numeric($_POST['anneeRecep']) && $_POST['anneeRecep']) {
        $anneeRecep = $_POST['anneeRecep'];
    }
} else {
    // L'utilisateur n'a pas entré d'année : on prend l'année courante
    $anneeRecep = date("Y");
}

require_once(PATH_MODELS.$page.'.php');
require_once(PATH_VIEWS.$page.'.php'); 