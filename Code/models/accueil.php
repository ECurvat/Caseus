<?php
$para = array($_SESSION['compte']->getId(), $semaine, $annee);
require_once(PATH_MODELS_DAO.'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
require_once(PATH_MODELS_DAO.'ServiceDAO.php');
$serviceDAO = new ServiceDAO(true);
$planning = $planningDAO->getPlanningParEmp($para);

if (!is_null($planning)) {
    require_once(PATH_MODELS_DAO.'JourDAO.php');
    $jourDAO = new JourDAO(true);
    $numJour = date('N') - 1;
    $para = array($planning->getIdPlanning(), $numJour);
    $jour = $jourDAO->getJourParPlanningEtNumero($para);
} else {
    $alert = choixAlert('pas_de_planning');
}

$listeServices = $serviceDAO->getListeServices();
$listeServicesIndex = array();
foreach ($listeServices as $elem) {
    $listeServicesIndex[$elem->getId()] = $elem;
}