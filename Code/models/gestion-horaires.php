<?php
$para = array($mois, $annee);
require_once(PATH_MODELS_DAO . 'AbsenceDAO.php');
$absenceDAO = new AbsenceDAO(true);
require_once(PATH_MODELS_DAO . 'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);
require_once(PATH_MODELS_DAO . 'ServiceDAO.php');
$serviceDAO = new ServiceDAO(true);
require_once(PATH_MODELS_DAO . 'CongeDAO.php');
$congeDAO = new CongeDAO(true);
require_once(PATH_MODELS_DAO . 'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
require_once(PATH_MODELS_DAO . 'JourDAO.php');
$jourDAO = new JourDAO(true);
$listeAbsences = $absenceDAO->getAbsenceParDate($para);
$listeConges = $congeDAO->getListeCongesAcceptesParDate(array($mois, $annee, $mois, $annee));

if (isset($_POST['generer'])) {
    // on regarde si le planning a déjà été généré pour tous les employés
    $generation = false;
    $listeEmployes = $employeDAO->getListeEmployes();
    if(isset($_POST['ignorer'])) {
        // on peut écraser le planning s'il existe déjà
        foreach ($listeEmployes as $elem) {
            $param = array($elem->getId(), $semainePlanning, $anneePlanning);
            if ($planningDAO->getPlanningParEmp($param) == null) {
                $planningDAO->addPlanning(array($elem->getId(), $semainePlanning, $anneePlanning));
            }
        }
        $generation = true;
    } else {
        // si le planning existe déjà, on ne peut pas le générer : donc on cherche à savoir si tous les employés ont un planning
        $planningGenere = true;
        foreach ($listeEmployes as $elem) {
            $param = array($elem->getId(), $semainePlanning, $anneePlanning);
            if ($planningDAO->getPlanningParEmp($param) == null) {
                $planningGenere = false;
                $planningDAO->addPlanning(array($elem->getId(), $semainePlanning, $anneePlanning));
            }
        }
        if (!$planningGenere) {
            $generation = true;
        }
    }
    
    if ($generation) {
        $srvPoly = array();
        $srvAssiMana = array();
        $affectation = array();

        function affecterService($jour, $idEmp, $srv) {
            if($GLOBALS['affectation'][$jour][$idEmp] == null) {
                $GLOBALS['affectation'][$jour][$idEmp] = $srv;
                if($GLOBALS['employeDAO']->getEmployeParId($idEmp)->getPosition() == 'POLY') {
                    $GLOBALS['nbSrvPoly'][$idEmp][$jour] = 1;
                    if ($srv != $GLOBALS['repos'] && $srv != $GLOBALS['conge']) {
                        $GLOBALS['totSrvPoly'][$idEmp] += 1;
                        if(($key = array_search($srv, $GLOBALS['srvPoly'][$jour], TRUE)) !== FALSE) {
                            unset($GLOBALS['srvPoly'][$jour][$key]);
                        }
                    }
                } else {
                    $GLOBALS['nbSrvAssiMana'][$idEmp][$jour] = 1;
                    if ($srv != $GLOBALS['repos'] && $srv != $GLOBALS['conge']) {
                        $GLOBALS['totSrvAssiMana'][$idEmp] += 1;
                        if(($key = array_search($srv, $GLOBALS['srvAssiMana'][$jour], TRUE)) !== FALSE) {
                            unset($GLOBALS['srvAssiMana'][$jour][$key]);
                        }
                    }
                }
            }        
        }

        $listePoly = $employeDAO->getEmployesParRang('POLY');
        $listeAssiMana = array_merge($employeDAO->getEmployesParRang('ASSI'), $employeDAO->getEmployesParRang('MANA'));

        for($i = 0; $i<7; $i++) {
            $srvPoly[$i] = array();
            $srvAssiMana[$i] = array();
            // on crée un tableau avec les services pour chaque jour de la semaine
            $listeServices = $serviceDAO->getListeServices();
            foreach ($listeServices as $service) {
                if (date('h:i:s', strtotime($service->getFin()) - strtotime($service->getDebut())) == '04:30:00') {
                    // alors c'est un service de polyvalent
                    for($j = 0; $j<$service->getNombre(); $j++) {
                        array_push($srvPoly[$i], $service);
                    }
                } else {
                    for($j = 0; $j<$service->getNombre(); $j++) {
                        array_push($srvAssiMana[$i], $service);
                    }
                }
            }
            foreach ($listePoly as $elem) {
                $affectation[$i][$elem->getId()] = NULL;
            }
            foreach ($listeAssiMana as $elem) {
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

        //POLY
        $nbSrvPoly = array();
        $totSrvPoly = array();
        foreach ($listePoly as $elem) {
            $nbSrvPoly[$elem->getId()] = array(0, 0, 0, 0, 0, 0, 0);
            $totSrvPoly[$elem->getId()] = 0;
        }

        $nbSrvAssiMana = array();
        $totSrvAssiMana = array();
        foreach ($listeAssiMana as $elem) {
            $nbSrvAssiMana[$elem->getId()] = array(0, 0, 0, 0, 0, 0, 0);
            $totSrvAssiMana[$elem->getId()] = 0;
        }

        //POLY
        if(!empty($listeConges)) {
            foreach ($listeConges as $elem) {
                $debut = new DateTime($elem->getDebut());
                $fin = new DateTime($elem->getFin());
                $debSemaine = new DateTime(date('Y-m-d',strtotime($anneePlanning.'W'.$semainePlanning)));
                $finSemaine = new DateTime(date('Y-m-d',strtotime($anneePlanning.'W'.$semainePlanning.'+6 days')));
                for($k = $debut; $k <= $fin; $k->modify('+1 day')){
                    if($k <= $finSemaine && $k >= $debSemaine) {                    
                        if($k->format("w") == 0)
                            affecterService(6, $elem->getIdEmploye(), $conge);
                        else
                            affecterService($k->format("w") - 1, $elem->getIdEmploye(), $conge);
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
            $listeAbsAssiMana = array();
            foreach ($listeAssiMana as $assiMana) {
                $listeAbsAssiMana[$assiMana->getId()] = $absenceDAO->getAbsenceParJourEtEmp(array($assiMana->getId(), $dateJourCourant));
                if($listeAbsAssiMana[$assiMana->getId()] == null) {
                    unset($listeAbsAssiMana[$assiMana->getId()]);
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
                            if (strtotime($da) < strtotime($ds) && strtotime($fa) < strtotime($ds) && $nbSrvPoly[$abs->getIdEmploye()][$i] == 0 && array_sum($nbSrvPoly[$abs->getIdEmploye()]) != 5) {
                                affecterService($i, $abs->getIdEmploye(), $srv);
                            }
                            // si l'absence se passe après le début et la fin du service
                            if (strtotime($ds) < strtotime($da) && strtotime($fs) < strtotime($da) && $nbSrvPoly[$abs->getIdEmploye()][$i] == 0 && array_sum($nbSrvPoly[$abs->getIdEmploye()]) != 5) {
                                affecterService($i, $abs->getIdEmploye(), $srv);
                            }
                            
                        } 
                        if ($affectation[$i][$abs->getIdEmploye()] == NULL) {
                            affecterService($i, $abs->getIdEmploye(), $repos);
                        }
                    }
                }
            }
            if (!empty($listeAbsAssiMana)) {
                
                foreach($listeAbsAssiMana as $idEmp => $tabAbs) {
                    foreach ($tabAbs as $nbAbs => $abs) {
                        $da = date("H:i:s", strtotime($abs->getDebut()));
                        $fa = date("H:i:s", strtotime($abs->getFin()));
                        foreach ($srvAssiMana[$i] as $srv) {
                            $ds = date("H:i:s", strtotime($srv->getDebut()));
                            $fs = date("H:i:s", strtotime($srv->getFin()));
                            if (strtotime($da) < strtotime($ds) && strtotime($fa) < strtotime($ds) && $nbSrvAssiMana[$abs->getIdEmploye()][$i] == 0 && array_sum($nbSrvAssiMana[$abs->getIdEmploye()]) != 5) {
                                affecterService($i, $abs->getIdEmploye(), $srv);
                            }
                            if (strtotime($ds) < strtotime($da) && strtotime($fs) < strtotime($da) && $nbSrvAssiMana[$abs->getIdEmploye()][$i] == 0 && array_sum($nbSrvAssiMana[$abs->getIdEmploye()]) != 5) {
                                affecterService($i, $abs->getIdEmploye(), $srv);
                            }
                            
                        } 
                        if ($affectation[$i][$abs->getIdEmploye()] == NULL) {
                            affecterService($i, $abs->getIdEmploye(), $repos);
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
            foreach ($totSrvAssiMana as $key => $value) {
                if($nbSrvAssiMana[$key][$i] == 0 && $totSrvAssiMana[$key] != 5 && !empty($srvAssiMana[$i])) {
                    // on regarde si il reste un d à affecter
                    foreach ($srvAssiMana[$i] as $srv) {
                        if ($srv->getId() == 'd') {
                            affecterService($i, $key, $srv);
                            break;
                        } else {
                            // aucun service d trouvé
                            if(count($srvAssiMana[$i]) == 2) {
                                // il reste les deux i : on peut l'affecter sans se poser de question
                                affecterService($i, $key, $srv);
                            } else {
                                // il ne reste qu'un seul i
                                // on cherche qui a le premier i affecté
                                foreach ($listeAssiMana as $assimana) {
                                    if ($affectation[$i][$assimana->getId()] != null && $affectation[$i][$assimana->getId()]->getId() == 'i') {
                                        foreach ($listeAssiMana as $elem) {
                                            // il faut parcourir tous les emp parce qu'on ne sait pas la position de l'employé courant
                                            if ($elem->getId() == $key) {
                                                if (($assimana->getPosition() == "MANA" && $elem->getPosition() == 'ASSI')
                                                || ($assimana->getPosition() == "ASSI" && $elem->getPosition() == 'ASSI')
                                                || ($assimana->getPosition() == "ASSI" && $elem->getPosition() == 'MANA')) {
                                                    affecterService($i, $key, $srv);
                                                    break;
                                                }
                                            }
                                        }
                                        
                                        
                                    }
                                }
                            }
                            break;
                        }
                    }
                    // si y a pas de d, on regarde si y a déjà un i qui a été affecté, et si oui à qui
                    // si aucun i n'a été affecté, on l'affecte à l'employé
                    // si un i a été affecté à un mana, et que l'employé actuel est un assi, on lui affecte
                    // si un i a été affecté à un assi, et que l'employé actuel est un mana OU un assi, on lui affecte
                }
            }
            // tri pour affecter en priorité les employés qui travaillent peu
            asort($totSrvPoly);
            asort($totSrvAssiMana);
        }

        // heures supplémentaires
        for ($i=0; $i < 7; $i++) {
            if (!empty($srvPoly[$i])) {
                // on parcourt tous les employés et on regarde si ils travaillent
                foreach ($listePoly as $poly) {
                    if ($affectation[$i][$poly->getId()] == NULL) {
                        // on regarde si il est ok pour des heures sup
                        if ($poly->getHeuresSup() == '1') {
                            affecterService($i, $poly->getId(), $srvPoly[$i][array_rand($srvPoly[$i])]);
                        }
                    }
                }
            }
            if(!empty($srvAssiMana[$i])) {
                foreach ($listeAssiMana as $assimana) {
                    if ($affectation[$i][$assimana->getId()] == NULL) {
                        // on regarde si il est ok pour des heures sup
                        if ($assimana->getHeuresSup() == '1') {
                            foreach ($srvAssiMana[$i] as $srv) {
                                if ($srv->getId() == 'd') {
                                    affecterService($i, $assimana->getId(), $srv);
                                    break;
                                } else {
                                    // aucun service d trouvé
                                    if(count($srvAssiMana[$i]) == 2) {
                                        // il reste les deux i : on peut l'affecter sans se poser de question
                                        affecterService($i, $assimana->getId(), $srv);
                                    } else {
                                        // il ne reste qu'un seul i
                                        // on cherche qui a le premier i affecté
                                        foreach ($listeAssiMana as $premier) {
                                            if ($affectation[$i][$premier->getId()] != null && $affectation[$i][$premier->getId()]->getId() == 'i') {
                                                if (($premier->getPosition() == "MANA" && $assimana->getPosition() == 'ASSI')
                                                || ($premier->getPosition() == "ASSI" && $assimana->getPosition() == 'ASSI')
                                                || ($premier->getPosition() == "ASSI" && $assimana->getPosition() == 'MANA')) {
                                                    affecterService($i, $assimana->getId(), $srv);
                                                    break;
                                                }
                                            }
                                        }
                                    }
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
        // création des jours dans les plannings
        
        if(isset($_POST['ignorer'])) {
            foreach ($listeEmployes as $elem) {
                $planningCourant = $planningDAO->getPlanningParEmp(array($elem->getId(), $semainePlanning, $anneePlanning));
                $jourDAO->removeJoursParPlanning($planningCourant->getIdPlanning());
            }
        }

        foreach ($affectation as $numJour => $value) {
            foreach($value as $idEmp => $srv) {
                if ($srv != null) {
                    $planningCourant = $planningDAO->getPlanningParEmp(array($idEmp, $semainePlanning, $anneePlanning));
                    $jourDAO->addJour(array($planningCourant->getIdPlanning(), $numJour, $srv->getId()));
                }
                
            }
        }
        
    }
}

if (isset($_POST['voir'])) {
    // on récupère la liste de tous les employés
    $listeEmployes = $employeDAO->getListeEmployes();
    $planningGenere = true;
    foreach ($listeEmployes as $elem) {
        $param = array($elem->getId(), $semainePlanning, $anneePlanning);
        if ($planningDAO->getPlanningParEmp($param) == null) {
            $planningGenere = false;
        }
    }
    if(!$planningGenere) {
        $alert = choixAlert('planning_pas_fait');
    } else {
        // on les trie par position
        $listePoly = array();
        $listeAssiMana = array();
        $listePlannings = array();
        foreach ($listeEmployes as $employe) {
            if ($employe->getPosition() == 'POLY') {
                $listePoly[] = $employe;
            } else {
                $listeAssiMana[] = $employe;
            }
            $listePlannings[$employe->getId()] = $planningDAO->getPlanningParEmp(array($employe->getId(), $semainePlanning, $anneePlanning));
        }
        // on récupère la liste des services
        $listeServices = $serviceDAO->getListeServices();
        
        // on déclare les affectations
        $affectation = array();
        $srvPoly = array();
        $srvAssiMana = array();
        for($i=0; $i<7; $i++) {
            foreach ($listePoly as $elem) {
                $affectation[$i][$elem->getId()] = NULL;
            }
            foreach ($listeAssiMana as $elem) {
                $affectation[$i][$elem->getId()] = NULL;
            }
            $srvPoly[$i] = array();
            $srvAssiMana[$i] = array();
            // on crée un tableau avec les services pour chaque jour de la semaine
            $listeServices = $serviceDAO->getListeServices();
            foreach ($listeServices as $service) {
                if (date('h:i:s', strtotime($service->getFin()) - strtotime($service->getDebut())) == '04:30:00') {
                    // alors c'est un service de polyvalent
                    for($j = 0; $j<$service->getNombre(); $j++) {
                        array_push($srvPoly[$i], $service);
                    }
                } else {
                    for($j = 0; $j<$service->getNombre(); $j++) {
                        array_push($srvAssiMana[$i], $service);
                    }
                }
            }
        }

        $totSrvPoly = array();
        foreach ($listePoly as $elem) {
            $totSrvPoly[$elem->getId()] = 0;
        }
        $totSrvAssiMana = array();
        foreach ($listeAssiMana as $elem) {
            $totSrvAssiMana[$elem->getId()] = 0;
        }

        foreach ($listePoly as $poly) {
            for($i=0; $i<7; $i++) {
                $jour = $jourDAO->getJourParPlanningEtNumero(array($listePlannings[$poly->getId()]->getIdPlanning(), $i));
                if ($jour != null) {
                    $srv = $serviceDAO->getServiceParId($jour->getIdService());
                    $affectation[$i][$poly->getId()] = $srv;
                    $totSrvPoly[$poly->getId()]++;
                    foreach ($srvPoly[$i] as $key => $current) {
                        if($current == $srv) {
                            unset($srvPoly[$i][$key]);
                        }
                    }
                }
            }
        }

        foreach ($listeAssiMana as $assimana) {
            for($i=0; $i<7; $i++) {
                $jour = $jourDAO->getJourParPlanningEtNumero(array($listePlannings[$assimana->getId()]->getIdPlanning(), $i));
                if ($jour != null) {
                    $srv = $serviceDAO->getServiceParId($jour->getIdService());
                    $affectation[$i][$assimana->getId()] = $srv;
                    $totSrvAssiMana[$assimana->getId()]++;
                    foreach ($srvAssiMana[$i] as $key => $current) {
                        if($current == $srv) {
                            unset($srvAssiMana[$i][$key]);
                        }
                    }
                }
            }
        }
    }
}