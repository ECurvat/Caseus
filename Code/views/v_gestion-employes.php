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
<table class="u-full-width">
<thead>
    <tr>
        <th>Id</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse mail</th>
        <th>Date</th>
        <th>Adresse</th>
        <th>Position</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($listeEmployes as $emp) {
        echo '<tr>';
        echo '<td>'.$emp->getId().'</td>';
        echo '<td>'.$emp->getNom().'</td>';
        echo '<td>'.$emp->getPrenom().'</td>';
        echo '<td>'.$emp->getMail().'</td>';
        echo '<td>'.$emp->getEmbauche().'</td>';
        echo '<td>'.$emp->getAdresse().'<br>'.$emp->getCodePostal().', '.$emp->getVille().'</td>';
        echo '<td>'.$emp->getPosition().'</td>';
        echo '</tr>';
    }
    ?>
</tbody>
</table>
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
            <label for="ajoutPosition">Position</label>
			<select name="ajoutPosition" class="u-full-width">
                <option value="POLY">Employé polyvalent</option>
                <option value="ASSI">Assistant manager</option>
                <option value="MANA">Manager</option>
            </select>
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
        <form method="post">
            <label for="modifierMDP">Réinitialiser le mot de passe</label>
            <p>Ceci enverra un nouveau mot de passe à l'adresse mail actuelle de l'employé séléctionné</p>
            <input class="button-warning u-full-width" type="submit" value="Confirmer" name="modifierMDP">
            <hr>
            <label for="modifierMsg">Envoyer un message</label>
            <textarea class="u-full-width" placeholder="Bonjour …" name="modifierMsg"></textarea>
            <input class="button-warning u-full-width" type="submit" value="Envoyer" name="modifierEnvoyer">
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
<?php }?>
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 