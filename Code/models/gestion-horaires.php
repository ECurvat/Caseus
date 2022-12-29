<?php
$para = array($mois, $annee);
require_once(PATH_MODELS . 'AbsenceDAO.php');
$absenceDAO = new AbsenceDAO(true);
$listeAbsences = $absenceDAO->getAbsenceParDate($para);
require_once(PATH_MODELS . 'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);
require_once(PATH_MODELS . 'ServiceDAO.php');
$serviceDAO = new ServiceDAO(true);
require_once(PATH_MODELS . 'CongeDAO.php');
$congeDAO = new CongeDAO(true);
$listeConges = $congeDAO->getListeCongesAcceptesParDate(array($mois, $annee, $mois, $annee));



if (isset($_POST['generer'])) {
    
    // Partie principale : création des emplois du temps
    //                                                      Gestion des employés polyvalents
    $srvPoly = array();
    $affectation = array();

    function affecterService($jour, $idEmp, $srv) {    
        $GLOBALS['nbSrvPoly'][$idEmp][$jour] = 1;
        $GLOBALS['affectation'][$jour][$idEmp] = $srv;
        if ($srv != $GLOBALS['repos'] && $srv != $GLOBALS['conge']) {
            $GLOBALS['totSrvPoly'][$idEmp] += 1;
            if(($key = array_search($srv, $GLOBALS['srvPoly'][$jour], TRUE)) !== FALSE) {
                unset($GLOBALS['srvPoly'][$jour][$key]);
            }
        }
    }

    $listePoly = $employeDAO->getEmployesParRang('POLY');
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
        foreach ($listePoly as $elem) {
            $affectation[$i][$elem->getId()] = NULL;
        }
    }

    foreach($listeServices as $srv) {
        if($srv->getId() == 'y') {
            $conge = $srv;
        }
        if ($srv->getId() == 'z') {
            $repos = $srv;
        }
    }

    $nbSrvPoly = array();
    $totSrvPoly = array();
    foreach ($listePoly as $elem) {
        $nbSrvPoly[$elem->getId()] = array(0, 0, 0, 0, 0, 0, 0);
        $totSrvPoly[$elem->getId()] = 0;
    }

    if(!empty($listeConges)) {
        foreach ($listeConges as $elem) {
            $debut = new DateTime($elem->getDebut());
            $fin = new DateTime($elem->getFin());
            $debSemaine = new DateTime(date('Y-m-d',strtotime($anneePlanning.'W'.$semainePlanning)));
            $finSemaine = new DateTime(date('Y-m-d',strtotime($anneePlanning.'W'.$semainePlanning.'+6 days')));
            // echo strtotime($debSemaine->format("Y-m-d")) . ' ' . strtotime($finSemaine->format("Y-m-d")) . '<Br>';
            for($k = $debut; $k <= $fin; $k->modify('+1 day')){
                if($k <= $finSemaine && $k >= $debSemaine) {
                    affecterService($k->format("w"), $elem->getIdEmploye(), $conge);
                }
            }
        }
    }

    // on trouve le premier jour de la semaine et le dernier jour de la semaine
    $jourCourant = new DateTime(date('Y-m-d',strtotime($anneePlanning.'W'.$semainePlanning)));
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
            // on traite les absences en priorité, et on regarde si on peut affecter un service avec les conditions de l'absence
            foreach ($listeAbsPoly as $idEmp => $tabAbs) {
                // dans abs, on a un tableau d'absences pour le polyvalent qu'on regarde
                foreach ($tabAbs as $nbAbs => $abs) {
                    // le formattage ci-dessous permet d'enlever la date et de ne garder que l'heure
                    $da = date("H:i:s", strtotime($abs->getDebut()));
                    $fa = date("H:i:s", strtotime($abs->getFin()));
                    foreach ($srvPoly[$i] as $srv) {
                        $ds = date("H:i:s", strtotime($srv->getDebut()));
                        $fs = date("H:i:s", strtotime($srv->getFin()));
                        // si l'absence se passe avant le début et la fin du service
                        if (strtotime($da) < strtotime($ds) && strtotime($fa) < strtotime($ds) && $nbSrvPoly[$abs->getIdEmploye()][$i] == 0 && array_sum($nbSrvPoly[$poly->getId()]) != 5) {
                            affecterService($i, $abs->getIdEmploye(), $srv);
                        }
                        // si l'absence se passe après le début et la fin du service
                        if (strtotime($ds) < strtotime($da) && strtotime($fs) < strtotime($da) && $nbSrvPoly[$abs->getIdEmploye()][$i] == 0 && array_sum($nbSrvPoly[$poly->getId()]) != 5) {
                            affecterService($i, $abs->getIdEmploye(), $srv);
                        }
                        if ($affectation[$i][$abs->getIdEmploye()] == NULL) {
                            affecterService($i, $abs->getIdEmploye(), $repos);
                        }
                    } 
                }
            }
        }
        $jourCourant->modify('+1 day');
    }

    for ($i=0; $i < 7; $i++) { 
        foreach ($totSrvPoly as $key => $value) {
            if($nbSrvPoly[$key][$i] == 0 && $totSrvPoly[$key] != 5 && !empty($srvPoly[$i])) {
                affecterService($i, $key, $srvPoly[$i][array_rand($srvPoly[$i])]);
            }
        }
        // tri pour affecter en priorité les employés qui travaillent peu
        asort($totSrvPoly);
    }
    // todo : traiter les jours qui ont le plus de SNA ?
    // todo : vérifier si pas congé mdr
}
