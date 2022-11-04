<?php
if (isset($_POST['semaine']) && 
    is_numeric($_POST['semaine']) && 
    isset($_POST['annee']) && 
    is_numeric($_POST['annee'])) {
    //Semaine choisie par l'utilisateur
    $semaine = htmlspecialchars($_POST['semaine']);
    $annee = htmlspecialchars($_POST['annee']);
} else {
    //Semaine choisie automatiquement en fonction du jour
    $ddate = date("Y-m-d");
    $duedt = explode ("-", $ddate);
    $date = mktime (0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
    $semaine = (int) date('W', $date);
    $annee = date("Y");
}

//On trouve le premier jour de la semaine choisie
$date = new DateTime(date('Y-m-d',strtotime($annee.'W'.$semaine)));

//On met les dates de la semaine choisie dans un tableau
$datesSemaine = array();

for($i = 0; $i<7; $i++) {
    array_push($datesSemaine, $date->format('d-m-Y'));
    $date->modify('+1 day');
}

require_once(PATH_MODELS.$page.'.php'); 
require_once(PATH_VIEWS.$page.'.php'); 