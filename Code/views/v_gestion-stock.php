<?php
//  En tête de page
?>
<?php require_once(PATH_VIEWS.'header.php');?>
<h1>Gestion stock</h1>
<!--  Zone message d'alerte -->
<?php require_once(PATH_VIEWS.'alert.php');?>

<!--  Début de la page -->
<div class="row">
    <form method="post">
        <div class="four columns">
            <input class="button-primary u-full-width" type="submit" value="Liste des produits" name="choixListe">
        </div>
        <div class="four columns">
            <input class="button-success u-full-width" type="submit" value="Entrer une livraison" name="choixEntrer">
        </div>
        <div class="four columns">
        <input class="button-danger u-full-width" type="submit" value="Faire la pesée" name="choixPesee">
        </div>
    </form>
</div>

<?php if (isset($_POST['choixListe'])) { ?>
<table class="u-full-width">
    <thead>
        <tr>
            <th>Id</th>
            <th>Dénomination</th>
            <th>Quantité en stock</th>
            <th>Unite</th>
            <th>Dernière modification</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($listeProduits as $produit) {
            echo '<tr>';
            echo '<td>'.$produit->getIdProduit().'</td>';
            echo '<td>'.$produit->getDenomination().'</td>';
            echo '<td>'.$produit->getQteEnStock().'</td>';
            echo '<td>'.$correspUnites[$produit->getIdUnite()].'</td>';
            echo '<td>'.$produit->getDerniereModif().'</td>';
            echo '</tr>';
        }?>
    </tbody>
</table>
<?php } else if (isset($_POST['choixEntrer'])) {?>
<div class="row">
        Nombre de produit(s) dans la livraison : <span id="nbProduits">0</span>
        <input class="button-success" type="button" value="+" name="entreeAjouterProduit">
</div>
<form method="post" id="entreeLivraison">
    <fieldset id="exempleAjout">
        <div class="row">
            <div class="five columns">
                <label id="entreeNomProduit" for="entreeNomProduit">Produit</label>
                <select class="u-full-width" id="entreeNomProduit" name="entreeNomProduit">
                <?php foreach ($listeProduits as $produit) {
                echo '<option value="'.$produit->getIdProduit().'">'.$produit->getDenomination().'</option>';
                }?>
                </select>
            </div>
            <div class="five columns">
                <label id="entreeQteProduit" for="entreeQteProduit">Quantité</label>
                <input type="number" class="u-full-width" name="entreeQteProduit" id="entreeQteProduit" min="0">
            </div>
            <div class="two columns">
                <label for="entreeEnleverProduit">Retirer le produit</label>
                <button class="button-warning u-full-width" type="button">-</button>
            </div>
        </div>
    </fieldset>
    <input class="button-primary u-full-width" type="submit" value="Valider" name="entreeValider">
</form>
<?php }?>
<script src="assets/scripts/gestion-stock.js"></script>
<!--  Fin de la page -->

<!--  Pied de page -->
<?php require_once(PATH_VIEWS.'footer.php'); 
