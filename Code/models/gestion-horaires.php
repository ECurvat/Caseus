<?php
$para = array($mois, $annee);
require_once(PATH_MODELS . 'AbsenceDAO.php');
$absenceDAO = new AbsenceDAO(true);
$listeAbsences = $absenceDAO->getAbsenceParDate($para);
require_once(PATH_MODELS . 'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);
require_once(PATH_MODELS . 'ServiceDAO.php');
$serviceDAO = new ServiceDAO(true);

// Partie principale : création des emplois du temps
$semTest = 49;
$anTest = 2022;
//                                                      Gestion des employés polyvalents
$srvPoly = array();
for($i = 0; $i<7; $i++) {
    $srvPoly[$i] = array();
    // on crée un tableau avec les services pour chaque jour de la semaine
    $listeServices = $serviceDAO->getListeServices();
    foreach ($listeServices as $service) {
        if (date('h:i:s', strtotime($service->getFin()) - strtotime($service->getDebut())) == '04:30:00') {
            // alors c'est un service de polyvalent
            for($j = 0; $j<$service->getNombre(); $j++) {
                array_push($srvPoly[$i], $service);
            }
        }
    }
}
$listePoly = $employeDAO->getEmployesParRang('POLY');
$nbSrvPoly = array();
foreach ($listePoly as $elem) {
    $nbSrvPoly[$elem->getId()] = array(0, 0, 0, 0, 0, 0, 0);
}
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

    if (!empty($listeAbsPoly)) {
        // on va traiter les absences qu'il y a
        // si le polyvalent a une absence, on va regarder s'il peut faire un service de matin
        // si il peut on lui met, sinon on regarde si son absence lui permet de faire un service de soir
        // si il peut on lui met, sinon rien
        foreach ($listeAbsPoly as $idEmp => $tabAbs) {
            // dans abs, on a un tableau d'absences pour le polyvalent qu'on regarde
            foreach ($tabAbs as $nbAbs => $abs) {
                // le formattage ci-dessous permet d'enlever la date et de ne garder que l'heure
                $da = date("H:i:s", strtotime($abs->getDebut()));
                $fa = date("H:i:s", strtotime($abs->getFin()));
                echo '<BR>DA  //////////   DS  ////////////////////////////////////////////  FA   ///////////    FS';
                foreach ($srvPoly[$i] as $srv) {
                    $ds = date("H:i:s", strtotime($srv->getDebut()));
                    $fs = date("H:i:s", strtotime($srv->getFin()));
                    echo '<br>        ' . $da . " et " . $ds . "     //////////    " . $fa . " et " . $fs;
                    if (strtotime($da) < strtotime($ds) && strtotime($fa) < strtotime($ds) && $nbSrvPoly[$abs->getIdEmploye()][$i] == 0) {
                        $nbSrvPoly[$abs->getIdEmploye()][$i] = 1;
                        if(($key = array_search($srv, $srvPoly[$i], TRUE)) !== FALSE) {
                            unset($srvPoly[$i][$key]);
                        }
                        echo 'DA < DS et FA < DS';
                    }
                    if (strtotime($ds) < strtotime($da) && strtotime($fs) < strtotime($da) && $nbSrvPoly[$abs->getIdEmploye()][$i] == 0) {
                        $nbSrvPoly[$abs->getIdEmploye()][$i] = 1;
                        if(($key = array_search($srv, $srvPoly[$i], TRUE)) !== FALSE) {
                            unset($srvPoly[$i][$key]);
                        }
                        echo 'DS < DA et FS < DA';
                    }
                }
            }
        }
        echo '<pre>';
        print_r($srvPoly[$i]);
        echo '</pre>';
    }
    $jourCourant->modify('+1 day');
}

