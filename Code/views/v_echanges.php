<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<h1>Echanges</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->
<h5>Créer un échange</h5>
<div class="row">
    <div class="four columns">
        <div class="row">
            <form method="post">
                <div class="six columns">
                    <label for="choixJour">Jour</label>
                    <input class="u-full-width" type="date" id="choixJour" name="choixJour" required>
                </div>
                <div class="six columns">
                    <input class="u-full-width button-primary" type="submit" name="submitChoixJour" value="Rechercher">
                </div>
            </form>
        </div>
        <div class="row">
            <?php if(isset($jourEmetteur) && $jourEmetteur && ($jourEmetteur->getConge() == 0)) { ?>
            <p>Jour prévu pour la date sélectionnée :</p>
                <p>Début : <?php echo $jourEmetteur->getDebutJournee() ?><br>
                Fin : <?php echo $jourEmetteur->getFinJournee() ?></p>
            <?php } ?>
        </div>
    </div>
    <div class="eight columns">

    </div>
</div>
<!-- Choisir un jour
Ca affiche sa journée de travail d'un côté, et de l'autre toutes les journées de travail des autres employés
Bouton a côté de chaque journée pour la choisir et demander l'échange (validation ?) -->
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 
