<?php
$days = '+0';
if(isset($_POST['previous'])) {
    $days = '-7';
}
if (isset($_POST['next'])) {
    $days = '+7';
}
if (isset($_POST['date'])) {
    //Date choisie par l'utilisateur
    $ajd = htmlspecialchars($_POST['date']);
} else {
    //Semaine choisie automatiquement en fonction du jour
    $ajd = date('Y-m-d');
}
$ajd = date('Y-m-d', strtotime($ajd. ' '.$days.' days'));

$semaine = date('W', strtotime($ajd));
$annee = date('Y', strtotime($ajd));

//On trouve le premier jour de la semaine choisie
$jourCourant = new DateTime(date('Y-m-d',strtotime($annee.'W'.$semaine)));

//On met les dates de la semaine choisie dans un tableau
$datesSemaine = array();

for($i = 0; $i<7; $i++) {
    array_push($datesSemaine, $jourCourant->format('d-m-Y'));
    $jourCourant->modify('+1 day');
}

require_once(PATH_MODELS.$page.'.php'); 
require_once(PATH_VIEWS.$page.'.php'); 