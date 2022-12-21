<?php
$para = array($mois, $annee);
require_once(PATH_MODELS . 'AbsenceDAO.php');
$absenceDAO = new AbsenceDAO(true);
$listeAbsences = $absenceDAO->getAbsenceParDate($para);
require_once(PATH_MODELS . 'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);

// Partie principale : création des emplois du temps
$semTest = 49;
$anTest = 2022;
//                                                      Gestion des employés polyvalents
$listePoly = $employeDAO->getEmployesParRang('POLY');
// on trouve le premier jour de la semaine et le dernier jour de la semaine
$jourCourant = new DateTime(date('Y-m-d',strtotime($anTest.'W'.$semTest)));
// on boucle sur tous les jours de la semaine
for($i = 0; $i<7; $i++) {
    $dateJourCourant = $jourCourant->format('Y-m-d');
    // pour chaque polyvalent on récupère ses absences pour le jour courant
    $listeAbsPoly = array();
    // $listeAbsPoly à l'indice de l'id de l'employé, c'est un tableau avec les absences de l'employé pour le jour courant
    foreach ($listePoly as $poly) {
        $listeAbsPoly[$poly->getId()] = $absenceDAO->getAbsenceParJourEtEmp(array($poly->getId(), $dateJourCourant));
        // on supprime les polyvalents qui n'ont pas d'absence du tableau
        if($listeAbsPoly[$poly->getId()] == null) {
            unset($listeAbsPoly[$poly->getId()]);
        }
    }
    $jourCourant->modify('+1 day');
}