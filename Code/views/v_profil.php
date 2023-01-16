<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<!--  Zone message d'alerte -->
<h1>Profil</h1>
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->
<table class="u-full-width">
<thead>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse Mail</th>
        <th>Date Embauche</th>
        <th>Adresse</th>
        <th>Code Postal</th>
        <th>Ville</th>
        <th>Heures Supplémentaires</th>
    </tr>
</thead>
<tbody>
    <?php
        echo '<tr>';
        echo '<td>'.$_SESSION['compte']->getNom().'</td>';
        echo '<td>'.$_SESSION['compte']->getPrenom().'</td>';
        echo '<td>'.$_SESSION['compte']->getMail().'</td>';
        echo '<td>'.$_SESSION['compte']->getEmbauche().'</td>';
        echo '<td>'.$_SESSION['compte']->getAdresse().'</td>';
        echo '<td>'.$_SESSION['compte']->getCodePostal().'</td>';
        echo '<td>'.$_SESSION['compte']->getVille().'</td>';
        if($_SESSION['compte']->getHeuresSup()==0) {
            echo '<td>'."Non".'</td>';
        } else {
            echo '<td>'."Oui".'</td>';
        }
        echo '</tr>';
    ?>
</tbody>
</table>
<div class="row">
    <form method="post">
        <input class="button-warning u-full-width" type="submit" value="Modifier" name="choixModifier">   
    </form>
</div>

<?php if (isset($_POST['choixModifier'])) {?>
<table class="u-full-width">
<thead>
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse Mail</th>
        <th>Date Embauche</th>
        <th>Adresse</th>
        <th>Code Postal</th>
        <th>Ville</th>
        <th>Heures Supplémentaires</th>
    </tr>
</thead>
<tbody>
<form method="post">   
    <tr>
        <td>
            <input class="u-full-width" type="text" id="modifNom" name="modifNom" value="<?php echo $_SESSION['compte']->getNom() ?>" required>
        </td>
        <td>
            <input class="u-full-width" type="text" id="modifPrenom" name="modifPrenom" value="<?php echo $_SESSION['compte']->getPrenom() ?>" required>
        </td>
        <td>
            <input class="u-full-width" type="email" id="modifMail" name="modifMail" value="<?php echo $_SESSION['compte']->getMail() ?>" required>
        </td>
        <td>
            <input class="u-full-width" type="date" value="<?php echo $_SESSION['compte']->getEmbauche() ?>" disabled>
        </td>
        <td>
            <input class="u-full-width" type="text" id="modifAdresse" name="modifAdresse" value="<?php echo $_SESSION['compte']->getAdresse() ?>" required>
        </td>
        <td>
            <input class="u-full-width" type="text" id="modifCP" name="modifCP" pattern="[0-9]*" value="<?php echo $_SESSION['compte']->getCodePostal() ?>" required>
        </td>
        <td>
            <input class="u-full-width" type="text" id="modifVille" name="modifVille" value="<?php echo $_SESSION['compte']->getVille() ?>" required>
        </td>
        <td>
            <?php
                if($_SESSION['compte']->getHeuresSup()==0) {
                    echo '<input type="checkbox" id="modifSup" name="modifSup">';
                } else {
                    echo '<input type="checkbox" id="modifSup" name="modifSup" checked>';
                }
            ?>
        </td>
    </tr>   
</tbody>
</table>
<div class="row">
    <input class="button-success u-full-width" type="submit" value="Valider" name="valider">  
</div>
</form>

<?php }?>
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php');