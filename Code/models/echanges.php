<!-- Modèle pour la page échanges -->
<?php
require_once(PATH_MODELS_DAO . 'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
require_once(PATH_MODELS_DAO . 'JourDAO.php');
$jourDAO = new JourDAO(true);
require_once(PATH_MODELS_DAO . 'EchangeDAO.php');
$echangeDAO = new EchangeDAO(true);
require_once(PATH_MODELS_DAO . 'EtatDAO.php');
$etatDAO = new EtatDAO(true);
require_once(PATH_MODELS_DAO . 'ServiceDAO.php');
$serviceDAO = new ServiceDAO(true);
require_once(PATH_MODELS_DAO . 'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);

// Indexation des services dans un tableau associatif pour accès plus rapide
$listeServices = $serviceDAO->getListeServices();
$listeServicesIndex = array();
foreach ($listeServices as $elem) {
    $listeServicesIndex[$elem->getId()] = $elem;
}

// Gestion de la recherche des jours avec lesquels échanger
if (isset($_POST['choixJour'])) {
    // On vérifie que l'émetteur a un planning et jour de travail pour le jour précisé
    $planningEmetteur = $planningDAO->getPlanningParEmp(array($_SESSION['compte']->getId(), $semaine, $annee));
    if (!$planningEmetteur) {
        $alert = choixAlert('pas_de_planning');
    } else {
        // Tentative de récupération du jour 
        // Il faut décrémenter le jour de 1 car nous stockons de 0 à 6 et la fonction renvoie de 1 à 7
        $numJour = date("N", strtotime($_POST['choixJour'])) - 1;
        $jourEmetteur = $jourDAO->getJourParPlanningEtNumero(array($planningEmetteur->getIdPlanning(), $numJour));
        if (!$jourEmetteur) {
            $alert = choixAlert('pas_de_jour');
        } else {
            if ($jourEmetteur->getIdService() == 'y' || $jourEmetteur->getIdService() == 'z') {
                $alert = choixAlert('conge_trouve');
            } else {
                // Tout est ok : on cherche les gens qui travaillent (pas congé et pas repos) pour le jour sélectionné
                // Sélectionner tous les plannings de la bonne semaine
                $planningsAutres = $planningDAO->getPlanningsTousEmps(array($semaine, $annee));
                if (!empty($planningsAutres)) {
                    // On retire le planning de l'employé qui cherche à échanger
                    // On enlève aussi les employés qui ont une position différente de celle de l'employé qui cherche à échanger (services de longueur différente)
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
                        // Sélectionner les jours correspondant aux plannings 
                        foreach ($planningsAutres as $elem) {
                            $jourCourant = $jourDAO->getJourParPlanningEtNumero(array($elem->getIdPlanning(), $numJour));
                            if ($jourCourant != null && $jourCourant->getIdService() != 'y' && $jourCourant->getIdService() != 'z') {
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
    // Un bouton pour échanger a été cliqué : sa valeur est de la forme idJourEmetteur|idJourRecepteur
    $idJourEmet =  explode("|", $_POST['echange'])[0];
    $idJourRecep = explode("|", $_POST['echange'])[1];
    $idEmpEmet = $_SESSION['compte']->getId();
    // On récupère le jour entier du récépteur, sur lequel on récupère l'id de planning
    // Avec l'id de planning, on récupère le planning entier, sur lequel on récupère l'id d'employé
    $idEmpRecep = $planningDAO->getPlanningParId($jourDAO->getJourParId($idJourRecep)->getIdPlanning())->getIdEmploye();

    // Avant d'ajouter l'échange, on vérifie que l'émetteur n'en a pas déjà un en attente
    if ($echangeDAO->verifEchangeEnCours($idJourEmet) == null) {
        $echangeDAO->ajouterEchange(array($idJourEmet, $idEmpEmet, $idJourRecep, $idEmpRecep));
        $alert = choixAlert('succes_operation');
    } else $alert = choixAlert('deja_echange');
}

// Gestion de la suppression d'une demande envoyée
if (isset($_POST['supprimer'])) {
    // On vérifie que l'état est bien en attente. Suppression impossible s'il est déjà accepté (pratique) ou refusé (historique)
    if ($echangeDAO->getEchangeParId($_POST['supprimer'])->getIdEtat() == 3) {
        $echangeDAO->supprimerEchange($_POST['supprimer']);
    } else $alert = choixAlert('supp_impossible');
}

// Gestion de l'acceptation ou du refus d'une demande reçue
if (isset($_POST['accepter'])) {
    $echangeCourant = $echangeDAO->getEchangeParId($_POST['accepter']);
    $jourDAO->echangerJours($echangeCourant->getIdJourEmet(), $echangeCourant->getIdJourRecep());
    $echangeDAO->changerEtatEchange(array(4, $_POST['accepter']));
}

if (isset($_POST['refuser'])) {
    $echangeDAO->changerEtatEchange(array(5, $_POST['refuser']));
}

// Gestion de la récupération des demandes envoyées
$listeEnvois = $echangeDAO->getEchangesEnvoyes(array($_SESSION['compte']->getId(), $anneeEnvoi));
$listeEnvoisPropre = array();
if (!is_null($listeEnvois)) {
    for ($i = 0; $i < count($listeEnvois); $i++) {
        // On récupère le planning de l'émetteur (récépteur marche aussi) pour trouver le jour concerné
        $planningEmetteur = $planningDAO->getPlanningParId($jourDAO->getJourParId($listeEnvois[$i]->getIdJourEmet())->getIdPlanning());

        // On cherche le premier jour de la semaine du planning de l'émetteur (récépteur marche aussi)
        $premJour = new DateTime(date('Y-m-d', strtotime($planningEmetteur->getAnneePlanning() . 'W' . $planningEmetteur->getNSemaine())));

        // On trouve quel jour du planning est concerné
        $nbJoursAAjouter = $jourDAO->getJourParId($listeEnvois[$i]->getIdJourEmet())->getNJour() - 1;
        $jour = $premJour->modify('+' . $nbJoursAAjouter . ' day');
        array_push($listeEnvoisPropre, array(
            $jour->format('d/m/y'),
            $listeServicesIndex[$jourDAO->getJourParId($listeEnvois[$i]->getIdJourEmet())->getIdService()],
            $listeServicesIndex[$jourDAO->getJourParId($listeEnvois[$i]->getIdJourRecep())->getIdService()],
            $etatDAO->getEtatParId($listeEnvois[$i]->getIdEtat()),
            $listeEnvois[$i]->getIdEchange()
        ));
    }
}

// Gestion de la récupération des demandes reçues
$listeRecus = $echangeDAO->getEchangesRecus(array($_SESSION['compte']->getId(), $anneeRecep));
$listeRecusPropre = array();
if (!is_null($listeRecus)) {
    for ($i = 0; $i < count($listeRecus); $i++) {
        // On récupère le planning de l'émetteur (récépteur marche aussi) pour trouver le jour concerné
        $planningEmetteur = $planningDAO->getPlanningParId($jourDAO->getJourParId($listeRecus[$i]->getIdJourEmet())->getIdPlanning());

        // On cherche le premier jour de la semaine du planning de l'émetteur (récépteur marche aussi)
        $premJour = new DateTime(date('Y-m-d', strtotime($planningEmetteur->getAnneePlanning() . 'W' . $planningEmetteur->getNSemaine())));

        // On trouve quel jour du planning est concerné
        $nbJoursAAjouter = $jourDAO->getJourParId($listeRecus[$i]->getIdJourEmet())->getNJour() - 1;
        $jour = $premJour->modify('+' . $nbJoursAAjouter . ' day');
        array_push($listeRecusPropre, array(
            $jour->format('d/m/y'),
            $listeServicesIndex[$jourDAO->getJourParId($listeRecus[$i]->getIdJourRecep())->getIdService()],
            $listeServicesIndex[$jourDAO->getJourParId($listeRecus[$i]->getIdJourEmet())->getIdService()],
            $listeRecus[$i]->getIdEchange()
        ));
    }
}

