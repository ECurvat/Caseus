<?php
require_once(PATH_MODELS.'EtatDAO.php');
$etatDAO = new EtatDAO(true);
$listeEtats = $etatDAO->getListeEtats();

$para = array($_SESSION['compte']->getId(), $semaine, $annee);
require_once(PATH_MODELS.'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
$planning = $planningDAO->getPlanningParEmp($para);

if (!is_null($planning)) {
    require_once(PATH_MODELS.'JourDAO.php');
    $jourDAO = new JourDAO(true);
    $listeJours = $jourDAO->getJoursParPlanning($planning->getIdPlanning());
} else {
    $alert = choixAlert('pas_de_planning');
}

require_once(PATH_MODELS . 'ServiceDAO.php');
$serviceDAO = new ServiceDAO(true);

$listeServices = $serviceDAO->getListeServices();
$listeServicesIndex = array();
foreach ($listeServices as $elem) {
    $listeServicesIndex[$elem->getId()] = $elem;
}