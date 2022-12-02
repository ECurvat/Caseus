<?php 
require_once(PATH_MODELS.'CongeDAO.php');
$congeDAO = new CongeDAO(true);


if (isset($_POST['accepter'])) {
    $congeDAO->accepterConge($_POST['idDemande']);
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