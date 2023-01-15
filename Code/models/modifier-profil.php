<?php
require_once(PATH_MODELS.'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);

if (isset($_POST['valider'])) {
    $choixSup = 0;
    if(isset($_POST['modifSup'])) {
        if($_POST['modifSup']=="on") {
            $choixSup = 1;
        }
    }
    $modif = array($_POST['modifNom'], $_POST['modifPrenom'], $_POST['modifMail'], $_POST['modifAdresse'], $_POST['modifCP'], $_POST['modifVille'], $choixSup, $_SESSION['compte']->getID());
    $employeDAO->alterEmploye($modif);
    $alert = choixAlert('succes_operation');
}