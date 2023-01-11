<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<h1>Absences</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->
<!-- insérer contraintes à respecter pour les dispo (même jour, début < fin ...) -->
<div class="row">
	<!-- Partie déclaration -->
	<div class="three columns">
		<h5>Déclaration</h5>
		<form method="post">
			<label for="ajoutDebut">Début</label>
			<input class="u-full-width" type="datetime-local" id="ajoutDebut" name="ajoutDebut" required>
			<label for="ajoutFin">Fin</label>
			<input class="u-full-width" type="datetime-local" id="ajoutFin" name="ajoutFin">
			<input class="button-success u-full-width" type="submit" value="Ajouter" name="ajouter" required>
		</form>
	</div>
	<!-- Partie édition des disponibilités -->
	<div class="nine columns">
		<h5>Edition</h5>
		<div class="row">
			<h6>Rechercher une absence</h6>
			<form method="post">
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
		<?php if (!empty($listeAbsences)) {?>
		<div class="row">
			<h6>Choisir l'absence</h6>
			<form method="post">
				<div class="nine columns">
					<label for="idAbsence">Absence</label>
					<select name="idAbsence" class="u-full-width">
						<?php 
							foreach ($listeAbsences as $elem) {
								$debut = jourFrancais(date("N", strtotime($elem->getDebut())), false) . date(' d (H\hi)', strtotime($elem->getDebut()));
								$fin = jourFrancais(date("N", strtotime($elem->getFin())), false) . date(' d (H\hi)', strtotime($elem->getFin()));
								if (isset($_POST['idAbsence']) && ($elem->getIdAbsence() == $_POST['idAbsence'])) echo '<option selected value="'.$elem->getIdAbsence().'">'.$debut.' - '.$fin.'</option>';
								echo '<option value="'.$elem->getIdAbsence().'">'.$debut.' - '.$fin.'</option>';
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

		<?php if (isset($absEditee)) {?>
		<div class="row">
			<h6>Editer l'absence</h6>
			<form method="post">
				<div class="three columns">
					<label for="modifId">ID</label>
					<input class="u-full-width" readonly type="text" id="modifId" name="modifId" value="<?php echo $absEditee->getIdAbsence();?>">
				</div>
				<div class="three columns">
					<label for="modifDebut">Début</label>
					<input class="u-full-width" type="datetime-local" id="modifDebut" name="modifDebut" value="<?php echo $absEditee->getDebut();?>">
				</div>
				<div class="three columns">
					<label for="modifFin">Fin</label>
					<input class="u-full-width" type="datetime-local" id="modifFin" name="modifFin" value="<?php echo $absEditee->getFin();?>">
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
