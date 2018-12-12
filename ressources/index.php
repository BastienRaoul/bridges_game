<?php
session_start();

header('charset=utf-8');

require "config/config.php";
require PATH_CONTROLEUR . "/routeur.php";

$routeur = new Routeur();
$routeur->routerRequete();
?>
