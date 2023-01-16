<!-- Modèle de la page de gestion des horaires -->
<?php
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

// Récupération de la liste des absences et congés de tous les employés
$para = array($mois, $annee);
$listeAbsences = $absenceDAO->getAbsenceParDate($para);
$listeConges = $congeDAO->getListeCongesAcceptesParDate(array($mois, $annee, $mois, $annee));

// Gestion de la génération d'un planning
if (isset($_POST['generer'])) {
    // On regarde si le planning a déjà été généré pour tous les employés
    $generation = false;
    $listeEmployes = $employeDAO->getListeEmployes();

    // La checkbox ignorer permet d'écraser un planning déjà existant
    if(isset($_POST['ignorer'])) {
        // On peut écraser le planning s'il existe déjà
        foreach ($listeEmployes as $elem) {
            $param = array($elem->getId(), $semainePlanning, $anneePlanning);
            if ($planningDAO->getPlanningParEmp($param) == null) {
                $planningDAO->addPlanning(array($elem->getId(), $semainePlanning, $anneePlanning));
            }
        }
        $generation = true;
    } else {
        // Si le planning existe déjà, on ne peut pas le générer : donc on cherche à savoir si tous les employés ont un planning
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
    
    // Si $generation est à true, on lance la génération du planning
    if ($generation) {
        $srvPoly = array(); // Tableau des services de polyvalents
        $srvAssiMana = array(); // Tableau des services d'assistant/manager
        $affectation = array(); // Tableau des affectations des employés

        /**
         * Fonction qui affecte un service à un employé pour un jour donné
         * @param int $jour
         * @param int $idEmp
         * @param int $srv
         */
        function affecterService($jour, $idEmp, $srv) {
            // On vérifie que l'employé n'est pas déjà affecté à un service pour ce jour
            if($GLOBALS['affectation'][$jour][$idEmp] == null) {
                $GLOBALS['affectation'][$jour][$idEmp] = $srv;

                // Traitement différent selon la position de l'employé
                if($GLOBALS['employeDAO']->getEmployeParId($idEmp)->getPosition() == 'POLY') {
                    $GLOBALS['nbSrvPoly'][$idEmp][$jour] = 1;
                    if ($srv != $GLOBALS['repos'] && $srv != $GLOBALS['conge']) {
                        $GLOBALS['totSrvPoly'][$idEmp] += 1;

                        // On supprime le service de la liste des services disponibles pour ce jour
                        if(($key = array_search($srv, $GLOBALS['srvPoly'][$jour], TRUE)) !== FALSE) {
                            unset($GLOBALS['srvPoly'][$jour][$key]);
                        }
                    }
                } else {
                    $GLOBALS['nbSrvAssiMana'][$idEmp][$jour] = 1;
                    if ($srv != $GLOBALS['repos'] && $srv != $GLOBALS['conge']) {
                        $GLOBALS['totSrvAssiMana'][$idEmp] += 1;

                        // On supprime le service de la liste des services disponibles pour ce jour
                        if(($key = array_search($srv, $GLOBALS['srvAssiMana'][$jour], TRUE)) !== FALSE) {
                            unset($GLOBALS['srvAssiMana'][$jour][$key]);
                        }
                    }
                }
            }        
        }

        // On récupère les services de polyvalents et d'assistants/managers
        $listePoly = $employeDAO->getEmployesParRang('POLY');
        $listeAssiMana = array_merge($employeDAO->getEmployesParRang('ASSI'), $employeDAO->getEmployesParRang('MANA'));

        // Initialisation de variables
        for($i = 0; $i<7; $i++) {
            $srvPoly[$i] = array();
            $srvAssiMana[$i] = array();

            // On crée un tableau avec les services pour chaque jour de la semaine
            $listeServices = $serviceDAO->getListeServices();
            foreach ($listeServices as $service) {
                if (date('h:i:s', strtotime($service->getFin()) - strtotime($service->getDebut())) == '04:30:00') {
                    // Alors c'est un service de polyvalent
                    for($j = 0; $j<$service->getNombre(); $j++) {
                        array_push($srvPoly[$i], $service);
                    }
                } else {
                    for($j = 0; $j<$service->getNombre(); $j++) {
                        array_push($srvAssiMana[$i], $service);
                    }
                }
            }

            // On met toutes les affectations à NULL
            foreach ($listePoly as $elem) {
                $affectation[$i][$elem->getId()] = NULL;
            }
            foreach ($listeAssiMana as $elem) {
                $affectation[$i][$elem->getId()] = NULL;
            }
        }

        // On récupère les services de congé et de repos pour accès plus facile plus tard
        foreach($listeServices as $srv) {
            if($srv->getId() == 'y') {
                $conge = $srv;
            }
            if ($srv->getId() == 'z') {
                $repos = $srv;
            }
        }

        // Variables pour vérifier ou compter les jours travaillés
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

        // $nbSrvPoly[id employé] et nbSrvAssiMana[id employé] contiennent 7 cases qui indiquent les jours travaillés
        // $totSrvPoly[id employé] et totSrvAssiMana[id employé] contiennent 1 case qui indique le nombre total de jours travaillés cette semaine

        // Il faut prendre en compte les demandes de congés déjà acceptées
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

        // On trouve le premier jour de la semaine du planning
        $jourCourant = new DateTime(date('Y-m-d',strtotime($anneePlanning.'W'.$semainePlanning)));
        // On boucle sur tous les jours de la semaine
        for($i = 0; $i<7; $i++) {
            $dateJourCourant = $jourCourant->format('Y-m-d');
            // Pour chaque polyvalent on récupère ses absences pour le jour courant
            $listeAbsPoly = array();
            // $listeAbsPoly[id de l'employé] c'est un tableau avec les absences de l'employé pour le jour courant
            foreach ($listePoly as $poly) {
                $listeAbsPoly[$poly->getId()] = $absenceDAO->getAbsenceParJourEtEmp(array($poly->getId(), $dateJourCourant));
                // On supprime les polyvalents qui n'ont pas d'absence du tableau
                if($listeAbsPoly[$poly->getId()] == null) {
                    unset($listeAbsPoly[$poly->getId()]);
                }
            }

            // Idem pour les assistants/managers
            $listeAbsAssiMana = array();
            foreach ($listeAssiMana as $assiMana) {
                $listeAbsAssiMana[$assiMana->getId()] = $absenceDAO->getAbsenceParJourEtEmp(array($assiMana->getId(), $dateJourCourant));
                if($listeAbsAssiMana[$assiMana->getId()] == null) {
                    unset($listeAbsAssiMana[$assiMana->getId()]);
                }
            }
            
            // Après les congés, on traite les absences
            if (!empty($listeAbsPoly)) {
                // On traite les absences en priorité, et on regarde si on peut affecter un service avec les conditions de l'absence
                foreach ($listeAbsPoly as $idEmp => $tabAbs) {
                    // Dans tabAbs, on a un tableau d'absences pour le polyvalent qu'on regarde
                    foreach ($tabAbs as $nbAbs => $abs) {
                        // le formattage ci-dessous permet d'enlever la date et de ne garder que l'heure
                        $da = date("H:i:s", strtotime($abs->getDebut()));
                        $fa = date("H:i:s", strtotime($abs->getFin()));

                        // Parcours de tous les services restants à affecter, et on regarde si on peut affecter un service même avec une absence
                        foreach ($srvPoly[$i] as $srv) {
                            $ds = date("H:i:s", strtotime($srv->getDebut()));
                            $fs = date("H:i:s", strtotime($srv->getFin()));
                            // Si l'absence se passe avant le début et la fin du service
                            if (strtotime($da) < strtotime($ds) && strtotime($fa) < strtotime($ds) && $nbSrvPoly[$abs->getIdEmploye()][$i] == 0 && array_sum($nbSrvPoly[$abs->getIdEmploye()]) != 5) {
                                affecterService($i, $abs->getIdEmploye(), $srv);
                            }
                            // Si l'absence se passe après le début et la fin du service
                            if (strtotime($ds) < strtotime($da) && strtotime($fs) < strtotime($da) && $nbSrvPoly[$abs->getIdEmploye()][$i] == 0 && array_sum($nbSrvPoly[$abs->getIdEmploye()]) != 5) {
                                affecterService($i, $abs->getIdEmploye(), $srv);
                            }
                        } 

                        // Si on a pas pu affecter un service, on affecte un repos
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

        // Après les congés et les absences, plus de contrainte, on peut affecter librement les services
        for ($i=0; $i < 7; $i++) { 
            foreach ($totSrvPoly as $key => $value) {
                if($nbSrvPoly[$key][$i] == 0 && $totSrvPoly[$key] != 5 && !empty($srvPoly[$i])) {
                    // On affecte un servie au hasard parmi ceux restants
                    affecterService($i, $key, $srvPoly[$i][array_rand($srvPoly[$i])]);
                }
            }

            // Pour les assistants/managers, on ne peut pas affecter au hasard, il faut respecter les contraintes
            // Le service d est soit couvert par 1 assistant, soit par 1 manager
            // Le service i est soit couvert par 1 manager et 1 assistant, soit par 2 assistants
            foreach ($totSrvAssiMana as $key => $value) {

                // On vérifie que l'employé ne travaille pas, n'a pas plus de 5 services dans la semaine et qu'il reste des services à affecter
                if($nbSrvAssiMana[$key][$i] == 0 && $totSrvAssiMana[$key] != 5 && !empty($srvAssiMana[$i])) {
                    // On regarde s'il reste un d à affecter
                    foreach ($srvAssiMana[$i] as $srv) {
                        if ($srv->getId() == 'd') {
                            affecterService($i, $key, $srv);
                            break;
                        } else {
                            // Aucun service d trouvé
                            if(count($srvAssiMana[$i]) == 2) {
                                // Il reste les deux i : on peut l'affecter sans se poser de question
                                affecterService($i, $key, $srv);
                            } else {
                                // Il ne reste qu'un seul i
                                // on cherche qui a le premier i affecté
                                foreach ($listeAssiMana as $assimana) {
                                    if ($affectation[$i][$assimana->getId()] != null && $affectation[$i][$assimana->getId()]->getId() == 'i') {
                                        foreach ($listeAssiMana as $elem) {
                                            // Il faut parcourir tous les employés parce qu'on ne sait pas la position de l'employé courant
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
                    // Algorithme pour les assistants/managers : 
                    // Si y a pas de d, on regarde si y a déjà un i qui a été affecté, et si oui à qui
                    // Si aucun i n'a été affecté, on l'affecte à l'employé
                    // Si un i a été affecté à un mana, et que l'employé actuel est un assi, on lui affecte
                    // Si un i a été affecté à un assi, et que l'employé actuel est un mana OU un assi, on lui affecte
                }
            }
            // Tri pour affecter en priorité les employés qui travaillent le moins
            asort($totSrvPoly);
            asort($totSrvAssiMana);
        }

        // Gestion des heures supplémentaires
        for ($i=0; $i < 7; $i++) {
            // On regarde si il reste des services à affecter
            if (!empty($srvPoly[$i])) {
                // On parcourt tous les employés et on regarde ceux qui ne travaillent pas
                foreach ($listePoly as $poly) {
                    if ($affectation[$i][$poly->getId()] == NULL) {
                        // On regarde s'il est ok pour des heures sup (s'il n'a pas de service, c'est qu'il a déjà + de 5 services)
                        if ($poly->getHeuresSup() == '1') {
                            affecterService($i, $poly->getId(), $srvPoly[$i][array_rand($srvPoly[$i])]);
                        }
                    }
                }
            }
            if(!empty($srvAssiMana[$i])) {
                foreach ($listeAssiMana as $assimana) {
                    if ($affectation[$i][$assimana->getId()] == NULL) {
                        // On regarde si il est ok pour des heures sup
                        if ($assimana->getHeuresSup() == '1') {
                            foreach ($srvAssiMana[$i] as $srv) {
                                if ($srv->getId() == 'd') {
                                    affecterService($i, $assimana->getId(), $srv);
                                    break;
                                } else {
                                    // Aucun service d trouvé
                                    if(count($srvAssiMana[$i]) == 2) {
                                        // Il reste les deux i : on peut l'affecter sans se poser de question
                                        affecterService($i, $assimana->getId(), $srv);
                                    } else {
                                        // Il ne reste qu'un seul i
                                        // On cherche qui a le premier i affecté
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

        // Création des jours dans les plannings
        // Si on a cliqué sur ignorer, on supprime tous les jours des plannings déjà existants
        if(isset($_POST['ignorer'])) {
            foreach ($listeEmployes as $elem) {
                $planningCourant = $planningDAO->getPlanningParEmp(array($elem->getId(), $semainePlanning, $anneePlanning));
                $jourDAO->removeJoursParPlanning($planningCourant->getIdPlanning());
            }
        }

        // On ajoute les jours dans les plannings
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

// Gestion de la visualisation d'un planning
if (isset($_POST['voir'])) {
    // On récupère la liste de tous les employés 
    $listeEmployes = $employeDAO->getListeEmployes();
    $planningGenere = true;
    foreach ($listeEmployes as $elem) {
        $param = array($elem->getId(), $semainePlanning, $anneePlanning);
        if ($planningDAO->getPlanningParEmp($param) == null) {
            $planningGenere = false;
        }
    }

    // Si certains plannings sont manquants, message d'erreur
    if(!$planningGenere) {
        $alert = choixAlert('planning_pas_fait');
    } else {
        // Tri des employés par position
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

        // On récupère la liste des services
        $listeServices = $serviceDAO->getListeServices();
        
        // On déclare les affectations pour utiliser le même affichage que lors de la génération (même variables...)
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
            // On crée un tableau avec les services pour chaque jour de la semaine
            $listeServices = $serviceDAO->getListeServices();
            foreach ($listeServices as $service) {
                if (date('h:i:s', strtotime($service->getFin()) - strtotime($service->getDebut())) == '04:30:00') {
                    // Service de polyvalent
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