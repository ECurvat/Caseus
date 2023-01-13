<?php //  En tête de page 
?>
<?php require_once(PATH_VIEWS . 'header.php'); ?>
<h1>Gestion des horaires</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS . 'alert.php'); ?>

<!--  Début de la page -->
<div class="row">
	<h5>Trouver les absences par mois</h5>
	<div class="row">
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
	<?php
	if (!empty($listeAbsences)) {
	?>
		<table class="u-full-width">
			<thead>
				<tr>
					<th>Id employé</th>
					<?php
					foreach ($datesTriees as $elem) {
						echo '<th>' . jourFrancais(date("N", strtotime($elem)), true) . date(" d/m", strtotime($elem)) . '</th>';
					}
					?>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 0;
				while ($i < count($idEmpTries)) {
					echo '<tr>';
					echo '<td>' . $idEmpTries[$i] . '</td>'; // id de l'employé
					// for qui parcourt tous les jours où il y a des absences 
					foreach ($datesTriees as $date) {
						echo '<td>';
						foreach ($listeAbsences as $abs) {
							if (($abs->getIdEmploye() == $idEmpTries[$i]) and (date("Y-m-d", strtotime($abs->getDebut())) == $date)) {
								echo date("H:i", strtotime($abs->getDebut())) . ' - ' . date("H:i", strtotime($abs->getFin()));
							}
						}
						echo '</td>';
					}
					echo '</tr>';
					$i++;
				}
				?>
			</tbody>
		</table>
	<?php
	}
	?>
</div>
<div class="row">
	<h5>Gérer un planning pour une semaine</h5>
	<div class="row">
		<form method="post">
			<div class="eight columns">
				
					<div class="six columns">
						<label for="semainePlanning">Semaine</label>
						<input class="u-full-width" type="text" value="<?php echo $semainePlanning ?>" id="semainePlanning" name="semainePlanning">
					</div>
					<div class="six columns">
						<label for="anneePlanning">Année</label>
						<input class="u-full-width" type="text" value="<?php echo $anneePlanning ?>" id="anneePlanning" name="anneePlanning">
					</div>
			</div>
			<div class="four columns">
				<input class="button-primary u-full-width" type="submit" value="Visualiser" name="voir">
				<br>
				
				<input class="button-success u-full-width" type="submit" value="Génerer" name="generer"><br>
				<input type="checkbox" id="ignorer" name="ignorer">
				<span class="label-checkbox">Ecraser l'ancien planning s'il existe déjà</span>
			</div>
		</form>
	</div>
	
	<?php if((isset($_POST['generer']) && $generation) || (isset($_POST['voir']) && $planningGenere)) {?>
		<table class="u-full-width">
			<thead>
				<tr>
					<th>Employé</th>
					<?php 
					$jourCourant = new DateTime(date('Y-m-d',strtotime($anneePlanning.'W'.$semainePlanning)));
					for($i=0;$i<7;$i++){
						echo '<th>'.jourFrancais($jourCourant->format('N'), true). ' ' .$jourCourant->format('d/m').'</th>';
						$jourCourant->modify('+1 day');
					}
					?>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($listePoly as $poly) {
					echo '<tr>';
					echo '<td>' . $poly->getId() . '</td>';
					for ($i=0; $i < 7; $i++) {
						if ($affectation[$i][$poly->getId()] != null) {
							switch($affectation[$i][$poly->getId()]->getId()) {
								case 'a':
								case 'b':
								case 'c':
									$class = 'matin';
									$icon = '<i class="fa-solid fa-sun"></i>';
									break;
								case 'e':
								case 'f':
								case 'g':
								case 'h':
									$class = 'soir';
									$icon = '<i class="fa-solid fa-moon"></i>';
									break;
								case 'y':
									$class = 'conges';
									$icon = '<i class="fa-solid fa-plane"></i>';
									break;
								case 'z':
									$class = 'repos';
									$icon = '<i class="fa-solid fa-bed"></i>';
									break;
								default:
									break;
							}
							echo '<td class="'.$class.'">'.$icon.' ' . strtoupper($affectation[$i][$poly->getId()]->getId()) . '</td>';
						} else {
							echo '<td></td>';
						}						
					}
					echo '<td>' . $totSrvPoly[$poly->getId()] . '</td>';
					echo '</tr>';
				}
				?>
				<tr>
					<td>SNA</td>
					<?php
					for ($i=0; $i < 7; $i++) {
						if (empty($srvPoly[$i])) {
							echo '<td><i class="success fa-solid fa-xmark"></i></td>';
						} else {
							echo '<td><i class="danger fa-solid fa-check"></i><br>';
							foreach ($srvPoly[$i] as $srv) {
								echo $srv->getId() . '; ';
							}
							echo '</td>';
						}
					}
					?>
					<td></td>
				</tr>
			</tbody>
		</table>

		<table class="u-full-width">
			<thead>
				<tr>
					<th>Employé</th>
					<?php 
					$jourCourant = new DateTime(date('Y-m-d',strtotime($anneePlanning.'W'.$semainePlanning)));
					for($i=0;$i<7;$i++){
						echo '<th>'.jourFrancais($jourCourant->format('N'), true). ' ' .$jourCourant->format('d/m').'</th>';
						$jourCourant->modify('+1 day');
					}
					?>
					<th>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach ($listeAssiMana as $emp) {
					echo '<tr>';
					echo '<td>' . $emp->getId() . ' (' . $emp->getPosition()[0].')</td>';
					for ($i=0; $i < 7; $i++) {
						if ($affectation[$i][$emp->getId()] != null) {
							switch($affectation[$i][$emp->getId()]->getId()) {
								case 'd':
									$class = 'matin';
									$icon = '<i class="fa-solid fa-sun"></i>';
									break;
								case 'i':
									$class = 'soir';
									$icon = '<i class="fa-solid fa-moon"></i>';
									break;
								case 'y':
									$class = 'conges';
									$icon = '<i class="fa-solid fa-plane"></i>';
									break;
								case 'z':
									$class = 'repos';
									$icon = '<i class="fa-solid fa-bed"></i>';
									break;
								default:
									break;
							}
							echo '<td class="'.$class.'">'.$icon.' ' . strtoupper($affectation[$i][$emp->getId()]->getId()) . '</td>';
						} else {
							echo '<td></td>';
						}						
					}
					echo '<td>' . $totSrvAssiMana[$emp->getId()] . '</td>';
					echo '</tr>';
				}
				?>
				<tr>
					<td>SNA</td>
					<?php
					for ($i=0; $i < 7; $i++) {
						if (empty($srvAssiMana[$i])) {
							echo '<td><i class="success fa-solid fa-xmark"></i></td>';
						} else {
							echo '<td><i class="danger fa-solid fa-check"></i><br>';
							foreach ($srvAssiMana[$i] as $srv) {
								echo $srv->getId() . '; ';
							}
							echo '</td>';
						}
					}
					?>
					<td></td>
				</tr>
			</tbody>
		</table>
	<?php } ?>
</div>
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS . 'footer.php');
