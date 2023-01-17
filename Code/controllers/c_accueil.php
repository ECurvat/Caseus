<!-- Contrôleur page d'accueil -->
<?php
// On récupère les données du jour courant
$semaine = date('W');
$annee = date('Y');

// On récupère la position de l'utilisateur pour l'afficher proprement
if($_SESSION['compte']->getPosition() == 'MANA') {
    $position = 'Manager';
} else if($_SESSION['compte']->getPosition() == 'ASSI') {
    $position = 'Assistant Manager';
} else {
    $position = 'Employé Polyvalent';
}

require_once(PATH_MODELS.$page.'.php');
require_once(PATH_VIEWS.$page.'.php'); 