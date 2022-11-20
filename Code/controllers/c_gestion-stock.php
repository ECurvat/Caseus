<?php
if (($_SESSION['compte']->getPosition() != 'MANA') && ($_SESSION['compte']->getPosition() != 'ASSI')) {
    header("Location: index.php");
    exit;
}



if (isset($_POST['entreeValider'])) {
    // on trouve le nombre de produits envoyés :
    $nbProduitsEntree = 0;
    foreach($_POST as $key =>$value){
        if (substr($key, 0, -1) == 'entreeQteProduit') {
            $nbProduitsEntree++;
        }
    }    
}

if (isset($_POST['sortieValider'])) {
    // on trouve le nombre de produits envoyés :
    $nbProduitsSortie = 0;
    foreach($_POST as $key =>$value){
        if (substr($key, 0, -1) == 'sortieQteProduit') {
            $nbProduitsSortie++;
        }
    }    
}

require_once(PATH_MODELS.$page.'.php'); 
require_once(PATH_VIEWS.$page.'.php'); 
if (empty($listeProduits)) $alert = choixAlert('pas_de_produit');