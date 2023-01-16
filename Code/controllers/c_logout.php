<!-- Contrôleur déconnexion -->
<?php
// Destruction de la session et retour vers la page de connexion
session_destroy();
header('Location: index.php?page=login');
exit();