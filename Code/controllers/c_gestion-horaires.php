<!-- Contrôleur page de gestion des horaires -->
<?php
// Vérification des autorisations
if ($_SESSION['compte']->getPosition() != 'MANA') {
    header("Location: index.php");
    exit;
}

// Recherche des absences par mois et année
if (isset($_POST['mois']) && is_numeric($_POST['mois']) && 
    isset($_POST['annee']) && is_numeric($_POST['annee']) &&
    $_POST['mois'] > 0 && $_POST['mois'] < 13) {
    // Mois et années choisis par l'utilisateur (vérification du bon format)
    $mois = htmlspecialchars($_POST['mois']);
    $annee = htmlspecialchars($_POST['annee']);
} else {
    // Mois et années choisis automatiquement en fonction du jour
    $mois = date("m");
    $annee = date("Y");
}

// Génération/visualisation d'un planning par semaine et année
if (isset($_POST['semainePlanning']) && is_numeric($_POST['semainePlanning']) && 
    isset($_POST['anneePlanning']) && is_numeric($_POST['anneePlanning']) &&
    $_POST['semainePlanning'] > 0 && $_POST['semainePlanning'] < 53) {
    // Semaine et année choisies par l'utilisateur (vérification du bon format)
    $semainePlanning = htmlspecialchars($_POST['semainePlanning']);
    $anneePlanning = htmlspecialchars($_POST['anneePlanning']);
} else {
    // Semaine et année choisies automatiquement en fonction du jour
    $semainePlanning = date("W");
    $anneePlanning = date("Y");
}

require_once(PATH_MODELS.$page.'.php');

// Gestion de l'affichage des absences
if(!empty($listeAbsences)) {

    function compareDate($date1, $date2){
        return strtotime($date1) - strtotime($date2);
    }

    // Tri des dates des absences récuperées par ordre croissant pour affichage
    $datesTriees = array();
    foreach ($listeAbsences as $elem) {
        array_push($datesTriees, date("Y-m-d",strtotime($elem->getDebut())));
    }
    $datesTriees = array_unique($datesTriees); // suppression des doublons
    usort($datesTriees, "compareDate"); // tri avec la fonction de comparaison des dates

    // Tableau avec les ids des employés qu'on va trier par ordre croissant
    $idEmpTries = array();
    foreach($listeAbsences as $elem) {
        array_push($idEmpTries, $elem->getIdEmploye());
    }
    $idEmpTries = array_unique($idEmpTries); // suppression des doublons
    sort($idEmpTries); // tri par ordre croissant des id trouvés
}
else if (isset($_POST['rechercher'])){
    // Aucune absence trouvée : affichage de l'alerte
    $alert = choixAlert('pas_d_absence');
}

if (isset($_POST['generer']) && isset($planningGenere) && $planningGenere) {
    // Si on a généré un planning mais qu'il y en a déjà un existant : affichage de l'alerte
    $alert = choixAlert('planning_existant');
}

require_once(PATH_VIEWS.$page.'.php'); 