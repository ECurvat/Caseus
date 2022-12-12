<?php
require_once(PATH_MODELS.'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
require_once(PATH_MODELS.'JourDAO.php');
$jourDAO = new JourDAO(true);
require_once(PATH_MODELS.'EchangeDAO.php');
$echangeDAO = new EchangeDAO(true);

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

$listeEnvois = $echangeDAO->getEchangesEnvoyes(array($_SESSION['compte']->getId(), $anneeEnvoi));
$listeEnvoisPropre = array();
if(!is_null($listeEnvois)) {
    for ($i=0; $i < count($listeEnvois); $i++) {
        // on récupère le planning de l'émetteur (récépteur marche aussi) pour trouver le jour concerné
        $planningEmetteur = $planningDAO->getPlanningParId($jourDAO->getJourParId($listeEnvois[$i]->getIdJourEmet())->getIdPlanning());

        // on cherche le premier jour de la semaine du planning de l'émetteur (récépteur marche aussi)
        $premJour = new DateTime(date('Y-m-d',strtotime($planningEmetteur->getAnneePlanning().'W'.$planningEmetteur->getNSemaine())));
        
        // on trouve quel jour du planning est concerné
        $nbJoursAAjouter = $jourDAO->getJourParId($listeEnvois[$i]->getIdJourEmet())->getNJour() - 1;
        $jour = $premJour->modify('+'.$nbJoursAAjouter.' day');
        array_push($listeEnvoisPropre, array(
            $jour->format('Y-m-d'),
            $jourDAO->getJourParId($listeEnvois[$i]->getIdJourEmet()),
            $jourDAO->getJourParId($listeEnvois[$i]->getIdJourRecep()),
            $listeEnvois[$i]->getDateProposition(),
            $listeEnvois[$i]->getIdEchange()
            ));
    }
}

$listeRecus = $echangeDAO->getEchangesRecus(array($_SESSION['compte']->getId(), $anneeRecep));
$listeRecusPropre = array();
if(!is_null($listeRecus)) {
    for ($i=0; $i < count($listeRecus); $i++) {
        // on récupère le planning de l'émetteur (récépteur marche aussi) pour trouver le jour concerné
        $planningEmetteur = $planningDAO->getPlanningParId($jourDAO->getJourParId($listeRecus[$i]->getIdJourEmet())->getIdPlanning());
    
        // on cherche le premier jour de la semaine du planning de l'émetteur (récépteur marche aussi)
        $premJour = new DateTime(date('Y-m-d',strtotime($planningEmetteur->getAnneePlanning().'W'.$planningEmetteur->getNSemaine())));
        
        // on trouve quel jour du planning est concerné
        $nbJoursAAjouter = $jourDAO->getJourParId($listeRecus[$i]->getIdJourEmet())->getNJour() - 1;
        $jour = $premJour->modify('+'.$nbJoursAAjouter.' day');
        array_push($listeRecusPropre, array(
            $jour->format('Y-m-d'),
            $jourDAO->getJourParId($listeRecus[$i]->getIdJourRecep()),
            $jourDAO->getJourParId($listeRecus[$i]->getIdJourEmet()),
            $listeRecus[$i]->getIdEchange()
            ));
    }
}



// modèle pour demandes reçues :
// date d'envoi
// jour actuel
// jour si accepté
// accepter
// refuser