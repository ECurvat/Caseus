<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<h1>Congés</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->
<div class="row">
    <h5>Envoyer une demande de congés</h5>
    <form method="post">
        <div class="row">
            <div class="four columns">
                <label for="ajoutDebut">Début</label>
		        <input class="u-full-width" type="date" id="ajoutDebut" name="ajoutDebut" required>
            </div>
            <div class="four columns">
                <label for="ajoutFin">Fin</label>
		        <input class="u-full-width" type="date" id="ajoutFin" name="ajoutFin" required>
            </div>
            <div class="four columns">
                <input class="button-success u-full-width" type="submit" value="Envoyer" name="ajoutValider">
            </div>
        </div>
    </form>
</div>

<div class="row">
    <h5>Mes demandes</h5>
    <form method="post">
        <div class="row">
            <div class="six columns">
                <label for="listeAnnee">Année</label>
				<input class="u-full-width" type="text" value="<?php echo $annee ?>" id="listeAnnee" name="listeAnnee">
            </div>
            <div class="six columns">
                <input class="button-primary u-full-width" type="submit" value="Rechercher" name="rechercher">
            </div>
        </div>
    </form>
    <?php if($listeConges != false) {?>
    <div class="table-container">
        <form method="post" name="supprimerDispo">
            <table class="u-full-width">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Début</th>
                    <th>Fin</th>
                    <th>Date de la demande</th>
                    <th>Etat</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    
                    foreach ($listeConges as $elem) {
                        switch ($elem->getIdEtat()) {
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
                        echo '<td>'.$elem->getIdDemande().'</td>';
                        echo '<td>'.jourFrancais(date("N", strtotime($elem->getDebut())), true) . " " . date("d/m/Y", strtotime($elem->getDebut())) .'</td>';
                        echo '<td>'.jourFrancais(date("N", strtotime($elem->getFin())), true) . " " . date("d/m/Y", strtotime($elem->getFin())) .'</td>';
                        echo '<td>'.date("d/m/Y", strtotime($elem->getDateDemande())).'</td>';
                        echo '<td><span class="'.$status.'">'.$listeEtats[$elem->getIdEtat() - 1]->getNomEtat().'</span></td>';
                        echo '<td><button class="button u-full-width" type="submit" name="del'.$elem->getIdDemande().'"><i class="fa-regular fa-trash-can"></i></button></td>';
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
        </form>
    </div>
    <?php }?>
</div>

<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 
