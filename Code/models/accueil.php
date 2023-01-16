<!-- Modèle de la page accueil -->
<?php
require_once(PATH_MODELS_DAO.'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
require_once(PATH_MODELS_DAO.'ServiceDAO.php');
$serviceDAO = new ServiceDAO(true);
require_once(PATH_MODELS_DAO.'JourDAO.php');
$jourDAO = new JourDAO(true);

// Récupération du planning de la semaine en cours
$paraPlanning = array($_SESSION['compte']->getId(), $semaine, $annee);
$planning = $planningDAO->getPlanningParEmp($paraPlanning);

// Si un planning existe : récupération du jour actuel, sinon : message d'erreur
if (!is_null($planning)) {
    $numJour = date('N') - 1;
    $paraJour = array($planning->getIdPlanning(), $numJour);
    $jour = $jourDAO->getJourParPlanningEtNumero($paraJour);
} else {
    $alert = choixAlert('pas_de_planning');
}

// Récupération de la liste des services pour affichage avec heures
$listeServices = $serviceDAO->getListeServices();
// Indexation des services dans un tableau associatif pour accès plus rapide
$listeServicesIndex = array();
foreach ($listeServices as $elem) {
    $listeServicesIndex[$elem->getId()] = $elem;
}