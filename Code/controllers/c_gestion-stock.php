<?php
if (($_SESSION['compte']->getPosition() != 'MANA') && ($_SESSION['compte']->getPosition() != 'ASSI')) {
    header("Location: index.php");
    exit;
}
require_once(PATH_MODELS.$page.'.php'); 
require_once(PATH_VIEWS.$page.'.php'); 
if (empty($listeProduits)) $alert = choixAlert('pas_de_produit');