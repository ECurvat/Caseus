<?php
require_once(PATH_MODELS.'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
require_once(PATH_MODELS.'JourDAO.php');
$jourDAO = new JourDAO(true);

if (isset($_POST['choixJour'])) {
    // on vérifie que l'émetteur a un planning et jour de travail pour le jour précisé
    $planningEmetteur = $planningDAO->getPlanningParEmp(array($_SESSION['compte']->getId(), $semaine, $annee));
    if (!$planningEmetteur) {
        $alert = choixAlert('pas_de_planning');
    } else {
        // on tente de récupérer le jour 
        $jourEmetteur = $jourDAO->getJourParPlanningEtNumero(array($planningEmetteur->getIdPlanning(), date("N", strtotime($_POST['choixJour']))));
        if (!$jourEmetteur) {
            $alert = choixAlert('pas_de_jour');
        } else {
            if ($jourEmetteur->getConge() == 1) {
                $alert = choixAlert('conge_trouve');                
            } else {
                // tout est ok : on cherche les gens qui travaillent (pas congé) pour le jour sélectionné
                // sélectionner tous les plannings de la bonne semaine
                $planningsAutres = $planningDAO->getPlanningsTousEmps(array($semaine, $annee));
                if (!empty($planningsAutres)) {
                    // on retire le planning de l'employé qui cherche à échanger
                    for($i = 0; $i < sizeof($planningsAutres); $i++) {
                        if($planningsAutres[$i]->getIdEmploye() == $_SESSION['compte']->getId()) {
                            array_splice($planningsAutres, $i, 1);
                        }
                    }
                    if (!empty($planningsAutres)) {
                        $joursEchangeables = array();
                        // sélectionner les jours correspondant aux plannings 
                        foreach ($planningsAutres as $elem) {
                            $jourCourant = $jourDAO->getJourParPlanningEtNumero(array($elem->getIdPlanning(), date("N", strtotime($_POST['choixJour']))));
                            if ($jourCourant != null && $jourCourant->getConge() == 0) {
                                array_push($joursEchangeables, $jourCourant);
                            }
                        }
                    } else {
                        $alert = choixAlert('pas_de_planning');
                    }
                } else { 
                    $alert = choixAlert('pas_de_planning');
                }
            }
        }
    }
}