<?php
session_start();
require_once("include.php");
verifParams();

if (!isset($_SERVER['PATH_INFO'])) {
    
    $_SERVER['PATH_INFO'] = "accueil";
}

$_SERVER['PATH_INFO'] = trim($_SERVER['PATH_INFO'], "/");
$url = explode("/", $_SERVER['PATH_INFO']);

$action = $url[0];
//print_r($_SERVER); exit();

$root = array(
    "accueil","inscription","actionInscription","event","connexion","deconnexion","profil","updateProfil","updateAction",
    "addEvent","addEventAction", "voir", "reservation","supprimer","about"
);

if (!in_array($action, $root)) {
    
    $title = "Page ".ucwords($action);
    $content = "URL INTROUVABLE !";
}else{
    $title = "Page ".ucwords($action);
    $function = "display".ucwords($action);
    $content = $function();
}

require_once VIEW.SP."vue.php";
?>