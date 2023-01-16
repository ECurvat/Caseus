<?php
require_once(PATH_MODELS_DAO.'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);
require_once(PATH_MODELS_DAO.'PlanningDAO.php');
$planningDAO = new PlanningDAO(true);
require_once(PATH_MODELS_DAO.'JourDAO.php');
$jourDAO = new JourDAO(true);
require_once(PATH_MODELS_DAO.'CongeDAO.php');
$congeDAO = new CongeDAO(true);
require_once(PATH_MODELS_DAO.'AbsenceDAO.php');
$absenceDAO = new AbsenceDAO(true);
$listeEmployes = $employeDAO->getListeEmployes();

if (isset($_POST['ajoutValider'])) {
    ($_POST['ajoutSup'] == 'on') ? $sup = 1 : $sup = 0;
    $para = array($_POST['ajoutNom'], $_POST['ajoutPrenom'], $_POST['ajoutMail'], $_POST['ajoutDate'], $_POST['ajoutAdresse'], $_POST['ajoutCP'], $_POST['ajoutVille'], password_hash($newMDP, PASSWORD_DEFAULT), $_POST['ajoutPosition'] , $sup);
    $employeDAO->addEmploye($para);
    $alert = choixAlert('succes_operation');
}

if (isset($_POST['supprimerValider'])) {
    $listePlannings = $planningDAO->getTousPlanningsParEmp($_POST['supprimerEmp']);
    if ($listePlannings != null) {
        foreach ($listePlannings as $planning) {
            $jourDAO->removeJoursParPlanning($planning->getIdPlanning());
            $planningDAO->removePlanning($planning->getIdPlanning());
        }
    }
    $absenceDAO->removeAbsencesParEmp($_POST['supprimerEmp']);
    $congeDAO->removeCongesParEmp($_POST['supprimerEmp']);
    $employeDAO->removeEmploye($_POST['supprimerEmp']);
    // on cherche les plannings de l'employé à supprimer
    
    // on supprime les plannings de l'employé à supprimer
    // on supprime tous les jours associés à ces plannings
    
    
    $alert = choixAlert('succes_operation');
}

if (isset($_POST['modifierMDP'])){
    $empModif = $employeDAO->getEmployeParId($_POST['modifierMDP']);
    $employeDAO->updateMDP(array(password_hash($newMDP, PASSWORD_DEFAULT), $_POST['modifierMDP']));
}

if (isset($_POST['modifierChoisir'])) {

    $empModif = $employeDAO->getEmployeParId($_POST['modifierChoixEmp']);
}