<?php
$positionCourante = $_SESSION['compte']->getPosition();
?>
<!-- Menu du site -->
<navbar>
    <img src="<?= PATH_IMAGES ?>logo.svg" id="logo">
    <div class="category <?php echo ($page=='accueil' ? "active":'')?>"><a href="index.php">Accueil</a></div>
    <?php if (($positionCourante == 'POLY') || ($positionCourante == 'ASSI') || ($positionCourante == 'MANA')): ?>
    <div class="category">Planning</div>
        <div class="subcategory <?php echo ($page=='horaires' ? "active":'')?>"><a href="index.php?page=horaires">Horaires</a></div>
        <div class="subcategory <?php echo ($page=='disponibilites' ? "active":'')?>"><a href="index.php?page=disponibilites">Disponibilités</a></div>
        <div class="subcategory <?php echo ($page=='echanges' ? "active":'')?>">Échanges</div>
        <div class="subcategory <?php echo ($page=='conges' ? "active":'')?>"><a href="index.php?page=conges">Congés</a></div>
    <?php endif; ?>
    <?php if (($positionCourante == 'ASSI') || ($positionCourante == 'MANA')): ?>
    <div class="category">Gestion</div>
        <div class="subcategory <?php echo ($page=='gestion-stock' ? "active":'')?>"><a href="index.php?page=gestion-stock">Stock</a></div>
        <div class="subcategory <?php echo ($page=='gestion-echanges' ? "active":'')?>">Échanges</div>
    <?php endif; ?>
    <?php if ($positionCourante == 'MANA'): ?>
        <div class="subcategory <?php echo ($page=='gestion-horaires' ? "active":'')?>"><a href="index.php?page=gestion-horaires">Horaires</a></div>
        <div class="subcategory <?php echo ($page=='gestion-conges' ? "active":'')?>"><a href="index.php?page=gestion-conges">Congés</a></div>
        <div class="subcategory <?php echo ($page=='gestion-employes' ? "active":'')?>"><a href="index.php?page=gestion-employes">Employés</a></div>
        <div class="subcategory <?php echo ($page=='statistiques' ? "active":'')?>">Statistiques</div>
    <?php endif; ?>
</navbar>