<!-- Modèle de la page de gestion du stock -->
<?php
require_once(PATH_MODELS_DAO.'UniteDAO.php');
$uniteDAO = new UniteDAO(true);
require_once(PATH_MODELS_DAO.'ProduitDAO.php');
$produitDAO = new ProduitDAO(true);

// Récupération de la liste de tous les produits pour affichage
$listeProduits = $produitDAO->getListeProduits();

// Indexation des unités par id pour accès plus rapide
$listeUnites = $uniteDAO->getListeUnites();
$correspUnites = array();
foreach ($listeUnites as $unite) {
    $correspUnites[$unite->getIdUnite()] = $unite->getNomUnite();
}

// Traitement des produits entrés ou sortis
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
