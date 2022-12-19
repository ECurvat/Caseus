<?php
$para = array($mois, $annee);
require_once(PATH_MODELS . 'AbsenceDAO.php');
$absenceDAO = new AbsenceDAO(true);
$listeAbsences = $absenceDAO->getAbsenceParDate($para);
