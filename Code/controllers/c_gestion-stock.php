<!-- Contrôleur page de gestion du stock -->
<?php
// Vérification des autorisations
if (($_SESSION['compte']->getPosition() != 'MANA') && ($_SESSION['compte']->getPosition() != 'ASSI')) {
    header("Location: index.php");
    exit;
}

// Recherche du nombre de produits entrés
if (isset($_POST['entreeValider'])) {
    // Il faut parcourir toute la variable superglobale $_POST car les champs sont numérotés, et on ne sait pas combien de produits ont été entrés
    $nbProduitsEntree = 0;
    foreach($_POST as $key => $value){
        if (substr($key, 0, -1) == 'entreeQteProduit') {
            $nbProduitsEntree++;
        }
    }    
}

// Recherche du nombre de produits sortis
if (isset($_POST['sortieValider'])) {
    // Il faut parcourir toute la variable superglobale $_POST car les champs sont numérotés, et on ne sait pas combien de produits ont été sortis
    $nbProduitsSortie = 0;
    foreach($_POST as $key =>$value){
        if (substr($key, 0, -1) == 'sortieQteProduit') {
            $nbProduitsSortie++;
        }
    }    
}

require_once(PATH_MODELS.$page.'.php');

// Aucun produit dans la base de données : affichage d'un message d'alerte
if (empty($listeProduits)) $alert = choixAlert('pas_de_produit');

require_once(PATH_VIEWS.$page.'.php'); 