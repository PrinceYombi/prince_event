<?php

/**
 * CONSTANTES
 */
define("ROOT", dirname(__DIR__));
define("SP", DIRECTORY_SEPARATOR);
define("SRC", ROOT.SP."src");
define("VIEW", ROOT.SP."view");
define("MODEL", ROOT.SP."model");
define("BASE_URL", dirname(dirname($_SERVER['SCRIPT_NAME'])));

require_once SRC.SP."functions.php";
require_once MODEL.SP."config.php";
require_once MODEL.SP."dataLayer.model.php";

$model = new DataLayer();

?>