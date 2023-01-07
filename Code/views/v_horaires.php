<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<h1>Horaires</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->

<div class="row">
	<form method="post">
		<div class="one column">
			<button class="button-success"><i class="fa-solid fa-arrow-left"></i></button>
		</div>
		<div class="five columns">
			<label for="date">Date</label>
			<input class="u-full-width" type="date" value="<?php echo $ajd ?>" id="date" name="date">
		</div>
		<div class="five columns">
			<input class="button-primary u-full-width" type="submit" value="Valider">
		</div>
		<div class="one column">
			<button class="button-success"><i class="fa-solid fa-arrow-right"></i></button>
		</div>
	</form>
</div>
<?php if (!isset($alert)) {?>
<h2>Semaine n° <?php echo $semaine ?></h2>
<table class="u-full-width">
	<thead>
		<tr>
			<th></th>
			<?php
			foreach($datesSemaine as $dateJour) {
				echo "<th>".date('D', strtotime($dateJour)).' '.date("j/m/y", strtotime($dateJour))."</th>";
			}
			?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>Service :</td>
			<?php for ($i=0; $i < 7; $i++) { 
				if (isset($listeJours[$i])) {
					switch($listeJours[$i]->getIdService()) {
						case 'a':
						case 'b':
						case 'c':
						case 'd':
							$class = 'matin';
							$icon = '<i class="fa-solid fa-sun"></i>';
							break;
						case 'e':
						case 'f':
						case 'g':
						case 'h':
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
					echo '<td class="'.$class.'">'.$icon.' ' . strtoupper($listeServicesIndex[$listeJours[$i]->getIdService()]->getId()) . '</td>';
				} else echo '<td></td>';
			}?>
		</tr>
		<tr>
			<td>Horaires :</td>
			<?php for ($i=0; $i < 7; $i++) { 
				if (isset($listeJours[$i])) {
					if(($listeJours[$i]->getIdService() == 'y') || ($listeJours[$i]->getIdService() == 'z')) {
						echo '<td></td>';
					} else {
						echo '<td>'.$listeServicesIndex[$listeJours[$i]->getIdService()]->getDebut().'<br>' . $listeServicesIndex[$listeJours[$i]->getIdService()]->getFin() . '</td>';
					}
				} else echo '<td></td>';
			}?>
		</tr>
	</tbody>
</table>
<?php }?>
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 
