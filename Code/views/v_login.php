<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>

<!--  Début de la page -->
<div class="container">
	<div class="row">
	  	<div class="one-half column">
			<h1>Connexion</h1>
			<!--  Zone message d'alerte -->
			<?php require_once(PATH_VIEWS.'alert.php');?>
			<form action="index.php?page=login" method="post">
				<label for="email">Adresse mail</label>
      			<input class="u-full-width" type="email" placeholder="john.doe@mail.com" id="email" name="mail">
				<label for="mdp">Mot de passe</label>
      			<input class="u-full-width" type="password" placeholder="azerty123" id="mdp" name="mdp">
				<input type="submit" value="Valider">
			</form>
		</div>
	</div>
</div>

<!--  Fin de la page -->