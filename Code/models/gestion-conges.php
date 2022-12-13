<?php 
require_once(PATH_MODELS.'CongeDAO.php');
$congeDAO = new CongeDAO(true);


if (isset($_POST['accepter'])) {
    $congeDAO->accepterConge($_POST['idDemande']);
    $congeAccepte = $congeDAO->getCongeParId($_POST['idDemande']);
    $debut = $congeAccepte->getDebut();
    $semDebut = date("W", strtotime($debut));
    $fin = $congeAccepte->getFin();
    $semFin = date("W", strtotime($fin));

    $idEmp = $congeAccepte->getIdEmploye();
    $anneeConcernee = date("Y", strtotime($debut));
    require_once(PATH_MODELS.'PlanningDAO.php');
    $planningDAO = new PlanningDAO(true);
    require_once(PATH_MODELS.'JourDAO.php');
    $jourDAO = new JourDAO(true);
    // on parcours toutes les semaines concernées par le congé accepté
    for($semaine = $semDebut; $semaine <= $semFin; $semaine++) {
        // pour chaque semaine : on regarde s'il y a un planning
        $planningSemaine = $planningDAO->getPlanningParEmp(array($idEmp, $semaine, $anneeConcernee));
        if($planningSemaine == null) {
            // alors on le créé
            $planningDAO->addPlanning(array($idEmp, $semaine, $anneeConcernee));
        }
        // on récupère le planning s'il a été créé
        $planningSemaine = $planningDAO->getPlanningParEmp(array($idEmp, $semaine, $anneeConcernee));

        // on va parcourir tous les jours de la semaine, s'ils sont >= au début et <= à la fin alors soit on le créé soit on met congé à 1
        // on trouve le premier jour de la semaine choisie
        $date = new DateTime(date('Y-m-d',strtotime($anneeConcernee.'W'.$semaine)));

        for($i = 0; $i<7; $i++) {
            $dateJour = $date->format('d-m-Y');
            if(strtotime($dateJour) >= strtotime($debut) && strtotime($dateJour) <= strtotime($fin)) {
                // ici on a tous les jours qui doivent être mis en congé = 1
                // on regarde si le jour existe déjà ou non
                $jourCourant = $jourDAO->getJourParPlanningEtNumero(array($planningSemaine->getIdPlanning(), $i + 1));
                if ($jourCourant == null) {
                    // il n'existe pas, on le créé
                    $jourDAO->addJourConge(array($planningSemaine->getIdPlanning(), $i + 1));
                } else {
                    // il existe déjà : s'il n'est pas déjà en congé, on le met en congé
                    if($jourCourant->getConge() == 0) {
                        $jourDAO->changeToConge($jourCourant->getIdJour());
                    }
                }
                // maintenant qu'on est sûr qu'il existe, on le récupère
                $jourCourant = $jourDAO->getJourParPlanningEtNumero(array($planningSemaine->getIdPlanning(), $i + 1));
            }
            $date->modify('+1 day');
        }
    }
    $alert = choixAlert('succes_operation');
} else if (isset($_POST['refuser'])) {
    $congeDAO->refuserConge($_POST['idDemande']);
    $alert = choixAlert('succes_operation');
}

$listeCongesEnAttente = $congeDAO->getCongeEnAttente();

if (!empty($listeCongesEnAttente)) {
    $idEmps = array();
    foreach ($listeCongesEnAttente as $elem) {
        array_push($idEmps, $elem->getIdEmploye());
    }

    require_once(PATH_MODELS.'EmployeDAO.php');
    $employeDAO = new EmployeDAO(true);
    $listeEmployes = array();
    foreach ($idEmps as $elem) {
        $listeEmployes[$elem] = $employeDAO->getEmployeParId($elem);
    }
} else {
    $alert = choixAlert('pas_de_demande');
}

// trouver le numéro du/des plannings concernés par la plage de congés 
// si il en existe certains, regarder s'il existe des jours déjà mis --> les supprimer
//                           ajouter dans les plannings, sur les dates concernés, les jours avec 'congé' = 1
// sinon créer les plannings et ajouter les jours avec 'congé' = 1