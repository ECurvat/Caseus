<?php
if ($_SESSION['compte']->getPosition() != 'MANA') {
    header("Location: index.php");
    exit;
}

if (isset($_POST['mois']) && 
    is_numeric($_POST['mois']) && 
    isset($_POST['annee']) && 
    is_numeric($_POST['annee']) &&
    $_POST['mois'] > 0 &&
    $_POST['mois'] < 13) {
    //Mois et années choisis par l'utilisateur
    $mois = htmlspecialchars($_POST['mois']);
    $annee = htmlspecialchars($_POST['annee']);
} else {
    //Mois et années choisis automatiquement en fonction du jour
    $mois = date("m");
    $annee = date("Y");
}

if (isset($_POST['semainePlanning']) && 
    is_numeric($_POST['semainePlanning']) && 
    isset($_POST['anneePlanning']) && 
    is_numeric($_POST['anneePlanning']) &&
    $_POST['semainePlanning'] > 0 &&
    $_POST['semainePlanning'] < 53) {
    //Mois et années choisis par l'utilisateur
    $semainePlanning = htmlspecialchars($_POST['semainePlanning']);
    $anneePlanning = htmlspecialchars($_POST['anneePlanning']);
} else {
    //Mois et années choisis automatiquement en fonction du jour
    $semainePlanning = date("W");
    $anneePlanning = date("Y");
}

require_once(PATH_MODELS.$page.'.php');
if(!empty($listeAbsences)) {
    //Tri des dates des absences récuperées par ordre croissant pour affichage
    function compareDate($date1, $date2){
        return strtotime($date1) - strtotime($date2);
    }

    $datesTriees = array();
    foreach ($listeAbsences as $elem) {
        array_push($datesTriees, date("Y-m-d",strtotime($elem->getDebut()))); // tri des dates Y-m-d uniquement
    }
    $datesTriees = array_unique($datesTriees);
    usort($datesTriees, "compareDate"); // tri avec la fonction des dates

    //On crée un array avec les ids des employés qu'on va trier par ordre croissant
    $idEmpTries = array();
    foreach($listeAbsences as $elem) {
        array_push($idEmpTries, $elem->getIdEmploye());
    };
    $idEmpTries = array_unique($idEmpTries);
    sort($idEmpTries); // tri par ordre croissant des id trouvés
}
else if (isset($_POST['rechercher'])){
    $alert = choixAlert('pas_d_absence');
}

if (isset($_POST['generer']) && isset($planningGenere) && $planningGenere) {
    $alert = choixAlert('planning_existant');
}

require_once(PATH_VIEWS.$page.'.php'); 