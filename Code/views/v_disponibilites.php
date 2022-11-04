<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>

<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->

<div class="row">
	<!-- Partie déclaration -->
	<div class="three columns">
		<h5>Déclaration</h5>
		<form method="post" action="index.php?page=disponibilites">
			<label for="debut">Début</label>
			<input class="u-full-width" type="datetime-local" id="debut" name="debut">
			<label for="fin">Fin</label>
			<input class="u-full-width" type="datetime-local" id="fin" name="fin">
			<input class="button-primary u-full-width" type="submit" value="Valider">
		</form>
	</div>
	<!-- Partie édition des disponibilités -->
	<div class="nine columns">
		<h5>Edition</h5>
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
				<input class="button-primary u-full-width" type="submit" value="Valider">
			</div>
		</form>
		<?php if (!empty($listeDispos)) {?>
		<h6>Choisir la disponibilité</h6>
		<form action="index.php?page=disponibilites" method="post">
			<div class=six columns">
				<label for="dispo">Mois</label>
				<select name="dispo" class="u-full-width">
					<?php 
						foreach ($listeDispos as $elem) {
							echo '<option value="'.$elem->getIdDispo().'">'.$elem->getDebutDispo().' - '.$elem->getFinDispo().'</option>';
						}
					?>
				</select>
			</div>
			<div class="six columns">
				<input class="button-primary u-full-width" type="submit" value="Valider">
			</div>
		</form>
		<?php }?>
	</div>
</div>
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 
