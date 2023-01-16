<!-- Contrôleur page absences -->
<?php
if (isset($_POST['mois']) && is_numeric($_POST['mois']) && 
    isset($_POST['annee']) && is_numeric($_POST['annee']) &&
    $_POST['mois'] > 0 && $_POST['mois'] < 13) {
    // Le mois et l'année sont choisis par l'utilisateur et ont un format correct
    $mois = htmlspecialchars($_POST['mois']);
    $annee = htmlspecialchars($_POST['annee']);
} else {
    // Le mois et l'année ne sont pas choisis par l'utilisateur : on prend les données du jour
    $mois = date("m");
    $annee = date("Y");
}

require_once(PATH_MODELS.$page.'.php');

// Si aucune absence n'est trouvée : on affiche l'alerte
if (empty($listeAbsences) && !isset($_POST['idAbsence'])) $alert = choixAlert('pas_d_absence');

require_once(PATH_VIEWS.$page.'.php'); 