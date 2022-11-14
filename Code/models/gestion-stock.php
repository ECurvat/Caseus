<?php
require_once(PATH_MODELS.'UniteDAO.php');
$uniteDAO = new UniteDAO(true);
$listeUnites = $uniteDAO->getListeUnites();
$correspUnites = array();
foreach ($listeUnites as $unite) {
    $correspUnites[$unite->getIdUnite()] = $unite->getNomUnite();
}

require_once(PATH_MODELS.'ProduitDAO.php');
$produitDAO = new ProduitDAO(true);
$listeProduits = $produitDAO->getListeProduits();
