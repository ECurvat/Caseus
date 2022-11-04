<?php
require_once(PATH_MODELS.'EmployeDAO.php');
$employeDAO = new EmployeDAO(true);
$employe = $employeDAO->getEmployeParMail($mail);