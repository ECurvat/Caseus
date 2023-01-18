<?php
 
const DEBUG = true;

// Accès base de données
const BD_HOST = 'localhost';
const BD_DBNAME = 'jeu_reduit';
const BD_USER = 'root';
const BD_PWD = 'root';

// Langue du site
const LANG ='FR-fr';

//dossiers racines du site
define('PATH_CONTROLLERS','./controllers/c_');
define('PATH_ENTITY','./entities/');
define('PATH_ASSETS','./assets/');
define('PATH_LIB','./lib/');
define('PATH_MODELS','./models/');
define('PATH_MODELS_DAO','./models/DAO/');
define('PATH_VIEWS','./views/v_');
define('PATH_TEXTES','./languages/');

//sous dossiers
define('PATH_CSS', PATH_ASSETS.'css/');
define('PATH_IMAGES', PATH_ASSETS.'images/');
define('PATH_SCRIPTS', PATH_ASSETS.'scripts/');

//fichiers
define('PATH_LOGO', PATH_IMAGES.'logo.png');
define('PATH_MENU', PATH_VIEWS.'menu.php');
