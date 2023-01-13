<?php
require_once(PATH_MODELS.'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);
$listeEmployes = $employeDAO->getListeEmployes();

if (isset($_POST['ajoutValider'])) {
    ($_POST['ajoutSup'] == 'on') ? $sup = 1 : $sup = 0;
    $para = array($_POST['ajoutNom'], $_POST['ajoutPrenom'], $_POST['ajoutMail'], $_POST['ajoutDate'], $_POST['ajoutAdresse'], $_POST['ajoutCP'], $_POST['ajoutVille'], password_hash($newMDP, PASSWORD_DEFAULT), $_POST['ajoutPosition'] , $sup);
    $employeDAO->addEmploye($para);
    $alert = choixAlert('succes_operation');
}

if (isset($_POST['supprimerValider'])) {
    $employeDAO->removeEmploye($_POST['supprimerEmp']);
    $alert = choixAlert('succes_operation');
}

if (isset($_POST['modifierMDP'])){
    $employeDAO->updateMDP(array(password_hash($newMDP, PASSWORD_DEFAULT), $_POST['modifierMDP']));
}