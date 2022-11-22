<?php
$para = array($mois, $annee);
require_once(PATH_MODELS.'DisponibiliteDAO.php');
$disponibiliteDAO = new DisponibiliteDAO(true);
$listeDispos = $disponibiliteDAO->getDispoParDate($para);
