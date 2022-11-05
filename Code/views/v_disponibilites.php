<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<h1>Disponibilités</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->
<!-- insérer contraintes à respecter pour les dispo (même jour, début < fin ...) -->
<div class="row">
	<!-- Partie déclaration -->
	<div class="three columns">
		<h5>Déclaration</h5>
		<form method="post" action="index.php?page=disponibilites">
			<label for="ajoutDebut">Début</label>
			<input class="u-full-width" type="datetime-local" id="ajoutDebut" name="ajoutDebut">
			<label for="ajoutFin">Fin</label>
			<input class="u-full-width" type="datetime-local" id="ajoutFin" name="ajoutFin">
			<input class="button-success u-full-width" type="submit" value="Ajouter" name="ajouter">
		</form>
	</div>
	<!-- Partie édition des disponibilités -->
	<div class="nine columns">
		<h5>Edition</h5>
		<div class="row">
			<h6>Rechercher une disponibilité</h6>
			<form action="index.php?page=disponibilites" method="post">
				<div class="four columns">
					<label for="mois">Mois</label>
					<input class="u-full-width" type="text" value="<?php echo $mois ?>" id="mois" name="mois">
				</div>
				<div class="four columns">
					<label for="annee">Année</label>
					<input class="u-full-width" type="text" value="<?php echo $annee ?>" id="annee" name="annee">
				</div>
				<div class="four columns">
					<input class="button-success u-full-width" type="submit" value="Rechercher" name="rechercher">
				</div>
			</form>
		</div>
		<?php if (!empty($listeDispos)) {?>
		<div class="row">
			<h6>Choisir la disponibilité</h6>
			<form action="index.php?page=disponibilites" method="post">
				<div class="nine columns">
					<label for="idDispo">Disponibilité</label>
					<select name="idDispo" class="u-full-width">
						<?php 
							foreach ($listeDispos as $elem) {
								$debut = date('l d (H:i)', strtotime($elem->getDebutDispo()));
								$fin = date('l d (H:i)', strtotime($elem->getFinDispo()));
								echo '<option value="'.$elem->getIdDispo().'">'.$debut.' - '.$fin.'</option>';
							}
						?>
					</select>
				</div>
				<div class="three columns">
					<input class="button-primary u-full-width" type="submit" value="Séléctionner" name="choisir">
				</div>
			</form>
		</div>
		<?php }?>

		<?php if (isset($dispoEditee)) {?>
		<div class="row">
			<h6>Editer la disponibilité</h6>
			<form action="index.php?page=disponibilites" method="post">
				<div class="three columns">
					<label for="modifId">ID</label>
					<input class="u-full-width" readonly type="text" id="modifId" name="modifId" value="<?php echo $dispoEditee->getIdDispo();?>">
				</div>
				<div class="three columns">
					<label for="modifDebut">Début</label>
					<input class="u-full-width" type="datetime-local" id="modifDebut" name="modifDebut" value="<?php echo $dispoEditee->getDebutDispo();?>">
				</div>
				<div class="three columns">
					<label for="modifFin">Fin</label>
					<input class="u-full-width" type="datetime-local" id="modifFin" name="modifFin" value="<?php echo $dispoEditee->getFinDispo();?>">
				</div>
				<div class="three columns">
					<input class="button-warning u-full-width" type="submit" value="Modifier" name="modifier">
					<input class="button-danger u-full-width" type="submit" value="Supprimer" name="supprimer">
				</div>
			</form>
		</div>
		<?php }?>
	</div>
</div>
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 
