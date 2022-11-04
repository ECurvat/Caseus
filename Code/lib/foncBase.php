<?php

function choixAlert($message)
{
	$alert = array();
	switch($message)
	{
		case 'requete' :
			$alert['messageAlert'] = ERREUR_REQUETE;
			break;
		case 'connexion' :
			$alert['messageAlert'] = ERREUR_CONNEXION;
			break;
		case 'rien_trouve' :
			$alert['messageAlert'] = RIEN_TROUVE;
			break;
		case 'url_non_valide' :
			$alert['messageAlert'] = TEXTE_PAGE_404;
			break;
		case 'pas_de_planning' :
			$alert['messageAlert'] = PAS_DE_PLANNING;
			break;
		default : 
			$alert['messageAlert'] = MESSAGE_ERREUR;
	}
	return $alert;
}
