<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS . 'header.php'); ?>
<h1>Echanges</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS . 'alert.php'); ?>

<!--  Début de la page -->
<h5>Créer un échange</h5>
<div class="row">
    <div class="four columns">
        <div class="row">
            <form method="post">
                <div class="six columns">
                    <label for="choixJour">Jour</label>
                    <input class="u-full-width" type="date" id="choixJour" name="choixJour" min="<?php echo date("Y-m-d");
                                                                                                    ?>" required>
                </div>
                <div class="six columns">
                    <input class="u-full-width button-primary" type="submit" name="submitChoixJour" value="Rechercher">
                </div>
            </form>
        </div>
        <div class="row">
            <?php if (isset($jourEmetteur) && $jourEmetteur && ($jourEmetteur->getIdService() != 'y')) { ?>
                <p>Jour prévu pour la date sélectionnée :</p>
                <p>Début : <?php echo $listeServicesIndex[$jourEmetteur->getIdService()]->getDebut() ?><br>
                    Fin : <?php echo $listeServicesIndex[$jourEmetteur->getIdService()]->getFin() ?></p>
            <?php } ?>
        </div>
    </div>
    <div class="eight columns">
        <?php if (isset($joursEchangeables) && !empty($joursEchangeables)) { ?>
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
                            echo '<td>' . $elem->getIdJour() . '</td>';
                            echo '<td>' . $elem->getIdPlanning() . '</td>';
                            echo '<td>' . $listeServicesIndex[$elem->getIdService()]->getDebut() . '</td>';
                            echo '<td>' . $listeServicesIndex[$elem->getIdService()]->getFin() . '</td>';
                            echo '<td><button class="button-success" type="submit" name="echange" value="' . $jourEmetteur->getIdJour() . '|' . $elem->getIdJour() . '"><i class="fa-solid fa-handshake"></i></button></td>';
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
        <h5>Demandes envoyées</h5>
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
            <div class="row">
                <table class="u-full-width">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Actuel</th>
                            <th>Souhaité</th>
                            <th>Etat</th>
                            <th>Supprimer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($listeEnvoisPropre); $i++) {
                            switch ($listeEnvoisPropre[$i][3]->getIdEtat()) {
                                case 3:
                                    $status = "warning";
                                    break;
                                case 4:
                                    $status = "success";
                                    break;
                                case 5:
                                    $status = "danger";
                                    break;
                                default:
                                    break;
                            }
                            echo '<tr>';
                            echo '<td>' . $listeEnvoisPropre[$i][0] . '</td>';
                            if ($listeEnvoisPropre[$i][3]->getIdEtat() == 4) echo '<td colspan="2">Nouveau jour : <br>' . $listeEnvoisPropre[$i][1]->getDebut() . ' - ' . $listeEnvoisPropre[$i][1]->getFin() . '</td>';
                            else {
                                echo '<td>' . $listeEnvoisPropre[$i][1]->getDebut() . '<br>' . $listeEnvoisPropre[$i][1]->getFin() . '</td>';
                                echo '<td>' . $listeEnvoisPropre[$i][2]->getDebut() . '<br>' . $listeEnvoisPropre[$i][2]->getFin() . '</td>';
                            }
                            echo '<td><span class="' . $status . '">' . $listeEnvoisPropre[$i][3]->getNomEtat() . '</span></td>';
                            echo '<td><button class="button button-warning" type="submit" name="supprimer" value="' . $listeEnvoisPropre[$i][4] . '"><i class="fa-regular fa-trash-can"></i></button></td>';
                            echo '</tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
    </div>
    <div class="six columns">
        <h5>Demandes reçues</h5>
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
            <div class="row">
                <table class="u-full-width">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Actuel</th>
                            <th>Proposé</th>
                            <th>Accepter</th>
                            <th>Refuser</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($listeRecusPropre); $i++) {
                            echo '<tr>';
                            echo '<td>' . $listeRecusPropre[$i][0] . '</td>';
                            echo '<td>' . $listeRecusPropre[$i][1]->getDebut() . '<br>' . $listeRecusPropre[$i][1]->getFin() . '</td>';
                            echo '<td>' . $listeRecusPropre[$i][2]->getDebut() . '<br>' . $listeRecusPropre[$i][2]->getFin() . '</td>';
                            echo '<td><button class="button button-success" type="submit" name="accepter" value="' . $listeRecusPropre[$i][3] . '"><i class="fa-regular fa-circle-check"></i></button></td>';
                            echo '<td><button class="button button-danger" type="submit" name="refuser" value="' . $listeRecusPropre[$i][3] . '"><i class="fa-regular fa-circle-xmark"></i></button></td>';
                            echo '</tr>';
                        } ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>
</div>
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS . 'footer.php');
