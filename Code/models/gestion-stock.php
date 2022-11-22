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
// traitement des produits entrés
if (isset($_POST['sortieValider']) || isset($_POST['entreeValider'])) {
    if ($nbProduitsEntree > 0) {
        for ($i=0; $i < $nbProduitsEntree; $i++) { 
            $produitDAO->ajouterQuantite(array($_POST["entreeQteProduit{$i}"], $_POST["entreeNomProduit{$i}"]));
        }
        $alert = choixAlert('succes_operation');
    } else if($nbProduitsSortie > 0) {
        for ($i=0; $i < $nbProduitsSortie; $i++) { 
            $produitDAO->majQuantite(array($_POST["sortieQteProduit{$i}"], $_POST["sortieNomProduit{$i}"]));
        }
        $alert = choixAlert('succes_operation');
    } else {
        $alert = choixAlert('form_vide');
    }
}
