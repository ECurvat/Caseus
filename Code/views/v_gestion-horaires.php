<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<h1>Gestion des horaires</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->
<h5>Trouver les disponibilités par mois</h5>
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
    if(!empty($listeDispos)) {
?>
<table class="u-full-width">
<thead>
  <tr>
    <th>Id employé</th>
    <?php 
        foreach ($datesTriees as $elem) {
            echo '<th>'.date("d-m-Y",strtotime($elem)).'</th>';
        }
    ?>
  </tr>
</thead>
<tbody>
    <?php
        $i = 0;
        while($i < count($idEmpTries)) {
            echo '<tr>';
            echo '<td>'.$idEmpTries[$i].'</td>';// id de l'employé
            // for qui parcourt tous les jours où il y a des dispos 
            foreach ($datesTriees as $date) {
                echo '<td>';
                foreach ($listeDispos as $dispo) {
                    if(($dispo->getIdEmploye() == $idEmpTries[$i]) and (date("Y-m-d",strtotime($dispo->getDebutDispo())) == $date)) {
                        echo date("H:i",strtotime($dispo->getDebutDispo())).' - '.date("H:i",strtotime($dispo->getFinDispo()));
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
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 