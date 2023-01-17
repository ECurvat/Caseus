<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<h1>Dashboard</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->

<h2><?php echo $_SESSION['compte']->getNom() . " " . $_SESSION['compte']->getPrenom() . " - " . $position;?></h2>

<?php 

if (!isset($alert)) {?>
<div class="row">
	<div class="six columns">
		<div class="item">
			<h4>Journée de travail</h4>
			<div>
				<p><strong><?php echo jourFrancais(date("N"), false) . " " . date("d") . " " . moisFrancais(date("m")) . " " . date("Y") ?></strong></p>
				<?php if ($jour != null && $jour->getIdService() != 'y' && $jour->getIdService() != 'z') { ?>
					<p>Prise de service <?php echo $listeServicesIndex[$jour->getIdService()]->getDebut() ?></p>
					<p>Fin de service <?php echo $listeServicesIndex[$jour->getIdService()]->getFin() ?></p>
				<?php } else { ?>
					<br><p>Pas de service</p>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="six columns">
		<div class="item">
			<h4>Modifier mon profil</h4>
			<p>Une information à modifier ?</p>
			<a href="index.php?page=profil"><button>Modifier mon profil</button></a>
		</div>
	</div>
</div>
<?php }?>
<br>
<a href="index.php?page=logout"><button class="u-full-width">Déconnexion</button></a>

<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 
