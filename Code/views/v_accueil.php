<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<h1>Dashboard</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->

<h1><?php
if($_SESSION['compte']->getPosition() == 'MANA') {
        $position = 'Manager';
    } else if($_SESSION['compte']->getPosition() == 'ASSI') {
        $position = 'Assistant Manager';
    } else {
        $position = 'Employé Polyvalent';
    }

    echo $_SESSION['compte']->getNom() . " " . $_SESSION['compte']->getPrenom() . " - " . $position;


?></h1>

<?php 

if (!isset($alert)) {?>
<table class="u-full-width">
	<h3>Votre emploie du temps de la journée - <?php echo date('l', strtotime($ddate)); ?></h3>
	<tbody>
		<tr>
			<td>Début :</td>
			<?php
				if (isset($jour)) {
					if($jour->getConge() == 1) {
						echo '<td>CONGÉ</td>';
					} else {
						echo '<td>'.$jour->getDebutJournee().'</td>';
					}
				} else echo '<td></td>';
			?>
		</tr>
		<tr>
			<td>Fin :</td>
			<?php
				if (isset($jour)) {
					if($jour->getConge() == 1) {
						echo '<td>CONGÉ</td>';
					} else {
						echo '<td>'.$jour->getFinJournee().'</td>';
					}
				} else echo '<td></td>';
			?>
		</tr>
	</tbody>
</table>
<?php }?>

<a href="index.php?page=logout"><button>Se déconnecter</button></a>

<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 
