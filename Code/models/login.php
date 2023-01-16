<?php
require_once(PATH_MODELS_DAO.'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);
$employe = $employeDAO->getEmployeParMail($mail);