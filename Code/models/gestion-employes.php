<?php
require_once(PATH_MODELS.'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);
$listeEmployes = $employeDAO->getListeEmployes();

if (isset($_POST['ajoutValider'])) {
    $para = array($_POST['ajoutNom'], $_POST['ajoutPrenom'], $_POST['ajoutMail'], $_POST['ajoutDate'], $_POST['ajoutAdresse'], $_POST['ajoutCP'], $_POST['ajoutVille'], '$2y$10$mYy/0tLWJjUXCAxf6XuJ5.nV0m1SJJx6xPsg5fo1VA.Hj1.eWPFe.', $_POST['ajoutPosition']);
    $employeDAO->addEmploye($para);
    $alert = choixAlert('succes_operation');
}

if (isset($_POST['supprimerValider'])) {
    $employeDAO->removeEmploye($_POST['supprimerEmp']);
    $alert = choixAlert('succes_operation');
}

if (isset($_POST['modifierMDP'])){
    echo ($newMDP);
    $employeDAO->updateMDP(array(password_hash($newMDP, PASSWORD_DEFAULT), $_POST['modifierMDP']));
}