<!-- Modèle de la page de gestion des congés -->
<?php 
require_once(PATH_MODELS_DAO.'CongeDAO.php');
$congeDAO = new CongeDAO(true);
require_once(PATH_MODELS_DAO.'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
require_once(PATH_MODELS_DAO.'JourDAO.php');
$jourDAO = new JourDAO(true);
require_once(PATH_MODELS_DAO.'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);

// Gestion de l'acceptation d'une demande de congés
if (isset($_POST['accepter'])) {
    $congeDAO->accepterConge($_POST['idDemande']);
    $congeAccepte = $congeDAO->getCongeParId($_POST['idDemande']);

    $debut = $congeAccepte->getDebut();
    $semDebut = date("W", strtotime($debut));

    $fin = $congeAccepte->getFin();
    $semFin = date("W", strtotime($fin));

    $idEmp = $congeAccepte->getIdEmploye();
    $anneeConcernee = date("Y", strtotime($debut));
    
    // Mise à jour de tous les plannings concernés
    // Parcours de toutes les semaines concernées par le congé accepté
    for($semaine = $semDebut; $semaine <= $semFin; $semaine++) {
        // Pour chaque semaine : on regarde s'il y a un planning
        $planningSemaine = $planningDAO->getPlanningParEmp(array($idEmp, $semaine, $anneeConcernee));
        if($planningSemaine == null) {
            // Pas de planning, on le crée
            $planningDAO->addPlanning(array($idEmp, $semaine, $anneeConcernee));
            $planningSemaine = $planningDAO->getPlanningParEmp(array($idEmp, $semaine, $anneeConcernee));
        }       

        // On va parcourir tous les jours de la semaine, s'ils sont >= au début et <= à la fin alors soit on le créé soit on met le service en Y
        // On trouve le premier jour de la semaine choisie
        $date = new DateTime(date('Y-m-d',strtotime($anneeConcernee.'W'.$semaine)));

        for($i = 0; $i<7; $i++) {
            $dateJour = $date->format('d-m-Y');
            if(strtotime($dateJour) >= strtotime($debut) && strtotime($dateJour) <= strtotime($fin)) {
                // Ici on a tous les jours qui doivent être mis en congé
                // On regarde si le jour existe déjà ou non
                $jourCourant = $jourDAO->getJourParPlanningEtNumero(array($planningSemaine->getIdPlanning(), $i + 1));
                if ($jourCourant == null) {
                    // il n'existe pas, on le créé
                    $jourDAO->addJourConge(array($planningSemaine->getIdPlanning(), $i + 1));
                } else {
                    // Il existe déjà : s'il n'est pas déjà en congé, on le met en congé
                    if($jourCourant->getIdService() != 'y') {
                        $jourDAO->changeToConge($jourCourant->getIdJour());
                    }
                }
                // Maintenant qu'on est sûr qu'il existe, on le récupère
                $jourCourant = $jourDAO->getJourParPlanningEtNumero(array($planningSemaine->getIdPlanning(), $i + 1));
            }
            $date->modify('+1 day');
        }
    }
    $alert = choixAlert('succes_operation');
}

// Gestion du refus d'une demande
if (isset($_POST['refuser'])) {
    $congeDAO->refuserConge($_POST['idDemande']);
    $alert = choixAlert('succes_operation');
}

// Récupération des demandes de congés en attente
$listeCongesEnAttente = $congeDAO->getCongeEnAttente();

// Indexation des employés pour accès plus rapide
$listeEmployes = $employeDAO->getListeEmployes();
$listeEmployesIndex = array();
foreach ($listeEmployes as $emp) {
    $listeEmployesIndex[$emp->getId()] = $emp;
}

// S'il y a des demandes en attente, on récupère les id des employés concernés
if (!empty($listeCongesEnAttente)) {
    $idEmps = array();
    foreach ($listeCongesEnAttente as $elem) {
        array_push($idEmps, $elem->getIdEmploye());
    }
} else {
    $alert = choixAlert('pas_de_demande');
}

// Récupération de toutes les demandes acceptées, >= à la date du jour
$listeCongesFuturs = $congeDAO->getCongesFuturs();