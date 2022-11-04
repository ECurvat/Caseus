<?php
$para = array($_SESSION['compte']->getId(), $mois, $annee);
require_once(PATH_MODELS.'DisponibiliteDAO.php');
$disponibiliteDAO = new DisponibiliteDAO(true);
$listeDispos = $disponibiliteDAO->getDispoParDate($para);

if (isset($_POST['idDispo'])) {
    $dispoEditee = $disponibiliteDAO->getDispoParId($_POST['idDispo']);
}

if (isset($_POST['ajouter']) &&
    isset($_POST['ajoutDebut']) &&
    isset($_POST['ajoutFin'])) {
    // ici, c'est le formulaire d'ajout qui a été envoyé
    $paramsAjout = array($_SESSION['compte']->getId(), $_POST['ajoutDebut'], $_POST['ajoutFin']);
    $disponibiliteDAO->ajouterDispo($paramsAjout);
    $alert = choixAlert('succes_operation');
}

if (isset($_POST['modifier'])) {
    // ici, c'est le formulaire pour modifier une dispo qui a été envoyé
    $dispoModifiee = new Disponibilite($_POST['modifId'], $_SESSION['compte']->getId(), $_POST['modifDebut'], $_POST['modifFin']);
    $disponibiliteDAO->modifierDispoParId($dispoModifiee);
    $alert = choixAlert('succes_operation');
}

if (isset($_POST['supprimer'])) {
    // ici, c'est le formulaire pour supprimer une dispo qui été envoyé
    $disponibiliteDAO->supprimerDispoParId($_POST['modifId']);
    $alert = choixAlert('succes_operation');
}