<?php
require_once(PATH_MODELS . 'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
require_once(PATH_MODELS . 'JourDAO.php');
$jourDAO = new JourDAO(true);
require_once(PATH_MODELS . 'EchangeDAO.php');
$echangeDAO = new EchangeDAO(true);
require_once(PATH_MODELS . 'EtatDAO.php');
$etatDAO = new EtatDAO(true);
require_once(PATH_MODELS . 'ServiceDAO.php');
$serviceDAO = new ServiceDAO(true);
require_once(PATH_MODELS . 'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);

$listeServices = $serviceDAO->getListeServices();
$listeServicesIndex = array();
foreach ($listeServices as $elem) {
    $listeServicesIndex[$elem->getId()] = $elem;
}

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
            if ($jourEmetteur->getIdService() == 'y') {
                $alert = choixAlert('conge_trouve');
            } else {
                // tout est ok : on cherche les gens qui travaillent (pas congé) pour le jour sélectionné
                // sélectionner tous les plannings de la bonne semaine
                $planningsAutres = $planningDAO->getPlanningsTousEmps(array($semaine, $annee));
                if (!empty($planningsAutres)) {
                    // on retire le planning de l'employé qui cherche à échanger
                    // on enlève aussi les employés qui ont une position différente de celle de l'employé qui cherche à échanger
                    foreach ($planningsAutres as $key => $planning) {
                        if ($planning->getIdEmploye() == $_SESSION['compte']->getId()) {
                            unset($planningsAutres[$key]);
                        } else if ((($employeDAO->getEmployeParId($planning->getIdEmploye()))->getPosition() == 'MANA') && ($_SESSION['compte']->getPosition() == 'POLY')) {
                            unset($planningsAutres[$key]);
                        } else if ((($employeDAO->getEmployeParId($planning->getIdEmploye()))->getPosition() == 'ASSI' && ($_SESSION['compte']->getPosition() == 'POLY'))) {
                            unset($planningsAutres[$key]);
                        } else if ((($employeDAO->getEmployeParId($planning->getIdEmploye()))->getPosition() == 'POLY') && ($_SESSION['compte']->getPosition() == 'ASSI')) {
                            unset($planningsAutres[$key]);
                        } else if ((($employeDAO->getEmployeParId($planning->getIdEmploye()))->getPosition() == 'POLY') && ($_SESSION['compte']->getPosition() == 'MANA')) {
                            unset($planningsAutres[$key]);
                        }
                    }
                    if (!empty($planningsAutres)) {
                        $joursEchangeables = array();
                        // sélectionner les jours correspondant aux plannings 
                        foreach ($planningsAutres as $elem) {
                            $jourCourant = $jourDAO->getJourParPlanningEtNumero(array($elem->getIdPlanning(), date("N", strtotime($_POST['choixJour']))));
                            if ($jourCourant != null && $jourCourant->getIdService() != 'y') {
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






// Vérification si une demande d'échange est envoyée, supprimée, accéptée ou refusée
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
        $echangeDAO->ajouterEchange(array($idJourEmet, $idEmpEmet, $idJourRecep, $idEmpRecep));
        $alert = choixAlert('succes_operation');
    } else $alert = choixAlert('deja_echange');
}

if (isset($_POST['supprimer'])) {
    // on vérifie que l'état est bien en attente. Suppression impossible s'il est déjà accepté (pratique) ou refusé (historique)
    if ($echangeDAO->getEchangeParId($_POST['supprimer'])->getIdEtat() == 3) {
        $echangeDAO->supprimerEchange($_POST['supprimer']);
    } else $alert = choixAlert('supp_echange_impossible');
}

if (isset($_POST['accepter'])) {
    $echangeCourant = $echangeDAO->getEchangeParId($_POST['accepter']);
    $jourDAO->echangerJours($echangeCourant->getIdJourEmet(), $echangeCourant->getIdJourRecep());
    $echangeDAO->changerEtatEchange(array(4, $_POST['accepter']));
}

if (isset($_POST['refuser'])) {
    $echangeDAO->changerEtatEchange(array(5, $_POST['refuser']));
}

// ajouter l'état des échanges envoyés
// si il est accepté = pas possible de le supprimer (pas de bouton poubelle)




$listeEnvois = $echangeDAO->getEchangesEnvoyes(array($_SESSION['compte']->getId(), $anneeEnvoi));
$listeEnvoisPropre = array();
if (!is_null($listeEnvois)) {
    for ($i = 0; $i < count($listeEnvois); $i++) {
        // on récupère le planning de l'émetteur (récépteur marche aussi) pour trouver le jour concerné
        $planningEmetteur = $planningDAO->getPlanningParId($jourDAO->getJourParId($listeEnvois[$i]->getIdJourEmet())->getIdPlanning());

        // on cherche le premier jour de la semaine du planning de l'émetteur (récépteur marche aussi)
        $premJour = new DateTime(date('Y-m-d', strtotime($planningEmetteur->getAnneePlanning() . 'W' . $planningEmetteur->getNSemaine())));

        // on trouve quel jour du planning est concerné
        $nbJoursAAjouter = $jourDAO->getJourParId($listeEnvois[$i]->getIdJourEmet())->getNJour() - 1;
        $jour = $premJour->modify('+' . $nbJoursAAjouter . ' day');
        array_push($listeEnvoisPropre, array(
            $jour->format('Y-m-d'),
            $jourDAO->getJourParId($listeEnvois[$i]->getIdJourEmet()),
            $jourDAO->getJourParId($listeEnvois[$i]->getIdJourRecep()),
            $etatDAO->getEtatParId($listeEnvois[$i]->getIdEtat()),
            $listeEnvois[$i]->getIdEchange()
        ));
    }
}

$listeRecus = $echangeDAO->getEchangesRecus(array($_SESSION['compte']->getId(), $anneeRecep));
$listeRecusPropre = array();
if (!is_null($listeRecus)) {
    for ($i = 0; $i < count($listeRecus); $i++) {
        // on récupère le planning de l'émetteur (récépteur marche aussi) pour trouver le jour concerné
        $planningEmetteur = $planningDAO->getPlanningParId($jourDAO->getJourParId($listeRecus[$i]->getIdJourEmet())->getIdPlanning());

        // on cherche le premier jour de la semaine du planning de l'émetteur (récépteur marche aussi)
        $premJour = new DateTime(date('Y-m-d', strtotime($planningEmetteur->getAnneePlanning() . 'W' . $planningEmetteur->getNSemaine())));

        // on trouve quel jour du planning est concerné
        $nbJoursAAjouter = $jourDAO->getJourParId($listeRecus[$i]->getIdJourEmet())->getNJour() - 1;
        $jour = $premJour->modify('+' . $nbJoursAAjouter . ' day');
        array_push($listeRecusPropre, array(
            $jour->format('Y-m-d'),
            $jourDAO->getJourParId($listeRecus[$i]->getIdJourRecep()),
            $jourDAO->getJourParId($listeRecus[$i]->getIdJourEmet()),
            $listeRecus[$i]->getIdEchange()
        ));
    }
}

