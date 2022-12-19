<?php
$para = array($_SESSION['compte']->getId(), $mois, $annee);
require_once(PATH_MODELS.'AbsenceDAO.php');
$absenceDAO = new AbsenceDAO(true);

if (isset($_POST['idAbsence'])) {
    $absEditee = $absenceDAO->getAbsenceParId($_POST['idAbsence']);
}

if (isset($_POST['ajouter']) &&
    isset($_POST['ajoutDebut']) &&
    isset($_POST['ajoutFin'])) {
        echo 'envoyé';
    // ici, c'est le formulaire d'ajout qui a été envoyé
    if (($_POST['ajoutDebut'] > $_POST['ajoutFin']) ||
    (explode("T", $_POST['ajoutDebut'])[0] != explode("T", $_POST['ajoutFin'])[0])) {
        $alert = choixAlert('contraintes');
    } else {
        $paramsAjout = array($_SESSION['compte']->getId(), $_POST['ajoutDebut'], $_POST['ajoutFin']);
        $absenceDAO->ajouterAbsence($paramsAjout);
        $alert = choixAlert('succes_operation');
    }
}

$listeAbsences = $absenceDAO->getAbsenceParDateParEmploye($para);

if (isset($_POST['modifier'])) {
    // ici, c'est le formulaire pour modifier une dispo qui a été envoyé
    if (($_POST['modifDebut'] > $_POST['modifFin']) ||
    (explode("T", $_POST['modifDebut'])[0] != explode("T", $_POST['modifFin'])[0]))  {
        $alert = choixAlert('contraintes');
    } else {
        $absEditee = new Absence($_POST['modifId'], $_SESSION['compte']->getId(), $_POST['modifDebut'], $_POST['modifFin']);
        $absenceDAO->modifierAbsenceParId($absEditee);
        $alert = choixAlert('succes_operation');
    }
}

if (isset($_POST['supprimer'])) {
    // ici, c'est le formulaire pour supprimer une dispo qui été envoyé
    $absenceDAO->supprimerAbsenceParId($_POST['modifId']);
    $alert = choixAlert('succes_operation');
}