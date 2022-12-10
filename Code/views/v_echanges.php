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
        <?php if (isset($joursEchangeables) && !empty($joursEchangeables)) {?>
            <form method="post" name="echangerJour">
                <table class="u-full-width">
                    <thead>
                        <tr>
                            <th>Id Jour</th>
                            <th>Id Planning</th>
                            <th>Debut</th>
                            <th>Fin</th>
                            <th>Sélectionner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($joursEchangeables as $elem) {
                            echo '<tr>';
                            echo '<td>'.$elem->getIdJour().'</td>';
                            echo '<td>'.$elem->getIdPlanning().'</td>';
                            echo '<td>'.$elem->getDebutJournee().'</td>';
                            echo '<td>'.$elem->getFinJournee().'</td>';
                            echo '<td><button class="button-success" type="submit" name="echange" value="'.$jourEmetteur->getIdJour().'|'.$elem->getIdJour().'"><i class="fa-solid fa-handshake"></i></button></td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </form>
         <?php } ?>
    </div>
</div>
<div class="row">
    <div class="six columns">
    <h5>Demandes que j'ai envoyées</h5>
    <form method="post">
        <div class="row">
            <div class="six columns">
                <label for="anneeEnvoi">Année</label>
                <input class="u-full-width" type="text" value="<?php echo $anneeEnvoi ?>" id="anneeEnvoi" name="anneeEnvoi" required>
            </div>
            <div class="six columns">
                <input class="button-success u-full-width" type="submit" value="Rechercher" name="rechercherEnvoi">
            </div>
        </div>
    </div>
    <div class="six columns">
    <h5>Demandes qu'on m'a envoyées</h5>
    <form method="post">
        <div class="row">
            <div class="six columns">
                <label for="anneeRecep">Année</label>
                <input class="u-full-width" type="text" value="<?php echo $anneeRecep ?>" id="anneeRecep" name="anneeRecep" required>
            </div>
            <div class="six columns">
                <input class="button-success u-full-width" type="submit" value="Rechercher" name="rechercherRecep">
            </div>
        </div>
    </div>
    </div>
</div>
<!-- Choisir un jour
Ca affiche sa journée de travail d'un côté, et de l'autre toutes les journées de travail des autres employés
Bouton a côté de chaque journée pour la choisir et demander l'échange (validation ?) -->
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 
