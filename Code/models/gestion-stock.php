<?php
// listing des produits
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
// insertion des produits entrés
if($nbProduitsEnvoyes > 0) {
    for ($i=0; $i < $nbProduitsEnvoyes; $i++) { 
        echo 'on va insérer '.$_POST["entreeQteProduit{$i}"].' fois le produit numéro '.$_POST["entreeNomProduit{$i}"];
    }
}
