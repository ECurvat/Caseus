<?php
require_once(PATH_MODELS.'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
require_once(PATH_MODELS.'JourDAO.php');
$jourDAO = new JourDAO(true);

if (isset($_POST['choixJour'])) {
    // on vérifie que l'émetteur a un planning et jour de travail pour le jour précisé
    $planningEmetteur = $planningDAO->getPlanningCourant(array($_SESSION['compte']->getId(), $semaine, $annee));
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
            }
        }
    }
}