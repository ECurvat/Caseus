<!-- Contrôleur page congés -->
<?php
// Affichage de ses demandes de congés
if (isset($_POST['listeAnnee']) && is_numeric($_POST['listeAnnee'])) {
    // Année choisie par l'utilisateur
    $annee = htmlspecialchars($_POST['listeAnnee']);
} else {
    // Année choisie en fonction du jour courant
    $annee = date("Y");
}

require_once(PATH_MODELS.$page.'.php');

if($listeConges == false) {
    // Aucune demande trouvée : on affiche l'alerte
    $alert = choixAlert('pas_de_conge');
}

require_once(PATH_VIEWS.$page.'.php');