<?php
$para = array($_SESSION['compte']->getId(), $mois, $annee);
require_once(PATH_MODELS.'DisponibiliteDAO.php');
$disponibiliteDAO = new DisponibiliteDAO(true);
$listeDispos = $disponibiliteDAO->getDispo($para);