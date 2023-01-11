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
		case 'pas_d_absence' :
			$alert['messageAlert'] = PAS_D_ABSENCE;
			break;
		case 'pas_de_produit' :
			$alert['messageAlert'] = PAS_DE_PRODUIT;
			break;
		case 'pas_de_conge' :
			$alert['messageAlert'] = PAS_DE_CONGE;
			break;
		case 'pas_de_demande' :
			$alert['messageAlert'] = PAS_DE_DEMANDE;
			break;
		case 'pas_de_jour' :
			$alert['messageAlert'] = PAS_DE_JOUR;
			break;
		case 'supp_echange_impossible' :
			$alert['messageAlert'] = SUPP_ECHANGE_IMPOSSIBLE;
			break;
		case 'conge_trouve' :
			$alert['messageAlert'] = CONGE_TROUVE;
			break;
		case 'deja_echange' :
			$alert['messageAlert'] = DEJA_ECHANGE;
			break;
		case 'planning_existant' :
			$alert['messageAlert'] = PLANNING_EXISTANT;
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

function jourFrancais($numero, $abrege) {
	switch($numero) {
		case 1 :
			$jour = 'Lundi';
			break;
		case 2 :
			$jour = 'Mardi';
			break;
		case 3 :
			$jour = 'Mercredi';
			break;
		case 4 :
			$jour = 'Jeudi';
			break;
		case 5 :
			$jour = 'Vendredi';
			break;
		case 6 :
			$jour = 'Samedi';
			break;
		case 7 :
			$jour = 'Dimanche';
			break;
		default :
			break;
	}
	if ($abrege == true) {
		$jour = substr($jour, 0, 3);
	}
	return $jour;
}

function moisFrancais($numero) {
	switch($numero) {
		case 1 :
			return 'janvier';
			break;
		case 2 :
			return 'février';
			break;
		case 3 :
			return 'mars';
			break;
		case 4 :
			return 'avril';
			break;
		case 5 :
			return 'mai';
			break;
		case 6 :
			return 'juin';
			break;
		case 7 :
			return 'juillet';
			break;
		case 8 :
			return 'août';
			break;
		case 9 :
			return 'septembre';
			break;
		case 10 :
			return 'octobre';
			break;
		case 11 :
			return 'novembre';
			break;
		case 12 :
			return 'décembre';
			break;
		default :
			break;
	}
}