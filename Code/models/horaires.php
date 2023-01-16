<?php
require_once(PATH_MODELS_DAO.'EtatDAO.php');
$etatDAO = new EtatDAO(true);
require_once(PATH_MODELS_DAO.'ServiceDAO.php');
$serviceDAO = new ServiceDAO(true);
$listeEtats = $etatDAO->getListeEtats();

$para = array($_SESSION['compte']->getId(), $semaine, $annee);
require_once(PATH_MODELS_DAO.'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
$planning = $planningDAO->getPlanningParEmp($para);

if (!is_null($planning)) {
    require_once(PATH_MODELS_DAO.'JourDAO.php');
    $jourDAO = new JourDAO(true);
    $listeJours = $jourDAO->getJoursParPlanning($planning->getIdPlanning());
} else {
    $alert = choixAlert('pas_de_planning');
}

$listeServices = $serviceDAO->getListeServices();
$listeServicesIndex = array();
foreach ($listeServices as $elem) {
    $listeServicesIndex[$elem->getId()] = $elem;
}