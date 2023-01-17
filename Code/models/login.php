<!-- Modèle de la page login -->
<?php
require_once(PATH_MODELS_DAO.'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);

// Récupération de l'employé correspondant au mail
$employe = $employeDAO->getEmployeParMail($mail);