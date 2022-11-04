<?php
$para = array($_SESSION['compte']->getId(), $mois, $annee);
require_once(PATH_MODELS.'DisponibiliteDAO.php');
$disponibiliteDAO = new DisponibiliteDAO(true);
$listeDispos = $disponibiliteDAO->getDispoParDate($para);

if (isset($_POST['idDispo'])) {
    $dispoEditee = $disponibiliteDAO->getDispoParId($_POST['idDispo']);
}

// Vérif de l'envoi du formulaire pour modifier une dispo
if (isset($_POST['modifier'])) {
    $dispoModifiee = new Disponibilite($_POST['modifId'], $_SESSION['compte']->getId(), $_POST['modifDebut'], $_POST['modifFin']);
    $disponibiliteDAO->modifierDispoParId($dispoModifiee);
}