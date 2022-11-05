<?php
if ($_SESSION['compte']->getPosition() != 'MANA') {
    header("Location: index.php");
    exit;
}
require_once(PATH_MODELS.$page.'.php');
require_once(PATH_VIEWS.$page.'.php'); 