<?php
require_once(PATH_MODELS.'CongeDAO.php');
$congeDAO = new CongeDAO(true);
$paraRecherche = array($_SESSION['compte']->getId(), $annee);
$listeConges = $congeDAO->getCongeParDateParEmploye($paraRecherche);

require_once(PATH_MODELS.'EtatDAO.php');
    $etatDAO = new EtatDAO(true);
    $listeEtats = $etatDAO->getListeEtats();

if (isset($_POST['ajoutValider'])) {
    if (($_POST['ajoutDebut'] < $_POST['ajoutFin'])) {
        $paraAjout = array($_SESSION['compte']->getId(), $_POST['ajoutDebut'], $_POST['ajoutFin']);
        $congeDAO->addConge($paraAjout);
        $alert = choixAlert('succes_operation');
        $listeConges = $congeDAO->getCongeParDateParEmploye($paraRecherche); // on actualise la liste des demandes
    } else {
        $alert = choixAlert('contraintes');
    } 
}

foreach ($listeConges as $elem) {
    if(isset($_POST['del'.$elem->getIdDemande()])) { // sorte d'écouteur sur les boutons de suppression
        $congeDAO->removeConge($elem->getIdDemande());
        $alert = choixAlert('succes_operation');
        $listeConges = $congeDAO->getCongeParDateParEmploye($paraRecherche); // on actualise la liste des demandes
    }
}