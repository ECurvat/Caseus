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
if (isset($_POST['echange'])) {
    // alors un bouton pour échanger a été cliqué : sa valeur est de la forme idJourEmetteur|idJourRecepteur
    require_once(PATH_MODELS.'EchangeDAO.php');
    $echangeDAO = new EchangeDAO(true);
    $idJourEmet =  explode("|", $_POST['echange'])[0];
    $idJourRecep = explode("|", $_POST['echange'])[1];
    $idEmpEmet = $_SESSION['compte']->getId();
    // on récupère le jour entier du récépteur, sur lequel on récupère l'id de planning
    // avec l'id de planning, on récupère le planning entier, sur lequel on récupère l'id d'employé
    $idEmpRecep = $planningDAO->getPlanningParId($jourDAO->getJourParId($idJourRecep)->getIdPlanning())->getIdEmploye();

    // avant d'ajouter l'échange, on vérifie que l'émetteur n'en a pas déjà un en attente
    if ($echangeDAO->verifEchangeEnCours($idJourEmet) == null) {
        $echangeDAO->addEchange(array($idJourEmet, $idEmpEmet, $idJourRecep, $idEmpRecep));
        $alert = choixAlert('succes_operation');
    }
    else $alert = choixAlert('deja_echange');
        
}