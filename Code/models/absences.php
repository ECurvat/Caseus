<!-- Modèle de la page absences -->
<?php
require_once(PATH_MODELS_DAO.'AbsenceDAO.php');
$absenceDAO = new AbsenceDAO(true);

// Récupération de l'absence que l'on veut modifier
if (isset($_POST['idAbsence'])) {
    $absEditee = $absenceDAO->getAbsenceParId($_POST['idAbsence']);
}

// Gestion du formulaire de déclaration d'absence
if (isset($_POST['ajouter']) && isset($_POST['ajoutDebut']) && isset($_POST['ajoutFin'])) {
    // Vérification des contraintes (une absence ne peut pas être sur plusieurs jours)
    if (($_POST['ajoutDebut'] > $_POST['ajoutFin']) ||
        (explode("T", $_POST['ajoutDebut'])[0] != explode("T", $_POST['ajoutFin'])[0])) {
        $alert = choixAlert('contraintes');
    } else {
        // Contraintes respectées : ajout de l'absence
        $paramsAjout = array($_SESSION['compte']->getId(), $_POST['ajoutDebut'], $_POST['ajoutFin']);
        $absenceDAO->ajouterAbsence($paramsAjout);
        $alert = choixAlert('succes_operation');
    }
}

// Gestion du formulaire de modification d'absence
if (isset($_POST['modifier'])) {
    // Vérification des contraintes (une absence ne peut pas être sur plusieurs jours)
    if (($_POST['modifDebut'] > $_POST['modifFin']) ||
    (explode("T", $_POST['modifDebut'])[0] != explode("T", $_POST['modifFin'])[0]))  {
        $alert = choixAlert('contraintes');
    } else {
        // Contraintes respectées : modification de l'absence
        $absEditee = new Absence($_POST['modifId'], $_SESSION['compte']->getId(), $_POST['modifDebut'], $_POST['modifFin']);
        $absenceDAO->modifierAbsenceParId($absEditee);
        $alert = choixAlert('succes_operation');
    }
}

// Gestion du formulaire de suppression d'absence
if (isset($_POST['supprimer'])) {
    $absenceDAO->supprimerAbsenceParId($_POST['modifId']);
    $alert = choixAlert('succes_operation');
}

// Récupération de la liste des absences pour affichage
$para = array($_SESSION['compte']->getId(), $mois, $annee);
$listeAbsences = $absenceDAO->getAbsenceParDateParEmploye($para);
