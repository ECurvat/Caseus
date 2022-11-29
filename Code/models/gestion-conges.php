<?php 
require_once(PATH_MODELS.'CongeDAO.php');
$congeDAO = new CongeDAO(true);
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
    print_r($listeEmployes);
}

