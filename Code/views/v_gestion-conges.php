<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<h1>Gestion des congés</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->
<h5>Demandes en attente</h5>
<?php if(!empty($listeCongesEnAttente)) {?>
<form method="post">
    <div class="six columns">
        <label for="idDemande">Demandes à traiter</label>
        <select name="idDemande" class="u-full-width">
            <?php 
                foreach ($listeCongesEnAttente as $elem) {
                    $emp = $listeEmployes[$elem->getIdEmploye()];
                    $debut = jourFrancais(date("N", strtotime($elem->getDebut())), false).date(" d/m/Y", strtotime($elem->getDebut()));
                    $fin = jourFrancais(date("N", strtotime($elem->getFin())), false).date(" d/m/Y", strtotime($elem->getFin()));
                    echo '<option value="'.$elem->getIdDemande().'">'.$emp->getPrenom().' '.$emp->getNom().' : '.$debut.' - '.$fin.'</option>';
                }
            ?>
        </select>
    </div>
    <div class="three columns">
        <input class="button-success u-full-width" type="submit" value="Accepter" name="accepter">
    </div>
    <div class="three columns">
        <input class="button-danger u-full-width" type="submit" value="Refuser" name="refuser">
    </div>
</form>
<?php } ?>
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 
