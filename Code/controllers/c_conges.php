<?php
if (isset($_POST['listeAnnee']) && 
is_numeric($_POST['listeAnnee'])) {
    $annee = htmlspecialchars($_POST['listeAnnee']);
} else {
//Année choisie automatiquement en fonction du jour
    $annee = date("Y");
}

require_once(PATH_MODELS.$page.'.php');

if($listeConges != false) {// 1 ou plusieurs demandes trouvées
    if (isset($_POST['del7'])) {
        
    }
} else {
    $alert = choixAlert('pas_de_conge');
}

require_once(PATH_VIEWS.$page.'.php');