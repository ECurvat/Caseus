<!-- Modèle de la page congés -->
<?php
require_once(PATH_MODELS_DAO.'CongeDAO.php');
$congeDAO = new CongeDAO(true);
require_once(PATH_MODELS_DAO.'EtatDAO.php');
$etatDAO = new EtatDAO(true);

// Récupération de la liste des états pour affichage dans le tableau
$listeEtats = $etatDAO->getListeEtats();

// Gestion de l'envoi d'une demande de congés
if (isset($_POST['ajoutValider'])) {
    // Vérification des contraintes (début < fin)
    if (($_POST['ajoutDebut'] < $_POST['ajoutFin'])) {
        $paraAjout = array($_SESSION['compte']->getId(), $_POST['ajoutDebut'], $_POST['ajoutFin']);
        $congeDAO->addConge($paraAjout);
        $alert = choixAlert('succes_operation');
    } else {
        $alert = choixAlert('contraintes');
    } 
}

// Récupération de la liste des congés de l'employé par année
$paraRecherche = array($_SESSION['compte']->getId(), $annee);
$listeConges = $congeDAO->getCongeParDateParEmploye($paraRecherche);

// Gestion de la suppression
if (!empty($listeConges)) {
    foreach ($listeConges as $elem) {
        // Ecouteur sur les boutons de suppression
        if(isset($_POST['del'.$elem->getIdDemande()])) {
            // Impossible de supprimer une demande acceptée ou refusée
            if ($elem->getIdEtat() == 3) {
                $congeDAO->removeConge($elem->getIdDemande());
                // Actualisation de la liste des congés après suppression
                $listeConges = $congeDAO->getCongeParDateParEmploye($paraRecherche);
                $alert = choixAlert('succes_operation');
            } else {
                $alert = choixAlert('supp_impossible');
            }
        }
    }
}