<?php
$semaine = date('W');
$annee = date('Y');
$ddate = date("Y-m-d"); 
if($_SESSION['compte']->getPosition() == 'MANA') {
    $position = 'Manager';
} else if($_SESSION['compte']->getPosition() == 'ASSI') {
    $position = 'Assistant Manager';
} else {
    $position = 'Employé Polyvalent';
}
require_once(PATH_MODELS.$page.'.php'); 
require_once(PATH_VIEWS.$page.'.php'); 