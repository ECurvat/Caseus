<?php
$para = array($_SESSION['compte']->getId(), $semaine, $annee);
require_once(PATH_MODELS.'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
$planning = $planningDAO->getPlanningParEmp($para);

if (!is_null($planning)) {
    require_once(PATH_MODELS.'JourDAO.php');
    $jourDAO = new JourDAO(true);
    $para = array($planning->getIdPlanning(), date('N')+1);
    $jour = $jourDAO->getJourParPlanningEtNumero($para);
} else {
    $alert = choixAlert('pas_de_planning');
}
