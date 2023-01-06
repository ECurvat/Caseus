<!DOCTYPE html>
<html>
	<head>
		<title><?= TITRE ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="Language" content="<?= LANG ?>"/>
		<meta name="viewport" content="width=device-width; initial-scale=1; maximum-scale=1; user-scalable=0"/> 

		<link href="<?= PATH_CSS ?>normalize.css" rel="stylesheet"> 
		<link href="<?= PATH_CSS ?>skeleton.css" rel="stylesheet">
		<link href="<?= PATH_CSS ?><?= $page ?>.css" rel="stylesheet">
		
		<script src="https://kit.fontawesome.com/c133ee1e05.js" crossorigin="anonymous"></script>
		<?php
		if ($page != 'login') {
			echo "<link href=\"".PATH_CSS."general.css\" rel=\"stylesheet\">";
		}
		?>
	</head> 
	<body>
		<?php
			if ($page != 'login') {
				//Menu
				echo '<div id="navbar-button"><i class="fa-solid fa-bars"></i><h2>Menu</h2></div>';
				echo '<div class="container">';
				echo '<div class="row mainscreen">';
				echo '<div class="three columns" id="sidebar">';
				include(PATH_VIEWS.'menu.php');
				echo '</div>';
				echo '<div class="nine columns" id="main">';

			}
		?>
		<!-- Vue -->