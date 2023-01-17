<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<h1>Gestion des employés</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->
					
<div class="row">
    <form method="post">
        <div class="three columns">
            <input class="button-primary u-full-width" type="submit" value="Liste" name="choixListe">
        </div>
        <div class="three columns">
            <input class="button-success u-full-width" type="submit" value="Ajouter" name="choixAjouter">
        </div>
        <div class="three columns">
            <input class="button-warning u-full-width" type="submit" value="Modifier" name="choixModifier">
        </div>
        <div class="three columns">
            <input class="button-danger u-full-width" type="submit" value="Supprimer" name="choixSupprimer">
        </div>
    </form>
</div>
<?php if (isset($_POST['choixListe'])) { ?>
<h5>Liste des employés</h5>
<div class="table-container">
    <table class="u-full-width">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Adresse mail</th>
            <th>Embauche</th>
            <th>Adresse</th>
            <th>Position</th>
            <th>Heures sup</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listeEmployes as $emp) {
            echo '<tr>';
            echo '<td>'.$emp->getId().'</td>';
            echo '<td>'.$emp->getNom().'</td>';
            echo '<td>'.$emp->getPrenom().'</td>';
            echo '<td>'.$emp->getMail().'</td>';
            echo '<td>'.date("d/m/Y", strtotime($emp->getEmbauche())).'</td>';
            echo '<td>'.$emp->getAdresse().'<br>'.$emp->getCodePostal().' '.$emp->getVille().'</td>';
            echo '<td>'.$emp->getPosition().'</td>';
            ($emp->getHeuresSup() == '0') ? $val = '<td>Non</td>' : $val = '<td>Oui</td>';
            echo $val;
            echo '</tr>';
        }
        ?>
    </tbody>
    </table>
</div>
<?php } elseif (isset($_POST['choixAjouter'])) {?>
    <h5>Ajouter un employé</h5>
    L'employé recevra un email avec les informations dont il a besoin pour se connecter
    <form method="post">
        <div class="row">
            <div class="six columns">
                <label for="ajoutNom">Nom</label>
		        <input class="u-full-width" type="text" id="ajoutNom" name="ajoutNom" required>
            </div>
            <div class="six columns">
                <label for="ajoutPrenom">Prénom</label>
		        <input class="u-full-width" type="text" id="ajoutPrenom" name="ajoutPrenom" required>
            </div>
        </div>
        <div class="row">
            <div class="six columns">
                <label for="ajoutMail">Mail</label>
		        <input class="u-full-width" type="email" id="ajoutMail" name="ajoutMail" required>
            </div>
            <div class="six columns">
                <label for="ajoutDate">Date d'embauche</label>
		        <input class="u-full-width" type="date" id="ajoutDate" name="ajoutDate" required>
            </div>
        </div>
        <div class="row">
            <label for="ajoutAdresse">Adresse</label>
		    <input class="u-full-width" type="text" id="ajoutAdresse" name="ajoutAdresse" required>
        </div>
        <div class="row">
            <div class="six columns">
                <label for="ajoutCP">Code postal</label>
		        <input class="u-full-width" type="text" id="ajoutCP" name="ajoutCP" pattern="[0-9]*" required>
            </div>
            <div class="six columns">
                <label for="ajoutVille">Ville</label>
		        <input class="u-full-width" type="text" id="ajoutVille" name="ajoutVille" required>
            </div>
        </div>
        <div class="row">
            <div class="nine columns">
                <label for="ajoutPosition">Position</label>
                <select name="ajoutPosition" class="u-full-width">
                    <option value="POLY">Employé polyvalent</option>
                    <option value="ASSI">Assistant manager</option>
                    <option value="MANA">Manager</option>
                </select>
            </div>
            <div class="three columns">
                <label>
                    <input type="checkbox" id="ajoutSup" name="ajoutSup">
                    <span class="label-checkbox">Heures sup ok ?</span>
                </label>
            </div>
        </div>
        <input class="button-success u-full-width" type="submit" value="Ajouter" name="ajoutValider">
    </form>
<?php } elseif (isset($_POST['choixModifier']) || isset($_POST['modifierChoisir'])) {?>
    <h5>Modifier les informations d'un employé</h5>
    <div class="row">
        <form method="post">
            <label for="modifierChoixEmp">Employé</label>
            <select name="modifierChoixEmp" class="u-full-width">
                <?php foreach ($listeEmployes as $emp) {
                    if ($emp->getId() == $_POST['modifierChoixEmp']) echo '<option selected value="'.$emp->getId().'">'.$emp->getId().' - '.$emp->getPrenom().' '.$emp->getNom().'</option>';
                    else echo '<option value="'.$emp->getId().'">'.$emp->getId().' - '.$emp->getPrenom().' '.$emp->getNom().'</option>';
                }?>
            </select>
            <input class="button-primary u-full-width" type="submit" value="Choisir" name="modifierChoisir">
        </form>
    </div>
    <?php if (isset($_POST['modifierChoisir'])) {?>
        <div class="infosEmp">
                <label for="modifId">Id</label>
                <input type="text" id="modifId" name="modifId" value="<?php echo $empModif->getId() ?>"disabled>
                <label for="modifNom">Nom</label>
                <input type="text" id="modifNom" name="modifNom" value="<?php echo $empModif->getNom() ?>"disabled>
                <label for="modifPrenom">Prénom</label>
                <input type="text" id="modifPrenom" name="modifPrenom" value="<?php echo $empModif->getPrenom() ?>"disabled>
                <label for="modifEmail">Email</label>
                <input type="text" id="modifEmail" name="modifEmail" value="<?php echo $empModif->getMail() ?>"disabled>
        </div>
        <form method="post">
            <label for="modifierMDP">Réinitialiser le mot de passe</label>
            <p>Ceci enverra un nouveau mot de passe à l'adresse mail actuelle de l'employé séléctionné</p>
            <button class="button-warning u-full-width" type="submit" value=<?php echo($_POST['modifierChoixEmp']) ?> name="modifierMDP">Confirmer</button>
        </form>
    <?php }?>
<?php } elseif (isset($_POST['choixSupprimer'])) {?>
    <h5>Supprimer un employé</h5>
    <div class="row">
        <form method="post">
            <label for="supprimerEmp">Employé</label>
            <select name="supprimerEmp" class="u-full-width">
                <?php foreach ($listeEmployes as $emp) {
                    echo '<option value="'.$emp->getId().'">'.$emp->getId().' - '.$emp->getPrenom().' '.$emp->getNom().'</option>';
                }?>
            </select>
            <input class="button-danger u-full-width" type="submit" value="Supprimer" name="supprimerValider">
        </form>
    </div>
<?php } if (isset($_POST['ajoutValider'])) {?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script type="text/javascript">
    (function(){
        emailjs.init("ai91zG73bzke7Otd4");
        var params = {
            to_name: "<?php echo $_POST['ajoutPrenom']; ?>",
            to_email: "<?php echo $_POST['ajoutMail']; ?>",
            mdp: "<?php echo $newMDP; ?>"
        };
        emailjs.send('service_yuqvdpk', 'template_8ekmhcr', params);
    })();
</script>
<?php } if (isset($_POST['modifierMDP'])) {?>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
<script type="text/javascript">
    (function(){
        emailjs.init("ai91zG73bzke7Otd4");
        var params = {
            to_name: "<?php echo $empModif->getPrenom(); ?>",
            to_email: "<?php echo $empModif->getMail(); ?>",
            mdp: "<?php echo $newMDP; ?>"
        };
        emailjs.send('service_yuqvdpk', 'template_ysf4tn9', params);
    })();
</script>
<?php } ?>

<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 