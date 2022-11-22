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
		case 'pas_de_dispo' :
			$alert['messageAlert'] = PAS_DE_DISPO;
			break;
		case 'pas_de_produit' :
			$alert['messageAlert'] = PAS_DE_PRODUIT;
			break;
		case 'succes_operation' :
			$alert['messageAlert'] = SUCCES_OPERATION;
			break;
		case 'contraintes' :
			$alert['messageAlert'] = CONTRAINTES;
			break;
		case 'privileges' :
			$alert['messageAlert'] = PRIVILEGES;
			break;
		case 'form_vide' :
			$alert['messageAlert'] = FORM_VIDE;
			break;
		default : 
			$alert['messageAlert'] = MESSAGE_ERREUR;
	}
	return $alert;
}
