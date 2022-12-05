<?php
if (isset($_POST['choixJour'])) {
    // on cherche la semaine pour vérifier s'il y a un planning
    $semaine = date("W", strtotime($_POST['choixJour']));
    $annee = date("Y", strtotime($_POST['choixJour']));
}
require_once(PATH_MODELS.$page.'.php');



require_once(PATH_VIEWS.$page.'.php'); 