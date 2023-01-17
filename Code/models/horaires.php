<!-- Modèle de la page horaires -->
<?php
require_once(PATH_MODELS_DAO.'ServiceDAO.php');
$serviceDAO = new ServiceDAO(true);
require_once(PATH_MODELS_DAO.'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
require_once(PATH_MODELS_DAO.'JourDAO.php');
$jourDAO = new JourDAO(true);

// Récupération du planning de l'employé
$para = array($_SESSION['compte']->getId(), $semaine, $annee);
$planning = $planningDAO->getPlanningParEmp($para);

// Vérification qu'il y a bien un planning et récupération des jours
if (!is_null($planning)) {
    $listeJours = $jourDAO->getJoursParPlanning($planning->getIdPlanning());
} else {
    $alert = choixAlert('pas_de_planning');
}

// Indexation de la liste des services pour accès plus facile
$listeServices = $serviceDAO->getListeServices();
$listeServicesIndex = array();
foreach ($listeServices as $elem) {
    $listeServicesIndex[$elem->getId()] = $elem;
}