<!-- Modèle de la page de gestion des employés -->
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

// Récupération de tous les employés pour affichage de la liste
$listeEmployes = $employeDAO->getListeEmployes();

// Gestion de l'ajout d'un employé
if (isset($_POST['ajoutValider'])) {
    ($_POST['ajoutSup'] == 'on') ? $sup = 1 : $sup = 0;
    $para = array($_POST['ajoutNom'], $_POST['ajoutPrenom'], $_POST['ajoutMail'], $_POST['ajoutDate'], $_POST['ajoutAdresse'], $_POST['ajoutCP'], $_POST['ajoutVille'], password_hash($newMDP, PASSWORD_DEFAULT), $_POST['ajoutPosition'] , $sup);
    $employeDAO->addEmploye($para);
    $alert = choixAlert('succes_operation');
}

// Gestion de la suppression d'un employé
if (isset($_POST['supprimerValider'])) {
    // Suppression de tous ses plannings, jours, absences, demandes de congés
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
    $alert = choixAlert('succes_operation');
}


// Gestion de la modification du mot de passe d'un employé
if (isset($_POST['modifierMDP'])){
    $empModif = $employeDAO->getEmployeParId($_POST['modifierMDP']);
    $employeDAO->updateMDP(array(password_hash($newMDP, PASSWORD_DEFAULT), $_POST['modifierMDP']));
}

// Gestion de la modification d'un employé
if (isset($_POST['modifierChoisir'])) {
    $empModif = $employeDAO->getEmployeParId($_POST['modifierChoixEmp']);
}